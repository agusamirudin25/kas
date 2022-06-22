<?php
$dataKegiatan       = $data['kegiatan'];
$dataDonatur        = $data['donatur'];
$dataPemasukan = $data['pemasukan'];
?>
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title"><?= $data['judul'] ?></h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= BASEURL ?>"><?= APL_NAME; ?></a></li>
                    <li class="breadcrumb-item"><a href="<?= BASEURL ?>/user"><?= $data['judul'] ?></a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="contentbar">
    <?php Flasher::flash(); ?>
    <div id="message"></div>
</div>
<div class="contentbar">

    <div class="row " id="cardAnggaran">
        <div class="col-lg">
            <div id="message"></div>
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-2">
                        <a class="btn btn-success waves-effect waves-light" href="<?= BASEURL . '/pemasukan/tambahData' ?>"> Tambah Data </a>
                    </div>
                    <div id="uraianBaru" class="mt-3">

                    </div>
                    <br>
                    <table class="table table-bordered data-table-format" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Donatur</th>
                                <th>nominal</th>
                                <th>Kegiatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- <tbody> -->
                        <tbody>
                            <?php
                            $no = 1; 
                            foreach($dataPemasukan as $item) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $item['tanggal'] ?></td>
                                    <td><?= $item['nama_donatur'] ?></td>
                                    <td><?= 'Rp. ' . number_format($item['nominal'], 0, ',', '.') ?></td>
                                    <td><?= $item['nama_kegiatan'] ?></td>
                                    <td>
                                        <a class="btn btn-warning" href="<?= BASEURL . '/pemasukan/ubahData/' . $item['id_anggaran'] ?>">Edit</a>
                                        <button class="btn btn-danger" onclick="hapusData(<?= $item['id_anggaran'] ?>)">Hapus</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-start formSubmitData" style="display: none;" id="formSubmitData"></div>

</div>


<script src="<?= BASEURL ?>/assets/plugins/autonumeric/autoNumeric.js"></script>
<script>
    $(document).ready(function() {
        $('.data-table-format').DataTable();
        $('.nominalData').mask('000.000.000', {reverse: true});
    });

    function hapusData(id) {
        let isExecuted = confirm("Yakin?");
        if (isExecuted) {
            $.ajax({
                url: '<?= BASEURL ?>/pemasukan/hapus',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    if (data > 0) {
                        alert("Data berhasil dihapus");
                        window.location.reload();
                    } else {
                        alert("Data gagal dihapus");
                    }
                },
                error: function(data) {
                    console.log("GAGAL");
                }
            })
        }
    }
</script>