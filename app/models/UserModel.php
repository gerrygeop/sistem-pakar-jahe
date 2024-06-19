<?php

class UserModel
{

    private $tbl_users = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {
        $query = "INSERT INTO " . $this->tbl_users . " (username, password, role) VALUES (:username, :password, :role)";

        $this->db->query($query);

        // $this->db->bind('id', $data['id']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', $data['password']);
        $this->db->bind('role', 'guest');

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function loginUser($username, $password)
    {
        $this->db->query('SELECT * FROM ' . $this->tbl_users . ' WHERE role=:role AND username=:username');
        $this->db->bind('role', 'guest');
        $this->db->bind('username', $username);

        $row = $this->db->single();

        if ($row == NULL) {
            return 0;
        }

        if ($password == $row['password']) {
            return $row;
        } else {
            return false;
        }
    }

    public function loginAdmin($username, $password)
    {
        $this->db->query('SELECT * FROM ' . $this->tbl_users . ' WHERE role=:role AND username=:username');
        $this->db->bind('role', 'admin');
        $this->db->bind('username', $username);

        $row = $this->db->single();
        $hashPassword = $row['password'];

        // if (password_verify($password, $hashPassword)) {
        if ($password == $hashPassword) {
            return $row;
        } else {
            return false;
        }
    }

    public function findUserByNIM($id)
    {
        $this->db->query('SELECT * FROM ' . $this->tbl_users . ' WHERE id=:id');
        $this->db->bind('id', $id);

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserByNIM($id)
    {
        $this->db->query('SELECT * FROM ' . $this->tbl_users . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function updateProfileUser($data)
    {
        $query = "UPDATE " . $this->tbl_users . " SET id=:id, username=:username WHERE id=:id";

        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('username', $data['username']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updatePasswordUser($password, $id)
    {
        $query = "UPDATE " . $this->tbl_users . " SET password=:password WHERE id=:id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('password', $password);

        $this->db->execute();
        return $this->db->rowCount();
    }
}
