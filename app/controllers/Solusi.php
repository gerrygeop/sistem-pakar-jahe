<?php

class Solusi extends Controller
{

    public function index()
    {
        $data['judul'] = 'Data Solusi';
        $data['solusi'] = $this->model('SolusiModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('solusi/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Data Solusi';

        $this->view('templates/header', $data);
        $this->view('solusi/create');
        $this->view('templates/footer');
    }

    public function datapenyakitStore()
    {
        if (empty($_POST['tingkat_kecocokan']) && empty($_POST['solusi'])) {
            Flasher::setAlert('Pastikan data sudah terisi dengan benar!', 'danger');
            header('Location: ' . BASEURL . '/solusi/create');
            exit;
        }

        if ($this->model('SolusiModel')->storeData($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'Disimpan', 'success');
            header('Location: ' . BASEURL . '/solusi');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Disimpan', 'danger');
            header('Location: ' . BASEURL . '/solusi/create');
            exit;
        }
    }

    public function edit($id)
    {
        $data['judul'] = 'Data Solusi';
        $data['solusi'] = $this->model('SolusiModel')->getID($id);

        $this->view('templates/header', $data);
        $this->view('solusi/edit', $data);
        $this->view('templates/footer');
    }

    public function update($id)
    {
        if (empty($_POST['tingkat_kecocokan']) && empty($_POST['solusi'])) {
            Flasher::setAlert('Pastikan data sudah terisi dengan benar!', 'danger');
            header('Location: ' . BASEURL . '/solusi/edit');
            exit;
        }

        if ($this->model('SolusiModel')->updateSolusi($_POST, $id) > 0) {
            Flasher::setFlash('Berhasil', 'Diedit', 'success');
            header('Location: ' . BASEURL . '/solusi');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Diedit', 'danger');
            header('Location: ' . BASEURL . '/solusi/edit');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model('SolusiModel')->hapusSolusi($id) > 0) {
            Flasher::setFlash('Berhasil', 'Dihapus', 'success');
            header('Location: ' . BASEURL . '/solusi');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Dihapus', 'danger');
            header('Location: ' . BASEURL . '/solusi');
            exit;
        }
    }
}
