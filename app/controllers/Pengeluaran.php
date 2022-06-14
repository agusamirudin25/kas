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
        $saveData['nominal'] = str_replace('.', '', $saveData['nominal']);

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
        $updateData['nominal'] = str_replace('.', '', $updateData['nominal']);

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

    public function hapus(){
        $id = $_POST['id'];
        $result = $this->model("AnggaranModel")->hapusData($id);
        echo json_encode($result);
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
