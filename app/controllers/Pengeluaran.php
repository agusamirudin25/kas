<?php
class Pengeluaran extends Controller
{
    public function index()
    {
        $data['judul'] = 'Pengeluaran';
        $data['kegiatan'] = $this->model("KegiatanModel")->getAllDataStatusWiting();
        $data['pengeluaran'] = $this->model("AnggaranModel")->getDataPengeluaran();
        $data['rekap'] = $this->model("AnggaranModel")->rekap();
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('anggaran/pengeluaran/index', $data);
        $this->view('templates/footer');
    }

    public function tambahData()
    {
        $data['judul'] = 'Tambah Pengeluaran';
        $data['kegiatan'] = $this->model("KegiatanModel")->getAllDataStatusWiting();
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('anggaran/pengeluaran/tambah', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $_POST['tipe_anggaran'] = UANG_KELUAR;
        $_POST['id_donatur'] = 0;
        $_POST['status'] = WAITING;
        $saveData = $_POST;
        $saveData['nominal'] = str_replace('.', '', $saveData['nominal']);

        // upload file bukti
        $bukti = $_FILES['file_bukti']['name'];
        $tmp = $_FILES['file_bukti']['tmp_name'];
        $bukti_baru = date('dmYHis') . $bukti;
        $path = 'bukti/' . $bukti_baru;
        if (move_uploaded_file($tmp, $path)) {
            $saveData['file_bukti'] = $bukti_baru;
            $insert = $this->model("AnggaranModel")->tambahData($saveData, true);
            if ($insert) {
                $response = [
                    'status' => 'success',
                    'message' => 'Data berhasil ditambahkan',
                    'redirect' => BASEURL . '/pengeluaran'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Data gagal ditambahkan'
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data gagal ditambahkan'
            ];
        }

        echo json_encode($response);
        die;
    }

    public function ubahData($id)
    {
        $data['judul'] = 'Ubah Pengeluaran';
        $data['kegiatan'] = $this->model("KegiatanModel")->getAllDataStatusWiting();
        $data['anggaran'] = $this->model("AnggaranModel")->getOneData($id);
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('anggaran/pengeluaran/ubah', $data);
        $this->view('templates/footer');
    }

    public function ubah()
    {
        $_POST['tipe_anggaran'] = UANG_KELUAR;
        $_POST['id_donatur'] = 0;
        $_POST['status'] = WAITING;
        $updateData = $_POST;
        $updateData['nominal'] = str_replace('.', '', $updateData['nominal']);

        if($_FILES['file_bukti']['name'] != ""){
            // upload file bukti
            $bukti = $_FILES['file_bukti']['name'];
            $tmp = $_FILES['file_bukti']['tmp_name'];
            $bukti_baru = date('dmYHis') . $bukti;
            $path = 'bukti/' . $bukti_baru;
            if (move_uploaded_file($tmp, $path)) {
                $updateData['file_bukti'] = $bukti_baru;
                $update = $this->model("AnggaranModel")->ubahData($updateData);
            }   
        }else{
            $updateData['file_bukti'] = $updateData['file_bukti_lama'];
            $update = $this->model("AnggaranModel")->ubahData($updateData);
        }
        if ($update) {
            $response = [
                'status' => 'success',
                'message' => 'Data berhasil diubah',
                'redirect' => BASEURL . '/pengeluaran'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data gagal diubah'
            ];
        }
        echo json_encode($response);
        die;
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
