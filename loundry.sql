-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Sep 2021 pada 04.38
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loundry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id` int(12) NOT NULL,
  `id_transaksi` varchar(12) NOT NULL,
  `id_paket` varchar(12) NOT NULL,
  `qty` double NOT NULL,
  `harga` int(12) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id`, `id_transaksi`, `id_paket`, `qty`, `harga`, `keterangan`) VALUES
(335, '202105211659', 'PAT054044376', 1, 15000, ''),
(336, '202105214035', 'PAT676345906', 1, 20000, ''),
(337, '202105215794', 'PAT676345906', 2, 20000, ''),
(338, '202105215794', 'PAT054044376', 2, 15000, ''),
(339, '202105215794', 'PAT034054251', 3, 20000, ''),
(340, '202105210000', 'PAT054044376', 1, 15000, ''),
(341, '202105214543', 'PAT034054251', 1, 20000, ''),
(342, '202105214543', 'PAT054044376', 1, 15000, ''),
(343, '202105211730', 'PAT034054251', 2, 20000, ''),
(344, '202105234705', 'PAT054044376', 1, 15000, ''),
(345, '202105234705', 'PAT034054251', 1, 20000, ''),
(346, '202105264009', 'PAT054044376', 1, 15000, ''),
(347, '202105263545', 'PAT054044376', 1, 15000, ''),
(348, '202105273332', 'PAT034054251', 1, 20000, ''),
(349, '202106303849', 'PAT034054251', 1, 20000, ''),
(350, '202106303849', 'PAT054044376', 1, 15000, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_member`
--

CREATE TABLE `tb_member` (
  `id` varchar(12) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tgl_daftar` datetime NOT NULL,
  `telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_member`
--

INSERT INTO `tb_member` (`id`, `nama`, `alamat`, `jenis_kelamin`, `tgl_daftar`, `telp`) VALUES
('072200030933', 'dede sutisna', 'Jl Raden Ganda no 30A Bandung Jawa Barat', 'L', '2021-04-17 00:24:52', '082117918297'),
('203909900886', 'kuroki eiyuu', 'Rancabali', 'L', '2021-04-16 05:12:26', '084937865327'),
('MEM206476022', 'asti fath', 'Jl batujajar', 'P', '2021-04-22 07:40:36', '089678590456'),
('MEM489004334', 'Danna sana', 'Jl cisarua no 30C jawa barat', 'L', '2021-04-20 05:10:00', '089475839284');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_outlet`
--

CREATE TABLE `tb_outlet` (
  `id` varchar(12) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_outlet`
--

INSERT INTO `tb_outlet` (`id`, `nama`, `alamat`, `tlp`) VALUES
('OT4364123656', 'Cabang Pusat', 'Jl Raden ganda no 30 A,sukaraja,cicendo,jawa barat', '085937284763'),
('OT4585609345', 'cabang disini', 'cimahi', '089637812935'),
('OT7459612906', 'cabang bandung', 'Bandung', '081267356718');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id` varchar(12) NOT NULL,
  `id_outlet` varchar(12) NOT NULL,
  `jenis` enum('kiloan','selimut','bed_cover','kaos','lain') NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `harga` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_paket`
--

INSERT INTO `tb_paket` (`id`, `id_outlet`, `jenis`, `nama_paket`, `harga`) VALUES
('PAT034054251', 'OT4364123656', 'kiloan', 'paket cuci,kering,wangi', 20000),
('PAT054044376', 'OT4364123656', 'kaos', 'Paket kaos', 15000),
('PAT503430097', 'OT4585609345', 'selimut', 'Paket Selimut', 12000),
('PAT676345906', 'OT4364123656', 'selimut', 'Paket Selimut', 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int(12) NOT NULL,
  `id_outlet` varchar(12) NOT NULL,
  `kode_invoice` varchar(100) NOT NULL,
  `id_member` varchar(12) NOT NULL,
  `tgl` date NOT NULL,
  `batas_waktu` datetime NOT NULL,
  `tgl_bayar` datetime NOT NULL,
  `biaya_tambahan` int(11) NOT NULL DEFAULT 0,
  `diskon` int(11) NOT NULL DEFAULT 0,
  `pajak` int(11) NOT NULL DEFAULT 0,
  `status` enum('baru','proses','selesai','diambil') NOT NULL DEFAULT 'baru',
  `dibayar` enum('dibayar','belum_dibayar') NOT NULL DEFAULT 'belum_dibayar',
  `id_user` varchar(12) NOT NULL,
  `total` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `id_outlet`, `kode_invoice`, `id_member`, `tgl`, `batas_waktu`, `tgl_bayar`, `biaya_tambahan`, `diskon`, `pajak`, `status`, `dibayar`, `id_user`, `total`) VALUES
(191, 'OT4364123656', '202105211659', '203909900886', '2021-05-21', '2021-05-21 07:12:00', '2021-05-21 07:12:17', 0, 0, 0, 'diambil', 'dibayar', '005698734569', 15000),
(192, 'OT4364123656', '202105214035', 'MEM206476022', '2021-05-21', '2021-05-21 07:14:00', '2021-05-27 13:15:50', 0, 0, 0, 'diambil', 'dibayar', '005698734569', 20000),
(193, 'OT4364123656', '202105215794', '072200030933', '2021-05-21', '2021-05-21 07:18:00', '0000-00-00 00:00:00', 0, 0, 0, 'selesai', 'belum_dibayar', '005698734569', 130000),
(194, 'OT4364123656', '202105210000', 'MEM489004334', '2021-05-21', '2021-05-21 07:19:00', '2021-05-21 07:19:11', 0, 0, 0, 'selesai', 'dibayar', '005698734569', 15000),
(195, 'OT4364123656', '202105214543', '072200030933', '2021-05-21', '2021-05-21 15:52:00', '2021-05-21 15:52:58', 0, 0, 0, 'selesai', 'dibayar', '005698734569', 35000),
(196, 'OT4364123656', '202105211730', '072200030933', '2021-05-21', '2021-05-01 20:33:00', '2021-05-21 20:52:16', 0, 1000, 3000, 'selesai', 'dibayar', '005698734569', 42000),
(197, 'OT4364123656', '202105234705', '072200030933', '2021-05-23', '2021-05-23 07:13:00', '0000-00-00 00:00:00', 0, 0, 0, 'baru', 'belum_dibayar', '005698734569', 35000),
(198, 'OT4364123656', '202105263545', '203909900886', '2021-05-26', '2021-05-26 05:43:00', '2021-05-27 13:16:14', 0, 0, 0, 'diambil', 'dibayar', '005698734569', 15000),
(199, 'OT4364123656', '202105273332', '203909900886', '2021-05-27', '2021-05-27 19:10:00', '2021-05-27 19:10:57', 0, 0, 0, 'selesai', 'dibayar', '005698734569', 20000),
(200, 'OT4364123656', '202106303849', 'MEM489004334', '2021-06-30', '2021-06-05 06:10:00', '0000-00-00 00:00:00', 0, 0, 0, 'baru', 'belum_dibayar', '005698734569', 35000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` varchar(12) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(120) NOT NULL,
  `id_outlet` varchar(12) NOT NULL,
  `tgl_daftar` datetime NOT NULL,
  `role` enum('admin','kasir','owner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `password`, `id_outlet`, `tgl_daftar`, `role`) VALUES
('005698734569', 'asep dera purnama', 'asep', '$2y$10$Y/KUrKdMC7FVZUynZELa1O7ILfQQVMlJJr2c3FpDb3VRrxiPMq9RG', 'OT4364123656', '2021-04-12 11:10:00', 'admin'),
('568350934467', 'rizki nugraha', 'rizki', '$2y$10$e1oIcNoxsblFnPlSk2uRxuYpONPMxL1uUEUwV/g1BP20u4.B224.W', 'OT4364123656', '2021-04-13 09:10:00', 'kasir'),
('980456723908', 'jeni sapitri', 'jeni', '$2y$10$bioRfaoaRZI2zYlebDnhVOabFIWG0T1PmjsD09hjeqiUO374vcAta', 'OT4364123656', '2021-04-12 11:30:00', 'owner'),
('USR430049252', 'akihisa yoshi', 'akihisa', '$2y$10$S99UBfUg.sAS2NMG9ZQJzeCVmdItL3FApw.ZfSq2qJiGdprnjzQF.', 'OT4585609345', '2021-04-20 05:39:49', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_outlet`
--
ALTER TABLE `tb_outlet`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=351;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
