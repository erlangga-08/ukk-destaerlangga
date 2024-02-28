<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="row mb-4 mt-3">
    <div class="col-lg-12">
        <h1><?= $judulHalaman; ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div>
                        <a href="<?= site_url('pdf-stok'); ?>" class="btn btn-danger">Download PDF<i class="fas fa-file-pdf mx-2"></i></a>
                    </div>
                </div>
                <table id="myTable" class="display table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 3%;">No</th>
                            <th>Nama Produk</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($dataProduk)) {
                            $no = null;
                            foreach ($dataProduk as $p) {
                                $no++;
                        ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $p['nama_produk']; ?></td>
                                    <td><?= $p['harga_jual']; ?></td>
                                    <td style="background-color: <?= $p['stok'] == 0 ? '#ffcccc' : 'transparent'; ?>"><?= $p['stok']; ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>



<?= $this->endSection(); ?>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<?= $this->endSection(); ?>