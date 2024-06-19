<?php

class AdminModel
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

    public function getAllRiwayat()
    {
        $query = "SELECT hasil.id, hasil.user_id, hasil.solusi_id, hasil.nilai_akhir, hasil.timestamps, hasil.record, users.username 
        FROM " . $this->tbl_hasil . "
        JOIN users 
        ON hasil.user_id = users.id
        ORDER BY timestamps DESC";

        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function detailRiwayat($user_id, $record)
    {
        $query = "SELECT * FROM " . $this->tbl_hasil . " WHERE user_id=:user_id AND record=:record";
        $this->db->query($query);
        $this->db->bind('user_id', $user_id);
        $this->db->bind('record', $record);

        return $this->db->single();
    }

    public function getCFAndHResponden($user_id, $record)
    {
        $query = "SELECT r_cf, H, " . $this->tbl_kriteria . ".kriteria, " . $this->tbl_kriteria . ".tingkatan 
        FROM `" . $this->tbl_responden . "` 
        JOIN `" . $this->tbl_kriteria . "` 
        ON " . $this->tbl_responden . ".kriteria_id = " . $this->tbl_kriteria . ".id 
        WHERE `" . $this->tbl_responden . "`.user_id=:user_id 
        AND `" . $this->tbl_responden . "`.record=:record";

        $this->db->query($query);
        $this->db->bind('user_id', $user_id);
        $this->db->bind('record', $record);
        return $this->db->resultSet();
    }

    public function detailRiwayatPerhitungan($user_id, $record)
    {
        $solusi = $this->getSolusi();
        foreach ($solusi as $key_solusi => $value_solusi) {

            $nilai_H = $this->getNilaiHByTingkatanAndRecord($value_solusi['id'], $user_id, $record);
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

    protected function getNilaiHByTingkatanAndRecord($id_solusi_string, $user_id, $record)
    {
        $solusi_id = intval($id_solusi_string);
        $query = "SELECT H FROM `" . $this->tbl_kriteria . "` 
        JOIN `" . $this->tbl_responden . "` 
        ON " . $this->tbl_kriteria . ".id = " . $this->tbl_responden . ".kriteria_id 
        WHERE " . $this->tbl_responden . ".user_id=:user_id 
        AND " . $this->tbl_responden . ".record=:record 
        AND tingkatan=:solusi_id";

        $this->db->query($query);
        $this->db->bind('user_id', $user_id);
        $this->db->bind('solusi_id', $solusi_id);
        $this->db->bind('record', $record);
        return $this->db->resultSet();
    }

    protected function getSolusi()
    {
        $this->db->query('SELECT * FROM ' . $this->tbl_solusi);
        return $this->db->resultSet();
    }

    public function hapusHasilResponden($user_id, $record)
    {
        $query = "DELETE FROM " . $this->tbl_hasil . " WHERE user_id=:user_id AND record=:record";

        $this->db->query($query);
        $this->db->bind('user_id', $user_id);
        $this->db->bind('record', $record);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusResponden($user_id, $record)
    {
        $query = "DELETE FROM " . $this->tbl_responden . " WHERE user_id=:user_id AND record=:record";

        $this->db->query($query);
        $this->db->bind('user_id', $user_id);
        $this->db->bind('record', $record);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
