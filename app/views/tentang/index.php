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
        <div class="col-lg-5">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="logobar">
                        <img src="<?= BASEURL ?>/assets/images/STMIK.png" class="img-fluid" alt="dashboard" height="50">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card m-b-30">
                <div class="card-body">
                    <p>
                        Nama : Arlia anne parmila
                    </p>
                    <p>
                        Npm : 43E57067193002

                    </p>
                    <p>
                        Prodi : Sistem informasi akuntansi/6
                    </p>
                    <p>
                        Judul penelitian : perancangan sistem informasi buku kas umum ( studi kasus pada Yayasan kemanusiaan Karawang peduli )
                    </p>
                    <p>
                        Komisi pembingbing :
                    </p>
                    <p>
                        1.Dedih., M.Kom
                    </p>
                    <p>
                        2. Supini.,S.Kom.,M.M
                    </p>
                </div>
            </div>
            <div class="card m-b-30">
                <div class="card-body">
                    <p>1. Prosedural masuk sistem sebagai admin.</p>
                    <p>a. Buka XAMPP yang telah terinstall.</p>
                    <p>b. Aktifkan Apache dan MySQL dengan cara klik start pada action palingatas.</p>
                    <p>c. Buka google chrome kemudian ketik http://localhost/kas/ pada address bar dan tekan enter.</p>
                    <p>d. Setelah masuk ke sistem ketikan Username dan Password , kemudian klik tombol Login.</p>
                    <p>e. Setelah login berhasil maka akan masuk ke halaman utama admin, pada halaman utama terdapat menu dashboard, user, pengurus,donatur, kegiatan, pemasukan, pengeluaran dan laporan.</p>
                    <p>f. Untuk penginputan data user pilih menu user lalu input nama user, password, user type, dan no pengurus sesuai dengan kebutuhan admin.</p>
                    <p>g. Untuk input data pengurus pilih menu pengurus lalu input nama pegawai, no pengurus dan select jabatan sesuai dengan kebutuhan admin.</p>
                    <p>h. Untuk penginputan kegiatan pilih menu kegiatan lalu input nama kegiatan, nama organisasi, tanggal, dan uraian sesuai dengan kebutuhan admin. </p>
                    <p>i. Untuk penginputan pemasukan pilih menu pemasukan lalu input tanggal, pilih kegiatan, nominal, no rekening, uraian. </p>
                    <p>j. Untuk penginputan pengeluaran pilih menu pengeluaran lalu klik search nama kegiatan dan pilih kegiatan sesuai yang telah di input sebelumnya, tambah data untuk mengiput data. </p>
                    <p>k. Untuk melihat laporan pilih menu laporan, dan untuk melihat laporan yang di inginkan klik tombol search lalu pilih kegiatan sesuai yang telah di input sebelumnya. </p>
                </div>
            </div>
        </div>
    </div>
</div>