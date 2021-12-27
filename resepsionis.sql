-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2019 at 04:42 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resepsionis`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_hamil`
--

CREATE TABLE `detail_hamil` (
  `no_registrasi` varchar(20) NOT NULL,
  `tgl_datang` date NOT NULL,
  `keluhan` varchar(20) NOT NULL,
  `tekanan_darah` varchar(10) NOT NULL,
  `umur_kehamilan` int(11) NOT NULL,
  `tinggi_fundus` int(11) NOT NULL,
  `letak_janin` varchar(15) NOT NULL,
  `denyut_jantung` varchar(20) NOT NULL,
  `hasil_periksa` varchar(20) NOT NULL,
  `tindakan` varchar(20) NOT NULL,
  `nasihat` varchar(20) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `tgl_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_hamil`
--

INSERT INTO `detail_hamil` (`no_registrasi`, `tgl_datang`, `keluhan`, `tekanan_darah`, `umur_kehamilan`, `tinggi_fundus`, `letak_janin`, `denyut_jantung`, `hasil_periksa`, `tindakan`, `nasihat`, `keterangan`, `tgl_kembali`) VALUES
('REG1', '2019-05-16', 'sakit', '80/90', 0, 123, '123', '123', '123', '123', '123', 'asd', '2019-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id_pegawai` varchar(6) NOT NULL,
  `nama_pegawai` varchar(35) NOT NULL,
  `notlp_pegawai` varchar(13) NOT NULL,
  `alamat_pegawai` varchar(50) NOT NULL,
  `stts` int(11) NOT NULL,
  `id_user` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id_pegawai`, `nama_pegawai`, `notlp_pegawai`, `alamat_pegawai`, `stts`, `id_user`) VALUES
('PEG1', 'Nur Sukma Pandawa', '082232326433', 'Jl Mentaraman', 1, 'USR1'),
('PEG2', 'Bagus Tri Widiyanto', '083834321083', 'Jl Regulo no 122', 1, 'USR2');

-- --------------------------------------------------------

--
-- Table structure for table `pasien_hamil`
--

CREATE TABLE `pasien_hamil` (
  `no_registrasi` varchar(20) NOT NULL,
  `hpht` date NOT NULL,
  `htp` date NOT NULL,
  `lingkar_lengan_kek` int(11) NOT NULL,
  `lingkar_lengan_nonkek` int(11) NOT NULL,
  `tinggi_badan` int(11) NOT NULL,
  `golongan_darah` varchar(5) NOT NULL,
  `riwayat_penyakit` varchar(20) NOT NULL,
  `riwayat_alergi` varchar(20) NOT NULL,
  `hamil_ke` int(11) NOT NULL,
  `jumlah_persalinan` int(11) NOT NULL,
  `jumlah_keguguran` int(11) NOT NULL,
  `anak_hidup` int(11) NOT NULL,
  `anak_mati` int(11) NOT NULL,
  `jarak_kehamilan` int(11) NOT NULL,
  `stts` varchar(20) NOT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien_hamil`
--

INSERT INTO `pasien_hamil` (`no_registrasi`, `hpht`, `htp`, `lingkar_lengan_kek`, `lingkar_lengan_nonkek`, `tinggi_badan`, `golongan_darah`, `riwayat_penyakit`, `riwayat_alergi`, `hamil_ke`, `jumlah_persalinan`, `jumlah_keguguran`, `anak_hidup`, `anak_mati`, `jarak_kehamilan`, `stts`, `tgl_daftar`) VALUES
('REG1', '2019-05-10', '2019-05-07', 123, 123, 123, 'B', '123', '123', 0, 0, 0, 0, 0, 0, 'Hamil', '2019-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `pasien_imunisasi`
--

CREATE TABLE `pasien_imunisasi` (
  `no_registrasi` varchar(6) NOT NULL,
  `berat_badan` int(11) NOT NULL,
  `tinggi_badan` int(11) NOT NULL,
  `nama_anak` varchar(35) NOT NULL,
  `jenis_imunisasi` varchar(20) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `stts` varchar(10) NOT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien_imunisasi`
--

INSERT INTO `pasien_imunisasi` (`no_registrasi`, `berat_badan`, `tinggi_badan`, `nama_anak`, `jenis_imunisasi`, `keterangan`, `stts`, `tgl_daftar`) VALUES
('REG1', 12, 120, 'amak', 'jenis', 'keterangan', 'Imunisasi', '2019-05-01'),
('REG4', 50, 179, 'Saya Sendiri', 'Vaksin', 'Sehat Walafiat', 'Imunisasi', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `pasien_kb`
--

CREATE TABLE `pasien_kb` (
  `no_registrasi` varchar(20) NOT NULL,
  `berat_badan` int(11) NOT NULL,
  `tensi_darah` varchar(20) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `stts` varchar(10) NOT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien_kb`
--

INSERT INTO `pasien_kb` (`no_registrasi`, `berat_badan`, `tensi_darah`, `tgl_kembali`, `keterangan`, `stts`, `tgl_daftar`) VALUES
('', 50, '90/100', '2019-03-20', 'Sudah Membaik', 'KB', '0000-00-00'),
('', 4, '40/90', '2019-03-20', 'Segera Keguguran', 'KB', '0000-00-00'),
('REG1', 123, '123', '2019-05-10', 'dasd', 'KB', '2019-05-01'),
('REG1', 0, 'asd', '2019-05-25', 'asdasd', 'KB', '2019-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `pasien_umum`
--

CREATE TABLE `pasien_umum` (
  `no_registrasi` varchar(20) NOT NULL,
  `keluhan` varchar(20) NOT NULL,
  `tekanan_darah` varchar(10) NOT NULL,
  `berat_badan` varchar(5) NOT NULL,
  `suhu_badan` varchar(5) NOT NULL,
  `diagnosa` varchar(20) NOT NULL,
  `terapi` varchar(20) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien_umum`
--

INSERT INTO `pasien_umum` (`no_registrasi`, `keluhan`, `tekanan_darah`, `berat_badan`, `suhu_badan`, `diagnosa`, `terapi`, `keterangan`, `tgl_daftar`) VALUES
('REG1', 'sakit', '80/90', '20', '29', 'diagnosa', 'terapi', 'keterangan', '2019-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `no_registrasi` varchar(6) NOT NULL,
  `no_kk` varchar(16) NOT NULL,
  `no_bpjs` varchar(20) NOT NULL,
  `nama_pasien` varchar(35) NOT NULL,
  `lahir_pasien` date NOT NULL,
  `alamat_pasien` varchar(35) NOT NULL,
  `notlp_pasien` varchar(13) NOT NULL,
  `agama_pasien` varchar(10) NOT NULL,
  `goldarah_pasien` enum('A','B','O','AB') NOT NULL,
  `pendidikan_pasien` varchar(5) NOT NULL,
  `pekerjaan_pasien` varchar(25) NOT NULL,
  `stts` varchar(10) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `param` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`no_registrasi`, `no_kk`, `no_bpjs`, `nama_pasien`, `lahir_pasien`, `alamat_pasien`, `notlp_pasien`, `agama_pasien`, `goldarah_pasien`, `pendidikan_pasien`, `pekerjaan_pasien`, `stts`, `tgl_daftar`, `param`) VALUES
('REG1', '120391327147', '123129343282', 'Reza Ananda', '2019-03-18', 'Jl Sengguruh', '0312928342', 'Atheis', 'A', 'SMA', 'Pelajar', 'Umum', '2019-03-18', 1),
('REG2', '2309329842123', '2442332432432', 'Rino Mardiansyah', '2019-03-10', 'Jl Taman Ayu', '0912312', '-', 'B', 'SMA', 'Pelajar', 'Hamil', '2019-03-18', 1),
('REG3', '123910432984', '835938539543', 'Meilia Inka P', '2001-05-16', 'Jl Garuda', '02433842', 'Islam', 'O', 'S1', 'Perawat', 'KB', '2019-03-18', 1),
('REG4', '432823498953', '234928440012', 'Kartika Dewi S', '2000-03-04', 'Jl Mentaraman', '024823493', 'Islam', 'A', 'SMK', 'Ibu Rumah Tangga', 'Imunisasi', '2019-03-18', 1),
('REG5', '435632456', '43356765', 'Puput Yustya Ratna', '2019-03-11', 'Semanding', '567890', 'Atheis', 'A', 'SMK', 'Ibu Rumah Tangga', 'Umum', '2019-03-18', 1),
('REG6', '43256787', '8790', 'Fitri Riski', '2019-03-04', 'Mentaraman', '4567', 'Islam', 'B', 'SMK', 'Ibu Rumah Tangga', 'Hamil', '2019-03-18', 1),
('REG7', '24356565', '354353345', 'Rifqi Ardian', '2019-03-12', 'Cokolion', '5467878', '-', 'O', 'TK', 'Pengacara', 'Imunisasi', '2019-03-18', 1),
('REG8', '345678', '65565', 'Aqshal Mahenda P', '2019-03-11', 'Lorre Stasiun', '323243234234', 'Konghucu', 'B', 'SD', 'Anak Gawang', 'Imunisasi', '2019-03-18', 1),
('REG9', '09123091283098', '01923812938102', 'nama', '2019-03-14', 'alamat', '0912039128390', 'Nasrani', 'A', '19203', 'pekerjaa', 'Umum', '2019-03-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(6) NOT NULL,
  `username` varchar(11) NOT NULL,
  `password` varchar(15) NOT NULL,
  `role` varchar(10) NOT NULL,
  `stts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`, `stts`) VALUES
('USR1', 'admin', 'nursukma', 'Admin', 1),
('USR2', 'bagus', 'bagus', 'Admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_hamil`
--
ALTER TABLE `detail_hamil`
  ADD PRIMARY KEY (`no_registrasi`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pasien_hamil`
--
ALTER TABLE `pasien_hamil`
  ADD PRIMARY KEY (`no_registrasi`);

--
-- Indexes for table `pasien_imunisasi`
--
ALTER TABLE `pasien_imunisasi`
  ADD PRIMARY KEY (`no_registrasi`);

--
-- Indexes for table `pasien_umum`
--
ALTER TABLE `pasien_umum`
  ADD PRIMARY KEY (`no_registrasi`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`no_registrasi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
