<?php

class Pengurus extends Controller
{
    public function index()
    {
        $data['judul']      = 'pengurus management';
        $data['pengurus']    = $this->model('PengurusModel')->getAllData();
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('pengurus/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $chkData = $this->model('PengurusModel')->getDataCountJabatan($_POST['jabatan']);
        $chkNopengurus = $this->model('PengurusModel')->countNopengurus($_POST['no_pengurus']);

        if ($chkNopengurus['CountData'] > 0) {
            Flasher::setFlash('gagal', 'ditambahkan, Nomor pengurus sudah ada', 'danger', 'pengurus');
            header('Location: ' . BASEURL . '/pengurus');
            exit;
        }

        if ($chkData['CountData'] < 1) {
            if ($this->model('PengurusModel')->tambahData($_POST) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success', 'pengurus');
                header('Location: ' . BASEURL . '/pengurus');
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger', 'pengurus');
                header('Location: ' . BASEURL . '/pengurus');
                exit;
            }
        } else if ($_POST['jabatan'] != KEPALA) {

            if ($this->model('PengurusModel')->tambahData($_POST) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success', 'pengurus');
                header('Location: ' . BASEURL . '/pengurus');
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger', 'pengurus');
                header('Location: ' . BASEURL . '/pengurus');
                exit;
            }
        } else {
            Flasher::setFlash('gagal', 'ditambahkan, jabatan sudah ada yang mengisi', 'danger', 'pengurus');
            header('Location: ' . BASEURL . '/pengurus');
            exit;
        }
    }

    public function hapus($id, $jabatan)
    {
        $jabatan = $this->convertJabatan($jabatan);
        $chkData = $this->model('PengurusModel')->getDataCountJabatan($jabatan);
        if ($chkData['CountData'] >= 2) {
            if ($this->model('PengurusModel')->hapus($id) > 0) {
                Flasher::setFlash('berhasil', 'dihapus', 'success', 'pengurus');
                header('Location: ' . BASEURL . '/pengurus');
                exit;
            } else {
                Flasher::setFlash('gagal', 'dihapus', 'danger', 'pengurus');
                header('Location: ' . BASEURL . '/pengurus');
                exit;
            }

            // echo "Berhasil Hapus";
        } else {
            Flasher::setFlash('gagal', 'dihapus, Jabatan tidak boleh kosong', 'danger', 'pengurus');
            header('Location: ' . BASEURL . '/pengurus');
            exit;
            // echo "Gagal Hapus";
        }
    }

    public function ubah()
    {
        if ($this->model('PengurusModel')->ubahData($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success', 'pengurus');
            header('Location: ' . BASEURL . '/pengurus');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger', 'pengurus');
            header('Location: ' . BASEURL . '/pengurus');
            exit;
        }
    }

    public function getUbah()
    {
        echo json_encode($this->model('PengurusModel')->getOneData($_POST['id']));
    }

    public function convertJabatan($jabatan)
    {
        if ($jabatan == "Pengurus") {
            $jabatan = KEPALA;
        } else  if ($jabatan == "Bendahara") {
            $jabatan = BENDAHARA;
        } else if ($jabatan == "Staff") {
            $jabatan = STAF;
        } else {
            $jabatan = "Tidak ada jabatan";
        }

        return $jabatan;
    }
}
