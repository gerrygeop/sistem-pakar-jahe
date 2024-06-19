<?php

class Auth extends Controller
{

    public function index()
    {
        $data['judul'] = 'Login';
        $data['login'] = 'mhs';

        $this->view('templates/header', $data);
        $this->view('auth/login', $data);
        $this->view('templates/footer');
    }
    public function adminLogin()
    {
        $data['judul'] = 'Login';
        $data['login'] = 'admin';

        $this->view('templates/header', $data);
        $this->view('auth/login', $data);
        $this->view('templates/footer');
    }

    public function loginMahasiswa()
    {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            Flasher::setAlert('Username dan Password tidak boleh kosong!', 'danger');
            header('Location: ' . BASEURL . '/auth');
            exit;
        } else {
            $loginUser = $this->model('UserModel')->loginUser($_POST['username'], $_POST['password']);

            if (!$loginUser) {
                Flasher::setAlert('Username atau Password Salah!', 'danger');
                header('Location: ' . BASEURL . '/auth');
                exit;
            } else {
                $this->createUserSession($loginUser);
            }
        }
    }

    public function loginAdmin()
    {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            Flasher::setAlert('Username dan Password tidak boleh kosong!', 'danger');
            header('Location: ' . BASEURL . '/auth/adminLogin');
            exit;
        } else {
            $loginUser = $this->model('UserModel')->loginAdmin($_POST['username'], $_POST['password']);

            if (!$loginUser) {
                Flasher::setAlert('Username atau Password Salah!', 'danger');
                header('Location: ' . BASEURL . '/auth/adminLogin');
                exit;
            } else {
                $this->createUserSession($loginUser);
            }
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header('Location: ' . BASEURL . '/home');
        exit;
    }

    public function register()
    {
        $data['judul'] = 'Register';

        $this->view('templates/header', $data);
        $this->view('auth/register');
        $this->view('templates/footer');
    }

    public function registerStore()
    {
        if (
            empty($_POST['username']) ||
            empty($_POST['password'])
        ) {
            Flasher::setAlert('Pastikan seluruh data sudah terisi dengan benar!', 'danger');
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        }

        if ($this->model('UserModel')->findUserByNIM($_POST['user_id'])) {
            Flasher::setAlert('User sudah terdaftar!', 'danger');
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        }

        // $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if ($this->model('UserModel')->register($_POST) > 0) {
            Flasher::setAlert('Register Berhasil Silahkan Login', 'success');
            header('Location: ' . BASEURL . '/auth');
            exit;
        } else {
            Flasher::setAlert('Register Gagal', 'danger');
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASEURL . '/');
        exit;
    }
}
