<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title"><?= ucwords($data['judul']) ?></h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= BASEURL ?>"><?= APL_NAME; ?></a></li>
                    <li class="breadcrumb-item"><a href="<?= BASEURL ?>/donatur"><?= $data['judul'] ?></a></li>
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
        <div class="col-lg-7">
            <div class="card m-b-30">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Input Data donatur</h4>
                    <!-- SELECT `id`, `nama_donatur`, `alamat`, `no_donatur`, `agama` FROM `donatur` WHERE 1 -->
                    <form action="<?= BASEURL; ?>/donatur/tambah" method="post" class="form-enter" id="formInputData">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="hidden" value="" id="id_donatur" name="id_donatur" placeholder="">
                                <input class="form-control" type="text" value="" id="nama_donatur" name="nama_donatur" placeholder="nama donatur">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Nomor rekening</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" value="" id="no_rekening" name="no_rekening" placeholder="nomor rekening">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Kontak</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" value="" id="kontak" name="kontak" placeholder="kontak">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Tipe</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="tipe_donatur" id="tipe_donatur">
                                    <option value="">Select Tipe</option>
                                    <option value="<?= SINGLE ?>">Peribadi</option>
                                    <option value="<?= GROUP ?>">kelompok</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-5">
                                <a href="#" class="btn btn-primary waves-effect waves-light" onclick="saveData()"> Save </a>
                                <button class="btn btn-danger waves-effect waves-light" type="reset" onclick="reload_location('donatur')"> Reset </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10">
            <div class="card m-b-30">
                <div class="card-body">
                    <!-- <pre>
                        <?php print_r($data['donatur']); ?>
                    </pre> -->
                    <table id="datatable2" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kode Rekening</th>
                                <th>Kontak</th>
                                <th>Tipe</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach ($data['donatur'] as $data) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['nama_donatur']; ?></td>
                                    <td><?= $data['no_rekening']; ?></td>
                                    <td><?= $data['kontak']; ?></td>
                                    <td><?= $data['tipe_donatur_desc']; ?></td>
                                    <td>
                                        <a href="<?= BASEURL; ?>/donatur/hapus/<?= $data['id_donatur']; ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Yakin?');">
                                            <span>
                                                Hapus
                                            </span>
                                        </a>
                                        <a href="#" class="getUbah btn btn-primary waves-effect waves-light" data-id="<?= $data['id_donatur']; ?>">
                                            <span>
                                                Ubah
                                            </span>
                                        </a>
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
        $('.form-enter').on('keypress', function(e) {
            return e.which !== 13;
        });

        $('.getUbah').on('click', function() {

            const id = $(this).data('id')
            console.log(id);
            $.ajax({
                url: '<?= BASEURL; ?>/donatur/getUbah/',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $("#id_donatur").val(data.id_donatur);
                    $("#nama_donatur").val(data.nama_donatur);
                    $("#no_rekening").val(data.no_rekening);
                    $("#kontak").val(data.kontak);
                    $("#tipe_donatur").val(data.tipe_donatur);

                    $(".card-body form").attr('action', '<?= BASEURL; ?>/donatur/ubah')
                    $('.card-body form button[type=submit]').html('Ubah Data')

                }
            });
        });

        $('#datatable2').DataTable();

    });

    function saveData() {
        if ($('#nama_donatur').val() == "") {
            $("#message").html(message('gagal', 'diubah atau ditambahkan, data yang di isi harus lengkap', 'danger', 'donatur'));
            return
        }
        if ($('#no_donatur').val() == "") {
            $("#message").html(message('gagal', 'diubah atau ditambahkan, data yang di isi harus lengkap', 'danger', 'donatur'));
            return
        }
        if ($('#bidang').val() == "") {
            $("#message").html(message('gagal', 'diubah atau ditambahkan, data yang di isi harus lengkap', 'danger', 'donatur'));
            return
        }
        if ($('#jabatan').val() == "") {
            $("#message").html(message('gagal', 'diubah atau ditambahkan, data yang di isi harus lengkap', 'danger', 'donatur'));
            return
        }

        $('#formInputData').submit();
    }

    function message(pesan, aksi, tipe, data) {
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