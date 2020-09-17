-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2019 at 07:33 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ujianonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `nip` varchar(18) NOT NULL,
  `nama_guru` varchar(40) DEFAULT NULL,
  `jk_guru` enum('L','P') DEFAULT NULL,
  `tmp_lahir_guru` varchar(40) DEFAULT NULL,
  `tgl_lahir_guru` date DEFAULT NULL,
  `alamat_guru` varchar(40) DEFAULT NULL,
  `photo_guru` varchar(255) DEFAULT NULL,
  `log_guru` datetime DEFAULT NULL,
  `pass_guru` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`nip`, `nama_guru`, `jk_guru`, `tmp_lahir_guru`, `tgl_lahir_guru`, `alamat_guru`, `photo_guru`, `log_guru`, `pass_guru`) VALUES
('1557301090', 'Ika Agustiawan S.Ag', 'P', 'Lampung', '2019-06-24', ' ', 'NOIMAGE.jpg', '2019-06-28 12:26:15', 'cec7229f1a99aa945f8248c5a215b6c9'),
('1557301091', 'Ahmad Fauzi, S.T', 'L', 'Surabaya', '2019-06-04', 'Jln Bandung    ', 'photo_1561214386_4539.jpg', '2019-06-22 09:39:46', 'eefdfbdaeca7001cc19bf7119dd1d444');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(6) DEFAULT NULL,
  `log_kelas` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `log_kelas`) VALUES
(4, '6', '2019-06-20 04:43:03'),
(5, '5', '2019-07-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_list_soal_ujian`
--

CREATE TABLE `tb_list_soal_ujian` (
  `id_list_soal_ujian` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `id_soalujian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_list_soal_ujian`
--

INSERT INTO `tb_list_soal_ujian` (`id_list_soal_ujian`, `id_soal`, `id_soalujian`) VALUES
(49, 9, 18),
(50, 10, 18),
(51, 12, 18),
(52, 13, 18),
(58, 9, 20),
(59, 10, 20),
(60, 11, 20),
(61, 12, 20),
(62, 13, 20),
(63, 9, 21);

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `id_mapel` int(11) NOT NULL,
  `mapel` varchar(20) DEFAULT NULL,
  `log_mapel` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mapel`
--

INSERT INTO `tb_mapel` (`id_mapel`, `mapel`, `log_mapel`) VALUES
(1, 'Agama', '2019-06-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_materi`
--

CREATE TABLE `tb_materi` (
  `id_materi` int(11) NOT NULL,
  `judul_materi` varchar(20) DEFAULT NULL,
  `materi` varchar(5000) DEFAULT NULL,
  `modul` varchar(255) DEFAULT NULL,
  `img_materi` varchar(255) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `log_materi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_materi`
--

INSERT INTO `tb_materi` (`id_materi`, `judul_materi`, `materi`, `modul`, `img_materi`, `nip`, `id_mapel`, `log_materi`) VALUES
(1, 'Hukum Fiqih Wajib', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '156203302338276-801-2-PB.pdf', 'photo_1562033023_1475.jpg', '1557301091', 1, '2019-07-02 09:03:43'),
(2, 'Pembersihan Ruang', 'qweqweqweqwe', NULL, 'NOIMAGE.jpg', '1557301091', 1, '2019-07-02 09:51:05');

-- --------------------------------------------------------

--
-- Table structure for table `tb_operator`
--

CREATE TABLE `tb_operator` (
  `id_operator` varchar(16) NOT NULL,
  `nama_operator` varchar(20) DEFAULT NULL,
  `jk_operator` enum('L','P') DEFAULT NULL,
  `photo_operator` varchar(255) DEFAULT NULL,
  `pass_operator` varchar(255) DEFAULT NULL,
  `log_operator` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_operator`
--

INSERT INTO `tb_operator` (`id_operator`, `nama_operator`, `jk_operator`, `photo_operator`, `pass_operator`, `log_operator`) VALUES
('admin', 'iqbal', 'L', 'photo_1561042225_4109.jpg', '21232f297a57a5a743894a0e4a801fc3', '2019-06-20 05:25:08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nis` varchar(10) NOT NULL,
  `nama_siswa` varchar(20) DEFAULT NULL,
  `jk_siswa` enum('L','P') DEFAULT NULL,
  `tmp_lahir_siswa` varchar(60) DEFAULT NULL,
  `tgl_lahir_siswa` date DEFAULT NULL,
  `alamat_siswa` varchar(60) DEFAULT NULL,
  `photo_siswa` varchar(255) DEFAULT NULL,
  `pass_siswa` varchar(255) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `log_siswa` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`nis`, `nama_siswa`, `jk_siswa`, `tmp_lahir_siswa`, `tgl_lahir_siswa`, `alamat_siswa`, `photo_siswa`, `pass_siswa`, `id_kelas`, `log_siswa`) VALUES
('9945731213', 'Muhammad Iqbal', 'L', 'Medan', '2019-06-10', 'Medan ', 'photo_1561214328_8940.jpg', '94070ebc98d22e5eaffb937058f24c67', 4, '2019-06-22 09:38:48'),
('9999999999', 'Joni', 'L', 'Bandung', '2019-06-17', ' asdsad', 'NOIMAGE.jpg', 'e0ec043b3f9e198ec09041687e4d4e8d', 4, '2019-06-30 12:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal`
--

CREATE TABLE `tb_soal` (
  `id_soal` int(11) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `soal` varchar(600) DEFAULT NULL,
  `a` varchar(200) DEFAULT NULL,
  `b` varchar(200) DEFAULT NULL,
  `c` varchar(200) DEFAULT NULL,
  `d` varchar(200) DEFAULT NULL,
  `kunci` varchar(1) DEFAULT NULL,
  `img_soal` varchar(255) DEFAULT NULL,
  `log_soal` datetime DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_soal`
--

INSERT INTO `tb_soal` (`id_soal`, `nip`, `soal`, `a`, `b`, `c`, `d`, `kunci`, `img_soal`, `log_soal`, `id_mapel`) VALUES
(9, '1557301091', 'Soal Nomer 1, Apakah Yang dimaksud dengan ku ?', 'entah', 'gak tau', 'Semua Benar', 'Semua Salah', 'a', 'photo_1561271741_9041.jpg', '2019-06-23 01:35:41', 1),
(10, '1557301091', 'Soal ke 2, Apa kepanjangan dari PHP ?', 'entah', 'gak tau', 'Ali Bin Abi Thalib', 'Semua Salah', 'a', 'NOIMAGE.jpg', '2019-06-23 01:40:31', 1),
(11, '1557301091', 'Soal Ke 3, FFFFttt ?', 'Amoeba', 'gak tau', 'Semua Benar', 'Alif Durjana', 'c', 'photo_1561272085_4924.jpg', '2019-06-23 01:41:25', 1),
(12, '1557301091', 'Soal ke 4, hahahaha?', 'entah', 'Annelida', 'Semua Benar', 'Alif Durjana', 'b', 'NOIMAGE.jpg', '2019-06-23 01:44:05', 1),
(13, '1557301091', 'soal ke 5, Kkakaokkoak', 'asd', 'dfdf', 'asda', 'dsds', 'd', 'NOIMAGE.jpg', '2019-06-23 01:46:33', 1),
(14, '1557301090', 'Siapakah Aku ?', 'asd', 'dsdsdsd', 'sssss', 'sssss', 'a', 'NOIMAGE.jpg', '2019-06-28 04:12:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal_ujian`
--

CREATE TABLE `tb_soal_ujian` (
  `id_soalujian` int(11) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `judul_soal_ujian` varchar(20) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `token` varchar(10) NOT NULL,
  `waktu_ujian` date NOT NULL,
  `lama_pengerjaan` int(11) NOT NULL,
  `keterangan` varchar(500) DEFAULT NULL,
  `log_soal_ujian` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_soal_ujian`
--

INSERT INTO `tb_soal_ujian` (`id_soalujian`, `nip`, `judul_soal_ujian`, `id_kelas`, `token`, `waktu_ujian`, `lama_pengerjaan`, `keterangan`, `log_soal_ujian`) VALUES
(18, '1557301091', 'Ujian Mid Tes', 4, '1907014957', '2019-07-18', 90, 'Dikerjakan dan dikumpulkan besok pagi', '2019-07-01 09:03:39'),
(20, '1557301091', 'wadi maulana', 4, '1907053539', '2019-07-05', 20, 'asdasd', '2019-07-05 10:42:15'),
(21, '1557301091', 'Ujian Mid Tes', 4, '1907083884', '2019-07-08', 45, '', '2019-07-08 09:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ujian`
--

CREATE TABLE `tb_ujian` (
  `id_ujian` int(11) NOT NULL,
  `id_soalujian` int(11) DEFAULT NULL,
  `jml_soal` int(11) DEFAULT NULL,
  `tot_benar` int(11) DEFAULT NULL,
  `tot_salah` int(11) DEFAULT NULL,
  `tot_kosong` int(11) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `nis` varchar(10) DEFAULT NULL,
  `log_ujian` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ujian`
--

INSERT INTO `tb_ujian` (`id_ujian`, `id_soalujian`, `jml_soal`, `tot_benar`, `tot_salah`, `tot_kosong`, `nilai`, `nis`, `log_ujian`) VALUES
(27, 20, 1, 0, 1, 0, 0, '9945731213', '2019-07-05 10:46:27');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_jawaban`
--

CREATE TABLE `tmp_jawaban` (
  `id_tmp` int(11) NOT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `nis` varchar(10) DEFAULT NULL,
  `jawaban` enum('a','b','c','d') DEFAULT NULL,
  `nilai` enum('benar','salah') DEFAULT NULL,
  `log_tmp` datetime DEFAULT NULL,
  `id_soalujian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_jawaban`
--

INSERT INTO `tmp_jawaban` (`id_tmp`, `id_soal`, `nis`, `jawaban`, `nilai`, `log_tmp`, `id_soalujian`) VALUES
(6, 9, '9945731213', 'c', 'salah', '2019-07-05 10:07:53', 18),
(7, 10, '9945731213', 'c', 'salah', '2019-07-05 10:07:00', 18),
(8, 12, '9945731213', 'c', 'salah', '2019-07-05 10:07:59', 18),
(9, 13, '9945731213', 'c', 'salah', '2019-07-05 10:07:07', 18);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_list_soal`
--

CREATE TABLE `tmp_list_soal` (
  `id_tmp_soal` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `nip` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_soal`
--

CREATE TABLE `tmp_soal` (
  `id_tmp_soal` int(11) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `id_soalujian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_soal`
--

INSERT INTO `tmp_soal` (`id_tmp_soal`, `nis`, `id_soal`, `id_soalujian`) VALUES
(6, '9945731213', 10, 18),
(7, '9945731213', 12, 18),
(8, '9945731213', 9, 18),
(9, '9945731213', 13, 18);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_waktu`
--

CREATE TABLE `tmp_waktu` (
  `id` int(11) NOT NULL,
  `id_soalujian` int(11) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `bataswaktu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_waktu`
--

INSERT INTO `tmp_waktu` (`id`, `id_soalujian`, `nis`, `bataswaktu`) VALUES
(2, 18, '9945731213', 1562346563);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_list_soal_ujian`
--
ALTER TABLE `tb_list_soal_ujian`
  ADD PRIMARY KEY (`id_list_soal_ujian`),
  ADD KEY `id_soal` (`id_soal`),
  ADD KEY `id_soalujian` (`id_soalujian`);

--
-- Indexes for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `tb_materi`
--
ALTER TABLE `tb_materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indexes for table `tb_operator`
--
ALTER TABLE `tb_operator`
  ADD PRIMARY KEY (`id_operator`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `nip` (`nip`),
  ADD KEY `tb_soal_ibfk_2` (`id_mapel`);

--
-- Indexes for table `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  ADD PRIMARY KEY (`id_soalujian`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `tb_ujian`
--
ALTER TABLE `tb_ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `nis` (`nis`),
  ADD KEY `tb_ujian_ibfk_2` (`id_soalujian`);

--
-- Indexes for table `tmp_jawaban`
--
ALTER TABLE `tmp_jawaban`
  ADD PRIMARY KEY (`id_tmp`),
  ADD KEY `id_soal` (`id_soal`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `tmp_list_soal`
--
ALTER TABLE `tmp_list_soal`
  ADD PRIMARY KEY (`id_tmp_soal`),
  ADD KEY `id_soal` (`id_soal`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `tmp_soal`
--
ALTER TABLE `tmp_soal`
  ADD PRIMARY KEY (`id_tmp_soal`),
  ADD KEY `id_soal` (`id_soal`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `tmp_waktu`
--
ALTER TABLE `tmp_waktu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_list_soal_ujian`
--
ALTER TABLE `tb_list_soal_ujian`
  MODIFY `id_list_soal_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_materi`
--
ALTER TABLE `tb_materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_soal`
--
ALTER TABLE `tb_soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  MODIFY `id_soalujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tb_ujian`
--
ALTER TABLE `tb_ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tmp_jawaban`
--
ALTER TABLE `tmp_jawaban`
  MODIFY `id_tmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tmp_list_soal`
--
ALTER TABLE `tmp_list_soal`
  MODIFY `id_tmp_soal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmp_soal`
--
ALTER TABLE `tmp_soal`
  MODIFY `id_tmp_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tmp_waktu`
--
ALTER TABLE `tmp_waktu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_list_soal_ujian`
--
ALTER TABLE `tb_list_soal_ujian`
  ADD CONSTRAINT `tb_list_soal_ujian_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `tb_soal` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_list_soal_ujian_ibfk_2` FOREIGN KEY (`id_soalujian`) REFERENCES `tb_soal_ujian` (`id_soalujian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_materi`
--
ALTER TABLE `tb_materi`
  ADD CONSTRAINT `tb_materi_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `tb_guru` (`nip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_materi_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `tb_mapel` (`id_mapel`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD CONSTRAINT `tb_soal_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `tb_guru` (`nip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_soal_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `tb_mapel` (`id_mapel`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  ADD CONSTRAINT `tb_soal_ujian_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `tb_guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_ujian`
--
ALTER TABLE `tb_ujian`
  ADD CONSTRAINT `tb_ujian_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `tb_siswa` (`nis`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_ujian_ibfk_2` FOREIGN KEY (`id_soalujian`) REFERENCES `tb_soal_ujian` (`id_soalujian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tmp_jawaban`
--
ALTER TABLE `tmp_jawaban`
  ADD CONSTRAINT `tmp_jawaban_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `tb_soal` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tmp_jawaban_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `tb_siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tmp_list_soal`
--
ALTER TABLE `tmp_list_soal`
  ADD CONSTRAINT `tmp_list_soal_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `tb_soal` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tmp_list_soal_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `tb_guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tmp_soal`
--
ALTER TABLE `tmp_soal`
  ADD CONSTRAINT `tmp_soal_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `tb_soal` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tmp_soal_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `tb_siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
