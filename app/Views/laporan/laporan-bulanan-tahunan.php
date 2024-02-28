<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="row mb-4 mt-3">
    <div class="col-lg-12">
        <h1><?= $judulHalaman; ?></h1>
    </div>
</div>

<div class="row p-3">
    <div class="col-lg-12">
        <p class="form-label">Jenis Laporan : <span class="fw-normal"><?= $jenis_laporan == 'bulanan' ? 'Bulanan' : 'Tahunan' ?></span></p>
        <p class="form-label">Tahun: <span class="fw-normal"><?= $tahun ?></span></p>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="row mt-3 mx-3">
                <div>
                    <a href="<?= site_url('cetak-laporan'); ?>" class="btn btn-danger">Download PDF<i class="fas fa-file-pdf mx-2"></i></a>
                </div>
            </div>
            <div class="card-body">
                <table id="myTable" class="display table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Harga Jual</th>
                            <th>Harga Beli</th>
                            <th>Total Harga</th>
                            <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php if (isset($detail_penjualan)) : ?>
                            <?php foreach ($detail_penjualan as $row) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['nama_produk'] ?></td>
                                    <td><?= $row['tgl_penjualan'] ?></td>
                                    <td><?= $row['qty'] ?></td>
                                    <td><?= $row['harga_jual'] ?></td>
                                    <td><?= $row['harga_beli'] ?></td>
                                    <td><?= $row['total_harga'] ?></td>
                                    <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <tfoot>
                        <tr>
                            <td colspan="6">Total Penjualan:</td>
                            <td><?= $total_penjualan ?></td>
                        </tr>
                        <tr>
                            <td colspan="6">Total Keuntungan:</td>
                            <td><?= $total_keuntungan ?></td>
                        </tr>
                    </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<?= $this->endSection(); ?>