<?php
$dataKegiatan       = $data['kegiatan'];
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
    <div class="row ">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <br>
                    <form autocomplete="off" method="post" action="<?= BASEURL . '/Pengeluaran/tambah' ?>" id="formSubmit" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" value="<?= date('Y-m-d') ?>" class="form-control" id="tanggal" readonly name="tanggal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kegiatan">Kegiatan</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="kegiatan" name="id_kegiatan" required>
                                    <option value="">-Pilih Kegiatan-</option>
                                    <?php foreach ($dataKegiatan as $item) : ?>
                                        <option value="<?= $item['id_kegiatan'] ?>"><?= $item['nama_kegiatan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Nominal</label>
                            <div class="col-sm-10">
                                <div class="input-group" id="wraper_nominal">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                    </div>
                                    <input type="text" id="nominal" name="nominal" class="form-control nominalData" placeholder="nominal">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Uraian Anggaran</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="keterangan" required id="keterangan" cols="30" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="file_bukti" class="col-sm-2 col-form-label">File Bukti</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control-file" accept="image/*" id="file_bukti" name="file_bukti">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <!-- redirect back -->
                                <a href="<?= BASEURL . '/Pengeluaran' ?>" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= BASEURL ?>/assets/plugins/autonumeric/autoNumeric.js"></script>
<script>
    $(document).ready(function() {
        $('.data-table-format').DataTable();
        $('.nominalData').mask('000.000.000', {
            reverse: true
        });

        $('#formSubmit').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            var url = form.attr('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    var data = JSON.parse(data);
                    if(data.status == 'success') {
                        alert(data.message);
                        window.location.href = '<?= BASEURL ?>/Pengeluaran';
                    } else {
                        alert(data.message);
                    }
                },
                error: function(data) {
                    console.log(data);
                    console.log("ERROR");
                }
            });
        });
    });
</script>