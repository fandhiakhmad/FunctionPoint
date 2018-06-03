SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `aktivitas`
-- ----------------------------
DROP TABLE IF EXISTS `aktivitas`;
CREATE TABLE `aktivitas` (
  `ID_AKTIVITAS` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PROFESI` int(11) DEFAULT NULL,
  `NAMA_AKTIVITAS` char(125) DEFAULT NULL,
  `KATEGORI_AKTIVITAS` int(11) DEFAULT NULL,
  `PRESENTASE_USAHA` double DEFAULT NULL,
  `TEMPLATE` int(10) DEFAULT NULL,
  PRIMARY KEY (`ID_AKTIVITAS`),
  KEY `FK_REFERENCE_11` (`ID_PROFESI`),
  CONSTRAINT `FK_REFERENCE_11` FOREIGN KEY (`ID_PROFESI`) REFERENCES `profesi` (`ID_PROFESI`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of aktivitas
-- ----------------------------
INSERT INTO `aktivitas` VALUES ('1', '2', 'Requirements', '1', '7.5', '0');
INSERT INTO `aktivitas` VALUES ('2', '2', 'Specifications & Design', '1', '17.5', '0');
INSERT INTO `aktivitas` VALUES ('3', '1', 'Coding', '1', '10', '0');
INSERT INTO `aktivitas` VALUES ('4', '4', 'Testing', '1', '7', '0');
INSERT INTO `aktivitas` VALUES ('5', '3', 'Project management', '2', '7', '0');
INSERT INTO `aktivitas` VALUES ('6', '2', 'Configuration Management', '2', '3', '0');
INSERT INTO `aktivitas` VALUES ('7', '5', 'Documentation', '2', '3', '0');
INSERT INTO `aktivitas` VALUES ('8', '2', 'Training & Support', '2', '3', '0');
INSERT INTO `aktivitas` VALUES ('9', '3', 'Acceptance & Deployment', '2', '5', '0');
INSERT INTO `aktivitas` VALUES ('10', '3', 'Quality Assurance & Control', '3', '12.34', '0');
INSERT INTO `aktivitas` VALUES ('11', '4', 'Evaluation and Testing', '3', '24.66', '0');
INSERT INTO `aktivitas` VALUES ('12', '2', 'Requirements', '1', '7.5', '1');
INSERT INTO `aktivitas` VALUES ('13', '2', 'Specifications & Design', '1', '17.5', '1');
INSERT INTO `aktivitas` VALUES ('14', '1', 'Coding', '1', '10', '1');
INSERT INTO `aktivitas` VALUES ('15', '4', 'Testing', '1', '7', '1');
INSERT INTO `aktivitas` VALUES ('16', '3', 'Project management', '2', '7', '1');
INSERT INTO `aktivitas` VALUES ('17', '2', 'Configuration Management', '2', '3', '1');
INSERT INTO `aktivitas` VALUES ('18', '5', 'Documentation', '2', '3', '1');
INSERT INTO `aktivitas` VALUES ('19', '2', 'Training & Support', '2', '3', '1');
INSERT INTO `aktivitas` VALUES ('20', '3', 'Acceptance & Deployment', '2', '5', '1');
INSERT INTO `aktivitas` VALUES ('21', '3', 'Quality Assurance & Control', '3', '12.34', '1');
INSERT INTO `aktivitas` VALUES ('22', '4', 'Evaluation and Testing', '3', '24.66', '1');

-- ----------------------------
-- Table structure for `profesi`
-- ----------------------------
DROP TABLE IF EXISTS `profesi`;
CREATE TABLE `profesi` (
  `ID_PROFESI` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_PROFESI` char(125) DEFAULT NULL,
  `GAJI_PER_BULAN` double DEFAULT NULL,
  PRIMARY KEY (`ID_PROFESI`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of profesi
-- ----------------------------
INSERT INTO `profesi` VALUES ('1', 'Programmer', '5000000');
INSERT INTO `profesi` VALUES ('2', 'System Analyst', '7000000');
INSERT INTO `profesi` VALUES ('3', 'Project Manager', '8500000');
INSERT INTO `profesi` VALUES ('4', 'Software QA', '5000000');
INSERT INTO `profesi` VALUES ('5', 'Seccretary', '4000000');

-- ----------------------------
-- Table structure for `anggota`
-- ----------------------------
DROP TABLE IF EXISTS `anggota`;
CREATE TABLE `anggota` (
  `ID_ANGGOTA` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_ANGGOTA` char(125) DEFAULT NULL,
  `ID_PROFESI` int(11) DEFAULT NULL,
  `PENGALAMAN` char(125) DEFAULT NULL,
  `STATUS` int(10) DEFAULT NULL,
  PRIMARY KEY (`ID_ANGGOTA`),
  KEY `FK_REFERENCE_15` (`ID_PROFESI`),
  CONSTRAINT `FK_REFERENCE_15` FOREIGN KEY (`ID_PROFESI`) REFERENCES `profesi` (`ID_PROFESI`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO `anggota` VALUES ('1', 'Dewangga Prasetya Praja', '1', '2 tahun', null);
INSERT INTO `anggota` VALUES ('2', 'Naufal Raihan Noly', '2', ' 2 tahun', null);
INSERT INTO `anggota` VALUES ('3', 'Fandhi Akhmad', '3', '2 tahun', null);
INSERT INTO `anggota` VALUES ('4', 'Brillianto WS', '4', '2 tahun', null);
INSERT INTO `anggota` VALUES ('5', 'M Iqbal Imaduddin', '5', '2 Tahun', null);
-- ----------------------------
-- Table structure for `anggota_tim`
-- ----------------------------
DROP TABLE IF EXISTS `anggota_tim`;
CREATE TABLE `anggota_tim` (
  `ID_ANGGOTA_TIM` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TIM` int(11) DEFAULT NULL,
  `ID_ANGGOTA` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_ANGGOTA_TIM`),
  KEY `Fk_tim` (`ID_TIM`),
  KEY `fk_anggota` (`ID_ANGGOTA`),
  CONSTRAINT `Fk_tim` FOREIGN KEY (`ID_TIM`) REFERENCES `tim` (`ID_TIM`),
  CONSTRAINT `fk_anggota` FOREIGN KEY (`ID_ANGGOTA`) REFERENCES `anggota` (`ID_ANGGOTA`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `aplikasi`
-- ----------------------------
DROP TABLE IF EXISTS `aplikasi`;
CREATE TABLE `aplikasi` (
  `ID_APLIKASI` int(11) NOT NULL AUTO_INCREMENT,
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
  `ER` double(10,2) DEFAULT '0.00',
  PRIMARY KEY (`ID_APLIKASI`),
  KEY `FK_REFERENCE_12` (`ID_TIM`),
  KEY `FK_CLIENT` (`ID_CLIENT`),
  CONSTRAINT `FK_CLIENT` FOREIGN KEY (`ID_CLIENT`) REFERENCES `client` (`ID_CLIENT`),
  CONSTRAINT `FK_REFERENCE_12` FOREIGN KEY (`ID_TIM`) REFERENCES `tim` (`ID_TIM`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `biaya_op`
-- ----------------------------
DROP TABLE IF EXISTS `biaya_op`;
CREATE TABLE `biaya_op` (
  `ID_OP` int(10) NOT NULL AUTO_INCREMENT,
  `ID_APLIKASI` int(10) DEFAULT NULL,
  `DESKRIPSI` varchar(125) DEFAULT NULL,
  `NILAI` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`ID_OP`),
  KEY `fk_id_aplikasi` (`ID_APLIKASI`),
  CONSTRAINT `fk_id_aplikasi` FOREIGN KEY (`ID_APLIKASI`) REFERENCES `aplikasi` (`ID_APLIKASI`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `client`
-- ----------------------------
DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `ID_CLIENT` int(10) NOT NULL AUTO_INCREMENT,
  `NAMA` varchar(125) DEFAULT NULL,
  `ALAMAT` text,
  `TANGGAL_PENGAJUAN` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`ID_CLIENT`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `fitur`
-- ----------------------------
DROP TABLE IF EXISTS `fitur`;
CREATE TABLE `fitur` (
  `ID_FITUR` int(10) NOT NULL AUTO_INCREMENT,
  `ID_APLIKASI` int(10) DEFAULT NULL,
  `NAMA_FITUR` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`ID_FITUR`),
  KEY `fk_id_aplikasi_fitur` (`ID_APLIKASI`),
  CONSTRAINT `fk_id_aplikasi_fitur` FOREIGN KEY (`ID_APLIKASI`) REFERENCES `aplikasi` (`ID_APLIKASI`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `penilaian_cfp`
-- ----------------------------

DROP TABLE IF EXISTS `pembobotan_cfp`;
CREATE TABLE `pembobotan_cfp` (
  `ID_P_CFP` int(11) NOT NULL AUTO_INCREMENT,
  `ITEM_DESCRIPTION` char(125) DEFAULT NULL,
  `TYPE` char(125) DEFAULT NULL,
  `BOBOT` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_P_CFP`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pembobotan_cfp
-- ----------------------------
INSERT INTO `pembobotan_cfp` VALUES ('1', 'Number Of User Inputs', 'simple', '3');
INSERT INTO `pembobotan_cfp` VALUES ('2', 'Number Of User Inputs', 'average', '4');
INSERT INTO `pembobotan_cfp` VALUES ('3', 'Number Of User Inputs', 'complex', '6');
INSERT INTO `pembobotan_cfp` VALUES ('4', 'Number Of User Outputs', 'simple', '4');
INSERT INTO `pembobotan_cfp` VALUES ('5', 'Number Of User Outputs', 'average', '5');
INSERT INTO `pembobotan_cfp` VALUES ('6', 'Number Of User Outputs', 'complex', '7');
INSERT INTO `pembobotan_cfp` VALUES ('7', 'Number Of User Inquiries', 'simple','3');
INSERT INTO `pembobotan_cfp` VALUES ('8', 'Number Of User Inquiries', 'average', '4');
INSERT INTO `pembobotan_cfp` VALUES ('9', 'Number Of User Inquiries', 'complex', '6');
INSERT INTO `pembobotan_cfp` VALUES ('10', 'Number Of Files', 'simple', '7');
INSERT INTO `pembobotan_cfp` VALUES ('11', 'Number Of Files', 'average', '10');
INSERT INTO `pembobotan_cfp` VALUES ('12', 'Number Of Files', 'complex', '15');
INSERT INTO `pembobotan_cfp` VALUES ('13', 'Number Of External Interfaces', 'simple', '5');
INSERT INTO `pembobotan_cfp` VALUES ('14', 'Number Of External Interfaces', 'average', '7');
INSERT INTO `pembobotan_cfp` VALUES ('15', 'Number Of External Interfaces', 'complex', '10');


-- ----------------------------
-- Table structure for `pembobotan_rcaf`
-- ----------------------------
DROP TABLE IF EXISTS `pembobotan_rcaf`;
CREATE TABLE `pembobotan_rcaf` (
  `ID_P_RCAF` int(11) NOT NULL AUTO_INCREMENT,
  `KARAKTERISTIK` char(125) DEFAULT NULL,
  `DESKRIPSI` text,
  `BOBOT` double DEFAULT NULL,
  PRIMARY KEY (`ID_P_RCAF`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pembobotan_rcaf
-- ----------------------------
INSERT INTO `pembobotan_rcaf` VALUES ('1', 'Tingkat Kompleksitas Komunikasi Data','','1');
INSERT INTO `pembobotan_rcaf` VALUES ('2', 'Tingkat Kompleksitas Pemrosesan Terdistribusi','','1');
INSERT INTO `pembobotan_rcaf` VALUES ('3', 'Tingkat Kompleksitas Performance','','1');
INSERT INTO `pembobotan_rcaf` VALUES ('4', 'Tingkat Kompleksitas Konfigurasi','','1');
INSERT INTO `pembobotan_rcaf` VALUES ('5', 'Tingkat Frekuensi Penggunaan Software','','1');
INSERT INTO `pembobotan_rcaf` VALUES ('6', 'Tingkat Frekuensi Input Data','','1');
INSERT INTO `pembobotan_rcaf` VALUES ('7', 'Tingkat Kemudahan Penggunaan Bagi User','','1');
INSERT INTO `pembobotan_rcaf` VALUES ('8', 'Tingkat Frekuensi Update Data','','1');
INSERT INTO `pembobotan_rcaf` VALUES ('9', 'Tingkat Kompleksitas Prosessing Data','','1');
INSERT INTO `pembobotan_rcaf` VALUES ('10', 'Tingkat Kemungkinan Penggunaan Kembali','','1');
INSERT INTO `pembobotan_rcaf` VALUES ('11', 'Tingkat Kemudahan Dalam Instalasi','','1');
INSERT INTO `pembobotan_rcaf` VALUES ('12', 'Tingkat Kemudahan Operasional Software','','1');
INSERT INTO `pembobotan_rcaf` VALUES ('13', 'Tingkat Software dibuat untuk multi organisasi/perusahaan client','','1');
INSERT INTO `pembobotan_rcaf` VALUES ('14', 'Tingkat Kompleksitas dalam mengikuti perubahan/fleksibel','','1');
INSERT INTO `pembobotan_rcaf` VALUES ('15', 'Tingkat Kompleksitas proses bisnis','','1');

-- ----------------------------
-- Table structure for `log_indikator_cfp`
-- ----------------------------

DROP TABLE IF EXISTS `log_indikator_cfp`;
CREATE TABLE `log_indikator_cfp` (
  `ID_LOG_CFP` int(11) NOT NULL AUTO_INCREMENT,
  `ID_APLIKASI` int(11) DEFAULT NULL,
  `ID_P_CFP` int(11) DEFAULT NULL,
  `VALUE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_LOG_CFP`),
  KEY `FK_REFERENCE_5` (`ID_APLIKASI`),
  KEY `FK_REFERENCE_6` (`ID_P_CFP`),
  CONSTRAINT `FK_REFERENCE_5` FOREIGN KEY (`ID_APLIKASI`) REFERENCES `aplikasi` (`ID_APLIKASI`),
  CONSTRAINT `FK_REFERENCE_6` FOREIGN KEY (`ID_P_CFP`) REFERENCES `pembobotan_cfp` (`ID_P_CFP`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `log_indikator_rcaf`
-- ----------------------------
DROP TABLE IF EXISTS `log_indikator_rcaf`;
CREATE TABLE `log_indikator_rcaf` (
  `ID_LOG_RCAF` int(11) NOT NULL AUTO_INCREMENT,
  `ID_APLIKASI` int(11) DEFAULT NULL,
  `ID_P_RCAF` int(11) DEFAULT NULL,
  `VALUE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_LOG_RCAF`),
  KEY `FK_REFERENCE_7` (`ID_APLIKASI`),
  KEY `FK_REFERENCE_8` (`ID_P_RCAF`),
  CONSTRAINT `FK_REFERENCE_7` FOREIGN KEY (`ID_APLIKASI`) REFERENCES `aplikasi` (`ID_APLIKASI`),
  CONSTRAINT `FK_REFERENCE_8` FOREIGN KEY (`ID_P_RCAF`) REFERENCES `pembobotan_rcaf` (`ID_P_RCAF`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `log_biaya`
-- ----------------------------
DROP TABLE IF EXISTS `log_biaya`;
CREATE TABLE `log_biaya` (
  `ID_LOG_BIAYA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_APLIKASI` int(11) DEFAULT NULL,
  `ID_AKTIVITAS` int(11) DEFAULT NULL,
  `NILAI_USAHA` double DEFAULT NULL,
  `GAJI_PER_JAM` double DEFAULT NULL,
  `BIAYA_AKTIVITAS` double DEFAULT NULL,
  `EDIT_BIAYA` int(10) DEFAULT '0',
  PRIMARY KEY (`ID_LOG_BIAYA`),
  KEY `FK_REFERENCE_14` (`ID_AKTIVITAS`),
  KEY `FK_REFERENCE_13` (`ID_APLIKASI`),
  CONSTRAINT `FK_REFERENCE_14` FOREIGN KEY (`ID_AKTIVITAS`) REFERENCES `aktivitas` (`ID_AKTIVITAS`),
  CONSTRAINT `FK_REFERENCE_13` FOREIGN KEY (`ID_APLIKASI`) REFERENCES `aplikasi` (`ID_APLIKASI`)
) ENGINE=InnoDB AUTO_INCREMENT=459 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `log_konstanta_effort`
-- ----------------------------
DROP TABLE IF EXISTS `log_konstanta_effort`;
CREATE TABLE `log_konstanta_effort` (
  `ID_K_EFFORT` int(11) NOT NULL AUTO_INCREMENT,
  `NILAI_EFFORT` double(10,2) NOT NULL,
  `DATE_CREATED` varchar(125) DEFAULT NULL,
  `TEMPLATE` int(10) DEFAULT NULL,
  PRIMARY KEY (`ID_K_EFFORT`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `tim`
-- ----------------------------
DROP TABLE IF EXISTS `tim`;
CREATE TABLE `tim` (
  `ID_TIM` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_TIM` char(125) DEFAULT NULL,
  PRIMARY KEY (`ID_TIM`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA` char(125) DEFAULT NULL,
  `USERNAME` char(125) DEFAULT NULL,
  `PASSWORD` varchar(125) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `ROLE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', null, '1');
INSERT INTO `user` VALUES ('2', 'Project Manager', 'projectmanager', '827ccb0eea8a706c4c34a16891f84e7b', null, '2');
INSERT INTO `user` VALUES ('3', 'System Analyst', 'analis', '81dc9bdb52d04dc20036dbd8313ed055', null, '3');
INSERT INTO `user` VALUES ('4', 'Seccretary', 'sekretaris', '202cb962ac59075b964b07152d234b70', null, '4');