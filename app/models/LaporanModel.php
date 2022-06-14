<?php

class LaporanModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    /* Laporan */
    public function getLaporan($tipe_anggaran)
    {
        $query = "  SELECT 
                        a.*,
                        CASE
                            WHEN a.no_rekening is null THEN '-'
                            WHEN a.no_rekening = '' THEN '-'
                            ELSE a.no_rekening
                        END as no_rekening_result,  
                        CASE
                            WHEN k.nama_kegiatan is null THEN '-'
                            ELSE k.nama_kegiatan
                        END as nama_kegiatan_result, 
                        CASE 
                            WHEN a.tipe_anggaran = 0 THEN a.nominal 
                            ELSE '-'
                        END as kredit, 
                        CASE 
                            WHEN a.tipe_anggaran = 1 THEN a.nominal 
                            ELSE '-' 
                        END as debit 
                    FROM anggaran a LEFT JOIN kegiatan k on a.id_kegiatan = k.id_kegiatan 
                    WHERE 
                        tipe_anggaran in (:tipe_anggaran) ORDER BY tanggal DESC";
        $this->db->query($query);
        $this->db->bind('tipe_anggaran', $tipe_anggaran);
        $allData = $this->db->resultset();
        for ($i = 0; $i < count($allData); $i++) {
            $status_loop = $allData[$i]["status"];
            if ($status_loop == WAITING) {
                $status_loop = "Proses Pemerikasaan";
            } else if ($status_loop == PROCESS) {
                $status_loop = "Telah di Setujui Bendahara";
            } else if ($status_loop == FINISH) {
                $status_loop = "Telah di Setuju Pengurus";
            } else {
                $status_loop = " - ";
            }
            $allData[$i]['status_desc'] = $status_loop;
        }
        return $allData;
    }

    public function getLaporanSummary($month)
    {
        $query = "  SELECT 
                        a.*,
                        CASE
                            WHEN k.nama_kegiatan is null THEN '-'
                            ELSE k.nama_kegiatan
                        END as nama_kegiatan_result, 
                        CASE 
                            WHEN a.tipe_anggaran = 0 THEN a.nominal 
                            ELSE '-'
                        END as kredit, 
                        CASE 
                            WHEN a.tipe_anggaran = 1 THEN a.nominal 
                            ELSE '-' 
                        END as debit,
                        CASE 
                            WHEN a.id_donatur = 0 THEN '-'
                            ELSE d.nama_donatur
                        END as donatur_result
                    FROM anggaran a LEFT JOIN kegiatan k on a.id_kegiatan = k.id_kegiatan
                    LEFT JOIN donatur d on a.id_donatur = d.id_donatur
                    WHERE 
                        tipe_anggaran in ('1','0') and a.tanggal Like :month ORDER BY tanggal DESC";
        $this->db->query($query);
        $this->db->bind('month', $month . '%');
        $allData = $this->db->resultset();
        for ($i = 0; $i < count($allData); $i++) {
            $status_loop = $allData[$i]["status"];
            if ($status_loop == WAITING) {
                $status_loop = "Proses Pemerikasaan";
            } else if ($status_loop == PROCESS) {
                $status_loop = "Telah di Setujui Bendahara";
            } else if ($status_loop == FINISH) {
                $status_loop = "Telah di Setuju Pengurus";
            } else {
                $status_loop = " - ";
            }
            $allData[$i]['status_desc'] = $status_loop;
        }
        return $allData;
    }

    public function getTotalSaldoBulanIni($month, $tipe_anggaran)
    {
        $query = "SELECT 
                    CASE
                        WHEN sum(nominal) is null THEN 0
                        ELSE sum(nominal) 
                    END
                    as totalAnggaran
                FROM 
                    anggaran a 
                WHERE a.tanggal Like :month and a.tipe_anggaran =:tipe_anggaran ";
        $this->db->query($query);
        $this->db->bind('tipe_anggaran', $tipe_anggaran);
        $this->db->bind('month', $month . '%');
        $allData = $this->db->single();
        return $allData;
    }

    public function getTotalSaldoSampaiBulanLalu($month, $tipe_anggaran)
    {
        $month_date = $month . "-01";
        $query = "SELECT 
                    CASE
                        WHEN sum(nominal) is null THEN 0
                        ELSE sum(nominal) 
                    END
                    as totalAnggaran
                FROM 
                    anggaran a 
                WHERE a.tipe_anggaran =:tipe_anggaran
                    AND a.tanggal 
                        BETWEEN 
                                (SELECT 
                                    CASE 
                                        WHEN (SELECT MIN(tanggal) FROM anggaran) > CAST(DATE_ADD(CONCAT(:month, '-01'), INTERVAL -2 MONTH) AS DATE) THEN CAST(DATE_ADD(CONCAT(:month, '-01'), INTERVAL -2 MONTH) AS DATE)
                                        WHEN  (SELECT MIN(tanggal) FROM anggaran) = CAST(DATE_ADD(CONCAT(:month, '-01'), INTERVAL -2 MONTH) AS DATE) THEN CAST(DATE_ADD(CONCAT(:month, '-01'), INTERVAL -2 MONTH) AS DATE)
                                    ELSE (SELECT MIN(tanggal) FROM anggaran)
                                END) 
                        AND
                                (SELECT 
                                    CASE 
                                        WHEN (SELECT MIN(tanggal) FROM anggaran) > CAST(DATE_ADD(LAST_DAY(:month_date), INTERVAL -1 MONTH) AS DATE) THEN CAST(DATE_ADD(LAST_DAY(:month_date), INTERVAL -1 MONTH) AS DATE)
                                        WHEN  (SELECT MIN(tanggal) FROM anggaran) = CAST(DATE_ADD(LAST_DAY(:month_date), INTERVAL -1 MONTH) AS DATE) THEN CAST(DATE_ADD(LAST_DAY(:month_date), INTERVAL -1 MONTH) AS DATE)
                                    ELSE (SELECT MIN(tanggal) FROM anggaran)
                                END)

                                        ";
        $this->db->query($query);
        $this->db->bind('tipe_anggaran', $tipe_anggaran);
        $this->db->bind('month', $month);
        $this->db->bind('month_date', $month_date);
        $allData = $this->db->single();
        return $allData;
    }

    public function getTotalSaldo($tipe_anggaran)
    {
        $query = "SELECT 
                CASE
                    WHEN sum(nominal) is null THEN 0
                    ELSE sum(nominal) 
                END
                as totalAnggaran
            FROM 
                anggaran a 
            WHERE a.tipe_anggaran =:tipe_anggaran ";
        $this->db->query($query);
        $this->db->bind('tipe_anggaran', $tipe_anggaran);
        $allData = $this->db->single();
        return $allData;
    }

    public function getTotalKegiatan()
    {
        $query = "SELECT 
                   COUNT(*) as total
                FROM 
                    kegiatan ";
        $this->db->query($query);
        $allData = $this->db->single();
        return $allData;
    }

    public function getTotalDonatur(){
        $query = "SELECT 
                COUNT(*) as total
            FROM 
                donatur ";
        $this->db->query($query);
        $allData = $this->db->single();
        return $allData;
    }

    public function getTopDonatur(){
        $query = "SELECT 
                    d.nama_donatur as nama_donatur, 
                    sum( a.nominal) as total  
                from donatur d join anggaran a on a.id_donatur = d.id_donatur 
                group by nama_donatur order by total desc limit 5 ";
        $this->db->query($query);
        $allData = $this->db->resultset();
        return $allData;
    }
}
