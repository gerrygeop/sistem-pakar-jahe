<?php

class Kriteria extends Controller
{

    public function index()
    {
        $data['judul'] = 'Data Kriteria';
        $data['kriteria'] = $this->model('KriteriaModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('kriteria/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Data Kriteria';
        $data['solusi'] = $this->model('SolusiModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('kriteria/create', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        if (
            empty($_POST['kriteria']) ||
            empty($_POST['tingkatan']) ||
            empty($_POST['MB']) ||
            empty($_POST['MD'])
        ) {

            die('Pastikan seluruh data sudah terisi dengan benar');
        }

        if ($this->model('KriteriaModel')->storeData($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'Disimpan', 'success');
            header('Location: ' . BASEURL . '/kriteria/index');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Disimpan', 'danger');
            header('Location: ' . BASEURL . '/kriteria/index');
            die('Kayaknye password salah');
        }
    }

    public function delete($id)
    {
        if ($this->model('KriteriaModel')->hapusKriteria($id) > 0) {
            Flasher::setFlash('Berhasil', 'Dihapus', 'success');
            header('Location: ' . BASEURL . '/kriteria/index');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Dihapus', 'danger');
            header('Location: ' . BASEURL . '/kriteria/index');
            exit;
        }
    }

    public function edit($id)
    {
        $data['judul'] = 'Data Kriteria';
        $data['kriteria'] = $this->model('KriteriaModel')->getID($id);
        $data['solusi'] = $this->model('SolusiModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('kriteria/edit', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if ($this->model('KriteriaModel')->updateKriteria($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'Diedit', 'success');
            header('Location: ' . BASEURL . '/kriteria/index');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Diedit', 'danger');
            header('Location: ' . BASEURL . '/kriteria/index');
            exit;
        }
    }
}
