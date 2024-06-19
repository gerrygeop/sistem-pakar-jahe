<?php

class User extends Controller
{


    public function profile()
    {
        $data['judul'] = 'Profile';
        $data['user'] = $this->model('UserModel')->getUserByNIM($_SESSION['user_id']);

        $this->view('templates/header', $data);
        $this->view('auth/edit', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if ($this->model('UserModel')->updateProfileUser($_POST) > 0) {
            Flasher::setAlert('Data Profile Berhasil di Update', 'success');
            header('Location: ' . BASEURL . '/user/profile');
            exit;
        } else {
            Flasher::setAlert('Data Profile Gagal di Update', 'danger');
            header('Location: ' . BASEURL . '/user/profile');
            exit;
        }
    }

    public function updatePassword()
    {
        $user_id = intval($_SESSION['user_id']);
        $checkOldPassword = $this->model('UserModel')->loginUser($user_id, $_POST['password']);

        if (!$checkOldPassword) {
            Flasher::setAlert('Password Lama Anda Salah!', 'danger');
            header('Location: ' . BASEURL . '/user/profile');
            exit;
        } else {

            if ($_POST['new_password'] == $_POST['confirm_password']) {

                if ($this->model('UserModel')->updatePasswordUser($_POST['new_password'], $user_id) > 0) {
                    Flasher::setAlert('Password Anda Berhasil di Update', 'success');
                    header('Location: ' . BASEURL . '/user/profile');
                    exit;
                } else {
                    Flasher::setAlert('Password Gagal di Update!', 'danger');
                    header('Location: ' . BASEURL . '/user/profile');
                    exit;
                }
            } else {
                Flasher::setAlert('Konfirmasi Password Salah!', 'danger');
                header('Location: ' . BASEURL . '/user/profile');
                exit;
            }
        }
    }
}
