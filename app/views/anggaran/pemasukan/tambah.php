<?php
$dataKegiatan       = $data['kegiatan'];
$dataDonatur        = $data['donatur'];
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
                    <form autocomplete="off" method="post" action="<?= BASEURL . '/Pemasukan/tambah' ?>" id="formSubmit">
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" value="<?= date('Y-m-d') ?>" class="form-control" id="tanggal" readonly name="tanggal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="donatur">Donatur</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="donatur" name="id_donatur" required>
                                    <option value="">-Pilih Donatur-</option>
                                    <?php foreach ($dataDonatur as $d) : ?>
                                        <option value="<?= $d['id_donatur'] ?>"><?= $d['nama_donatur'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kegiatan">Kegiatan</label>
                            <div class="col-sm-10">
                                <?php foreach ($dataKegiatan as $row) : ?>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="<?= $row['id_kegiatan'] ?>" name="kegiatan[]" id="kegiatan_<?= $row['id_kegiatan'] ?>" onchange="showHide(this)">
                                                <label class="form-check-label" for="kegiatan_<?= $row['id_kegiatan'] ?>">
                                                    <?= $row['nama_kegiatan'] ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group" id="wraper_nominal_<?= $row['id_kegiatan'] ?>" style="display: none;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                                </div>
                                                <input type="text" id="nominal_<?= $row['id_kegiatan'] ?>" class="form-control nominalData" placeholder="nominal">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Uraian Anggaran</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="keterangan" required id="keterangan" cols="30" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <!-- redirect back -->
                                <a href="<?= BASEURL . '/Pemasukan' ?>" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
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
                        window.location.href = '<?= BASEURL ?>/Pemasukan';
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

    function showHide(id){
        var id = id.id;
        var idWrapperNominal = id.replace('kegiatan', 'wraper_nominal');
        var wrapperNominal = $('#' + idWrapperNominal);
        var idNominal = id.replace('kegiatan_', 'nominal_');
        var nominal = $(`#${idNominal}`)
        if ($(`#${id}`).is(':checked')) {
            wrapperNominal.show();
            // add atribute name to select
            nominal.attr('name', 'nominal[]');
        } else {
            // remove attribute name to select
            nominal.removeAttr('name');
            wrapperNominal.hide();
        }
    }
</script>