<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="row mb-4 mt-3">
    <div class="col-lg-12">
        <h1><?= $judulHalaman; ?></h1>
    </div>
</div>

<div class="row">

    <div class="col-lg-10">
        <!-- Default Card Example -->
        <div class="card mb-4">
            <div class="card-header">
                Form Tambah
            </div>
            <div class="card-body">
                <form action="<?= site_url('laporan-pendapatan'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="form-group mb-3">
                                <label for="namaSatuan" class="form-label">Penjualan Berdasarkan Bulan</label>
                                <select name="bulan" id="bulan" class="form-select">
                                    <option value="" selected>--pilih bulan--</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="namaSatuan" class="form-label">Penjualan Berdasarkan Tahun</label>
                                <input type="number" name="tahun" id="tahun" min="2022" max="2050" value="<?php echo date('Y'); ?>" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="namaSatuan" class="form-label">Jenis Laporan</label>
                                <select name="jenis_laporan" id="jenis_laporan" class="form-select">
                                    <option value="bulanan">Bulanan</option>
                                    <option value="tahunan">Tahunan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>

    </div>


</div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<?= $this->endSection(); ?>