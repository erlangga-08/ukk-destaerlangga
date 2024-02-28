-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Feb 2024 pada 12.24
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_penjualan`
--

CREATE TABLE `tbl_detail_penjualan` (
  `id_detail` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `tbl_detail_penjualan`
--
DELIMITER $$
CREATE TRIGGER `kurangTotalHarga` AFTER DELETE ON `tbl_detail_penjualan` FOR EACH ROW UPDATE tbl_penjualan SET tbl_penjualan.grand_total = tbl_penjualan.grand_total - OLD.total_harga
WHERE tbl_penjualan.id_penjualan = OLD.id_penjualan
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurangiStok` AFTER INSERT ON `tbl_detail_penjualan` FOR EACH ROW UPDATE tbl_produk SET tbl_produk.stok = tbl_produk.stok - NEW.qty
WHERE tbl_produk.id_produk = NEW.id_produk
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `nambahTotalHarga` AFTER INSERT ON `tbl_detail_penjualan` FOR EACH ROW UPDATE tbl_penjualan SET tbl_penjualan.grand_total=tbl_penjualan.grand_total + new.total_harga
WHERE tbl_penjualan.id_penjualan=new.id_penjualan
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `nambahTotalStokJIkaHapusDetail` AFTER DELETE ON `tbl_detail_penjualan` FOR EACH ROW UPDATE tbl_produk SET tbl_produk.stok = tbl_produk.stok + OLD.qty
WHERE tbl_produk.id_produk = OlD.id_produk
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'perlengkapan belajar'),
(2, 'kosmetik'),
(3, 'pakaian'),
(4, 'minuman'),
(9, 'Obat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','kasir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`email`, `username`, `nama_lengkap`, `password`, `level`) VALUES
('aamsetiana@gmail.com', 'aamz', 'Aam Setiana  ', '202cb962ac59075b964b07152d234b70', 'admin'),
('arifhidayat@gmail.com', 'arif', 'Arif Hidayat   ', '202cb962ac59075b964b07152d234b70', 'kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `tgl_penjualan` datetime NOT NULL,
  `grand_total` decimal(10,0) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(25) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_beli` decimal(10,0) NOT NULL,
  `harga_jual` decimal(10,0) NOT NULL,
  `diskon` decimal(10,0) DEFAULT NULL,
  `id_satuan` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `kode_produk`, `nama_produk`, `harga_beli`, `harga_jual`, `diskon`, `id_satuan`, `id_kategori`, `stok`) VALUES
(1, 'PRD001', 'Buku Tulis', 10000, 15000, NULL, 3, 1, 50),
(2, 'PRD002', 'Pensil', 12000, 18000, NULL, 3, 1, 60),
(3, 'PRD003', 'Buku Gambar', 9000, 14000, NULL, 3, 1, 40),
(4, 'PRD004', 'Penggaris', 11000, 16000, NULL, 3, 1, 55),
(5, 'PRD005', 'Spidol', 9500, 13000, NULL, 3, 1, 30),
(6, 'PRD006', 'Kertas HVS', 10500, 16000, NULL, 3, 1, 45),
(7, 'PRD007', 'Penghapus', 8000, 12000, NULL, 3, 1, 25),
(8, 'PRD008', 'Penggaris Plastik', 7500, 11000, NULL, 3, 1, 60),
(9, 'PRD009', 'Stabilo', 13500, 20000, NULL, 3, 1, 35),
(10, 'PRD010', 'Kalkulator', 35000, 50000, NULL, 3, 1, 20),
(11, 'PRD011', 'Pensil Warna', 20000, 28000, NULL, 3, 1, 40),
(12, 'PRD012', 'Pensil 2B', 6000, 10000, NULL, 3, 1, 70),
(13, 'PRD013', 'Penggaris Aluminium', 12500, 18000, NULL, 3, 1, 45),
(14, 'PRD014', 'Penggaris Segitiga', 7000, 12000, NULL, 3, 1, 55),
(15, 'PRD015', 'Pensil Mekanik', 18000, 25000, NULL, 3, 1, 30),
(16, 'PRD016', 'Pensil HB', 5000, 9000, NULL, 3, 1, 65),
(17, 'PRD017', 'Pensil H', 5500, 9500, NULL, 3, 1, 70),
(18, 'PRD018', 'Pensil B', 5500, 9500, NULL, 3, 1, 65),
(19, 'PRD019', 'Pensil 2H', 5500, 9500, NULL, 3, 1, 75),
(20, 'PRD020', 'Buku Catatan', 8500, 12000, NULL, 3, 1, 45),
(21, 'PRD021', 'Penghapus Karet', 3500, 6000, NULL, 3, 1, 80),
(22, 'PRD022', 'Sticker', 2000, 5000, NULL, 3, 1, 100),
(23, 'PRD023', 'Tipe-X', 5000, 8000, NULL, 3, 1, 75),
(24, 'PRD024', 'Pensil Warna 24 Warna', 28000, 35000, NULL, 3, 1, 25),
(25, 'PRD025', 'Pensil Warna 12 Warna', 16000, 22000, NULL, 3, 1, 30),
(26, 'PRD026', 'Pensil Warna 48 Warna', 40000, 55000, NULL, 3, 1, 20),
(27, 'PRD027', 'Pensil Warna 36 Warna', 32000, 45000, NULL, 3, 1, 25),
(28, 'PRD028', 'Buku Catatan Kecil', 5500, 9000, NULL, 3, 1, 50),
(29, 'PRD029', 'Buku Catatan Besar', 10000, 15000, NULL, 3, 1, 30),
(30, 'PRD030', 'Stabilo 12 Warna', 25000, 35000, NULL, 3, 1, 40),
(31, 'PRD031', 'Stabilo 24 Warna', 40000, 55000, NULL, 3, 1, 20),
(32, 'PRD032', 'Stabilo 36 Warna', 60000, 75000, NULL, 3, 1, 15),
(33, 'PRD033', 'Buku Catatan Warna Warni', 12000, 18000, NULL, 3, 1, 35),
(34, 'PRD034', 'Penghapus Putih', 4000, 7000, NULL, 3, 1, 60),
(35, 'PRD035', 'Buku Bacaan', 15000, 20000, NULL, 3, 1, 25),
(36, 'PRD036', 'Penghapus Pensil', 2000, 4000, NULL, 3, 1, 70),
(37, 'PRD037', 'Spidol Permanent', 15000, 20000, NULL, 3, 1, 30),
(38, 'PRD038', 'Buku Sketsa', 18000, 25000, NULL, 3, 1, 40),
(39, 'PRD039', 'Kertas Folio', 12000, 18000, NULL, 3, 1, 30),
(40, 'PRD040', 'Kertas Duplikat', 9000, 15000, NULL, 3, 1, 55),
(41, 'PRD041', 'Kertas Buram', 9500, 14000, NULL, 3, 1, 35),
(42, 'PRD042', 'Kertas Origami', 7500, 11000, NULL, 3, 1, 60),
(43, 'PRD043', 'Pulpen', 5000, 8000, NULL, 3, 1, 80),
(44, 'PRD044', 'Binder', 30000, 40000, NULL, 3, 1, 20),
(45, 'PRD045', 'Kertas Lipat', 10000, 15000, NULL, 3, 1, 35),
(46, 'PRD046', 'Kertas Kado', 8000, 12000, NULL, 3, 1, 50),
(47, 'PRD047', 'Buku Diary', 20000, 25000, NULL, 3, 1, 30),
(48, 'PRD048', 'Buku Jurnal', 25000, 35000, NULL, 3, 1, 25),
(49, 'PRD049', 'Tipe-X Cair', 8000, 12000, NULL, 3, 1, 40),
(50, 'PRD050', 'Buku Tulis 200 Halaman', 10000, 15000, NULL, 3, 1, 30),
(51, 'PRD051', 'Pensil 4B', 5500, 9500, NULL, 3, 1, 65),
(52, 'PRD052', 'Pensil 3B', 5500, 9500, NULL, 3, 1, 70),
(53, 'PRD053', 'Pensil 2B', 5500, 9500, NULL, 3, 1, 75),
(54, 'PRD054', 'Pensil HB', 5500, 9500, NULL, 3, 1, 70),
(55, 'PRD055', 'Pensil H', 5500, 9500, NULL, 3, 1, 70),
(56, 'PRD056', 'Pensil B', 5500, 9500, NULL, 3, 1, 65),
(57, 'PRD057', 'Pensil 2H', 5500, 9500, NULL, 3, 1, 75),
(58, 'PRD058', 'Penghapus Pensil', 2000, 4000, NULL, 3, 1, 85),
(59, 'PRD059', 'Penghapus Putih', 4000, 7000, NULL, 3, 1, 70),
(60, 'PRD060', 'Stabilo 12 Warna', 25000, 35000, NULL, 3, 1, 40),
(61, 'PRD061', 'Stabilo 24 Warna', 40000, 55000, NULL, 3, 1, 20),
(62, 'PRD062', 'Stabilo 36 Warna', 60000, 75000, NULL, 3, 1, 15),
(63, 'PRD063', 'Buku Catatan Warna Warni', 12000, 18000, NULL, 3, 1, 35),
(64, 'PRD064', 'Pensil Warna 24 Warna', 28000, 35000, NULL, 3, 1, 25),
(65, 'PRD065', 'Pensil Warna 12 Warna', 16000, 22000, NULL, 3, 1, 30),
(66, 'PRD066', 'Pensil Warna 48 Warna', 40000, 55000, NULL, 3, 1, 20),
(67, 'PRD067', 'Pensil Warna 36 Warna', 32000, 45000, NULL, 3, 1, 25),
(68, 'PRD068', 'Buku Catatan Besar', 10000, 15000, NULL, 3, 1, 30),
(69, 'PRD069', 'Buku Catatan Kecil', 5500, 9000, NULL, 3, 1, 50),
(70, 'PRD070', 'Sticker', 2000, 5000, NULL, 3, 1, 100),
(71, 'PRD071', 'Tipe-X', 5000, 8000, NULL, 3, 1, 75),
(72, 'PRD072', 'Penghapus Karet', 3500, 6000, NULL, 3, 1, 80),
(73, 'PRD073', 'Buku Catatan', 8500, 12000, NULL, 3, 1, 45),
(74, 'PRD074', 'Pensil H', 5500, 9500, NULL, 3, 1, 70),
(75, 'PRD075', 'Pensil 2B', 5500, 9500, NULL, 3, 1, 70),
(76, 'PRD076', 'Pensil 3B', 5500, 9500, NULL, 3, 1, 70),
(77, 'PRD077', 'Pensil 4B', 5500, 9500, NULL, 3, 1, 70),
(78, 'PRD078', 'Pensil 5B', 5500, 9500, NULL, 3, 1, 70),
(79, 'PRD079', 'Penghapus Pensil', 2000, 4000, NULL, 3, 1, 70),
(80, 'PRD080', 'Penghapus Putih', 4000, 7000, NULL, 3, 1, 70),
(81, 'PRD081', 'Stabilo 12 Warna', 25000, 35000, NULL, 3, 1, 70),
(82, 'PRD082', 'Stabilo 24 Warna', 40000, 55000, NULL, 3, 1, 70),
(83, 'PRD083', 'Stabilo 36 Warna', 60000, 75000, NULL, 3, 1, 70),
(84, 'PRD084', 'Buku Catatan Warna Warni', 12000, 18000, NULL, 3, 1, 70),
(85, 'PRD085', 'Pensil Warna 24 Warna', 28000, 35000, NULL, 3, 1, 70),
(86, 'PRD086', 'Pensil Warna 12 Warna', 16000, 22000, NULL, 3, 1, 70),
(87, 'PRD087', 'Pensil Warna 48 Warna', 40000, 55000, NULL, 3, 1, 70),
(88, 'PRD088', 'Pensil Warna 36 Warna', 32000, 45000, NULL, 3, 1, 70),
(89, 'PRD089', 'Buku Catatan Besar', 10000, 15000, NULL, 3, 1, 70),
(90, 'PRD090', 'Buku Catatan Kecil', 5500, 9000, NULL, 3, 1, 70),
(91, 'PRD091', 'Sticker', 2000, 5000, NULL, 3, 1, 70),
(92, 'PRD092', 'Tipe-X', 5000, 8000, NULL, 3, 1, 70),
(93, 'PRD093', 'Penghapus Karet', 3500, 6000, NULL, 3, 1, 70),
(94, 'PRD094', 'Buku Catatan', 8500, 12000, NULL, 3, 1, 70),
(95, 'PRD095', 'Pensil H', 5500, 9500, NULL, 3, 1, 70),
(96, 'PRD096', 'Pensil 2B', 5500, 9500, NULL, 3, 1, 70),
(97, 'PRD097', 'Pensil 3B', 5500, 9500, NULL, 3, 1, 70),
(98, 'PRD098', 'Pensil 4B', 5500, 9500, NULL, 3, 1, 70),
(99, 'PRD099', 'Pensil 5B', 5500, 9500, NULL, 3, 1, 70),
(100, 'PRD100', 'Penghapus Pensil', 2000, 4000, NULL, 3, 1, 70);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`id_satuan`, `nama_satuan`) VALUES
(3, 'pcs'),
(15, 'kg'),
(16, 'box'),
(17, 'ton');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_detail_penjualan`
--
ALTER TABLE `tbl_detail_penjualan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `kode_produk` (`id_produk`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `email` (`email`);

--
-- Indeks untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_satuan` (`id_satuan`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_penjualan`
--
ALTER TABLE `tbl_detail_penjualan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_detail_penjualan`
--
ALTER TABLE `tbl_detail_penjualan`
  ADD CONSTRAINT `tbl_detail_penjualan_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `tbl_penjualan` (`id_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_penjualan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tbl_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD CONSTRAINT `tbl_produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_produk_ibfk_2` FOREIGN KEY (`id_satuan`) REFERENCES `tbl_satuan` (`id_satuan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
