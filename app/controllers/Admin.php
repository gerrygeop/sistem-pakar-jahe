<?php

class Admin extends Controller
{

    public function laporanDataUser()
    {
        $data['judul'] = 'Laporan Data User';
        $data['laporan'] = $this->model('AdminModel')->getAllRiwayat();
        $data['solusi'] = $this->model('SolusiModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('admin/laporan', $data);
        $this->view('templates/footer');
    }

    public function detail($user_id, $record)
    {
        $data['judul'] = 'Laporan Data User';
        $data['laporan'] = $this->model('AdminModel')->detailRiwayat($user_id, $record);
        $data['riwayatResponden'] = $this->model('AdminModel')->getCFAndHResponden($user_id, $record);
        $data['nilaiH'] = $this->model('AdminModel')->detailRiwayatPerhitungan($user_id, $record);
        $data['solusi'] = $this->model('SolusiModel')->getAll();
        $data['mhs'] = $this->model('UserModel')->getUserByNIM($data['laporan']['user_id']);

        $this->view('templates/header', $data);
        $this->view('admin/detail-laporan', $data);
        $this->view('templates/footer');
    }

    public function delete($user_id, $record)
    {
        if ($this->model('AdminModel')->hapusHasilResponden($user_id, $record) > 0 && $this->model('AdminModel')->hapusResponden($user_id, $record) > 0) {
            Flasher::setFlash('Berhasil', 'Dihapus', 'success');
            header('Location: ' . BASEURL . '/admin/laporanDataUser');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Dihapus', 'danger');
            header('Location: ' . BASEURL . '/admin/laporanDataUser');
            exit;
        }
    }
}
