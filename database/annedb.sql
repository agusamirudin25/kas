/*
 Navicat Premium Data Transfer

 Source Server         : kominfo
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : annedb

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 23/06/2022 07:50:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for anggaran
-- ----------------------------
DROP TABLE IF EXISTS `anggaran`;
CREATE TABLE `anggaran`  (
  `id_anggaran` int(10) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `nominal` int(20) NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipe_anggaran` int(2) NOT NULL,
  `id_kegiatan` int(4) NOT NULL,
  `id_donatur` int(4) NOT NULL,
  `status` int(3) NOT NULL,
  `file_bukti` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_anggaran`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of anggaran
-- ----------------------------
INSERT INTO `anggaran` VALUES (23, '2022-06-29', 100000, 'diterima sejumlah uang pada tgl  05 bulan juni 2022', 1, 8, 6, 0, NULL);
INSERT INTO `anggaran` VALUES (24, '2022-06-29', 1000000, 'diterima sejumlah uang pada tanggal 12 juni 2022', 1, 8, 5, 0, NULL);
INSERT INTO `anggaran` VALUES (25, '2022-06-29', 150000, 'diterima sejumlah uang pada tanggal 18 bulan juni 2022', 1, 9, 4, 0, NULL);
INSERT INTO `anggaran` VALUES (27, '2022-06-29', 500000, 'membelanjakan bahan sembako', 0, 8, 0, 0, NULL);
INSERT INTO `anggaran` VALUES (30, '2022-06-18', 1000000, 'uraian ya gaes', 1, 7, 6, 0, NULL);
INSERT INTO `anggaran` VALUES (31, '2022-06-18', 250000, 'melakukan pemberian', 1, 7, 5, 0, NULL);
INSERT INTO `anggaran` VALUES (34, '2022-06-18', 1000000, 'contoh', 1, 7, 4, 0, NULL);
INSERT INTO `anggaran` VALUES (35, '2022-06-18', 99, 'uraian pemasukan', 1, 9, 5, 0, NULL);
INSERT INTO `anggaran` VALUES (52, '2022-06-22', 100000, 'uraian anggaran', 1, 9, 6, 0, NULL);
INSERT INTO `anggaran` VALUES (53, '2022-06-22', 200000, 'uraian anggaran', 1, 8, 6, 0, NULL);
INSERT INTO `anggaran` VALUES (54, '2022-06-22', 240000, 'uraian anggaran', 1, 7, 6, 0, NULL);
INSERT INTO `anggaran` VALUES (55, '2022-06-22', 100000, 'uraian anggaran', 1, 9, 4, 0, NULL);
INSERT INTO `anggaran` VALUES (60, '2022-06-22', 10000, 'tes', 0, 9, 0, 0, NULL);
INSERT INTO `anggaran` VALUES (61, '2022-06-22', 1000000, 'tes uangsa', 0, 7, 0, 0, '22062022192316alurmekanismepengelolaankeberatan.jpg');

-- ----------------------------
-- Table structure for donatur
-- ----------------------------
DROP TABLE IF EXISTS `donatur`;
CREATE TABLE `donatur`  (
  `id_donatur` int(11) NOT NULL AUTO_INCREMENT,
  `nama_donatur` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kontak` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_rekening` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipe_donatur` int(11) NOT NULL,
  PRIMARY KEY (`id_donatur`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of donatur
-- ----------------------------
INSERT INTO `donatur` VALUES (4, 'firmansyah', '01298734', '107890', 0);
INSERT INTO `donatur` VALUES (5, 'cindi indriani', '01260982', '105987', 1);
INSERT INTO `donatur` VALUES (6, 'inggita sari', '01285102', '108906', 0);

-- ----------------------------
-- Table structure for kegiatan
-- ----------------------------
DROP TABLE IF EXISTS `kegiatan`;
CREATE TABLE `kegiatan`  (
  `id_kegiatan` int(4) NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lokasi` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id_kegiatan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kegiatan
-- ----------------------------
INSERT INTO `kegiatan` VALUES (7, 'Beasiswa Yatim', 'Yayasan Kemanusiaan Karawang Peduli', '2022-06-18', 'bertujuan untuk mewujudkan kembali cita-cita indah anak agar dapat bersekolah lagi', 0);
INSERT INTO `kegiatan` VALUES (8, 'Sedekah pangan', 'Yayasan Kemanusiaan Karawang Peduli', '2022-06-29', 'menyediakan kebuthan pangan keluarga kurang mampu untuk memenuhi keberlangsungan hidup', 0);
INSERT INTO `kegiatan` VALUES (9, 'Gerakan BBM ( Bersih-Bersih masjid)', 'masjid masjid daerah karawang', '2022-07-09', 'membelanjakan alat-alat kebersihan', 0);

-- ----------------------------
-- Table structure for pengurus
-- ----------------------------
DROP TABLE IF EXISTS `pengurus`;
CREATE TABLE `pengurus`  (
  `id_pengurus` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pengurus` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_pengurus` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` int(2) NOT NULL,
  PRIMARY KEY (`id_pengurus`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengurus
-- ----------------------------
INSERT INTO `pengurus` VALUES (5, 'Hilmawan kepala bagian', '100001', 1);
INSERT INTO `pengurus` VALUES (9, 'Juwinda Bendahara', '100003', 2);
INSERT INTO `pengurus` VALUES (10, 'Tia admin', '100002', 3);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` int(5) NOT NULL AUTO_INCREMENT,
  `no_pengurus` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('kepala1', 'kepala', '1', 9, '0123456');
INSERT INTO `user` VALUES ('master', 'master', '0', 10, '');
INSERT INTO `user` VALUES ('Tia admin', 'admin', '3', 12, '100002');
INSERT INTO `user` VALUES ('juwinda bendahara', 'bendahara', '2', 13, '100003');
INSERT INTO `user` VALUES ('Hilmawan', 'pengurus', '1', 14, '100001');

SET FOREIGN_KEY_CHECKS = 1;
