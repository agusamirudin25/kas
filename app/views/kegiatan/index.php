<div class="page-content-wrapper">
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <h4 class="page-title"><?= ucwords($data['judul']) ?></h4>
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
        <div class="row">
            <div class="col-lg-8">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Input Data Kegiatan</h4>
                        <form action="<?= BASEURL; ?>/kegiatan/tambah" method="post" class="form-enter" id="formIputData">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="hidden" value="" id="id_kegiatan" name="id_kegiatan">
                                    <input class="form-control" type="text" value="" id="nama_kegiatan" name="nama_kegiatan" placeholder="Nama Kegiatan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Lokasi Kegiatan</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="" id="lokasi" name="lokasi" placeholder="Lokasi Kegiatan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date" value="" id="tanggal" name="tanggal">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-5">
                                    <a href="#" class="btn btn-primary waves-effect waves-light" onclick="saveData()"> Save </a>
                                    <button class="btn btn-danger waves-effect waves-light" type="reset" onclick="reload_location('kegiatan')"> Reset </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card m-b-30">
                    <div class="card-body">
                        <table class="table table-bordered data-table-format">
                            <thead>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Kegitan</th>
                                <th>Lokasi</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data['kegiatan'] as $data) : ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $data['tanggal']; ?></td>
                                        <td>
                                            <a href="#" class="getDetail" data-id="<?= $data['id_kegiatan']; ?>" data-toggle="modal" data-target="#dataModal">
                                                <span>
                                                    <?= $data['nama_kegiatan']; ?>
                                                </span>
                                            </a>
                                        </td>
                                        <td><?= $data['lokasi']; ?></td>
                                        <td>
                                            <a href="<?= BASEURL; ?>/kegiatan/hapus/<?= $data['id_kegiatan']; ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Yakin?');">
                                                <span>
                                                    Hapus
                                                </span>
                                            </a>
                                            <a href="#" class="getUbah btn btn-primary waves-effect waves-light" data-id="<?= $data['id_kegiatan']; ?>">
                                                <span>
                                                    Ubah
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php $no++;
                                endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Detail -->
    <div class="modal fade bd-example-modal-lg" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataModalLabel">Detail Kegitana</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-3 col-form-label">Nama Kegiatan</label>
                        <label for="example-text-input" class="col-sm-9 col-form-label" id='nama_kegiatan_detail'></label>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-3 col-form-label">organisasi</label>
                        <label for="example-text-input" class="col-sm-9 col-form-label" id='organisasi_kegiatan_detail'></label>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-3 col-form-label">Tanggal</label>
                        <label for="example-text-input" class="col-sm-9 col-form-label" id='tanggal_kegiatan_detail'></label>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-3 col-form-label">Keterangan</label>
                        <label for="example-text-input" class="col-sm-9 col-form-label" id='ketrangan_kegiatan_detail'></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.form-enter').on('keypress', function(e) {
                return e.which !== 13;
            });

            $('.getUbah').on('click', function() {
                const id = $(this).data('id')
                console.log(id);
                $.ajax({
                    url: '<?= BASEURL; ?>/kegiatan/getUbah',
                    data: {
                        id: id
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#id_kegiatan').val(data.id_kegiatan);
                        $('#nama_kegiatan').val(data.nama_kegiatan);
                        $('#lokasi').val(data.lokasi);
                        $('#tanggal').val(data.tanggal);
                        $('#keterangan').val(data.keterangan);

                        $(".card-body form").attr('action', '<?= BASEURL; ?>/kegiatan/ubah')
                        $('.card-body form button[type=submit]').html('Ubah Data')
                    }
                })
            });

            $('.getDetail').on('click', function() {
                const id = $(this).data('id')
                $.ajax({
                    url: '<?= BASEURL; ?>/kegiatan/getUbah',
                    data: {
                        id: id
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $("#nama_kegiatan_detail").html(": " + data.nama_kegiatan)
                        $("#organisasi_kegiatan_detail").html(": " + data.organisasi)
                        $("#tanggal_kegiatan_detail").html(": " + data.tanggal)
                        $("#ketrangan_kegiatan_detail").html(": " + data.keterangan)
                    }
                })
            });

            $('.data-table-format').DataTable();
        })

        function saveData() {
            var alert_error = message_alert('gagal', 'diubah atau ditambahkan, data yang di isi harus lengkap', 'danger', 'Kegiatan')
            console.log(alert_error);

            if ($('#nama_kegiatan').val() == "") {
                $("#message").html(alert_error);
                return
            }
            if ($('#organisasi').val() == "") {
                $("#message").html(alert_error);
                return
            }
            if ($('#tanggal').val() == "") {
                $("#message").html(alert_error);
                return
            }


            $('#formIputData').submit();
        }

        function message_alert(pesan, aksi, tipe, data) {
            allert_load = "";
            allert_load += '<div class="alert alert-' + tipe + ' alert-dismissible fade show" role="alert">'
            allert_load += 'Data ' + data + ' <strong>' + pesan + ' </strong> ' + aksi
            allert_load += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
            allert_load += '<span aria-hidden="true">&times;</span>'
            allert_load += '</button>'
            allert_load += '</div>'
            return allert_load
        }
    </script>