<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="row mb-3 mt-3">
    <div class="col-lg-12">
        <h1><?= $judulHalaman; ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card" style="height:430px; max-height: 430px;">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-12 form-label">
                        <i class="ti ti-chart-dots"></i> Penjualan Produk
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-4">
                        <p class="form-label">Tanggal : <span class="fw-normal"><?= $tanggal; ?></span></p>
                    </div>
                    <div class="col-lg-3">
                        <p class="form-label">Waktu : <span class="fw-normal"><?= $waktu; ?></span></p>
                    </div>
                    <div class="col-lg-3">
                        <p class="form-label">Kasir : <span class="fw-normal"><?= session()->get('nama_pengguna'); ?></span></p>
                    </div>
                    <div class="col-lg-4">
                        <p class="form-label">No Faktur : <span class="fw-normal"><?= $noFaktur; ?></span></p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= site_url('tambah-penjualan') ?>" method="post" id="formPenjualan">
                    <!-- <input type="hidden" class="form-control" name="id_produk" id="idProduk" autocomplete="off"> -->
                    <input type="hidden" class="form-control" name="no_faktur" id="nomorFaktur" autocomplete="off" value="<?= $noFaktur ?>">
                    <!-- <input type="hidden" class="form-control" name="hargaProduk" id="hargaProduk" autocomplete="off"> -->
                    <!-- <input type="hidden" class="form-control" name="id_pelanggan" id="idPelanggan" autocomplete="off"> -->
                    <!-- <input type="hidden" class="form-control" name="id_enjualan" id="idPenjualan" autocomplete="off"> -->
                    <!-- <div class="col-md-4 mb-3">
                                    <label for="validationCustom02">Pelanggan</label>
                                    <input type="text" class="form-control" placeholder="Masukan Id Pelanggan" autocomplete="off" name="cariPelanggan" id="cariPelanggan">
                                </div> -->
                    <div class="form-group mb-3 mt-1">
                        <label for="produk" class="mb-1 form-label">Produk</label>
                        <select class="js-example-basic-single form-control <?= session()->has('errors') ? 'is-invalid' : null ?>" name="id_produk">
                            <option value="">--Cari Produk--</option>
                            <?php if (isset($dataProduk)) :
                                foreach ($dataProduk as $row) : ?>
                                    <option value="<?= $row['id_produk']; ?>"><?= $row['nama_produk']; ?> | <?= $row['stok']; ?> | <?= number_format($row['harga_jual'], 0, ',', '.'); ?></option>
                            <?php
                                endforeach;
                            endif; ?>
                        </select>
                        <?php if (isset(session('errors')['id_produk'])) : ?>
                            <div class="mx-1 invalid-feedback">
                                <p style="font-size: 1rem;">
                                    <?= session('errors')['id_produk']; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jumlah" class="mb-1 form-label">Jumlah</label>
                        <input type="text" class="form-control <?= session()->has('errors') ? 'is-invalid' : null ?>" id="jumlah" placeholder="Masukan jumlah" name="jumlah" autocomplete="off">
                        <?php if (session()->has('errors') && session('errors')['jumlah']) : ?>
                            <div class="mx-1 invalid-feedback">
                                <p style="font-size: 1rem;">
                                    <?= session('errors')['jumlah']; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- <div class="col-md-4 mb-3">
                                    <label for="validationCustom01">Produk</label>
                                    <input type="text" class="form-control" placeholder="Masukan Kode Produk" name="cariProduk" id="cariProduk" autocomplete="off">
                                </div> -->
                    <!-- <div class="col-md-4 mb-3">
                                    <label for="validationCustomUsername">Jumlah</label>
                                    <input type="text" class="form-control" name="jumlah" placeholder="Msukan Jumlah" autocomplete="off">
                                </div> -->
                    <button type="submit" class="btn btn-primary mx-1"><i class="fas fa-cart-plus"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <h1 style="position:relative;" class="mb-3">Total : Rp.<span id="totalHargaSemuaBarang"><?= number_format($totalHarga, 0, ',', '.'); ?></span></h1>
        <div class="card" style="height:370px; max-height: 370px;">
            <div class="card-header form-label">
                <i class="ti ti-credit-card"></i> Pembayaran
            </div>
            <div class="card-body">
                <form action="" method="post" id="formPembayaran">
                    <div class="form-group mb-3">
                        <label for="bayar" class="mb-1 form-label">Bayar</label>
                        <input type="text" name="jumlahBayar" class="form-control" id="jumlahPembayaran" placeholder="Jumlah Bayar" autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <label for="kembali" class="mb-1 form-label">Kembali</label>
                        <input type="text" name="kembali" class="form-control" id="kembali" placeholder="Kembali" readonly>
                    </div>
                    <button type="submit" class="btn btn-success" id="btnPembayaran"><i class="ti ti-credit-card-pay"></i> Bayar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header form-label">
                <i class="ti ti-chart-candle"></i> Data Transaksi
            </div>
            <div class="card-body">
                <table id="" class="display table table-bordered" id="tabelPenjualan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($detailPenjualan) && !empty($detailPenjualan)) :
                            $no = 1;
                            foreach ($detailPenjualan as $detail) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $detail['nama_produk']; ?></td>
                                    <td><?= $detail['qty']; ?></td>
                                    <td><?= number_format($detail['harga_jual'], 0, ',', '.'); ?></td>
                                    <td><?= number_format($detail['total_harga'], 0, ',', '.'); ?></td>
                                    <form action="<?= site_url('hapus-detail/') . $detail['id_detail']; ?>" method="post">
                                        <td>
                                            <button type="submit" class="btn btn-danger"><i class="ti ti-trash"></i></button>
                                        </td>
                                    </form>
                                </tr>
                            <?php endforeach;
                        else : ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada produk</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

    function aturStatusPembayaran() {
        let totalBayar = parseFloat($('#jumlahPembayaran').val());
        let totalHargaSemuaBarang = parseFloat(<?= $totalHarga; ?>);

        if (totalBayar >= totalHargaSemuaBarang) {
            $('#btnPembayaran').prop('disabled', false);
        } else {
            $('#btnPembayaran').prop('disabled', true);
        }
    }

    // Ketika nilai pembayaran berubah, hitung jumlah kembali dan perbarui tampilan
    $('#jumlahPembayaran').on('input', function() {
        let totalBayar = parseFloat($(this).val());
        let totalHargaSemuaBarang = parseFloat(<?= $totalHarga; ?>);
        let kembali = totalBayar - totalHargaSemuaBarang;

        // $('#kembali').val('Rp.' + kembali);
        if (kembali >= 0) {
            $('#kembali').val(kembali.toFixed(2).replace(/(\.00)+$/, '')); // Menampilkan hingga 2 digit desimal
        } else {
            $('#kembali').val('0'); 
        }
        // Memanggil fungsi untuk mengatur status pembayaran setiap kali nilai berubah
        aturStatusPembayaran();
    });

    // Saat formulir pembayaran diserahkan, lakukan pembayaran
    $('#formPembayaran').submit(function(e) {
        e.preventDefault();

        let totalBayar = parseFloat($('#jumlahPembayaran').val());
        let totalHargaSemuaBarang = parseFloat(<?= $totalHarga; ?>);

        if (totalBayar >= totalHargaSemuaBarang) {
            let kembali = totalBayar - totalHargaSemuaBarang;
            alert('Pembayaran berhasil! Kembali: Rp.' + (kembali));
            $.ajax({
                type: "POST",
                url: "<?= site_url('pembayaran'); ?>",
                data: $('#formPembayaran').serialize(),
                success: function(response) {
                    console.log(response)
                }
            });

            location.reload();
        } else {
            alert('Pembayaran kurang! Jumlah yang dibayarkan harus lebih besar atau sama dengan total harga semua barang.');
        }
    });

    // Memanggil fungsi untuk mengatur status pembayaran saat dokumen dimuat
    $(document).ready(function() {
        aturStatusPembayaran();
    });
</script>
<?= $this->endSection(); ?>