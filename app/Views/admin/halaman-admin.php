<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="row mb-4 mt-3">
    <div class="col-lg-12">
        <h1><?= $judulHalaman; ?> <?= session()->get('nama_pengguna'); ?></h1>
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
                        <p class="card-text"><?= $totalProduk; ?></p>
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
                        <p class="card-text"><?= 'Rp.' . number_format($pendapatanBulanIni, 2, ',', '.'); ?></p>
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
                        <p class="card-text"><?= 'Rp.' . number_format($pendapatanHariIni, 2, ',', '.'); ?></p>
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
                        <h5 class="card-title">Total Pengguna</h5>
                        <p class="card-text"><?= $totalPengguna; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="row">
    <!-- /.col (LEFT) -->
    <div class="col-md-12">
        <!-- LINE CHART -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Grafik Pendapatan Perbulan</h3>
            </div>
            <div class="card-body">
                <div class="chart">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="myChart" width="600" height="150"></canvas>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card -->

    </div>
    <!-- /.col (RIGHT) -->
</div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    // Ambil data dari controller
    var chartData = <?= json_encode($chartData) ?>;

    // Daftar bulan untuk label chart
    var months = chartData.months;

    // Data pendapatan bulanan
    var incomeData = chartData.monthlyIncome;

    // Buat grafik menggunakan Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Pendapatan',
                data: incomeData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Warna biru
                borderColor: 'rgba(54, 162, 235, 1)', // Warna biru
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<?= $this->endSection(); ?>