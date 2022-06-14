<?php
class Pengeluaran extends Controller
{
    public function index()
    {
        $data['judul'] = 'Pengeluaran';
        $data['kegiatan'] = $this->model("KegiatanModel")->getAllDataStatusWiting();
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('anggaran/pengeluaran/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $_POST['tipe_anggaran'] = UANG_KELUAR;
        $_POST['id_donatur'] = 0;
        $_POST['status'] = WAITING;
        $saveData = $_POST;

        if ($this->model("AnggaranModel")->tambahData($saveData) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success', 'pengeluaran');
            header('Location: ' . BASEURL . '/pengeluaran');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger', 'pengeluaran');
            header('Location: ' . BASEURL . '/pengeluaran');
            exit;
        }
    }

    public function ubah()
    {
        $_POST['tipe_anggaran'] = UANG_KELUAR;
        $_POST['id_donatur'] = 0;
        $_POST['status'] = WAITING;
        $updateData = $_POST;

        if ($this->model("AnggaranModel")->ubahData($updateData) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success', 'pengeluaran');
            header('Location: ' . BASEURL . '/pengeluaran');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger', 'pengeluaran');
            header('Location: ' . BASEURL . '/pengeluaran');
            exit;
        }
    }

    public function hapus($id){
        if ($this->model("AnggaranModel")->hapusData($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success', 'pengeluaran');
            header('Location: ' . BASEURL . '/pengeluaran');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger', 'pengeluaran');
            header('Location: ' . BASEURL . '/pengeluaran');
            exit;
        }
    }

    public function getUbah()
    {
        echo json_encode($this->model('AnggaranModel')->getOneData($_POST['id']));
    }

    public function getByKegitanAnggaran()
    {
        $allData = [];
        $allData = $this->model("AnggaranModel")->getDataByIdKegiatan($_POST['id'], UANG_KELUAR);
        echo json_encode($allData);
    }
}
