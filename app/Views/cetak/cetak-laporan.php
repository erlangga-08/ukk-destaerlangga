<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin: 0 auto;
            width: 100%;
        }

        p {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1><?= $title ?></h1>
        <hr>
    </div>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama Produk</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
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
            </tbody>
        </table>
    </div>
</body>

</html>