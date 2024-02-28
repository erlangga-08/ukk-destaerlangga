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
                <form action="<?= site_url('tambah-pengguna'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control <?= session()->has('errors') && array_key_exists('email', session('errors')) ? 'is-invalid' : null ?>" placeholder="Masukan Email" autocomplete="off" name="email" id="email" value="<?= old('email'); ?>">
                        <?php if (session()->has('errors') && array_key_exists('email', session('errors'))) : ?>
                            <div class="mx-1 invalid-feedback">
                                <p style="font-size: 1rem;">
                                    <?= session('errors')['email']; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control <?= session()->has('errors') && array_key_exists('nama_lengkap', session('errors')) ? 'is-invalid' : null ?>" placeholder="Masukan Nama Lengkap" autocomplete="off" name="nama_lengkap" id="namaLengkap" value="<?= old('nama_lengkap'); ?>">
                        <?php if (session()->has('errors') && array_key_exists('nama_lengkap', session('errors'))) : ?>
                            <div class="mx-1 invalid-feedback">
                                <p style="font-size: 1rem;">
                                    <?= session('errors')['nama_lengkap']; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control <?= session()->has('errors') && array_key_exists('username', session('errors')) ? 'is-invalid' : null ?>" placeholder="Masukan Username" autocomplete="off" name="username" id="username" value="<?= old('username'); ?>">
                        <?php if (session()->has('errors') && array_key_exists('username', session('errors'))) : ?>
                            <div class="mx-1 invalid-feedback">
                                <p style="font-size: 1rem;">
                                    <?= session('errors')['username']; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control <?= session()->has('errors') && array_key_exists('password', session('errors')) ? 'is-invalid' : null ?>" placeholder="Masukan Password" autocomplete="off" name="password" id="pass" value="<?= old('password'); ?>">
                        <?php if (session()->has('errors') && array_key_exists('password', session('errors'))) : ?>
                            <div class="mx-1 invalid-feedback">
                                <p style="font-size: 1rem;">
                                    <?= session('errors')['password']; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select class="form-select <?= session()->has('errors') && array_key_exists('level', session('errors')) ? 'is-invalid' : null ?>" id="level" name="level">
                            <?php if (isset($levelPengguna)) : ?>
                                <?php foreach ($levelPengguna as $value) : ?>
                                    <option value="<?= $value ?>" <?= ($value == old('level')) ? 'selected' : '' ?>><?= $value ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
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