<?php
class User extends Controller
{
    public function index()
    {
        $data['judul']      = 'user management';
        $data['user']       = $this->model('UserModel')->getAllData();
        $data['pengurus']    = $this->model('PengurusModel')->getAllData();
       
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $saveData = $_POST;
        if ($this->model("UserModel")->tambahData($saveData) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success', 'User');
            header('Location: ' . BASEURL . '/user');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger', 'User');
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }

    public function ubah()
    {
        $updateData = $_POST;
        $countResult = $this->model("UserModel")->ubahData($updateData);
        if ( $countResult > 0) {
            Flasher::setFlash('berhasil', 'dirubah', 'success', 'User');
            header('Location: ' . BASEURL . '/user');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dirubah', 'danger', 'User');
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }

    public function getUbah()
    {
        echo json_encode($this->model("UserModel")->getOneDataById($_POST['id']));
    }

    public function hapus($id)
    {
        // $id = $_POST['id'];
        if ($this->model("UserModel")->hapusData($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success', 'User');
            header('Location: ' . BASEURL . '/user');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger', 'User');
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }
    
}
