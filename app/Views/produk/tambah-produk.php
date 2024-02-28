<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="row mb-3 mt-3">
    <div class="col-lg-12">
        <h1><?= $judulHalaman; ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Form Tambah
            </div>
            <div class="card-body">
                <form action="<?= site_url('tambah-produk'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="namaSatuan" class="form-label">Kode Produk</label>
                                <input type="text" class="form-control" id="kodeProduk" placeholder="Masukan Kode Produk" autocomplete="off" value="<?= $kodeProduk; ?>" disabled>
                                <input type="hidden" class="form-control" id="kodeProduk" placeholder="Masukan Kode Produk" autocomplete="off" value="<?= $kodeProduk; ?>" name="kode_produk">
                            </div>
                            <div class="mb-3">
                                <label for="namaSatuan" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control <?= session()->has('errors') && array_key_exists('nama_produk', session('errors')) ? 'is-invalid' : null ?>" id="namaProduk" placeholder="Masukan Nama Produk" autocomplete="off" name="nama_produk">
                                <?php if (session()->has('errors') && array_key_exists('nama_produk', session('errors'))) : ?>
                                    <div class="mx-1 invalid-feedback">
                                        <p style="font-size: 1rem;">
                                            <?= session('errors')['nama_produk']; ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <label for="basic-url" class="form-label">Harga Beli</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="form-control uang <?= session()->has('errors') && array_key_exists('harga_beli', session('errors')) ? 'is-invalid' : null ?>" placeholder="Masukan Harga Beli" name="harga_beli">
                                <?php if (session()->has('errors') && array_key_exists('harga_beli', session('errors'))) : ?>
                                    <div class="mx-1 invalid-feedback">
                                        <p style="font-size: 1rem;">
                                            <?= session('errors')['harga_beli']; ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <label for="basic-url" class="form-label">Harga Jual</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3">Rp.</span>
                                <input type="text" class="form-control uang <?= session()->has('errors') && array_key_exists('harga_jual', session('errors')) ? 'is-invalid' : null ?>" placeholder="Masukan Harga Jual" name="harga_jual">
                                <?php if (session()->has('errors') && array_key_exists('harga_jual', session('errors'))) : ?>
                                    <div class="mx-1 invalid-feedback">
                                        <p style="font-size: 1rem;">
                                            <?= session('errors')['harga_jual']; ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="namaSatuan" class="form-label">Stok</label>
                                <input type="text" class="form-control stok <?= session()->has('errors') && array_key_exists('stok', session('errors')) ? 'is-invalid' : null ?>" id="stok" autocomplete="off" placeholder="Masukan Stok Produk" name="stok">
                                <?php if (session()->has('errors') && array_key_exists('stok', session('errors'))) : ?>
                                    <div class="mx-1 invalid-feedback">
                                        <p style="font-size: 1rem;">
                                            <?= session('errors')['stok']; ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="namaSatuan" class="form-label">Satuan</label>
                                <select class="form-select mr-sm-2 <?= session()->has('errors') && array_key_exists('satuan', session('errors')) ? 'is-invalid' : null ?>" id="satuan" name="satuan">
                                    <option value="">--Pilih--</option>
                                    <?php if (isset($dataSatuan)) : ?>
                                        <?php foreach ($dataSatuan as $value) : ?>
                                            <option value="<?= $value['id_satuan'] ?>" <?= ($value['id_satuan'] == old('satuan')) ? 'selected' : '' ?>><?= $value['nama_satuan']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <?php if (session()->has('errors') && array_key_exists('satuan', session('errors'))) : ?>
                                    <div class="mx-1 invalid-feedback">
                                        <p style="font-size: 1rem;">
                                            <?= session('errors')['satuan']; ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="namaSatuan" class="form-label">Kategori</label>
                                <select class="form-select mr-sm-2 <?= session()->has('errors') && array_key_exists('kategori', session('errors')) ? 'is-invalid' : null ?>" id="satuan" name="kategori">
                                    <option value="">--Pilih--</option>
                                    <?php if (isset($dataKategori)) : ?>
                                        <?php foreach ($dataKategori as $value) : ?>
                                            <option value="<?= $value['id_kategori'] ?>" <?= ($value['id_kategori'] == old('kategori')) ? 'selected' : '' ?>><?= $value['nama_kategori']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <?php if (session()->has('errors') && array_key_exists('kategori', session('errors'))) : ?>
                                    <div class="mx-1 invalid-feedback">
                                        <p style="font-size: 1rem;">
                                            <?= session('errors')['kategori']; ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    // input nomer
    $('.stok').mask('000.000', {
        reverse: true
    });

    // input nomer
    $('.uang').mask('000.000.000.000.000', {
        reverse: true
    });
</script>
<?= $this->endSection(); ?>