<?php

class PengurusModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllData()
    {
        $allData = [];
        $this->db->query(" SELECT * FROM pengurus ORDER BY id_pengurus DESC ");
        $allData = $this->db->resultset();
        for ($i = 0; $i < count($allData); $i++) {
            $jabatan_loop = $allData[$i]['jabatan'];
            if ($jabatan_loop == KEPALA) {
                $jabatan_loop = "Pengurus";
            } else  if ($jabatan_loop == BENDAHARA) {
                $jabatan_loop = "Bendahara";
            }else if ($jabatan_loop == STAF) {
                $jabatan_loop = "Staff";
            }else{
                $jabatan_loop = "Tidak ada jabatan";
            }
            $allData[$i]['jabatan'] = $jabatan_loop;
        }
        return $allData;
    }

    public function getOneData($id_pengurus)
    {
        $this->db->query('select * from pengurus where id_pengurus=:id_pengurus');
        $this->db->bind('id_pengurus', $id_pengurus);
        return $this->db->single();
    }

    public function tambahData($data)
    {
        $query = " INSERT INTO pengurus
                    VALUES
                    ('', :nama_pengurus, :no_pengurus, :jabatan) 
                ";
        $this->db->query($query);
        $this->db->bind('nama_pengurus', $data['nama_pengurus']);
        $this->db->bind('no_pengurus', $data['no_pengurus']);
        $this->db->bind('jabatan', $data['jabatan']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapus($id_pengurus)
    {
        $query = " DELETE  FROM pengurus WHERE id_pengurus=:id_pengurus";
        $this->db->query($query);
        $this->db->bind('id_pengurus', $id_pengurus);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahData($data)
    {
        $query = " UPDATE pengurus SET 
                        nama_pengurus    =:nama_pengurus,
                        no_pengurus      =:no_pengurus,
                        jabatan         =:jabatan
                    WHERE 
                    id_pengurus=:id_pengurus
                ";
        $this->db->query($query);
        $this->db->bind('nama_pengurus', $data['nama_pengurus']);
        $this->db->bind('no_pengurus', $data['no_pengurus']);
        $this->db->bind('jabatan', $data['jabatan']);
        $this->db->bind('id_pengurus', $data['id_pengurus']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getDataByJabatan($jabatan)
    {
        $this->db->query("  SELECT nama_pengurus, no_pengurus FROM pengurus WHERE jabatan =:jabatan ORDER BY id_pengurus DESC limit 1 ");
        $this->db->bind('jabatan', $jabatan);
        return $this->db->single();
    }


    public function countNopengurus($no_pengurus){
        $this->db->query("  SELECT count(*) AS CountData FROM pengurus WHERE no_pengurus =:no_pengurus ");
        $this->db->bind('no_pengurus', $no_pengurus);
        return $this->db->single();
    }

    public function getNamaByJabatan($jabatan)
    {
        $this->db->query("  SELECT nama_pengurus, no_pengurus FROM pengurus WHERE jabatan =:jabatan ORDER BY id_pengurus DESC limit 1 ");
        $this->db->bind('jabatan', $jabatan);
        return $this->db->single();
    }

    public function getDataCountJabatan($jabatan)
    {
        $this->db->query("  SELECT count(*) AS CountData FROM pengurus WHERE jabatan =:jabatan ");
        $this->db->bind('jabatan', $jabatan);
        return $this->db->single();
    }
}
