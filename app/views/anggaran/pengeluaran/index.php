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
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title"></h4>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-3 col-form-label">Nama Kegiatan</label>
                        <div class="col-sm-7">
                            <input class="form-control" type="text" value="" id="nama_kegiatan" placeholder="nama kegiatan" readonly>
                            <input class="form-control" type="hidden" value="" id="nama_kegiatan_hide" name="nama_kegiatan">
                            <input class="form-control" type="hidden" value="" id="id_kegiatan">
                            <input class="form-control" type="hidden" value="" id="tanggal_kegiatan">
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-primary waves-effect waves-light" type="button" data-toggle="modal" data-target="#dataModal"> search </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contentbar">

    <div class="row " id="cardAnggaran" style="display: none;">
        <div class="col-lg">
            <div id="message"></div>
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-2">
                        <button class="btn btn-success waves-effect waves-light" id="button_tambah" onclick="tambahDataElement('0')" type="button"> Tambah Data </button>
                    </div>
                    <br>
                    <table class="table table-bordered data-table-format" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Uraian</th>
                                <th>nominal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- <tbody> -->
                        <tbody id="resultAnggaran">

                        </tbody>
                        <tbody id="resultAnggaranEmpty">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-start formSubmitData" style="display: none;" id="formSubmitData"></div>

</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataModalLabel">Data Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>

                </button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered data-table-format" width="100%">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Tanggal</th>
                            <th>Nama Kegiatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataKegiatan as $data) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $data['tanggal']; ?></td>
                                <td>
                                    <a href="#" class="getNamaKegiatan" data-kegiatan="<?= $data['nama_kegiatan']; ?>" data-id="<?= $data['id_kegiatan']; ?>" data-tanggal="<?= $data['tanggal']; ?>" data-status="<?= $data['status']; ?>" data-dismiss="modal">
                                        <span>
                                            <?= $data['nama_kegiatan']; ?>
                                        </span>
                                    </a>

                                </td>
                            </tr>
                        <?php
                            $no++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#table-donatur').DataTable();
        $('.getNamaKegiatan').on('click', function() {
            const kegiatan = $(this).data('kegiatan');
            const id = $(this).data('id');
            const tanggal = $(this).data('tanggal');
            const status = $(this).data('status');

            $("#nama_kegiatan").val(kegiatan);
            $("#nama_kegiatan_hide").val(kegiatan);
            $("#id_kegiatan").val(id);
            $("#tanggal_kegiatan").val(tanggal);
            $("#tanggal_table_anggaran").html(tanggal);

            reloadTabelAnggaran(id);

            if (status != 0) {
                $("#form-anggaran").hide();
                $(".generate-status").hide();
            } else {
                $("#form-anggaran").show();
                $(".generate-status").show();
            }

            $("#cardAnggaran").show();
        })

        
    });

    function reloadTabelAnggaran(id) {
        $.ajax({
            url: '<?= BASEURL; ?>/pengeluaran/getByKegitanAnggaran',
            data: {
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                var data_load = '';
                num = 0;
                console.log(data);
                if (data.length != 0) {

                    for (let index = 0; index < data.length; index++) {
                        num++;
                        const element = data[index];
                        var inner_data = "save_" + index;
                        var inner_view = "view_" + index;
                        var inner_view2 = "view2_" + index;
                        var inner_view3 = "view3_" + index;
                        var function_viewDonatur = "viewDonatur('" + inner_view + "', '" + inner_view2 + "', '" + inner_view3 + "')";
                        var function_save = "saveDataElement('" + inner_data + "')";
                        var function_connfirmation = "hapusData(" + element.id_anggaran + ");"
                        var tipeUangMasuk = (parseInt(element.tipe_anggaran) === parseInt("<?= UANG_MASUK ?>")) ? "selected" : " ";
                        var tipeUangKeluar = (parseInt(element.tipe_anggaran) === parseInt("<?= UANG_KELUAR ?>")) ? "selected" : " ";
                        var namaDonatur = (element.nama_donatur != null) ? element.nama_donatur : "-";
                        data_load += '<tr>'
                        data_load += '    <td><input class="form-control" value="' + element.id_anggaran + '" type="hidden" name="id" id="" >' + num + '</td>'
                        data_load += '    <td class="dataInput"><input class="form-control" value="' + element.tanggal + '" type="date" name="tanggal" id="" placeholder="tanggal" readonly="readonly"></td>'
                        data_load += '    <td class="dataInput"><input class="form-control" value="' + element.keterangan + '" type="text" name="keterangan" id="" placeholder="keterangan" required ></td>'
                        data_load += '    <td class="dataInput"><input class="form-control" value="' + element.nominal + '" type="number" name="nominal" id="" placeholder="nominal" required ></td>'
                        data_load += '    <td class="dataInput">'
                        data_load += '          <button class="getHapus btn btn-danger waves-effect waves-light" data-id="' + element.id_anggaran + '" onclick="' + function_connfirmation + '"><span>Hapus</span></button>'
                        data_load += '          <button class="save btn btn-primary waves-effect waves-light" id="' + inner_data + '" onclick="' + function_save + '">Simpan</button>'
                        data_load += '    </td>'
                        data_load += '</tr>'
                    }
                }

                $('#resultAnggaran').html(data_load);
            },
            error: function(data) {
                console.log(data);
                console.log("ERROR");
            }
        });
    }

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
                        $("#message").html(message('berhasil', 'dihapus', 'success', 'anggaran'));
                    } else {
                        $("#message").html(message('gagal', 'dihapus', 'danger', 'anggaran'));
                    }
                    reloadTabelAnggaran($("#id_kegiatan").val());

                },
                error: function(data) {
                    console.log("GAGAL");
                }
            })
        }
    }

    function saveDataElement(id) {
        var data_id = document.getElementById(id).parentElement.parentElement;
        // console.log(data);
        const dataLength = document.getElementById(id).parentElement.parentElement.firstChild;
        const dataLength1 = document.getElementById(id).parentElement.parentElement.childNodes;
        isEdit = false;
        var form_costume = document.createElement("form");
        form_costume.setAttribute("id", "insert-anggaran");
        form_costume.setAttribute("method", "post");

        for (let i = 0; i < dataLength1.length; i++) {
            const element = dataLength1[i];
            if (element.children != undefined) {
                if (element.children.length != 0) {

                    for (let j = 0; j < element.children.length; j++) {
                        const element01 = element.children[j];
                        if (element01.tagName == "INPUT" || element01.tagName == "SELECT") {
                            element01_name = element01.name;
                            if (element01.tagName == "SELECT") {
                                element01_value = element01.options[element01.selectedIndex].value;
                            } else {

                                element01_value = element01.value;
                            }
                            console.log("element name :: => " + element01_name + "   ||| element_value :: => " + element01_value);

                            var inp = document.createElement('input')
                            inp.setAttribute('type', 'text');
                            inp.setAttribute('name', element01_name)
                            inp.setAttribute('value', element01_value)
                            form_costume.append(inp)
                            if ((element01_name == 'id') && (parseInt(element01_value) > 0)) {
                                isEdit = true;
                            }
                            if (!validationData(element01_name, element01_value)) return;
                        }
                    }
                }
            }
        }

        if (!isEdit) {
            url_send_data = "<?= BASEURL ?>/pengeluaran/tambah";
        } else {
            url_send_data = "<?= BASEURL ?>/pengeluaran/ubah";
        }

        var inp = document.createElement('input')
        inp.setAttribute('type', 'text');
        inp.setAttribute('name', 'id_kegiatan')
        inp.setAttribute('value', $("#id_kegiatan").val())
        form_costume.append(inp)

        $('#formSubmitData').append(form_costume)

        $.ajax({
            url: url_send_data,
            data: $('#insert-anggaran').serialize(),
            method: 'post',
            success: function(result) {
                console.log(result);
                $("#message").html(message('sukses', 'diubah atau ditambahkan', 'success', 'Anggaran'));
                $('#insert-anggaran').remove();
                data_id.remove();
                reloadTabelAnggaran($("#id_kegiatan").val());
            },
            error: function(result) {
                console.log(result);
                console.log("GAGAL");
            }
        });

    }

    function removeElement(id) {
        var data_id = document.getElementById(id).parentElement.parentElement;
        data_id.remove();
        $("#message").html(message('berhasil', 'dihapus', 'success', 'anggaran'));
    }

    function validationData(elementName, elementValue) {
        if (elementName == 'keterangan' && elementValue == '') {
            $("#message").html(message('gagal', 'diubah atau ditambahkan, Keterangan harus di isi', 'danger', 'anggaran'));
            return false;

        } else if (elementName == 'nominal' && (elementValue == '' || elementValue < 1)) {
            $("#message").html(message('gagal', 'diubah atau ditambahkan, Kredit harus di isi', 'danger', 'anggaran'));
            return false;

        } else {
            return true;
        }
    }

    function tambahDataElement(id) {
        id = parseInt(id) + 1
        var inner_data = "tambah_" + id;
        var inner_view = "lihat_" + id;
        var inner_view2 = "lihat2_" + id;
        var inner_view3 = "lihat3_" + id;
        var function_viewDonatur = "viewDonatur('" + inner_view + "', '" + inner_view2 + "', '" + inner_view3 + "')";
        var function_save = "saveDataElement('" + inner_data + "')";
        var function_remove = "removeElement('" + inner_data + "')";
        var data_load = '';
        data_load += '<tr>'
        data_load += '    <td bgcolor="SteelBlue"><input class="form-control" value="0" type="hidden" name="id" id="" placeholder="tanggal"></td>'
        data_load += '    <td class="dataInput"><input class="form-control" value="' + $("#tanggal_kegiatan").val() + '" type="date" name="tanggal" id="" placeholder="tanggal" readonly="readonly"></td>'
        data_load += '    <td class="dataInput"><input class="form-control" value="" type="text" name="keterangan" id="" placeholder="Uraian" required></td>'
        data_load += '    <td class="dataInput"><input class="form-control" value="" type="number" name="nominal" id="" placeholder="nominal" required></td>'
        data_load += '    <td class="dataInput">'
        data_load += '          <button class="btn btn-danger waves-effect waves-light"  onclick="' + function_remove + '"><span>Hapus</span></button>'
        data_load += '          <button class="save btn btn-primary waves-effect waves-light" id="' + inner_data + '" onclick="' + function_save + '">Simpan</button>'
        data_load += '    </td>'
        data_load += '</tr>'
        $('#button_tambah').attr('onclick', "tambahDataElement('" + id + "')");
        $('#resultAnggaranEmpty').append(data_load);
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