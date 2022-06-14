<?php
class Laporan extends Controller
{
    public function index()
    {
        $data['judul'] = 'dashboard';
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }


    public function pemasukan()
    {
        $data['judul'] = 'Laporan Pemasukan';
        $data['anggaran'] = $this->model("LaporanModel")->getLaporan(UANG_MASUK);
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('laporan/pemasukan/index', $data);
        $this->view('templates/footer');
    }

    public function pengeluaran()
    {
        $data['judul'] = 'Laporan Pengeluaran';
        $data['anggaran'] = $this->model("LaporanModel")->getLaporan(UANG_KELUAR);
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('laporan/pengeluaran/index', $data);
        $this->view('templates/footer');
    }

    public function summary()
    {
        $data['judul'] = 'Laporan Summary';
        $data['nama_KPA'] = $this->model('PengurusModel')->getDataByJabatan(KEPALA);
        $data['nama_Bendahara'] = $this->model('PengurusModel')->getDataByJabatan(BENDAHARA);
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('laporan/summary/index', $data);
        $this->view('templates/footer');
    }

    public function getDataByMonth()
    {
        $month = $_POST['month'];
        $allData['anggaran'] = $this->model("LaporanModel")->getLaporanSummary($month);
        $allData['totalPemasukanSampaiBulanLalu'] = $this->model("LaporanModel")->getTotalSaldoSampaiBulanLalu($month, UANG_MASUK);
        $allData['totalPengeluaranSampaiBulanLalu'] = $this->model("LaporanModel")->getTotalSaldoSampaiBulanLalu($month, UANG_KELUAR);
        $allData['totalPemasukanBulanIni'] = $this->model("LaporanModel")->getTotalSaldoBulanIni($month, UANG_MASUK);
        $allData['totalPengeluaranBulanIni'] = $this->model("LaporanModel")->getTotalSaldoBulanIni($month, UANG_KELUAR);
        echo json_encode($allData);
    }

    public function ubahStatusById()
    {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $result = $this->model("AnggaranModel")->ubahStatusById($id, $status);
        echo json_encode($result);
    }

    public function ubahStatusByIdKegiatan()
    {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $result = $this->model("AnggaranModel")->ubahStatusByIdKegiatan($id, $status);
        echo json_encode($result);
    }

    public function printLaporanpdf($month)
    {
        $data['judul'] = 'Laporan Summary';
        $data['bulan'] = $this->convertMonth($month);
        $data['nama_KPA'] = $this->model('PengurusModel')->getDataByJabatan(KEPALA);
        $data['nama_Bendahara'] = $this->model('PengurusModel')->getDataByJabatan(BENDAHARA);
        $data['anggaran'] = $this->model("LaporanModel")->getLaporanSummary($month);
        $data['totalPemasukanSampaiBulanLalu'] = $this->model("LaporanModel")->getTotalSaldoSampaiBulanLalu($month, UANG_MASUK);
        $data['totalPengeluaranSampaiBulanLalu'] = $this->model("LaporanModel")->getTotalSaldoSampaiBulanLalu($month, UANG_KELUAR);
        $data['totalPemasukanBulanIni'] = $this->model("LaporanModel")->getTotalSaldoBulanIni($month, UANG_MASUK);
        $data['totalPengeluaranBulanIni'] = $this->model("LaporanModel")->getTotalSaldoBulanIni($month, UANG_KELUAR);
        $this->view('templates/header', $data);
        $this->view('download/downloadFilePDF', $data);
    }

    public function convertMonth($month) {
        $monthArr = explode("-",$month);
        $months = array(
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Augustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        );
        return $months[intval($monthArr[1])-1]." ".$monthArr[0];
    }
}
