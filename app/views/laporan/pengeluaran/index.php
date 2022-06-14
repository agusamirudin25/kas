<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="<?= BASEURL ?>"><?= APL_NAME; ?></a></li>
                            <li class="breadcrumb-item active"><?= $data['judul']; ?></li>
                        </ol>
                    </div>
                    <h4 class="page-title"><?= ucwords($data['judul']); ?></h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-lg-10">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered data-table-format">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>No Rekening</th>
                            <th>Uraian</th>
                            <th>kredit</th>
                            <th>status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dataPemasukan = $data['anggaran'];
                        $no = 0;
                        foreach ($dataPemasukan as $pemasukan) :
                            $no++;
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $pemasukan['tanggal']; ?></td>
                                <td><?= $pemasukan['no_rekening']; ?></td>
                                <td><?= $pemasukan['keterangan']; ?></td>
                                <td><?= $pemasukan['kredit']; ?></td>
                                <td><?= $pemasukan['status_desc']; ?></td>
                                <td>
                                    <button class="ubahStatus btn btn-primary waves-effect waves-light" data-id="<?= $pemasukan['id']; ?>" data-status="<?= $pemasukan['status'] ?>">
                                        <span>
                                            Ubah Status
                                        </span>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        disableButton();

        $('.data-table-format').DataTable();

        $('.ubahStatus').on('click', function() {
            var id = $(this).data('id')
            var status = modifyStatus($(this).data('status'));
            console.log(id);
            console.log(status);
            $.ajax({
                url: '<?= BASEURL; ?>/laporan/ubahstatusbyid',
                data: {
                    id: id,
                    status: status
                },
                method: 'post',
                dataType: 'json',
                beforeSend: function() {
                    $.blockUI({
                        message: null
                    });
                },
                complete: function() {
                    $.unblockUI();
                },
                success: function(data) {
                    console.log(data);
                    location.reload();
                },
                error: function(data) {
                    console.log("ERROR");
                }
            })

        });
    });

    function modifyStatus(status) {
        if (parseInt(status) == 0) {
            status = 1
        } else if (parseInt(status) == 1) {
            status = 2
        }
        return status
    }

    function disableButton() {
        <?php $sessionUserType = $_SESSION['login']['type'];
        if ($sessionUserType == KEPALA_USR) {
            if (!intval($pemasukan['status'] == intval(PROCESS))) { ?>
                $('.ubahStatus').prop('disabled', true)
            <?php }
        } else if ($sessionUserType == BENDAHARA_USR) {
            if (!intval($pemasukan['status'] == intval(WAITING))) { ?>
                $('.ubahStatus').prop('disabled', true)
            <?php }
        } else {
            if (!intval($pemasukan['status'] == intval(PROCESS))) { ?>
                $('.ubahStatus').prop('disabled', true)
        <?php }
        } ?>

    }
</script>