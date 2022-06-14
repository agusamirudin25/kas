<?php
class Donatur extends Controller
{
    public function index()
    {
        $data['judul']      = 'Donatur';
        $data['donatur']    = $this->model('DonaturModel')->getAllData();

        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('donatur/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $saveData = $_POST;
        $countResult = $this->model("DonaturModel")->tambahData($saveData);
        if ($countResult > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success', 'donatur');
            header('Location: ' . BASEURL . '/donatur');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger', 'donatur');
            header('Location: ' . BASEURL . '/donatur');
            exit;
        }
    }

    public function ubah()
    {
        $updateData = $_POST;
        $countResult = $this->model("DonaturModel")->ubahData($updateData);
        if ($countResult > 0) {
            Flasher::setFlash('berhasil', 'dirubah', 'success', 'donatur');
            header('Location: ' . BASEURL . '/donatur');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dirubah', 'danger', 'donatur');
            header('Location: ' . BASEURL . '/donatur');
            exit;
        }
    }

    public function getUbah()
    {
        echo json_encode($this->model("DonaturModel")->getOneDataById($_POST['id']));
    }
    public function hapus($id)
    {
        echo $id;
        if ($this->model("DonaturModel")->hapusData($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success', 'donatur');
            header('Location: ' . BASEURL . '/donatur');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger', 'donatur');
            header('Location: ' . BASEURL . '/donatur');
            exit;
        }
    }
}
