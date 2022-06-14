<?php
class Home extends Controller
{
    public function index()
    {
        $data['judul'] = 'Dashboard';
        $data['mainController'] = 'Home';
        $data['totalKegiatan'] = $this->model("LaporanModel")->getTotalKegiatan();
        $data['totalDonatur'] = $this->model("LaporanModel")->getTotalDonatur();
        $data['topDonatur'] = $this->model("LaporanModel")->getTopDonatur();
        $data['januari'] = $this->model("LaporanModel")->getTotalSaldoBulanIni('2022-01', UANG_MASUK);
        $data['februari'] = $this->model("LaporanModel")->getTotalSaldoBulanIni('2022-02', UANG_MASUK);
        $data['maret'] = $this->model("LaporanModel")->getTotalSaldoBulanIni('2022-03', UANG_MASUK);
        $data['april'] = $this->model("LaporanModel")->getTotalSaldoBulanIni('2022-04', UANG_MASUK);
        $data['mei'] = $this->model("LaporanModel")->getTotalSaldoBulanIni('2022-05', UANG_MASUK);
        $data['juni'] = $this->model("LaporanModel")->getTotalSaldoBulanIni('2022-06', UANG_MASUK);
        $data['juli'] = $this->model("LaporanModel")->getTotalSaldoBulanIni('2022-07', UANG_MASUK);
        $data['agustus'] = $this->model("LaporanModel")->getTotalSaldoBulanIni('2022-08', UANG_MASUK);
        $data['september'] = $this->model("LaporanModel")->getTotalSaldoBulanIni('2022-09', UANG_MASUK);
        $data['oktober'] = $this->model("LaporanModel")->getTotalSaldoBulanIni('2022-10', UANG_MASUK);
        $data['november'] = $this->model("LaporanModel")->getTotalSaldoBulanIni('2022-11', UANG_MASUK);
        $data['desember'] = $this->model("LaporanModel")->getTotalSaldoBulanIni('2022-12', UANG_MASUK);
        $data['totalPemasukan'] = $this->model("LaporanModel")->getTotalSaldo(UANG_MASUK);
        $data['totalPengeluaran'] = $this->model("LaporanModel")->getTotalSaldo(UANG_KELUAR);
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}
