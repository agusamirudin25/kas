<?php
class DonaturModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllData()
    {
        $allData = [];
        $this->db->query("SELECT * FROM donatur");
        $allData = $this->db->resultset();
        for ($i = 0; $i < count($allData); $i++) {
            $dontur_type = $allData[$i]["tipe_donatur"];
            if ($dontur_type == SINGLE) {
                $dontur_type = "Peorangan";
            } else if ($dontur_type == GROUP) {
                $dontur_type = "Kelompok";
            } else {
                $dontur_type = "Invalid Format";
            }
            $allData[$i]["tipe_donatur_desc"] = $dontur_type;
        }
        return $allData;
    }

    public function getOneDataById($id)
    {
        $this->db->query(" SELECT * from donatur WHERE id_donatur =:id_donatur  ");
        $this->db->bind('id_donatur', $id);
        return $this->db->single();
    }

    public function tambahData($data)
    {
        $query = "INSERT INTO donatur(id_donatur,nama_donatur,kontak,no_rekening,tipe_donatur) 
                    VALUES 
                        ( '',:nama_donatur,:kontak,:no_rekening,:tipe_donatur)
                ";
        $this->db->query($query);
        $this->db->bind('nama_donatur', $data['nama_donatur']);
        $this->db->bind('kontak', $data['kontak']);
        $this->db->bind('no_rekening', $data['no_rekening']);
        $this->db->bind('tipe_donatur', $data['tipe_donatur']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahData($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        $query = " UPDATE donatur SET 
                        nama_donatur=:nama_donatur,
                        kontak=:kontak,
                        no_rekening=:no_rekening,
                        tipe_donatur=:tipe_donatur
                    WHERE 
                        id_donatur=:id_donatur
                ";

        $this->db->query($query);
        $this->db->bind('nama_donatur', $data['nama_donatur']);
        $this->db->bind('kontak', $data['kontak']);
        $this->db->bind('no_rekening', $data['no_rekening']);
        $this->db->bind('tipe_donatur', $data['tipe_donatur']);
        $this->db->bind('id_donatur', $data['id_donatur']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusData($id_donatur)
    {
        $query = " DELETE FROM donatur WHERE id_donatur=:id_donatur";
        $this->db->query($query);
        $this->db->bind('id_donatur', $id_donatur);
        $this->db->execute();
        return $this->db->rowCount();
    }

}
