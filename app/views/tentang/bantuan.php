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
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                   <iframe src="<?= BASEURL . '/assets/PANDUAN PENGGUNAAN.pdf' ?>" frameborder="0" width="100%" height="800px"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>