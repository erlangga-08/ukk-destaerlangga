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
                                    <td><?= $p['stok']; ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
            </tbody>
        </table>
    </div>
</body>

</html>