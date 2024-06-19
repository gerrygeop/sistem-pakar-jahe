<?php

class RespondenModel
{

    private $db;
    private $tbl_responden = 'responden';
    private $tbl_kriteria = 'kriteria';
    private $tbl_solusi = 'solusi';
    private $tbl_hasil = 'hasil';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM ' . $this->tbl_responden);
        return $this->db->resultSet();
    }

    public function getKriteria()
    {
        $this->db->query('SELECT * FROM ' . $this->tbl_kriteria . ' ORDER BY tingkatan');
        return $this->db->resultSet();
    }

    protected function getCF()
    {
        $this->db->query('SELECT CF FROM ' . $this->tbl_kriteria);
        return $this->db->resultSet();
    }

    public function tambahResponden($data)
    {
        $user_id = intval($_SESSION['user_id']);
        $record = uniqid();
        $_SESSION['record'] = $record;

        foreach ($data as $kriteria_id => $rcf_string) {

            $r_cf = (float) $rcf_string;
            $CF_string = $this->getCFByID($kriteria_id);
            $CF = (float) $CF_string['CF'];
            $nilai_H = $CF * $r_cf;

            $query = "INSERT INTO " . $this->tbl_responden . " (kriteria_id, user_id, r_cf, H, record) VALUES (:kriteria_id, :user_id, :r_cf, :H, :record)";
            $this->db->query($query);

            $this->db->bind('kriteria_id', $kriteria_id);
            $this->db->bind('user_id', $user_id);
            $this->db->bind('r_cf', $r_cf);
            $this->db->bind('H', $nilai_H);
            $this->db->bind('record', $record);
            $this->db->execute();
        }

        $data['nilaiH'] = $this->hasilCF();
        $data['solusi'] = $this->getSolusi();
        $this->simpanHasil($data['nilaiH'], $data['solusi']);

        $result['rowCount'] = $this->db->rowCount();
        $result['record'] = $record;
        return $result;
    }

    protected function getCFByID($id)
    {
        $this->db->query('SELECT CF FROM ' . $this->tbl_kriteria . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    protected function getNilaiHByTingkatan($solusi_id_string)
    {
        $solusi_id = intval($solusi_id_string);
        $user_id = intval($_SESSION['user_id']);

        $query = "SELECT H FROM `" . $this->tbl_kriteria . "` 
        JOIN `" . $this->tbl_responden . "` 
        ON " . $this->tbl_kriteria . ".id = " . $this->tbl_responden . ".kriteria_id 
        WHERE " . $this->tbl_responden . ".user_id=:user_id 
        AND tingkatan=:solusi_id 
        AND " . $this->tbl_responden . ".record=:record";

        $this->db->query($query);
        $this->db->bind('user_id', $user_id);
        $this->db->bind('record', $_SESSION['record']);
        $this->db->bind('solusi_id', $solusi_id);
        return $this->db->resultSet();
    }

    protected function getSolusi()
    {
        $this->db->query('SELECT * FROM ' . $this->tbl_solusi);
        return $this->db->resultSet();
    }

    public function hasilCF()
    {
        $solusi = $this->getSolusi();
        foreach ($solusi as $key_solusi => $value_solusi) {

            $nilai_H = $this->getNilaiHByTingkatan($value_solusi['id']);

            $hcf = 0;
            foreach ($nilai_H as $key_H => $value) {
                if ($key_H === array_key_first($nilai_H)) {
                    $hcf = $value['H'];
                } else {
                    $hcf = $hcf + $value['H'] * (1 - $hcf);
                }
            }

            $hasilAkhirSolusi[$key_solusi] = $hcf;
            unset($hcf);
        }

        $tempHasilAkhir = '';
        foreach ($hasilAkhirSolusi as $index => $nilaiAkhir) {
            if ($index === array_key_first($hasilAkhirSolusi)) {
                $tempHasilAkhir = $nilaiAkhir;
            } else {
                $tempHasilAkhir = $tempHasilAkhir + $nilaiAkhir;
            }

            $sumHasil = $tempHasilAkhir;
        }

        $bagiTiga = $sumHasil / count($hasilAkhirSolusi);
        unset($sumHasil);

        $bagiSeratus = $bagiTiga * 100;
        unset($bagiTiga);

        unset($hasilAkhirSolusi);
        return $bagiSeratus;
    }

    public function simpanHasil($nilaiH, $solusi)
    {
        $solusi_id = $this->dapatkanLevelKriteria($nilaiH, $solusi);
        $user_id = intval($_SESSION['user_id']);

        $query = "INSERT INTO " . $this->tbl_hasil . " (user_id, solusi_id, nilai_akhir, record) 
        VALUES (:user_id, :solusi_id, :nilai_akhir, :record)";

        $this->db->query($query);

        $this->db->bind('user_id', $user_id);
        $this->db->bind('solusi_id', $solusi_id);
        $this->db->bind('nilai_akhir', $nilaiH);
        $this->db->bind('record', $_SESSION['record']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    protected function dapatkanLevelKriteria($nilaiH, $solusi)
    {
        foreach ($solusi as $value) {
            if (
                $nilaiH >= $value['min'] &&
                $nilaiH <= $value['max']
            ) {
                return $value['id'];
            }
        }
    }

    public function getRiwayat()
    {
        $user_id = intval($_SESSION['user_id']);

        $query = "SELECT * FROM " . $this->tbl_hasil . " WHERE user_id=:user_id ORDER BY timestamps DESC";
        $this->db->query($query);
        $this->db->bind('user_id', $user_id);

        return $this->db->resultSet();
    }

    public function detailRiwayat($record)
    {
        $query = "SELECT * FROM " . $this->tbl_hasil . " WHERE record=:record";
        $this->db->query($query);
        $this->db->bind('record', $record);

        return $this->db->single();
    }

    public function detailRiwayatPerhitungan($record)
    {
        $solusi = $this->getSolusi();
        foreach ($solusi as $key_solusi => $value_solusi) {

            $nilai_H = $this->getNilaiHByTingkatanAndRecord($value_solusi['id'], $record);
            $hcf = 0;
            foreach ($nilai_H as $key_H => $value) {
                if ($key_H === array_key_first($nilai_H)) {
                    $hcf = $value['H'];
                } else {
                    $hcf = $hcf + $value['H'] * (1 - $hcf);
                    $combin[$value_solusi['id']][] = $hcf;
                }
            }

            $hasilAkhirSolusi[$key_solusi] = $hcf;
            unset($hcf);
        }

        $tempHasilAkhir = 0;
        foreach ($hasilAkhirSolusi as $index => $nilaiAkhir) {
            if ($index === array_key_first($hasilAkhirSolusi)) {
                $tempHasilAkhir = $nilaiAkhir;
            } else {
                $tempHasilAkhir = $tempHasilAkhir + $nilaiAkhir;
            }

            $sumHasil = $tempHasilAkhir;
        }

        $bagiTiga = $sumHasil / count($hasilAkhirSolusi);
        unset($sumHasil);

        $bagiSeratus = $bagiTiga * 100;

        unset($bagiTiga);
        unset($hasilAkhirSolusi);

        $hasil['combin'] = $combin;
        $hasil['hasilBagiSeratus'] = $bagiSeratus;
        return $hasil;
    }

    protected function getNilaiHByTingkatanAndRecord($id_solusi_string, $record)
    {
        $solusi_id = intval($id_solusi_string);

        $query = "SELECT H FROM `" . $this->tbl_kriteria . "` 
        JOIN `" . $this->tbl_responden . "` 
        ON " . $this->tbl_kriteria . ".id = " . $this->tbl_responden . ".kriteria_id 
        WHERE " . $this->tbl_responden . ".user_id=:user_id 
        AND " . $this->tbl_responden . ".record=:record AND tingkatan=:solusi_id";

        $this->db->query($query);
        $this->db->bind('user_id', $_SESSION['user_id']);
        $this->db->bind('solusi_id', $solusi_id);
        $this->db->bind('record', $record);
        return $this->db->resultSet();
    }

    public function getCFAndHResponden($record)
    {
        $query = "SELECT r_cf, H, " . $this->tbl_kriteria . ".kriteria, " . $this->tbl_kriteria . ".tingkatan 
        FROM `" . $this->tbl_responden . "` 
        JOIN `" . $this->tbl_kriteria . "` 
        ON " . $this->tbl_responden . ".kriteria_id = " . $this->tbl_kriteria . ".id 
        WHERE " . $this->tbl_responden . ".user_id=:user_id AND " . $this->tbl_responden . ".record=:record";

        $this->db->query($query);
        $this->db->bind('user_id', $_SESSION['user_id']);
        $this->db->bind('record', $record);
        return $this->db->resultSet();
    }
}
