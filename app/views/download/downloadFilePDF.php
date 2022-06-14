<body onload="window.print()">
    <div class="col-lg">
        <div class="card" id="card-tabel-summary">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-sm-3">
                        <img src="<?= BASEURL ?>/assets/images/karawang epduli.jpeg" height="150" alt="logo">
                    </div>
                    <div class="col-sm-7">
                        <div class="row d-flex justify-content-center">
                            <h2 class="text-center">Karawang Peduli</h2>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <h3 class="text-center">Berbagi dan Peduli dengan Hati</h3>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Organisai</label>
                    <label for="example-text-input" class="col-sm-7 col-form-label">: KARAWANG PEDULI</label>
                </div>
                <div class="row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Pengguna Anggaran (PA)/Kuasa PA/Pengurus</label>
                    <label for="example-text-input" class="col-sm-2 col-form-label">: <?= $data['nama_KPA']['nama_pengurus'] ?></label>
                </div>
                <div class="row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Bendahara</label>
                    <label for="example-text-input" class="col-sm-2 col-form-label">: <?= $data['nama_Bendahara']['nama_pengurus'] ?></label>
                </div>
                <div class="row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Bendahara Pembantu</label>
                    <label for="example-text-input" class="col-sm-2 col-form-label">: - </label>
                </div>
                <div class="row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Bulan</label>
                    <label for="example-text-input" class="col-sm-2 col-form-label">: <span id="bulan_search"><?= $data['bulan'] ?></span></label>
                </div>
                <hr>
                <table class="table table-bordered data-table-format">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Donatur</th>
                            <th>Nama Kegiatan</th>
                            <th>Uraian</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                        </tr>
                    </thead>
                    <tbody id="summaryResult">
                        <?php
                        $anggaranArr = $data['anggaran'];
                        $no = 0;
                        foreach ($anggaranArr as $anggaran) :
                            $no++;
                            $debit = ($anggaran['debit'] != '-') ? $anggaran['debit'] : 0;
                            $kredit = ($anggaran['kredit'] != '-') ? $anggaran['kredit'] : 0;
                            $totalSaldo = $debit - $kredit;
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $anggaran['tanggal']; ?></td>
                                <td><?= $anggaran['donatur_result']; ?></td>
                                <td><?= $anggaran['nama_kegiatan_result']; ?></td>
                                <td><?= $anggaran['keterangan']; ?></td>
                                <td><?= number_format($debit); ?></td>
                                <td><?= number_format($kredit); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <?php
                        $pemasukanBulanIni = $data['totalPemasukanBulanIni']['totalAnggaran'];
                        $pengeluaranBulanIni = $data['totalPengeluaranBulanIni']['totalAnggaran'];
                        $totalSaldobulanIni = intval($pemasukanBulanIni) - intval($pengeluaranBulanIni);
                        ?>
                        <tr>
                            <th colspan="5">Jumlah Bulan Ini</th>
                            <th><span id="total-pemasukan-bulan-ini"><?= number_format($pemasukanBulanIni); ?></span></th>
                            <th><span id="total-pengeluaran-bulan-ini"><?= number_format($pengeluaranBulanIni); ?></span></th>
                        </tr>
                        <?php
                        $totalPemasukanSampaiBulanLalu = $data['totalPemasukanSampaiBulanLalu']['totalAnggaran'];
                        $totalPengeluaranSampaiBulanLalu = $data['totalPengeluaranSampaiBulanLalu']['totalAnggaran'];
                        $totalSaldoBulanLau = intval($totalPemasukanSampaiBulanLalu) - intval($totalPengeluaranSampaiBulanLalu);
                        ?>
                        <tr>
                            <th colspan="5">Jumlah s/d Bulan Lalu</th>
                            <th><span id="total-pemasukan-sampai-bulan-lalu"><?= number_format($totalPemasukanSampaiBulanLalu); ?></th>
                            <th><span id="total-pengeluaran-sampai-bulan-lalu"><?= number_format($totalPengeluaranSampaiBulanLalu); ?></th>
                        </tr>
                        <?php
                        $totalPemasukanKeseluruhan = intval($pemasukanBulanIni) + intval($totalPemasukanSampaiBulanLalu);
                        $totalPengeluranKeseluruhan = intval($pengeluaranBulanIni) + intval($totalPengeluaranSampaiBulanLalu);
                        $totalSaldoKeseluruhan = intval($totalPemasukanKeseluruhan) - intval($totalPengeluranKeseluruhan);
                        ?>
                        <tr>
                            <th colspan="5">Jumlah s/d Bulan Ini</th>
                            <th><span id="total-pemasukan-keseluruhan"><?= number_format($totalPemasukanKeseluruhan); ?></th>
                            <th><span id="total-pengeluaran-keseluruhan"><?= number_format($totalPengeluranKeseluruhan); ?></th>
                        </tr>
                    </tfoot>
                </table>

            </div>
            <div class="row">
                <label for="example-text-input" class="col-sm-11 col-form-label d-flex justify-content-end"> Karawang, <?= date("d F Y") ?></label>
            </div>
            <div class="row">
                <label for="example-text-input" class="col-sm-10 col-form-label d-flex justify-content-center">Mengetahui,</label>
            </div>
            <div class="row">
                <label for="example-text-input" class="col-sm-5 col-form-label d-flex justify-content-around"> Kepal Bagian,</label>
                <label for="example-text-input" class="col-sm-5 col-form-label d-flex justify-content-around"> Bendahara,</label>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="row">
                <label for="example-text-input" class="col-sm-5 col-form-label d-flex justify-content-around" style="text-decoration: underline;"> <?= $data['nama_KPA']['nama_pengurus']; ?></label>
                <label for="example-text-input" class="col-sm-5 col-form-label d-flex justify-content-around" style="text-decoration: underline;"> <?= $data['nama_Bendahara']['nama_pengurus']; ?></label>
            </div>
            <div class="row">
                <label for="example-text-input" class="col-sm-5 col-form-label d-flex justify-content-around">NIP. <?= $data['nama_KPA']['no_pengurus']; ?></label>
                <label for="example-text-input" class="col-sm-5 col-form-label d-flex justify-content-around">NIP. <?= $data['nama_Bendahara']['no_pengurus']; ?></label>
            </div>
            <br>
        </div>
    </div>
</body>