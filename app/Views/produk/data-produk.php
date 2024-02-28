<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="row mb-4 mt-3">
    <div class="col-lg-12">
        <h1><?= $judulHalaman; ?></h1>
    </div>
</div>


<div class="row">
    <div class="col-lg-12 mb-4">
        <a href="<?= site_url('tambah-produk'); ?>" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Data</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-5"><?php if (session('success')) : ?>
            <?= session('success') ?>
        <?php endif; ?></div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <table id="myTable" class="display table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Satuan</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Aksi</th>
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
                                    <td><?= $p['kode_produk']; ?></td>
                                    <td><?= $p['nama_produk']; ?></td>
                                    <td><?= $p['harga_beli']; ?></td>
                                    <td><?= $p['harga_jual']; ?></td>
                                    <td><?= $p['nama_satuan']; ?></td>
                                    <td><?= $p['nama_kategori']; ?></td>
                                    <td><?= $p['stok']; ?></td>
                                    <td>
                                        <a href=<?= site_url('/edit-produk/' . $p['id_produk']); ?> class="btn btn-warning"><i class="ti ti-pencil"></i></a>
                                        <form action="<?= site_url('hapus-produk/') . $p['id_produk']; ?>" method="post" class="d-inline-block">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="ti ti-trash"></i></button>
                                        </form>
                                    </td>
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

<?= $this->section('js'); ?>
<?= $this->endSection(); ?>