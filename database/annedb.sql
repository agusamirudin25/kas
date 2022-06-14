-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jun 2022 pada 05.13
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `annedb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggaran`
--

CREATE TABLE `anggaran` (
  `id_anggaran` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` int(20) NOT NULL,
  `keterangan` text NOT NULL,
  `tipe_anggaran` int(2) NOT NULL,
  `id_kegiatan` int(4) NOT NULL,
  `id_donatur` int(4) NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggaran`
--

INSERT INTO `anggaran` (`id_anggaran`, `tanggal`, `nominal`, `keterangan`, `tipe_anggaran`, `id_kegiatan`, `id_donatur`, `status`) VALUES
(13, '2022-06-01', 213123, '1212', 1, 4, 2, 0),
(14, '2022-06-01', 12121, 'ERREW', 1, 4, 2, 0),
(15, '2022-06-01', 10, 'Tulisan Tangan', 1, 4, 2, 0),
(16, '2022-06-01', 1122, 'pengeluaran', 0, 4, 0, 0),
(17, '2022-06-01', 1000, 'rte3qw', 1, 4, 3, 0),
(18, '2022-06-09', 10000, 'qweqewqe', 1, 6, 3, 0),
(19, '2022-06-09', 2000, 'qwertfdsfgdsa', 1, 6, 3, 0),
(20, '2022-06-06', 7000, 'musa testing', 1, 5, 2, 0),
(21, '2022-06-06', 7000, 'testing 123', 1, 5, 2, 0),
(22, '2022-06-06', 789654, 'desr', 1, 5, 3, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `donatur`
--

CREATE TABLE `donatur` (
  `id_donatur` int(11) NOT NULL,
  `nama_donatur` varchar(45) NOT NULL,
  `kontak` varchar(45) NOT NULL,
  `no_rekening` varchar(45) NOT NULL,
  `tipe_donatur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `donatur`
--

INSERT INTO `donatur` (`id_donatur`, `nama_donatur`, `kontak`, `no_rekening`, `tipe_donatur`) VALUES
(2, 'hamba allah', '12345', '10', 1),
(3, 'hamba allah 2', '012548', '1236574', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(4) NOT NULL,
  `nama_kegiatan` varchar(45) NOT NULL,
  `lokasi` varchar(45) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama_kegiatan`, `lokasi`, `tanggal`, `keterangan`, `status`) VALUES
(4, 'Musa testing kegiatan', 'karawang', '2022-06-08', 'testing 1', 0),
(5, 'test', 'Karawang', '2022-06-06', 'test', 0),
(6, 'Training PNS', 'Pebayuran', '2022-06-09', 'tet', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus`
--

CREATE TABLE `pengurus` (
  `id_pengurus` int(11) NOT NULL,
  `nama_pengurus` varchar(45) NOT NULL,
  `no_pengurus` varchar(45) NOT NULL,
  `jabatan` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengurus`
--

INSERT INTO `pengurus` (`id_pengurus`, `nama_pengurus`, `no_pengurus`, `jabatan`) VALUES
(5, 'anne kepala bagian', '01234567', 1),
(6, 'anne bendahara', '123654', 2),
(7, 'anne staf', '14789', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_name` varchar(45) NOT NULL,
  `password` varchar(10) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `id_user` int(5) NOT NULL,
  `no_pengurus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_name`, `password`, `user_type`, `id_user`, `no_pengurus`) VALUES
('kepala1', 'kepala', '1', 9, '0123456'),
('master', 'master', '0', 10, '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggaran`
--
ALTER TABLE `anggaran`
  ADD PRIMARY KEY (`id_anggaran`);

--
-- Indeks untuk tabel `donatur`
--
ALTER TABLE `donatur`
  ADD PRIMARY KEY (`id_donatur`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indeks untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id_pengurus`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggaran`
--
ALTER TABLE `anggaran`
  MODIFY `id_anggaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `donatur`
--
ALTER TABLE `donatur`
  MODIFY `id_donatur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id_pengurus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
