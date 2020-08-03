-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 03 Agu 2020 pada 16.37
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_gua`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `id_trans` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`id`, `id_trans`, `id_product`, `product_name`, `quantity`, `price`) VALUES
(25, 39, 2, 'Daging Sapi', 1, 120000),
(26, 39, 1, 'Beras', 1, 8000),
(27, 39, 3, 'Daging Ayam', 1, 80000),
(28, 40, 2, 'Daging Sapi', 1, 120000),
(29, 40, 5, 'Gula', 1, 15000),
(30, 40, 7, 'Mie', 1, 80000),
(31, 41, 1, 'Beras', 2, 8000),
(32, 41, 7, 'Mie', 2, 80000),
(33, 41, 8, 'Minyak', 2, 15000),
(34, 41, 3, 'Daging Ayam', 2, 80000),
(35, 42, 2, 'Daging Sapi', 2, 120000),
(36, 42, 3, 'Daging Ayam', 1, 80000),
(37, 43, 2, 'Daging Sapi', 1, 120000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `description` varchar(128) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `measure` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `description`, `price`, `quantity`, `measure`) VALUES
(1, 'Beras', 'beras.png', 'Beras /Liter', 8000, 100, 'Lt'),
(2, 'Daging Sapi', 'sapi.jpg', 'Daging sapi lokal /Kg', 120000, 100, 'Kg'),
(3, 'Daging Ayam', 'ayam.jpg', 'Daging ayam lokal /Kg', 80000, 100, 'Kg'),
(4, 'Garam', 'garam.jpeg', 'Garam dapur Dolpin beryodium /pcs 500g', 3000, 100, 'pcs'),
(5, 'Gula', 'gula.jpg', 'Gulaku /Kg', 15000, 100, 'Kg'),
(6, 'Jagung', 'jagung.png', 'Jagung /Kg', 15000, 100, 'Kg'),
(7, 'Mie', 'mie.jpg', 'Indomie goreng, 85gram /Dus isi 40pcs', 80000, 100, 'Dus'),
(8, 'Minyak', 'minyak.png', 'Minyak goreng lokal /Liter', 15000, 100, 'Lt'),
(9, 'Susu', 'susu.jpg', 'Susu Ultra UHT /Liter 1000ml', 18000, 100, 'Lt'),
(10, 'Telur', 'telur.jpg', 'Telur ayam /Kg', 22000, 100, 'Kg'),
(11, 'Sosis', 'sosis.png', 'Sosis /pcs 500g', 20000, 100, 'pcs');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `name` varchar(129) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(128) NOT NULL,
  `date_order` datetime NOT NULL,
  `payment_deadline` datetime NOT NULL,
  `payment_method` varchar(128) NOT NULL,
  `total` decimal(10,3) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `name`, `email`, `phone`, `address`, `date_order`, `payment_deadline`, `payment_method`, `total`, `status`) VALUES
(39, 'Ujang', 'ujang@gmail.com', '08982342', 'Ciomas', '2020-07-04 11:58:03', '2020-07-05 11:58:03', 'BCA', '208.000', 1),
(40, 'Ujang', 'ujang@gmail.com', '12321', 'asdasd', '2020-07-04 12:10:47', '2020-07-05 12:10:47', 'BCA', '215.000', 1),
(41, 'Kabayan', 'kabayan@gmail.com', '1123123', 'asdasdasd', '2020-07-04 14:15:10', '2020-07-05 14:15:10', 'BCA', '366.000', 1),
(42, 'Rizki', 'rizkihutama@gmail.com', '089812345', 'Cilendek', '2020-07-07 23:43:35', '2020-07-08 23:43:35', 'BCA', '320.000', 1),
(43, 'Hilda', 'hilda@gmail.com', '123456', 'Ciomas', '2020-07-10 14:48:56', '2020-07-11 14:48:56', 'BCA', '120.000', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Cepot', 'cepot@gmail.com', 'abdur.png', '$2y$10$wSWkYGpPLaa0RJwE8.GFAOdsMgSfOiBir7PHdUOR2/TRLB1sU7K6q', 1, 1, 1589295172),
(4, 'Ujang', 'ujang@gmail.com', 'toto.png', '$2y$10$zV5Cd9Wsh7/rDb2hks6bHufoJubgVtRKx057k0XoqXTikmrzPK4Ha', 2, 1, 1591186925),
(5, 'Kabayan', 'kabayan@gmail.com', 'default.png', '$2y$10$GXzM9RGvhvyMKn.g/5nVKuy/0I9Zzfo7QTtnZSI9voLYGaAIEEirq', 2, 1, 1593846787),
(6, 'Rizki', 'rizkihutama@gmail.com', 'default.png', '$2y$10$I2sckYS0HKw30/pCJMS.Oe03Uqo0PqkgnpsxTPBhkXldph6tO4sta', 2, 1, 1594139990),
(7, 'Hilda', 'hilda@gmail.com', 'default.png', '$2y$10$eu.tiNu.uYsLg2Jh8dxQi.1yAKTzIC1/ERc0YBZW.aur.k9VGKpli', 2, 1, 1594366542);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', '1'),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', '1'),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', '1'),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', '1'),
(5, 3, 'Submenu Management', 'menu/subMenu', 'far fa-fw fa-folder', '1'),
(19, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
