<?php
class Tentang extends Controller
{
    public function index()
    {
        $data['judul']      = 'Tentang';
       
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('tentang/index', $data);
        $this->view('templates/footer');
    }

    public function bantuan()
    {
        $data['judul']      = 'Bantuan';
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('tentang/bantuan', $data);
        $this->view('templates/footer');
    }

}