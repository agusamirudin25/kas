<?php
$dataKegiatan       = $data['kegiatan'];
$dataPengeluaran = $data['pengeluaran'];
$dataRekap = $data['rekap'];
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
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-6">
                        <h3>Rekap Saldo</h3>
                    </div>
                    <table class="table table-bordered data-table-format" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kegiatan</th>
                                <th>Pemasukan</th>
                                <th>Pengeluaran</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <!-- <tbody> -->
                        <tbody>
                            <?php
                            $no = 1; 
                            foreach($dataRekap as $item) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $item['nama_kegiatan'] ?></td>
                                    <td><?= 'Rp. ' . number_format($item['pemasukan'], 0, ',', '.') ?></td>
                                    <td><?= 'Rp. ' . number_format($item['pengeluaran'], 0, ',', '.') ?></td>
                                    <td><?= 'Rp. ' . number_format($item['pemasukan'] - $item['pengeluaran'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contentbar">
    <div class="row " id="cardAnggaran">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-2">
                        <a class="btn btn-success waves-effect waves-light" href="<?= BASEURL . '/pengeluaran/tambahData' ?>"> Tambah Data </a>
                    </div>
                    <br>
                    <table class="table table-bordered data-table-format" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kegiatan</th>
                                <th>nominal</th>
                                <th>Uraian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- <tbody> -->
                        <tbody>
                            <?php
                            $no = 1; 
                            foreach($dataPengeluaran as $item) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $item['tanggal'] ?></td>
                                    <td><?= $item['nama_kegiatan'] ?></td>
                                    <td><?= 'Rp. ' . number_format($item['nominal'], 0, ',', '.') ?></td>
                                    <td><?= $item['keterangan'] ?></td>
                                    <td>
                                        <a class="btn btn-warning" href="<?= BASEURL . '/pengeluaran/ubahData/' . $item['id_anggaran'] ?>">Edit</a>
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
</div>

<script>
    $(document).ready(function() {
        $('.data-table-format').DataTable();
    });

    function hapusData(id) {
        let isExecuted = confirm("Yakin?");
        console.log(isExecuted);
        if (isExecuted) {
            $.ajax({
                url: '<?= BASEURL ?>/pengeluaran/hapus',
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