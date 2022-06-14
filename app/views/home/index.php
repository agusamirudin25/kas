<!-- End Topbar -->
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title"><?= $data['judul'] ?></h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Actions</button>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbbar -->
<!-- Start Contentbar -->
<div class="contentbar">
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 col-xl-7">
            <!-- Start row -->
            <div class="row">
                <!-- Start col -->
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h5 class="card-title mb-30">LaporanKeuangan</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body py-0">
                            <div class="row align-items-center">
                                <div class="col-lg-3 pr-0">
                                    <div class="revenue-box border-bottom mb-2">
                                        <h4>+ <?= $data['totalPemasukan']['totalAnggaran'] ?></h4>
                                        <p>Total Pemasukan</p>
                                    </div>
                                    <div class="revenue-box">
                                        <h4>- <?= $data['totalPengeluaran']['totalAnggaran'] ?></h4>
                                        <p>Total Pengeluaran</p>
                                    </div>
                                </div>
                                <div class="col-lg-9 px-1 m-b-20">
                                    <div id="apex-line-chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
                <!-- Start col -->
                <div class="col-lg-3 col-xl-6">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="media">
                                <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="feather icon-folder"></i></span>
                                <div class="media-body">
                                    <p class="mb-0">Kegiatan</p>
                                    <h5 class="mb-0"><?= $data['totalKegiatan']['total'] ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
                <!-- Start col -->
                <div class="col-lg-3 col-xl-6">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="media">
                                <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="feather icon-clipboard"></i></span>
                                <div class="media-body">
                                    <p class="mb-0">Donatur</p>
                                    <h5 class="mb-0"><?= $data['totalDonatur']['total'] ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
            </div>
            <!-- End row -->
        </div>
        <!-- End col -->
        <div class="col-lg-7 col-xl-2">
            <div class="card m-b-30">
                <div class="card-body text-center">
                    <div class="user-slider">
                        <?php foreach ($data['topDonatur'] as $top) : ?>
                            <div class="user-slider-item">
                                <img src="<?= BASEURL ?>/assets/images/users/men.svg" alt="avatar" class="rounded-circle mt-3 mb-4">
                                <h5> <?= $top['nama_donatur']?></h5>
                                <p>Sebesar</p>
                                <p>Rp. <?= $top['total']?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
    <!-- End row -->
    <!-- Start row -->

    <!-- End row -->
</div>
<!-- End Contentbar -->
<script>
    var options = {
        chart: {
            height: 300,
            type: 'line',
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            }
        },
        colors: ['#0080ff'],
        series: [{
            name: "Pemasukan",
            data: [<?= $data['januari']['totalAnggaran'] ?>,
                <?= $data['februari']['totalAnggaran'] ?>,
                <?= $data['maret']['totalAnggaran'] ?>,
                <?= $data['april']['totalAnggaran'] ?>,
                <?= $data['mei']['totalAnggaran'] ?>,
                <?= $data['juni']['totalAnggaran'] ?>,
                <?= $data['juli']['totalAnggaran'] ?>,
                <?= $data['agustus']['totalAnggaran'] ?>,
                <?= $data['september']['totalAnggaran'] ?>,
                <?= $data['oktober']['totalAnggaran'] ?>,
                <?= $data['november']['totalAnggaran'] ?>,
                <?= $data['desember']['totalAnggaran'] ?>,
            ]
        }],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight'
        },
        grid: {
            row: {
                colors: ['transparent', 'transparent'],
                opacity: .2
            },
            borderColor: 'rgba(0,0,0,0.05)'
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Nov', 'Des'],
            axisBorder: {
                show: true,
                color: 'rgba(0,0,0,0.05)'
            },
            axisTicks: {
                show: true,
                color: 'rgba(0,0,0,0.05)'
            }
        }
    }
    var chart = new ApexCharts(
        document.querySelector("#apex-line-chart1"),
        options
    );
    chart.render();
</script>