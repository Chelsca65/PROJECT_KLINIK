-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2026 at 03:52 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` varchar(6) NOT NULL,
  `nama_dokter` varchar(50) NOT NULL,
  `spesialis` varchar(50) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `tarif_konsultasi` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama_dokter`, `spesialis`, `no_hp`, `tarif_konsultasi`) VALUES
('D-001', 'dr. Andi Pratama', 'Penyakit Dalam', '081214567890', '150000'),
('D-002', 'dr. Siti Rahma', 'Anak', '087896374275', '175000'),
('D-003', 'dr. Budi Santoso', 'Kandungan', '089696374265', '200000'),
('D-004', 'dr. Rina Wulandari', 'Jantung', '081567894050', '250000'),
('D-005', 'dr. Dimas Saputra', 'THT', '087346578765', '180000'),
('D-006', 'dr. Maya Lestari', 'Kulit dan Kelamin', '083015267312', '200000');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` varchar(6) NOT NULL,
  `id_dokter` varchar(6) NOT NULL,
  `hari` varchar(15) NOT NULL,
  `jam_praktik` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_dokter`, `hari`, `jam_praktik`) VALUES
('J-001', 'D-001', 'Senin', '08.00-10.00'),
('J-002', 'D-002', 'Selasa', '10.00-12.00'),
('J-003', 'D-003', 'Rabu', '12.00-14.00'),
('J-004', 'D-004', 'Kamis', '14.00-16.00'),
('J-005', 'D-005', 'Jumat', '16.00-18.00'),
('J-006', 'D-006', 'Sabtu', '19.00-21.00');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` int(11) NOT NULL,
  `id_daftar` varchar(10) NOT NULL,
  `id_pasien` varchar(6) NOT NULL,
  `pengirim` varchar(30) NOT NULL,
  `pesan` text NOT NULL,
  `waktu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id_konsultasi`, `id_daftar`, `id_pasien`, `pengirim`, `pesan`, `waktu`) VALUES
(1, 'D-001', 'P-001', 'pasien', 'Selamat pagi Dok, saya sudah 2 hari merasakan nyeri di ulu hati. Perut terasa perih saat terlambat makan, kadang mual dan sering bersendawa.', '2026-06-30 05:48:28'),
(2, 'D-001', '', 'dokter', 'Selamat pagi. Dari keluhan yang Anda sampaikan, kemungkinan mengarah ke gangguan lambung seperti maag (gastritis). Untuk sementara usahakan makan secara teratur, hindari makanan pedas, asam, kopi, dan minuman bersoda. Bila perlu, konsumsi obat lambung sesuai anjuran. Jika keluhan tidak membaik dalam beberapa hari atau justru semakin berat, segera datang ke klinik untuk pemeriksaan lebih lanjut. Semoga lekas sembuh.', '2026-06-30 05:49:06'),
(7, 'D-002', 'P-002', 'pasien', 'halo dok', '2026-06-30 10:46:44'),
(8, 'D-002', '', 'dokter', 'halo', '2026-06-30 10:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` varchar(6) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `jenkel` varchar(10) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `jenkel`, `alamat`, `no_hp`) VALUES
('P-001', 'chelsea', 'Perempuan', 'Jend.Sudirman', '087896374275'),
('P-002', 'nabila', 'Perempuan', 'gg. bahagia', '087896374275');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_daftar` varchar(6) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `status_bayar` enum('Lunas','Menunggu Verifikasi','Belum Lunas') NOT NULL,
  `metode_bayar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_daftar`, `tgl_bayar`, `status_bayar`, `metode_bayar`) VALUES
('D-001', '2026-06-29', 'Lunas', 'Transfer Bank'),
('D-002', '2026-06-30', 'Lunas', 'E-Wallet');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_daftar` varchar(6) NOT NULL,
  `id_jadwal` varchar(6) NOT NULL,
  `id_pasien` varchar(6) NOT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_daftar`, `id_jadwal`, `id_pasien`, `tgl_daftar`) VALUES
('D-001', 'J-001', 'P-001', '2026-06-30'),
('D-002', 'J-002', 'P-002', '2026-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(6) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','dokter','pasien') NOT NULL,
  `id_pasien` varchar(6) NOT NULL,
  `id_dokter` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`, `id_pasien`, `id_dokter`) VALUES
('', 'admin', '1234', 'admin', '', NULL),
('', 'andi', '1234', 'dokter', '', 'D-001'),
('', 'siti', '1234', 'dokter', '', 'D-002'),
('', 'budi', '1234', 'dokter', '', 'D-003'),
('', 'rina', '1234', 'dokter', '', 'D-004'),
('', 'dimas', '1234', 'pasien', '', 'D-005'),
('', 'maya', '1234', 'dokter', '', 'D-006'),
('U-589', 'chelsea', '1234', 'pasien', 'P-001', NULL),
('U-297', 'nabila', '1234', 'pasien', 'P-002', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id_konsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
