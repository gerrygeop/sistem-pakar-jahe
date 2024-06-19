<?php

class KriteriaModel
{
    private $tbl_kriteria = 'kriteria';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM ' . $this->tbl_kriteria . ' ORDER BY tingkatan');
        return $this->db->resultSet();
    }

    public function getID($id)
    {
        $this->db->query('SELECT * FROM ' . $this->tbl_kriteria . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function storeData($data)
    {
        $CF = $data['MB'] - $data['MD'];

        $query = "INSERT INTO " . $this->tbl_kriteria . " (kriteria, tingkatan, MB, MD, CF) VALUES (:kriteria, :tingkatan, :MB, :MD, :CF)";

        $this->db->query($query);

        // $this->db->bind('id', $data['id']);
        $this->db->bind('kriteria', $data['kriteria']);
        $this->db->bind('tingkatan', $data['tingkatan']);
        $this->db->bind('MB', $data['MB']);
        $this->db->bind('MD', $data['MD']);
        $this->db->bind('CF', $CF);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusKriteria($id)
    {
        $query = "DELETE FROM " . $this->tbl_kriteria . " WHERE id=:id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateKriteria($data)
    {
        $CF = $data['MB'] - $data['MD'];
        $query = "UPDATE " . $this->tbl_kriteria . " SET kriteria=:kriteria, tingkatan=:tingkatan, MB=:MB, MD=:MD, CF=:CF WHERE id=:id";

        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('kriteria', $data['kriteria']);
        $this->db->bind('tingkatan', $data['tingkatan']);
        $this->db->bind('MB', $data['MB']);
        $this->db->bind('MD', $data['MD']);
        $this->db->bind('CF', $CF);

        $this->db->execute();
        return $this->db->rowCount();
    }
}
