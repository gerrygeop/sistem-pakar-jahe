<?php

class Responden extends Controller
{

    public function index()
    {
        $data['judul'] = 'Konsultasi';
        $data['getKriteria'] = $this->model('RespondenModel')->getKriteria();


        $this->view('templates/header', $data);
        $this->view('responden/index', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        $result = $this->model('RespondenModel')->tambahResponden($_POST);
        if ($result['rowCount']) {
            Flasher::setFlash('Berhasil', 'Ditambahkan', 'success');
            header('Location: ' . BASEURL . '/responden/detail/' . $result['record']);
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/responden');
            exit;
        }
    }

    public function riwayat()
    {
        $data['judul'] = 'Riwayat Konsultasi';
        $data['riwayat'] = $this->model('RespondenModel')->getRiwayat();
        $data['solusi'] = $this->model('SolusiModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('responden/riwayat', $data);
        $this->view('templates/footer');
    }

    public function detail($record)
    {
        $data['judul'] = 'Detail Konsultasi';
        $data['riwayatResponden'] = $this->model('RespondenModel')->getCFAndHResponden($record);
        $data['nilaiH'] = $this->model('RespondenModel')->detailRiwayatPerhitungan($record);
        $data['solusi'] = $this->model('SolusiModel')->getAll();

        $data['h'] = $this->checkNilaiH($data['nilaiH'], $data['solusi']);

        $this->view('templates/header', $data);
        $this->view('responden/detail', $data);
        $this->view('templates/footer');
    }

    protected function checkNilaiH($nilaiH, $solusi)
    {
        if ($nilaiH['hasilBagiSeratus'] < 34) {
            return [
                'tingkat_kecocokan' => $solusi[0]['tingkat_kecocokan'],
                'solusi' => $solusi[0]['solusi'],
                'class' => 'bg-warning',
                'style' => ''
            ];
        }

        if ($nilaiH['hasilBagiSeratus'] >= 34 && $nilaiH['hasilBagiSeratus'] <= 68) {
            return [
                'tingkat_kecocokan' => $solusi[1]['tingkat_kecocokan'],
                'solusi' => $solusi[1]['solusi'],
                'class' => 'bg-orange text-white',
                'style' => 'style="background-color: #ff8906;"'
            ];
        }

        if ($nilaiH['hasilBagiSeratus'] > 68) {
            return [
                'tingkat_kecocokan' => $solusi[2]['tingkat_kecocokan'],
                'solusi' => $solusi[2]['solusi'],
                'class' => 'bg-danger text-white',
                'style' => ''
            ];
        }
    }
}
