<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="row mb-4 mt-3">
    <div class="col-lg-12">
        <h1><?= $judulHalaman; ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 mb-4">
        <a href="<?= site_url('tambah-kategori'); ?>" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Data</a>
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
                            <th style="width: 3%;">No</th>
                            <th>Nama kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($dataKategori)) {
                            $no = null;
                            foreach ($dataKategori as $k) {
                                $no++;
                        ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $k['nama_kategori']; ?></td>
                                    <td>
                                        <a href=<?= site_url('/edit-kategori/' . $k['id_kategori']); ?> class="btn btn-warning"><i class="ti ti-pencil"></i></a>
                                        <form action="<?= site_url('/hapus-kategori/' . $k['id_kategori']); ?>" method="post" class="d-inline-block">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" id="hapusKategori" data-id="<?= $k['id_kategori']; ?>"><i class="ti ti-trash"></i></button>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {

        periksaKeterkaitanDataKategori();
        // Periksa keterkaitan satuan
        function periksaKeterkaitanDataKategori() {
            let daftarIdData = [];
            let buttons = document.querySelectorAll('#hapusKategori');
            buttons.forEach(function(button) {
                daftarIdData.push(button.dataset.id);
            });

            daftarIdData.forEach(function(idData) {
                let xhr = new XMLHttpRequest();
                xhr.open('GET', '<?= site_url('cek-kategori-digunakan/'); ?>' + idData, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {

                            // Respons berhasil diterima
                            let response = JSON.parse(xhr.responseText);

                            if (response.has_keterkaitan) {
                                let tombol = document.querySelector('#hapusKategori[data-id="' + idData + '"]');
                                tombol.disabled = true;

                                let pesan = document.createElement('span');
                                pesan.classList.add('pesan-error');
                                pesan.textContent = 'Data sudah digunakan dan tidak bisa dihapus';

                                pesan.style.display = 'inline-block';
                                pesan.style.color = 'red';
                                pesan.style.marginLeft = '10px';
                                pesan.style.backgroundColor = 'rgba(255, 0, 0, 0.1)';

                                tombol.parentNode.insertBefore(pesan, tombol.nextSibling);
                            }
                        } else {
                            // Respons gagal
                            console.error('Terjadi kesalahan saat melakukan permintaan AJAX');
                        }
                    }
                };
                xhr.send();
            });
        }
    });
</script>
<?= $this->endSection(); ?>