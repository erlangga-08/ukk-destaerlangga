<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="row mb-3 mt-3">
    <div class="col-lg-12">
        <h1>Edit Data Satuan</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Form Edit
            </div>
            <div class="card-body">
                <form action="<?= site_url('edit-data-satuan/') . $dataSatuan['id_satuan']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="namaSatuan" class="form-label">Nama Satuan</label>
                        <input type="text" class="form-control <?= session()->has('errors') ? 'is-invalid' : null ?>" id="namaSatuan" placeholder="Masukan Nama Satuan" autocomplete="off" name="nama_satuan" value="<?= $dataSatuan['nama_satuan'] ?>">
                        <?php if (session()->has('errors') && session('errors')['nama_satuan']) : ?>
                            <div class="mx-1 invalid-feedback">
                                <p style="font-size: 1rem;">
                                    <?= session('errors')['nama_satuan']; ?>
                                </p>
                            </div>
                        <?php endif; ?>
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