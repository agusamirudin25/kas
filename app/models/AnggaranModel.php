<?php

class AnggaranModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllDataByStatus($status)
    {
        $query = "
                SELECT 
                    sum(p.biaya) as total_sum 
                FROM anggaran p 
                    WHERE p.status =:status
                ";
        $this->db->query($query);
        $this->db->bind('status', $status);
        $allData = $this->db->single();
        return $allData;
    }

    public function getAllData()
    {
        $allData = [];
        $this->db->query(" SELECT * FROM anggaran ");
        $allData = $this->db->resultset();
        return $allData;
    }

    public function getDataPemasukan()
    {
        $allData = [];
        $this->db->query(" SELECT a.*, d.*, k.nama_kegiatan FROM anggaran a LEFT JOIN donatur d on d.id_donatur = a.id_donatur
        LEFT JOIN kegiatan k ON a.id_kegiatan = k.id_kegiatan WHERE tipe_anggaran = '" . UANG_MASUK . "'");
        $allData = $this->db->resultset();
        return $allData;
    }

    public function getDataPengeluaran()
    {
        $allData = [];
        $this->db->query(" SELECT a.*, d.*, k.nama_kegiatan FROM anggaran a LEFT JOIN donatur d on d.id_donatur = a.id_donatur
        LEFT JOIN kegiatan k ON a.id_kegiatan = k.id_kegiatan WHERE tipe_anggaran = '" . UANG_KELUAR . "'");
        $allData = $this->db->resultset();
        return $allData;
    }

    public function getDataByIdKegiatan($id_kegiatan, $tipe_anggaran)
    {
        $allData = [];
        $this->db->query(" SELECT a.*, d.*, k.nama_kegiatan FROM anggaran a LEFT JOIN donatur d on d.id_donatur = a.id_donatur
                            LEFT JOIN kegiatan k ON a.id_kegiatan = k.id_kegiatan
                            WHERE a.id_kegiatan =:id_kegiatan  and tipe_anggaran =:tipe_anggaran ");
        $this->db->bind('id_kegiatan', $id_kegiatan);
        $this->db->bind('tipe_anggaran', $tipe_anggaran);
        $allData = $this->db->resultset();
        return $allData;
    }

    public function getDataPemasukanById($id_anggaran)
    {
        $allData = [];
        $this->db->query(" SELECT keterangan FROM anggaran
                            WHERE id_anggaran =:id_anggaran");
        $this->db->bind('id_anggaran', $id_anggaran);
        $allData = $this->db->resultset();
        return $allData;
    }

    public function tambahData($data, $file = null)
    {
        if($file != null){
            $query = " INSERT INTO 
                    anggaran(id_anggaran, tanggal, nominal, keterangan, tipe_anggaran, id_kegiatan, status, id_donatur, file_bukti)  
                    VALUES ('', :tanggal, :nominal, :keterangan, :tipe_anggaran, :id_kegiatan, :status, :id_donatur, :file_bukti);
                ";
        }else{
            $query = " INSERT INTO 
                    anggaran(id_anggaran, tanggal, nominal, keterangan, tipe_anggaran, id_kegiatan, status, id_donatur)  
                    VALUES ('', :tanggal, :nominal, :keterangan, :tipe_anggaran, :id_kegiatan, :status, :id_donatur);
                ";
        }
        $this->db->query($query);
        $this->db->bind('tanggal', $data['tanggal']);
        $this->db->bind('nominal', $data['nominal']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('tipe_anggaran', $data['tipe_anggaran']);
        $this->db->bind('id_kegiatan', $data['id_kegiatan']);
        $this->db->bind('status', $data['status']);
        $this->db->bind('id_donatur', $data['id_donatur']);
        if($file != null){
            $this->db->bind('file_bukti', $data['file_bukti']);
        }

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahData($data)
    {
        $query = "  UPDATE anggaran SET 
                        tanggal         =:tanggal,
                        nominal         =:nominal,
                        keterangan      =:keterangan,
                        tipe_anggaran   =:tipe_anggaran,
                        id_kegiatan     =:id_kegiatan,
                        id_donatur      =:id_donatur,
                        file_bukti      =:file_bukti,
                        status          =:status 
                    WHERE 
                        id_anggaran =:id_anggaran
            ";
        $this->db->query($query);
        $this->db->bind('id_anggaran', $data['id']);
        $this->db->bind('tanggal', $data['tanggal']);
        $this->db->bind('nominal', $data['nominal']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('tipe_anggaran', $data['tipe_anggaran']);
        $this->db->bind('id_kegiatan', $data['id_kegiatan']);
        $this->db->bind('id_donatur', $data['id_donatur']);
        $this->db->bind('file_bukti', $data['file_bukti']);
        $this->db->bind('status', $data['status']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahStatusByIdKegiatan($id_kegiatan, $status)
    {

        $query = " UPDATE anggaran
                   SET
                       status      =:status 
                   WHERE 
                       id_kegiatan =:id_kegiatan
           ";
        $this->db->query($query);
        $this->db->bind('status', $status);
        $this->db->bind('id_kegiatan', $id_kegiatan);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahStatusById($id, $status)
    {

        $query = " UPDATE anggaran
                   SET
                       status      =:status 
                   WHERE 
                   id_anggaran =:id_anggaran
           ";
        $this->db->query($query);
        $this->db->bind('status', $status);
        $this->db->bind('id_anggaran', $id);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getOneData($id)
    {
        $this->db->query(" SELECT * FROM anggaran WHERE id_anggaran =:id_anggaran");
        $this->db->bind('id_anggaran', $id);
        return $this->db->single();
    }

    public function cekingData($id)
    {
        $allData = [];
        $query = " SELECT count(*) AS CountData FROM anggaran WHERE id_anggaran =:id_anggaran ";

        $this->db->query($query);
        $this->db->bind('id_anggaran', $id);
        $allData = $this->db->single();
        return $allData;
    }

    public function hapusData($id)
    {
        $query = " DELETE FROM anggaran WHERE id_anggaran =:id_anggaran ";
        $this->db->query($query);
        $this->db->bind('id_anggaran', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataByKegiatan($id_kegiatan)
    {
        $query = " DELETE FROM anggaran WHERE id_kegiatan =:id_kegiatan ";
        $this->db->query($query);
        $this->db->bind('id_kegiatan', $id_kegiatan);
        $this->db->execute();
        return $this->db->rowCount();
    }

    function rekap()
    {
        $this->db->query(" SELECT k.nama_kegiatan, (SELECT SUM(nominal) FROM anggaran WHERE id_kegiatan = a.id_kegiatan AND tipe_anggaran = 1) as `pemasukan`, (SELECT SUM(nominal) FROM anggaran WHERE id_kegiatan = a.id_kegiatan AND tipe_anggaran = 0) as `pengeluaran` FROM `anggaran` a JOIN kegiatan k ON a.id_kegiatan = k.id_kegiatan
        GROUP BY a.id_kegiatan ");
        return $this->db->resultset();
    }
}

/* define('WAITING','0');
define('PROCESS','1');
define('FINISH','2');
define('APPROVE','3'); */