<?php
class Pemasukan extends Controller
{
    public function index()
    {
        $data['judul'] = 'Pemasukan';
        $data['kegiatan'] = $this->model("KegiatanModel")->getAllDataStatusWiting();
        $data['donatur'] = $this->model("DonaturModel")->getAllData();
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('anggaran/pemasukan/index', $data);
        $this->view('templates/footer');
    }

    public function getByKegitanAnggaran()
    {
        $allData = [];
        $allData = $this->model("AnggaranModel")->getDataByIdKegiatan($_POST['id'], UANG_MASUK);
        $kegiatan = $this->model("KegiatanModel")->getAllData();
        $allData = [
            'data' => $allData,
            'kegiatan' => $kegiatan
        ];
        echo json_encode($allData);
    }

    public function getAnggaranById()
    {
        $allData = [];
        $allData = $this->model("AnggaranModel")->getDataPemasukanById($_POST['id']);
        echo json_encode($allData);
    }

    public function tambah()
    {
        $_POST['tipe_anggaran'] = UANG_MASUK;
        $_POST['status'] = WAITING;
        $saveData = $_POST;
        $saveData['nominal'] = str_replace('.', '', $saveData['nominal']);
        $saveData['id_kegiatan'] = $saveData['kegiatan'];
        unset($saveData['kegiatan']);
        echo "<pre>";
        print_r($saveData);
        echo "</pre>";

        if ($this->model("AnggaranModel")->tambahData($saveData) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success', 'anggaran');
            header('Location: ' . BASEURL . '/anggaran');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger', 'anggaran');
            header('Location: ' . BASEURL . '/anggaran');
            exit;
        }
    }

    public function ubah()
    {
        $_POST['tipe_anggaran'] = UANG_MASUK;
        $_POST['status'] = WAITING;
        $updateData = $_POST;
        $updateData['nominal'] = str_replace('.', '', $updateData['nominal']);
        $updateData['id_kegiatan'] = $_POST['kegiatan'];
        unset($updateData['kegiatan']);

        if ($this->model("AnggaranModel")->ubahData($updateData) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success', 'anggaran');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger', 'anggaran');
            exit;
        }
    }

    public function hapus()
    {
        $id = $_POST['id'];
        $result = $this->model("AnggaranModel")->hapusData($id);
        echo json_encode($result);
    }
}
