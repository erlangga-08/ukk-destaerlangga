<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="row mb-4 mt-3">
    <div class="col-lg-12">
        <h1><?= $judulHalaman; ?></h1>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-3">
        <div class="card" style="height:140px; max-height:140px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <i class="ti ti-box-seam" style="font-size: 45px;"></i>
                    </div>
                    <div class="col-md-8">
                        <h5 class="card-title">Jumlah Produk</h5>
                        <p class="card-text">50</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card" style="height:140px; max-height:140px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="ti ti-businessplan" style="font-size: 45px;"></i>
                    </div>
                    <div class="col-md-8">
                        <h5 class="card-title">Pendapatan Bulan Ini</h5>
                        <p class="card-text">Rp.100.000,00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card" style="height:140px; max-height:140px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <i class="ti ti-coin" style="font-size: 45px;"></i>
                    </div>
                    <div class="col-md-8">
                        <h5 class="card-title">Pendapatan Hari Ini</h5>
                        <p class="card-text">Rp.100.000,00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card" style="height:140px; max-height:140px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <i class="ti ti-users" style="font-size: 45px;"></i>
                    </div>
                    <div class="col-md-8">
                        <h5 class="card-title">Pengguna</h5>
                        <p class="card-text">10</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<?= $this->endSection(); ?>