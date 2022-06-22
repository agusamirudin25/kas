<?php
class Pemasukan extends Controller
{
    public function index()
    {
        $data['judul'] = 'Pemasukan';
        $data['kegiatan'] = $this->model("KegiatanModel")->getAllDataStatusWiting();
        $data['donatur'] = $this->model("DonaturModel")->getAllData();
        $data['pemasukan'] = $this->model("AnggaranModel")->getDataPemasukan();
        $data['rekap'] = $this->model("AnggaranModel")->rekap();
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

    public function tambahData()
    {
        $data['judul'] = 'Tambah Pemasukan';
        $data['kegiatan'] = $this->model("KegiatanModel")->getAllDataStatusWiting();
        $data['donatur'] = $this->model("DonaturModel")->getAllData();
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('anggaran/pemasukan/tambah', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $_POST['tipe_anggaran'] = UANG_MASUK;
        $_POST['status'] = WAITING;
        $dataInput = $_POST;
        $arrKegiatan = $dataInput['kegiatan'];
        $arrNominal = $dataInput['nominal'];
        if(count($arrKegiatan) > 0){
            foreach($arrKegiatan as $key => $kegiatan){
                $dataInsert = [
                    'id_kegiatan' => $kegiatan,
                    'id_donatur' => $dataInput['id_donatur'],
                    'tipe_anggaran' => UANG_MASUK,
                    'status' => WAITING,
                    'nominal' => str_replace('.', '', $arrNominal[$key]),
                    'tanggal' => $dataInput['tanggal'],
                    'keterangan' => $dataInput['keterangan']
                ];
                $this->model("AnggaranModel")->tambahData($dataInsert);
            }
        }
        $response = [
            'status' => 'success',
            'message' => 'Data berhasil ditambahkan',
            'redirect' => BASEURL . '/pemasukan'
        ];
        echo json_encode($response);
        die;
    }

    public function ubahData($id)
    {
        $data['judul'] = 'Ubah Pemasukan';
        $data['kegiatan'] = $this->model("KegiatanModel")->getAllDataStatusWiting();
        $data['donatur'] = $this->model("DonaturModel")->getAllData();
        $data['anggaran'] = $this->model("AnggaranModel")->getOneData($id);
        $this->view('templates/header', $data);
        $this->view('templates/sidemenu');
        $this->view('anggaran/pemasukan/ubah', $data);
        $this->view('templates/footer');
    }

    public function ubah()
    {
        $_POST['tipe_anggaran'] = UANG_MASUK;
        $_POST['status'] = WAITING;
        $updateData = $_POST;
        $updateData['nominal'] = str_replace('.', '', $updateData['nominal']);

        if ($this->model("AnggaranModel")->ubahData($updateData) > 0) {
            $response = [
                'status' => 'success',
                'message' => 'Data berhasil diubah',
                'redirect' => BASEURL . '/pemasukan'
            ];
        } else {
            $response = [
                'status' => 'false',
                'message' => 'Data gagal diubah',
            ];
        }
        echo json_encode($response);
        die;
    }

    public function hapus()
    {
        $id = $_POST['id'];
        $result = $this->model("AnggaranModel")->hapusData($id);
        echo json_encode($result);
    }
}
