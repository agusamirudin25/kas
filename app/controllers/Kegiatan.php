<?php

class Kegiatan extends Controller{
    public function index(){
        $data['judul'] = 'kegiatan';
        $data['kegiatan'] = $this->model("KegiatanModel")->getAllData();
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('kegiatan/index', $data);
        $this->view('templates/footer');
    }

    public function tambah(){
        if($this->model('KegiatanModel')->tambahData($_POST)>0){
            Flasher::setFlash('berhasil', 'ditambahkan', 'success', 'Kegiatan');
            header('Location: '.BASEURL.'/kegiatan');
            exit;
        }else{
            Flasher::setFlash('gagal', 'ditambahkan', 'danger', 'Kegiatan');
            header('Location: '.BASEURL.'/kegiatan');
            exit;
        }
    }

    public function ubah(){
        if($this->model('KegiatanModel')->ubahData($_POST)>0){
            Flasher::setFlash('berhasil', 'diubah', 'success', 'Kegiatan');
            header('Location: '.BASEURL.'/kegiatan');
            exit;
        }else{
            Flasher::setFlash('gagal', 'diubah', 'danger', 'Kegiatan');
            header('Location: '.BASEURL.'/kegiatan');
            exit;
        }
    }

    public function getUbah(){
        echo json_encode($this->model('KegiatanModel')->getOneData($_POST['id']));
    }

    public function hapus($id){
        if($this->model('KegiatanModel')->hapusData($id)>0 ){
            $this->model('AnggaranModel')->hapusDataByKegiatan($id); 
            Flasher::setFlash('berhasil', 'dihapus', 'success', 'User');
            header('Location: '.BASEURL.'/kegiatan');
            exit;
        }else{
            Flasher::setFlash('gagal', 'dihapus', 'danger', 'User');
            header('Location: '.BASEURL.'/kegiatan');
            exit;
        }
    }

}