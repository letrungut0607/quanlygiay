-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 31 Mai 2017 à 15:42
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sanxuatgiay`
--

-- --------------------------------------------------------

--
-- Structure de la table `chitietnhapkho`
--

CREATE TABLE `chitietnhapkho` (
  `id` int(11) NOT NULL,
  `nhapkho_id` int(11) NOT NULL DEFAULT '0',
  `nguyenlieu_id` int(11) NOT NULL DEFAULT '0',
  `soluong` int(11) NOT NULL DEFAULT '0',
  `dongia` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `chitietnhapkho`
--

INSERT INTO `chitietnhapkho` (`id`, `nhapkho_id`, `nguyenlieu_id`, `soluong`, `dongia`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100, 1000000, '2017-05-15 14:37:46', '2017-05-15 14:37:46'),
(2, 1, 5, 100, 1000000, '2017-05-15 14:37:46', '2017-05-15 14:37:46');

-- --------------------------------------------------------

--
-- Structure de la table `lichsucongno`
--

CREATE TABLE `lichsucongno` (
  `id` int(11) NOT NULL,
  `xuatkho_id` int(11) DEFAULT NULL,
  `sotiendatra` bigint(20) DEFAULT NULL,
  `ngaytra` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `id` int(11) NOT NULL,
  `tenloai` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `loaisanpham`
--

INSERT INTO `loaisanpham` (`id`, `tenloai`) VALUES
(1, 'Sản phẩm wallet'),
(2, 'Sản phẩm napkin');

-- --------------------------------------------------------

--
-- Structure de la table `nguyenlieu`
--

CREATE TABLE `nguyenlieu` (
  `id` int(11) NOT NULL,
  `manguyenlieu` varchar(255) DEFAULT NULL,
  `tennguyenlieu` varchar(255) DEFAULT NULL,
  `donvitinh` varchar(255) DEFAULT NULL,
  `soluongtonkho` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `nguyenlieu`
--

INSERT INTO `nguyenlieu` (`id`, `manguyenlieu`, `tennguyenlieu`, `donvitinh`, `soluongtonkho`, `created_at`, `updated_at`) VALUES
(1, '23456789', 'Phôi sản xuất wallet', 'kg', 0, '2017-05-09 21:49:57', '2017-05-30 08:36:59'),
(2, '1494394072', 'Thùng', 'Cái', 9.3, '2017-05-10 05:28:08', '2017-05-30 09:04:32'),
(3, '1494857635', 'Túi trắng', 'Cái', 10, '2017-05-15 14:14:04', '2017-05-15 14:14:26'),
(4, '1494857644', 'Bao bì', 'Cái', 0, '2017-05-15 14:14:17', '2017-05-30 09:05:50'),
(5, '1494858939', 'Phôi sản xuất napkin', 'Kg', 10, '2017-05-15 14:35:51', '2017-05-16 13:49:10');

-- --------------------------------------------------------

--
-- Structure de la table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id` int(11) NOT NULL,
  `tennhanvien` varchar(255) DEFAULT NULL,
  `manhanvien` varchar(255) DEFAULT NULL,
  `taikhoan` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `phanquyen` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `nhanvien`
--

INSERT INTO `nhanvien` (`id`, `tennhanvien`, `manhanvien`, `taikhoan`, `password`, `remember_token`, `phanquyen`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Hoàng Phút', '1234567890', 'demo1', '$2y$10$vjlKuemekfX0so7KS9LeBusU9FWoy7lno6gS5zpgIgHBOrEV0xdOe', '8t9TJVNCRXJgbSrOPD2ylf6yBZr7PvPV1MTCsnqI6jQaEWJD68LATYwU2428', 0, '2017-05-11 07:23:11', '2017-05-15 15:21:50'),
(2, 'Nguyễn Hồng Nhiên', '1494490225', 'demo2', '$2y$10$vjlKuemekfX0so7KS9LeBusU9FWoy7lno6gS5zpgIgHBOrEV0xdOe', NULL, 0, '2017-05-11 08:10:42', '2017-05-11 08:10:42');

-- --------------------------------------------------------

--
-- Structure de la table `nhanviensanxuat`
--

CREATE TABLE `nhanviensanxuat` (
  `id` int(11) NOT NULL,
  `nhanvien_id` int(11) DEFAULT NULL,
  `sanpham_id` int(11) DEFAULT NULL,
  `dongia` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `nhanviensanxuat`
--

INSERT INTO `nhanviensanxuat` (`id`, `nhanvien_id`, `sanpham_id`, `dongia`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 20000, '2017-05-11 08:24:46', '2017-05-12 12:45:24'),
(2, 2, 1, 100000, '2017-05-11 09:39:37', '2017-05-12 12:47:33'),
(3, 2, 2, 10000, '2017-05-11 09:40:13', '2017-05-11 09:40:13');

-- --------------------------------------------------------

--
-- Structure de la table `nhaphanphoi`
--

CREATE TABLE `nhaphanphoi` (
  `id` int(11) NOT NULL,
  `manhaphanphoi` varchar(255) DEFAULT NULL,
  `tennhaphanphoi` varchar(255) DEFAULT NULL,
  `tinh` varchar(255) DEFAULT NULL,
  `huyen` varchar(255) DEFAULT NULL,
  `diachi` varchar(255) DEFAULT NULL,
  `sodienthoai` varchar(255) DEFAULT NULL,
  `congno` bigint(20) DEFAULT NULL,
  `ghichu` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `nhaphanphoi`
--

INSERT INTO `nhaphanphoi` (`id`, `manhaphanphoi`, `tennhaphanphoi`, `tinh`, `huyen`, `diachi`, `sodienthoai`, `congno`, `ghichu`, `created_at`, `updated_at`) VALUES
(1, 'NPP_T_B_C_M', 'Tên nhà phân phối', NULL, NULL, 'Thới Bình, Cà Mau', NULL, 0, NULL, '2017-05-10 07:29:39', '2017-05-31 13:40:23'),
(2, 'NPP_T_B_C_M', 's', NULL, NULL, 'Thới Bình, Cà Mau', NULL, 0, NULL, '2017-05-29 09:45:01', '2017-05-29 09:45:01'),
(3, 'NPP_T_B_C_M', 'Tên', '', NULL, 'Thới Bình, Cà Mau', '', 0, 'Ghi chú', '2017-05-29 09:56:03', '2017-05-29 09:57:46'),
(4, 'NPP_C_M_T_B', 's', 'Cà Mau', 'Thới Bình', 'Thới Bình, Cà Mau', '', 0, '', '2017-05-30 05:27:49', '2017-05-30 05:27:49'),
(5, 'NPP_K_G_G_R', 'NPP', 'Kiên Giang', 'Giồng Riềng', '', '', 0, '', '2017-05-30 05:28:47', '2017-05-30 05:28:47');

-- --------------------------------------------------------

--
-- Structure de la table `nhapkho`
--

CREATE TABLE `nhapkho` (
  `id` int(11) NOT NULL,
  `manhapkho` varchar(255) NOT NULL DEFAULT '0',
  `ngaynhap` timestamp NULL DEFAULT NULL,
  `nhanvien_id` int(11) NOT NULL DEFAULT '0',
  `tongtien` bigint(20) DEFAULT '0',
  `ghichu` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `nhapkho`
--

INSERT INTO `nhapkho` (`id`, `manhapkho`, `ngaynhap`, `nhanvien_id`, `tongtien`, `ghichu`, `created_at`, `updated_at`) VALUES
(1, '1494859047', '2017-05-15 14:37:45', 1, 200000000, '', '2017-05-15 14:37:45', '2017-05-15 14:37:46');

-- --------------------------------------------------------

--
-- Structure de la table `phanphoisanpham`
--

CREATE TABLE `phanphoisanpham` (
  `id` int(11) NOT NULL,
  `xuatkho_id` int(11) DEFAULT NULL,
  `sanpham_id` int(11) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `soluongdaytrenthung` int(11) DEFAULT NULL,
  `dongia` bigint(20) DEFAULT NULL,
  `thanhtien` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `phanphoisanpham`
--

INSERT INTO `phanphoisanpham` (`id`, `xuatkho_id`, `sanpham_id`, `soluong`, `soluongdaytrenthung`, `dongia`, `thanhtien`, `created_at`, `updated_at`) VALUES
(6, 6, 1, 10, 1, 100000, 1000000, '2017-05-13 07:46:26', '2017-05-13 07:46:26'),
(7, 6, 2, 10, 1, 100000, 1000000, '2017-05-13 07:46:27', '2017-05-13 07:46:27'),
(12, 11, 1, 10, 10, 10000, 1000000, '2017-05-30 09:46:16', '2017-05-30 09:46:16'),
(13, 12, 2, 1, 10, 10, 100, '2017-05-31 07:17:36', '2017-05-31 07:17:36'),
(14, 13, 1, 1, 100, 10000, 1000000, '2017-05-31 07:21:30', '2017-05-31 07:21:30'),
(15, 14, 1, 1, 10, 1000000, 10000000, '2017-05-31 07:24:07', '2017-05-31 07:24:07'),
(16, 15, 1, 1, 100, 1000000, 100000000, '2017-05-31 07:24:50', '2017-05-31 07:24:50'),
(17, 16, 1, 1, 100, 1000000, 100000000, '2017-05-31 07:25:28', '2017-05-31 07:25:28');

-- --------------------------------------------------------

--
-- Structure de la table `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `loaisanpham_id` int(11) DEFAULT NULL,
  `tensanpham` varchar(255) DEFAULT NULL,
  `giasanpham` bigint(20) DEFAULT NULL,
  `khoiluong` float DEFAULT NULL,
  `soluong` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `sanpham`
--

INSERT INTO `sanpham` (`id`, `loaisanpham_id`, `tensanpham`, `giasanpham`, `khoiluong`, `soluong`, `created_at`, `updated_at`) VALUES
(1, 2, 'Sản phẩm Uni', 100000, 0.5, 10006, '2017-05-10 04:44:08', '2017-05-31 07:25:29'),
(2, 2, 'Sản phẩm Ngọc Lan', 100000, 0.58, 18, '2017-05-10 05:59:56', '2017-05-31 07:17:36'),
(3, 1, 'Sản phẩm mỹ lan', 100000, 0, 10, '2017-05-15 14:26:16', '2017-05-15 14:26:16'),
(4, 2, 'Sản phẩm ngọc lan xanh', 100000, 0, 10, '2017-05-15 14:26:46', '2017-05-15 14:26:46'),
(5, 2, 'Sản phẩm ngọc lan tím', 100000, 0, 10, '2017-05-15 14:26:59', '2017-05-15 14:26:59'),
(6, 2, 'Sản phẩm Susu', 10000, 0, 10, '2017-05-15 14:27:14', '2017-05-30 05:48:24'),
(7, 2, 'Sản phẩm lola', 100000, 0, 10, '2017-05-15 14:27:23', '2017-05-15 14:27:23');

-- --------------------------------------------------------

--
-- Structure de la table `sanxuatnapkin`
--

CREATE TABLE `sanxuatnapkin` (
  `id` int(11) NOT NULL,
  `nguyenlieu_id` int(11) NOT NULL DEFAULT '0',
  `nhanvien_id` int(11) NOT NULL DEFAULT '0',
  `sanpham_id` int(11) NOT NULL DEFAULT '0',
  `buoithuchien` char(1) NOT NULL DEFAULT '0',
  `soluongto` int(11) NOT NULL DEFAULT '0',
  `soluongtrenmaydem` int(11) NOT NULL DEFAULT '0',
  `soluongthanhpham` int(11) NOT NULL DEFAULT '0',
  `soluongthuctethung` int(11) NOT NULL DEFAULT '0',
  `soluongthuctegoi` int(11) NOT NULL DEFAULT '0' COMMENT 'congvao sanpham',
  `sokg` float NOT NULL DEFAULT '0' COMMENT 'trừ bên nl soluongthuctegoi*trongluong',
  `trongluong` float DEFAULT '0',
  `ngaysanxuat` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `sanxuatnapkin`
--

INSERT INTO `sanxuatnapkin` (`id`, `nguyenlieu_id`, `nhanvien_id`, `sanpham_id`, `buoithuchien`, `soluongto`, `soluongtrenmaydem`, `soluongthanhpham`, `soluongthuctethung`, `soluongthuctegoi`, `sokg`, `trongluong`, `ngaysanxuat`, `created_at`, `updated_at`) VALUES
(7, 5, 1, 1, '1', 10, 10, 20, 10, 10, 5.8, 0, '2017-05-16 20:49:10', '2017-05-16 13:49:10', '2017-05-16 13:49:10'),
(8, 1, 1, 2, '1', 10, 10, 20, 10, 10, 5.8, 0, '2017-05-29 18:44:26', '2017-05-29 11:44:26', '2017-05-29 11:44:26'),
(9, 1, 1, 2, '1', 10, 10, 10, 10, 10, 0.1, 10, '2017-05-30 00:00:00', '2017-05-30 08:23:35', '2017-05-30 08:23:35'),
(10, 1, 2, 2, '1', 10, 10, 10, 10, 10, 0.1, 10, '2017-05-30 00:00:00', '2017-05-30 08:23:35', '2017-05-30 08:23:35'),
(11, 1, 1, 1, '1', 10, 10, 10, 10, 10, 0.1, 10, '2017-05-30 00:00:00', '2017-05-30 08:36:59', '2017-05-30 08:36:59');

-- --------------------------------------------------------

--
-- Structure de la table `sanxuatwallet`
--

CREATE TABLE `sanxuatwallet` (
  `id` int(11) NOT NULL,
  `nguyenlieu_id` int(11) NOT NULL DEFAULT '0',
  `nhanvien_id` int(11) NOT NULL DEFAULT '0',
  `sanpham_id` int(11) NOT NULL DEFAULT '0',
  `sodaysanxuat` int(11) NOT NULL DEFAULT '0',
  `sokg` float NOT NULL DEFAULT '0' COMMENT 'Trừ số lượng NL',
  `sogoisanxuatduoc` int(11) NOT NULL DEFAULT '0' COMMENT 'Cộng số lượng sản phẩm',
  `ngaysanxuat` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `sanxuatwallet`
--

INSERT INTO `sanxuatwallet` (`id`, `nguyenlieu_id`, `nhanvien_id`, `sanpham_id`, `sodaysanxuat`, `sokg`, `sogoisanxuatduoc`, `ngaysanxuat`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 0.01, 0, '2017-05-14 12:17:24', '2017-05-14 05:17:25', '2017-05-14 05:17:26'),
(2, 1, 1, 2, 10, 0.01, 0, '2017-05-14 15:04:38', '2017-05-14 08:04:38', '2017-05-14 08:04:38'),
(3, 1, 1, 3, 10, 0.01, 0, '2017-05-14 15:05:00', '2017-05-14 08:05:00', '2017-05-14 08:05:00'),
(4, 1, 1, 4, 10, 0.01, 0, '2017-05-29 15:50:01', '2017-05-29 08:50:01', '2017-05-29 08:50:01'),
(5, 1, 1, 5, 10, 0.01, 0, '2017-05-29 15:51:37', '2017-05-29 08:51:37', '2017-05-29 08:51:37'),
(6, 1, 1, 5, 10, 1, 0, '2017-05-29 15:53:46', '2017-05-29 08:53:46', '2017-05-29 08:53:46'),
(7, 1, 2, 6, 10, 0.01, 1, '2017-05-29 15:54:50', '2017-05-29 08:54:50', '2017-05-29 08:54:50'),
(8, 2, 2, 1, 10000, 0.7, 10000, '2017-05-30 16:04:32', '2017-05-30 09:04:32', '2017-05-30 09:04:32'),
(9, 4, 1, 1, 10, 10, 10000, '2017-05-30 16:05:49', '2017-05-30 09:05:49', '2017-05-30 09:05:49'),
(10, 4, 2, 1, 10, 10, 10000, '2017-05-30 16:05:49', '2017-05-30 09:05:49', '2017-05-30 09:05:49');

-- --------------------------------------------------------

--
-- Structure de la table `xuatkho`
--

CREATE TABLE `xuatkho` (
  `id` int(11) NOT NULL,
  `nhaphanphoi_id` int(11) DEFAULT NULL,
  `maxuatkho` varchar(255) DEFAULT NULL,
  `tongtien` bigint(20) DEFAULT NULL,
  `sotientratruoc` bigint(20) DEFAULT NULL,
  `ghichu` text,
  `ngayxuatkho` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `xuatkho`
--

INSERT INTO `xuatkho` (`id`, `nhaphanphoi_id`, `maxuatkho`, `tongtien`, `sotientratruoc`, `ghichu`, `ngayxuatkho`, `created_at`, `updated_at`) VALUES
(6, 1, '1494661563', 2000000, 2000000, 'Ghi chú xuất kho cho nhà phân phối', '2017-05-13 14:46:26', '2017-05-13 07:46:26', '2017-05-31 10:12:01'),
(7, 1, '1496048884', 2000000, 2000000, '', '2017-05-29 16:26:21', '2017-05-29 09:26:21', '2017-05-29 09:26:21'),
(11, 1, '1496137525', 1000000, 1000000, '', '2017-05-30 16:46:16', '2017-05-30 09:46:16', '2017-05-30 09:46:17'),
(12, 1, '1496214772', 100, 100, '', '2017-05-31 14:17:36', '2017-05-31 07:17:36', '2017-05-31 07:17:37'),
(13, 1, '1496215278', 1000000, 1000000, '', '2017-05-31 14:21:30', '2017-05-31 07:21:30', '2017-05-31 10:15:55'),
(14, 1, '1496215435', 10000000, 10000000, '', '2017-05-31 14:24:07', '2017-05-31 07:24:07', '2017-05-31 07:24:07'),
(15, 1, '1496215477', 100000000, 100000000, '', '2017-05-31 14:24:50', '2017-05-31 07:24:50', '2017-05-31 13:40:23'),
(16, 1, '1496215478', 100000000, 100000000, '', '2017-05-31 14:25:28', '2017-05-31 07:25:28', '2017-05-31 13:40:00');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `chitietnhapkho`
--
ALTER TABLE `chitietnhapkho`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lichsucongno`
--
ALTER TABLE `lichsucongno`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nguyenlieu`
--
ALTER TABLE `nguyenlieu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nhanviensanxuat`
--
ALTER TABLE `nhanviensanxuat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nhaphanphoi`
--
ALTER TABLE `nhaphanphoi`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nhapkho`
--
ALTER TABLE `nhapkho`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `phanphoisanpham`
--
ALTER TABLE `phanphoisanpham`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sanxuatnapkin`
--
ALTER TABLE `sanxuatnapkin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sanxuatwallet`
--
ALTER TABLE `sanxuatwallet`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `xuatkho`
--
ALTER TABLE `xuatkho`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `chitietnhapkho`
--
ALTER TABLE `chitietnhapkho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `lichsucongno`
--
ALTER TABLE `lichsucongno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `nguyenlieu`
--
ALTER TABLE `nguyenlieu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `nhanviensanxuat`
--
ALTER TABLE `nhanviensanxuat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `nhaphanphoi`
--
ALTER TABLE `nhaphanphoi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `nhapkho`
--
ALTER TABLE `nhapkho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `phanphoisanpham`
--
ALTER TABLE `phanphoisanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `sanxuatnapkin`
--
ALTER TABLE `sanxuatnapkin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `sanxuatwallet`
--
ALTER TABLE `sanxuatwallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `xuatkho`
--
ALTER TABLE `xuatkho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
