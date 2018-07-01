-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2018 at 12:27 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `functionpoint`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas`
--

CREATE TABLE `aktivitas` (
  `ID_AKTIVITAS` int(11) NOT NULL,
  `ID_PROFESI` int(11) DEFAULT NULL,
  `NAMA_AKTIVITAS` char(125) DEFAULT NULL,
  `KATEGORI_AKTIVITAS` int(11) DEFAULT NULL,
  `PRESENTASE_USAHA` double DEFAULT NULL,
  `TEMPLATE` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aktivitas`
--

INSERT INTO `aktivitas` (`ID_AKTIVITAS`, `ID_PROFESI`, `NAMA_AKTIVITAS`, `KATEGORI_AKTIVITAS`, `PRESENTASE_USAHA`, `TEMPLATE`) VALUES
(1, 2, 'Requirements', 1, 7.5, 0),
(2, 2, 'Specifications & Design', 1, 17.5, 0),
(3, 1, 'Coding', 1, 10, 0),
(4, 4, 'Testing', 1, 7, 0),
(5, 3, 'Project management', 2, 7, 0),
(6, 2, 'Configuration Management', 2, 3, 0),
(7, 5, 'Documentation', 2, 3, 0),
(8, 2, 'Training & Support', 2, 3, 0),
(9, 3, 'Acceptance & Deployment', 2, 5, 0),
(10, 3, 'Quality Assurance & Control', 3, 12.34, 0),
(11, 4, 'Evaluation and Testing', 3, 24.66, 0),
(12, 2, 'Requirements', 1, 7.5, 1),
(13, 2, 'Specifications & Design', 1, 17.5, 1),
(14, 1, 'Coding', 1, 10, 1),
(15, 4, 'Testing', 1, 7, 1),
(16, 3, 'Project management', 2, 7, 1),
(17, 2, 'Configuration Management', 2, 3, 1),
(18, 5, 'Documentation', 2, 3, 1),
(19, 2, 'Training & Support', 2, 3, 1),
(20, 3, 'Acceptance & Deployment', 2, 5, 1),
(21, 3, 'Quality Assurance & Control', 3, 12.34, 1),
(22, 4, 'Evaluation and Testing', 3, 24.66, 1);

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `ID_ANGGOTA` int(11) NOT NULL,
  `NAMA_ANGGOTA` char(125) DEFAULT NULL,
  `ID_PROFESI` int(11) DEFAULT NULL,
  `PENGALAMAN` char(125) DEFAULT NULL,
  `STATUS` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`ID_ANGGOTA`, `NAMA_ANGGOTA`, `ID_PROFESI`, `PENGALAMAN`, `STATUS`) VALUES
(1, 'Dewangga Prasetya Praja', 1, '2 tahun', NULL),
(2, 'Naufal Raihan Noly', 2, ' 2 tahun', NULL),
(3, 'Fandhi Akhmad', 3, '2 tahun', NULL),
(4, 'Brillianto WS', 4, '2 tahun', NULL),
(5, 'M Iqbal Imaduddin', 5, '2 Tahun', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `anggota_tim`
--

CREATE TABLE `anggota_tim` (
  `ID_ANGGOTA_TIM` int(11) NOT NULL,
  `ID_TIM` int(11) DEFAULT NULL,
  `ID_ANGGOTA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota_tim`
--

INSERT INTO `anggota_tim` (`ID_ANGGOTA_TIM`, `ID_TIM`, `ID_ANGGOTA`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `aplikasi`
--

CREATE TABLE `aplikasi` (
  `ID_APLIKASI` int(11) NOT NULL,
  `NAMA_APLIKASI` char(125) DEFAULT NULL,
  `CFP` double(10,2) DEFAULT '0.00',
  `RCAF` double(10,2) DEFAULT '0.00',
  `EFFORT_ESTIMATE` double(10,2) DEFAULT '0.00',
  `EFFORT_REAL` double(12,2) NOT NULL DEFAULT '0.00' COMMENT '0',
  `BIAYA_ESTIMASI` double(255,2) DEFAULT '0.00',
  `DATE_CREATED` varchar(125) DEFAULT NULL,
  `ID_TIM` int(11) DEFAULT NULL,
  `STATUS` int(11) DEFAULT NULL,
  `TEMPLATE` int(11) DEFAULT NULL,
  `STEP` int(5) DEFAULT '0',
  `ID_CLIENT` int(10) DEFAULT NULL,
  `ER` double(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aplikasi`
--

INSERT INTO `aplikasi` (`ID_APLIKASI`, `NAMA_APLIKASI`, `CFP`, `RCAF`, `EFFORT_ESTIMATE`, `EFFORT_REAL`, `BIAYA_ESTIMASI`, `DATE_CREATED`, `ID_TIM`, `STATUS`, `TEMPLATE`, `STEP`, `ID_CLIENT`, `ER`) VALUES
(1, 'Aplikasi TDI', 198.00, 59.00, 2013.26, 0.00, 81057968.75, '21-06-2018', 1, 0, 0, 7, 1, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `biaya_op`
--

CREATE TABLE `biaya_op` (
  `ID_OP` int(10) NOT NULL,
  `ID_APLIKASI` int(10) DEFAULT NULL,
  `DESKRIPSI` varchar(125) DEFAULT NULL,
  `NILAI` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `ID_CLIENT` int(10) NOT NULL,
  `NAMA` varchar(125) DEFAULT NULL,
  `ALAMAT` text,
  `TANGGAL_PENGAJUAN` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ID_CLIENT`, `NAMA`, `ALAMAT`, `TANGGAL_PENGAJUAN`) VALUES
(1, 'Pemerintah kota XYZ', 'Surabaya', '21-06-2018');

-- --------------------------------------------------------

--
-- Table structure for table `fitur`
--

CREATE TABLE `fitur` (
  `ID_FITUR` int(10) NOT NULL,
  `ID_APLIKASI` int(10) DEFAULT NULL,
  `NAMA_FITUR` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_biaya`
--

CREATE TABLE `log_biaya` (
  `ID_LOG_BIAYA` int(11) NOT NULL,
  `ID_APLIKASI` int(11) DEFAULT NULL,
  `ID_AKTIVITAS` int(11) DEFAULT NULL,
  `NILAI_USAHA` double DEFAULT NULL,
  `GAJI_PER_JAM` double DEFAULT NULL,
  `BIAYA_AKTIVITAS` double DEFAULT NULL,
  `EDIT_BIAYA` int(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_biaya`
--

INSERT INTO `log_biaya` (`ID_LOG_BIAYA`, `ID_APLIKASI`, `ID_AKTIVITAS`, `NILAI_USAHA`, `GAJI_PER_JAM`, `BIAYA_AKTIVITAS`, `EDIT_BIAYA`) VALUES
(23, 1, 1, 150.99, 43750, 6605812.5, 0),
(24, 1, 2, 352.32, 43750, 15414000, 0),
(25, 1, 3, 201.33, 31250, 6291562.5, 0),
(26, 1, 4, 140.93, 31250, 4404062.5, 0),
(27, 1, 5, 140.93, 53125, 7486906.25, 0),
(28, 1, 6, 60.4, 43750, 2642500, 0),
(29, 1, 7, 60.4, 25000, 1510000, 0),
(30, 1, 8, 60.4, 43750, 2642500, 0),
(31, 1, 9, 100.66, 53125, 5347562.5, 0),
(32, 1, 10, 248.44, 53125, 13198375, 0),
(33, 1, 11, 496.47, 31250, 15514687.5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `log_indikator_cfp`
--

CREATE TABLE `log_indikator_cfp` (
  `ID_LOG_CFP` int(11) NOT NULL,
  `ID_APLIKASI` int(11) DEFAULT NULL,
  `ID_P_CFP` int(11) DEFAULT NULL,
  `VALUE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_indikator_cfp`
--

INSERT INTO `log_indikator_cfp` (`ID_LOG_CFP`, `ID_APLIKASI`, `ID_P_CFP`, `VALUE`) VALUES
(1, 1, 1, 17),
(2, 1, 2, 3),
(3, 1, 3, 4),
(4, 1, 4, 5),
(5, 1, 5, 1),
(6, 1, 6, 0),
(7, 1, 7, 5),
(8, 1, 8, 0),
(9, 1, 9, 1),
(10, 1, 10, 5),
(11, 1, 11, 2),
(12, 1, 12, 0),
(13, 1, 13, 2),
(14, 1, 14, 0),
(15, 1, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `log_indikator_rcaf`
--

CREATE TABLE `log_indikator_rcaf` (
  `ID_LOG_RCAF` int(11) NOT NULL,
  `ID_APLIKASI` int(11) DEFAULT NULL,
  `ID_P_RCAF` int(11) DEFAULT NULL,
  `VALUE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_indikator_rcaf`
--

INSERT INTO `log_indikator_rcaf` (`ID_LOG_RCAF`, `ID_APLIKASI`, `ID_P_RCAF`, `VALUE`) VALUES
(31, 1, 1, 5),
(32, 1, 2, 4),
(33, 1, 3, 4),
(34, 1, 4, 2),
(35, 1, 5, 1),
(36, 1, 6, 5),
(37, 1, 7, 5),
(38, 1, 8, 4),
(39, 1, 9, 3),
(40, 1, 10, 5),
(41, 1, 11, 5),
(42, 1, 12, 3),
(43, 1, 13, 5),
(44, 1, 14, 3),
(45, 1, 15, 5);

-- --------------------------------------------------------

--
-- Table structure for table `log_konstanta_effort`
--

CREATE TABLE `log_konstanta_effort` (
  `ID_K_EFFORT` int(11) NOT NULL,
  `NILAI_EFFORT` double(10,2) NOT NULL,
  `DATE_CREATED` varchar(125) DEFAULT NULL,
  `TEMPLATE` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembobotan_cfp`
--

CREATE TABLE `pembobotan_cfp` (
  `ID_P_CFP` int(11) NOT NULL,
  `ITEM_DESCRIPTION` char(125) DEFAULT NULL,
  `TYPE` char(125) DEFAULT NULL,
  `BOBOT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembobotan_cfp`
--

INSERT INTO `pembobotan_cfp` (`ID_P_CFP`, `ITEM_DESCRIPTION`, `TYPE`, `BOBOT`) VALUES
(1, 'Number Of User Inputs', 'Simple', 3),
(2, 'Number Of User Inputs', 'Average', 4),
(3, 'Number Of User Inputs', 'Complex', 6),
(4, 'Number Of User Outputs', 'Simple', 4),
(5, 'Number Of User Outputs', 'Average', 5),
(6, 'Number Of User Outputs', 'Complex', 7),
(7, 'Number Of User Inquiries', 'Simple', 3),
(8, 'Number Of User Inquiries', 'Average', 4),
(9, 'Number Of User Inquiries', 'Complex', 6),
(10, 'Number Of Files', 'Simple', 7),
(11, 'Number Of Files', 'Average', 10),
(12, 'Number Of Files', 'Complex', 15),
(13, 'Number Of External Interfaces', 'Simple', 5),
(14, 'Number Of External Interfaces', 'Average', 7),
(15, 'Number Of External Interfaces', 'Complex', 10);

-- --------------------------------------------------------

--
-- Table structure for table `pembobotan_rcaf`
--

CREATE TABLE `pembobotan_rcaf` (
  `ID_P_RCAF` int(11) NOT NULL,
  `KARAKTERISTIK` char(125) DEFAULT NULL,
  `DESKRIPSI` text,
  `BOBOT` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembobotan_rcaf`
--

INSERT INTO `pembobotan_rcaf` (`ID_P_RCAF`, `KARAKTERISTIK`, `DESKRIPSI`, `BOBOT`) VALUES
(1, 'Tingkat Kompleksitas Komunikasi Data', '', 1),
(2, 'Tingkat Kompleksitas Pemrosesan Terdistribusi', '', 1),
(3, 'Tingkat Kompleksitas Performance', '', 1),
(4, 'Tingkat Kompleksitas Konfigurasi', '', 1),
(5, 'Tingkat Frekuensi Penggunaan Software', '', 1),
(6, 'Tingkat Frekuensi Input Data', '', 1),
(7, 'Tingkat Kemudahan Penggunaan Bagi User', '', 1),
(8, 'Tingkat Frekuensi Update Data', '', 1),
(9, 'Tingkat Kompleksitas Prosessing Data', '', 1),
(10, 'Tingkat Kemungkinan Penggunaan Kembali', '', 1),
(11, 'Tingkat Kemudahan Dalam Instalasi', '', 1),
(12, 'Tingkat Kemudahan Operasional Software', '', 1),
(13, 'Tingkat Software dibuat untuk multi organisasi/perusahaan client', '', 1),
(14, 'Tingkat Kompleksitas dalam mengikuti perubahan/fleksibel', '', 1),
(15, 'Tingkat Kompleksitas proses bisnis', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profesi`
--

CREATE TABLE `profesi` (
  `ID_PROFESI` int(11) NOT NULL,
  `NAMA_PROFESI` char(125) DEFAULT NULL,
  `GAJI_PER_BULAN` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profesi`
--

INSERT INTO `profesi` (`ID_PROFESI`, `NAMA_PROFESI`, `GAJI_PER_BULAN`) VALUES
(1, 'Programmer', 5000000),
(2, 'System Analyst', 7000000),
(3, 'Project Manager', 20000000),
(4, 'Software QA', 8000000),
(5, 'Seccretary', 4000000);

-- --------------------------------------------------------

--
-- Table structure for table `tim`
--

CREATE TABLE `tim` (
  `ID_TIM` int(11) NOT NULL,
  `NAMA_TIM` char(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tim`
--

INSERT INTO `tim` (`ID_TIM`, `NAMA_TIM`) VALUES
(1, 'Tim Aplikasi TDI');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `NAMA` char(125) DEFAULT NULL,
  `USERNAME` char(125) DEFAULT NULL,
  `PASSWORD` varchar(125) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `ROLE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `NAMA`, `USERNAME`, `PASSWORD`, `EMAIL`, `ROLE`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, 1),
(2, 'Project Manager', 'projectmanager', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 2),
(3, 'System Analyst', 'analis', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 3),
(4, 'Seccretary', 'sekretaris', '202cb962ac59075b964b07152d234b70', NULL, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD PRIMARY KEY (`ID_AKTIVITAS`),
  ADD KEY `FK_REFERENCE_11` (`ID_PROFESI`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`ID_ANGGOTA`),
  ADD KEY `FK_REFERENCE_15` (`ID_PROFESI`);

--
-- Indexes for table `anggota_tim`
--
ALTER TABLE `anggota_tim`
  ADD PRIMARY KEY (`ID_ANGGOTA_TIM`),
  ADD KEY `Fk_tim` (`ID_TIM`),
  ADD KEY `fk_anggota` (`ID_ANGGOTA`);

--
-- Indexes for table `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`ID_APLIKASI`),
  ADD KEY `FK_REFERENCE_12` (`ID_TIM`),
  ADD KEY `FK_CLIENT` (`ID_CLIENT`);

--
-- Indexes for table `biaya_op`
--
ALTER TABLE `biaya_op`
  ADD PRIMARY KEY (`ID_OP`),
  ADD KEY `fk_id_aplikasi` (`ID_APLIKASI`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID_CLIENT`);

--
-- Indexes for table `fitur`
--
ALTER TABLE `fitur`
  ADD PRIMARY KEY (`ID_FITUR`),
  ADD KEY `fk_id_aplikasi_fitur` (`ID_APLIKASI`);

--
-- Indexes for table `log_biaya`
--
ALTER TABLE `log_biaya`
  ADD PRIMARY KEY (`ID_LOG_BIAYA`),
  ADD KEY `FK_REFERENCE_14` (`ID_AKTIVITAS`),
  ADD KEY `FK_REFERENCE_13` (`ID_APLIKASI`);

--
-- Indexes for table `log_indikator_cfp`
--
ALTER TABLE `log_indikator_cfp`
  ADD PRIMARY KEY (`ID_LOG_CFP`),
  ADD KEY `FK_REFERENCE_5` (`ID_APLIKASI`),
  ADD KEY `FK_REFERENCE_6` (`ID_P_CFP`);

--
-- Indexes for table `log_indikator_rcaf`
--
ALTER TABLE `log_indikator_rcaf`
  ADD PRIMARY KEY (`ID_LOG_RCAF`),
  ADD KEY `FK_REFERENCE_7` (`ID_APLIKASI`),
  ADD KEY `FK_REFERENCE_8` (`ID_P_RCAF`);

--
-- Indexes for table `log_konstanta_effort`
--
ALTER TABLE `log_konstanta_effort`
  ADD PRIMARY KEY (`ID_K_EFFORT`);

--
-- Indexes for table `pembobotan_cfp`
--
ALTER TABLE `pembobotan_cfp`
  ADD PRIMARY KEY (`ID_P_CFP`);

--
-- Indexes for table `pembobotan_rcaf`
--
ALTER TABLE `pembobotan_rcaf`
  ADD PRIMARY KEY (`ID_P_RCAF`);

--
-- Indexes for table `profesi`
--
ALTER TABLE `profesi`
  ADD PRIMARY KEY (`ID_PROFESI`);

--
-- Indexes for table `tim`
--
ALTER TABLE `tim`
  ADD PRIMARY KEY (`ID_TIM`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivitas`
--
ALTER TABLE `aktivitas`
  MODIFY `ID_AKTIVITAS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `ID_ANGGOTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `anggota_tim`
--
ALTER TABLE `anggota_tim`
  MODIFY `ID_ANGGOTA_TIM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `ID_APLIKASI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `biaya_op`
--
ALTER TABLE `biaya_op`
  MODIFY `ID_OP` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `ID_CLIENT` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fitur`
--
ALTER TABLE `fitur`
  MODIFY `ID_FITUR` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_biaya`
--
ALTER TABLE `log_biaya`
  MODIFY `ID_LOG_BIAYA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `log_indikator_cfp`
--
ALTER TABLE `log_indikator_cfp`
  MODIFY `ID_LOG_CFP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `log_indikator_rcaf`
--
ALTER TABLE `log_indikator_rcaf`
  MODIFY `ID_LOG_RCAF` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `log_konstanta_effort`
--
ALTER TABLE `log_konstanta_effort`
  MODIFY `ID_K_EFFORT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembobotan_cfp`
--
ALTER TABLE `pembobotan_cfp`
  MODIFY `ID_P_CFP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pembobotan_rcaf`
--
ALTER TABLE `pembobotan_rcaf`
  MODIFY `ID_P_RCAF` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `profesi`
--
ALTER TABLE `profesi`
  MODIFY `ID_PROFESI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tim`
--
ALTER TABLE `tim`
  MODIFY `ID_TIM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD CONSTRAINT `FK_REFERENCE_11` FOREIGN KEY (`ID_PROFESI`) REFERENCES `profesi` (`ID_PROFESI`);

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `FK_REFERENCE_15` FOREIGN KEY (`ID_PROFESI`) REFERENCES `profesi` (`ID_PROFESI`);

--
-- Constraints for table `anggota_tim`
--
ALTER TABLE `anggota_tim`
  ADD CONSTRAINT `Fk_tim` FOREIGN KEY (`ID_TIM`) REFERENCES `tim` (`ID_TIM`),
  ADD CONSTRAINT `fk_anggota` FOREIGN KEY (`ID_ANGGOTA`) REFERENCES `anggota` (`ID_ANGGOTA`);

--
-- Constraints for table `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD CONSTRAINT `FK_CLIENT` FOREIGN KEY (`ID_CLIENT`) REFERENCES `client` (`ID_CLIENT`),
  ADD CONSTRAINT `FK_REFERENCE_12` FOREIGN KEY (`ID_TIM`) REFERENCES `tim` (`ID_TIM`);

--
-- Constraints for table `biaya_op`
--
ALTER TABLE `biaya_op`
  ADD CONSTRAINT `fk_id_aplikasi` FOREIGN KEY (`ID_APLIKASI`) REFERENCES `aplikasi` (`ID_APLIKASI`);

--
-- Constraints for table `fitur`
--
ALTER TABLE `fitur`
  ADD CONSTRAINT `fk_id_aplikasi_fitur` FOREIGN KEY (`ID_APLIKASI`) REFERENCES `aplikasi` (`ID_APLIKASI`);

--
-- Constraints for table `log_biaya`
--
ALTER TABLE `log_biaya`
  ADD CONSTRAINT `FK_REFERENCE_13` FOREIGN KEY (`ID_APLIKASI`) REFERENCES `aplikasi` (`ID_APLIKASI`),
  ADD CONSTRAINT `FK_REFERENCE_14` FOREIGN KEY (`ID_AKTIVITAS`) REFERENCES `aktivitas` (`ID_AKTIVITAS`);

--
-- Constraints for table `log_indikator_cfp`
--
ALTER TABLE `log_indikator_cfp`
  ADD CONSTRAINT `FK_REFERENCE_5` FOREIGN KEY (`ID_APLIKASI`) REFERENCES `aplikasi` (`ID_APLIKASI`),
  ADD CONSTRAINT `FK_REFERENCE_6` FOREIGN KEY (`ID_P_CFP`) REFERENCES `pembobotan_cfp` (`ID_P_CFP`);

--
-- Constraints for table `log_indikator_rcaf`
--
ALTER TABLE `log_indikator_rcaf`
  ADD CONSTRAINT `FK_REFERENCE_7` FOREIGN KEY (`ID_APLIKASI`) REFERENCES `aplikasi` (`ID_APLIKASI`),
  ADD CONSTRAINT `FK_REFERENCE_8` FOREIGN KEY (`ID_P_RCAF`) REFERENCES `pembobotan_rcaf` (`ID_P_RCAF`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
