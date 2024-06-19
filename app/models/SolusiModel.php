<?php

class SolusiModel
{

    private $tbl_solusi = 'solusi';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM ' . $this->tbl_solusi);
        return $this->db->resultSet();
    }

    public function getID($id)
    {
        $this->db->query('SELECT * FROM ' . $this->tbl_solusi . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function storeData($data)
    {
        $min = $data['min'] == null ? null : $data['min'];
        $max = $data['max'] == null ? null : $data['max'];

        $query = "INSERT INTO " . $this->tbl_solusi . " (tingkat_kecocokan, solusi, saran, min, max, warna) VALUES (:tingkat_kecocokan, :solusi, :saran, :min, :max, :warna)";

        $this->db->query($query);

        $this->db->bind('tingkat_kecocokan', $data['tingkat_kecocokan']);
        $this->db->bind('solusi', $data['solusi']);
        $this->db->bind('saran', $data['saran']);
        $this->db->bind('min', $min);
        $this->db->bind('max', $max);
        $this->db->bind('warna', $data['warna']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateSolusi($data, $id)
    {
        $min = $data['min'] == null ? null : $data['min'];
        $max = $data['max'] == null ? null : $data['max'];

        $query = "UPDATE " . $this->tbl_solusi . " SET tingkat_kecocokan=:tingkat_kecocokan, solusi=:solusi, saran=:saran, min=:min, max=:max, warna=:warna WHERE id=:id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('tingkat_kecocokan', $data['tingkat_kecocokan']);
        $this->db->bind('solusi', $data['solusi']);
        $this->db->bind('saran', $data['saran']);
        $this->db->bind('min', $min);
        $this->db->bind('max', $max);
        $this->db->bind('warna', $data['warna']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusSolusi($id)
    {
        $query = "DELETE FROM " . $this->tbl_solusi . " WHERE id=:id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
