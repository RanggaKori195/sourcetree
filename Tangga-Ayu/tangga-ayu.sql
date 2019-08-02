-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2019 at 11:36 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tangga-ayu`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id_brand` int(11) NOT NULL,
  `nama_brand` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id_brand`, `nama_brand`) VALUES
(1, 'WARDAH'),
(2, 'REVLON'),
(7, 'MAYBELLINE'),
(8, 'ETERNALLY');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_transaksi` varchar(15) NOT NULL,
  `id_kosmetik` varchar(6) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_transaksi`, `id_kosmetik`, `qty`, `sub_total`) VALUES
('TR-0430-0000001', 'PR0001', 2, 100000),
('TR-0430-0000001', 'PR0002', 3, 150000),
('TR-0430-0000001', 'PR0003', 4, 200000),
('TR-0430-0000002', 'PR0005', 1, 50000),
('TR-0430-0000002', 'PR0014', 3, 150000),
('TR-0430-0000003', 'PR0017', 1, 50000),
('TR-0430-0000003', 'PR0029', 1, 50000),
('TR-0501-0000004', 'PR0010', 2, 100000),
('TR-0501-0000004', 'PR0002', 3, 150000),
('TR-0501-0000005', 'PR0006', 5, 250000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'LIPSTICK'),
(3, 'BEDAK'),
(4, 'SABUN MUKA'),
(5, 'SABUN BADAN'),
(6, 'PARFUM');

-- --------------------------------------------------------

--
-- Table structure for table `kosmetik`
--

CREATE TABLE `kosmetik` (
  `id_kosmetik` varchar(6) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_brand` int(11) DEFAULT NULL,
  `nama_kosmetik` varchar(50) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `harga_kosmetik` double NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kosmetik`
--

INSERT INTO `kosmetik` (`id_kosmetik`, `id_kategori`, `id_brand`, `nama_kosmetik`, `satuan`, `harga_kosmetik`, `stok`) VALUES
('PR0001', 2, 1, 'ACNE DERM ACNE SPOT TREATMENT GEL  ', 'Pcs', 50000, 50),
('PR0002', 2, 1, 'ACNE DAY MOISTURIZER ', 'Pcs', 50000, 47),
('PR0003', 2, 1, 'ACNE FACE POWDER ', 'Pcs', 50000, 50),
('PR0004', 2, 1, 'MORNING ESSENTIALS BODY MOIST ', 'Pcs', 50000, 50),
('PR0005', 2, 1, 'C-DEFENCE SERUM', 'Pcs', 50000, 50),
('PR0006', 2, 1, 'C-DEFENCE CREAM LIGHT ', 'Pcs', 50000, 45),
('PR0007', 2, 1, 'PERFECT BRIGHT MOISTURIZER NORMAL SKIN ', 'Pcs', 50000, 50),
('PR0008', 2, 1, 'PERFECT BRIGHT MOISTURIZER SPF 28 ', 'Pcs', 50000, 50),
('PR0009', 2, 1, 'PERFECT BRIGHT TONE ', 'Pcs', 50000, 50),
('PR0010', 2, 1, 'LIGHTENING BB CREAM LIGHT ', 'Pcs', 50000, 48),
('PR0011', 2, 1, 'LIGHTENING BB CREAM NATURAL', 'Pcs', 50000, 50),
('PR0012', 2, 1, 'LIGHTENING FACE TONE', 'Pcs', 50000, 50),
('PR0013', 2, 1, 'LIGHTENING MILK CLEANSER ', 'Pcs', 50000, 50),
('PR0014', 2, 1, 'LIGHTENING NIGHT CREAM', 'Pcs', 50000, 50),
('PR0015', 2, 1, 'LIGHTENING DAY CREAM', 'Pcs', 50000, 50),
('PR0016', 2, 1, 'NATURE DAILY ALOE HYDRAMILD FACIAL WASH', 'Pcs', 50000, 50),
('PR0017', 2, 1, 'NATURE DAILY ALOE HYDRAMILD MOITURIZER CREAM', 'Pcs', 50000, 50),
('PR0018', 2, 1, 'SUNSCREEN GEL SPF 30 ', 'Pcs', 50000, 50),
('PR0019', 2, 1, 'WARDAH NUTRI SHINE CONDITIONER ', 'Pcs', 50000, 50),
('PR0020', 2, 1, 'DAILY FRESH SHAMPOO', 'Pcs', 50000, 50),
('PR0021', 2, 1, 'ANTI DANDRUFF SHAMPOO', 'Pcs', 50000, 50),
('PR0022', 2, 1, 'NUTRI SHINE SHAMPOO', 'Pcs', 50000, 50),
('PR0023', 2, 1, 'JOYFULL BODY MIST ', 'Pcs', 50000, 50),
('PR0024', 2, 1, 'PASSION BODY MIST', 'Pcs', 50000, 50),
('PR0025', 2, 1, 'PURIFY BODY MIST', 'Pcs', 50000, 50),
('PR0026', 2, 1, 'BODY BUTTER LAVENDER AND GINGER ', 'Pcs', 50000, 50),
('PR0027', 2, 1, 'BODY BUTTER OLIVE  ', 'Pcs', 50000, 50),
('PR0028', 2, 1, 'BODY BUTTER ROSE ', 'Pcs', 50000, 50),
('PR0029', 2, 1, 'SOFT SCRUB OLIVE ', 'Pcs', 50000, 50),
('PR0030', 2, 1, 'SOFT SCRUB STRAWBERRY', 'Pcs', 50000, 50),
('PR0031', 2, 1, 'RENEW YOU ANTI AGING DAY CREAM', 'Pcs', 50000, 50),
('PR0032', 2, 1, 'RENEW YOU ANTI AGING NIGHT CREAM', 'Pcs', 50000, 50),
('PR0033', 2, 1, 'RENEW YOU ANTI AGING EYE CREAM', 'Pcs', 50000, 50),
('PR0034', 2, 1, 'WHITE SECRET DAY CREAM', 'Pcs', 50000, 50),
('PR0035', 2, 1, 'WHITE SECRET NIGHT CREAM ', 'Pcs', 50000, 50),
('PR0036', 2, 1, 'WHITE SECRET BRIGHTENING EYE CREAM ', 'Pcs', 50000, 50),
('PR0037', 2, 1, 'BLUSH ON ', 'Pcs', 50000, 50),
('PR0038', 2, 1, 'EYE BROW ', 'Pcs', 50000, 50),
('PR0039', 2, 1, 'EYE SHADOW', 'Pcs', 50000, 50),
('PR0040', 2, 1, 'EYEXPERT AQUA LASH MASCARA', 'Pcs', 50000, 50),
('PR0041', 2, 1, 'NUDE COLOR EYESHADOW CLASSIC', 'Pcs', 50000, 50),
('PR0042', 2, 1, 'EVERYDAY BB CREAM LIGHT ', 'Pcs', 50000, 50),
('PR0043', 2, 1, 'EXCLUSIVE LIPSTICK ', 'Pcs', 50000, 50),
('PR0044', 2, 1, 'EXCLUSIVE MATTE LIPCREAM', 'Pcs', 50000, 50),
('PR0045', 2, 1, 'INTENSE MATTE LIPSTICK ', 'Pcs', 50000, 50),
('PR0046', 2, 1, 'LONG LASTING LIPSTICK ', 'Pcs', 50000, 50),
('PR0047', 2, 1, 'MATTE LIPSTICK ', 'Pcs', 50000, 50),
('PR0048', 2, 2, 'SKIN RESCHEDULING NIGHT CREAM ', 'Pcs', 50000, 50),
('PR0049', 2, 2, 'CLEANSING LOTION', 'Pcs', 50000, 50),
('PR0050', 2, 2, 'MILKY TONER', 'Pcs', 50000, 50),
('PR0051', 2, 2, 'FOAMING CLEANSER', 'Pcs', 50000, 50),
('PR0052', 2, 2, 'SUNBLOCK FACE CREAM', 'Pcs', 50000, 50),
('PR0053', 2, 2, 'BALANCING SOFTENER ', 'Pcs', 50000, 50),
('PR0054', 2, 2, 'PURIFYING CLEANSER ', 'Pcs', 50000, 50),
('PR0055', 2, 2, 'FRESH MOISTURIZING ', 'Pcs', 50000, 50),
('PR0056', 2, 2, 'TIME LESS PINK ', 'Pcs', 50000, 50),
('PR0057', 2, 2, 'RED PAGODA', 'Pcs', 50000, 50),
('PR0058', 2, 2, 'HONEY BEE PINK ', 'Pcs', 50000, 50),
('PR0059', 2, 2, 'BEACH SILK', 'Pcs', 50000, 50),
('PR0060', 2, 2, 'MAROONED', 'Pcs', 50000, 50),
('PR0061', 2, 2, 'ORANGE FLIP', 'Pcs', 50000, 50),
('PR0062', 2, 2, 'PINK ', 'Pcs', 50000, 50),
('PR0063', 2, 2, 'LIP CONDITIONER ', 'Pcs', 50000, 50),
('PR0064', 2, 2, 'REALLY RED', 'Pcs', 50000, 50),
('PR0065', 2, 2, 'RETRO RED', 'Pcs', 50000, 50),
('PR0066', 2, 2, 'PARADISE PINK', 'Pcs', 50000, 50),
('PR0067', 2, 2, 'NUDE HONEY', 'Pcs', 50000, 50),
('PR0068', 2, 2, 'ALMOND SUEDE', 'Pcs', 50000, 50),
('PR0069', 2, 2, 'FANCY ROSE', 'Pcs', 50000, 50),
('PR0070', 2, 2, 'NAUGHTY MAUVE ', 'Pcs', 50000, 50),
('PR0071', 2, 2, 'BERRY LIT', 'Pcs', 50000, 50),
('PR0072', 2, 2, 'CRIMSON  FEELS', 'Pcs', 50000, 50),
('PR0073', 2, 2, 'EXTRA VIOLET ', 'Pcs', 50000, 50),
('PR0074', 2, 2, 'COLORSTAY LINER', 'Pcs', 50000, 50),
('PR0075', 2, 2, 'COLORSTAY LIQUID LINER ', 'Pcs', 50000, 50),
('PR0076', 2, 2, 'COLORSTAY MOISTURE STAIN  ', 'Pcs', 50000, 50),
('PR0077', 2, 2, 'COLORSTAY 16 HOUR EYESADOW', 'Pcs', 50000, 50),
('PR0078', 2, 2, 'COLORSTAY LIQUID EYE PEN', 'Pcs', 50000, 50),
('PR0079', 2, 2, 'COLORSTAY CONCEALER', 'Pcs', 50000, 50),
('PR0080', 2, 2, 'COLORSTAY TOTAL COVER FOUNDATION', 'Pcs', 50000, 50),
('PR0081', 2, 2, 'REVLON COLORSILK HAIR COLOR ', 'Pcs', 50000, 50),
('PR0082', 2, 7, 'MYB MASCARA VOLUME EXPRESS', 'Pcs', 50000, 50),
('PR0083', 2, 7, 'MYB REMOVER', 'Pcs', 50000, 50),
('PR0084', 2, 7, 'MYB POWDER', 'Pcs', 50000, 50),
('PR0085', 2, 7, 'MYB MASTER EYELINER BLACK', 'Pcs', 50000, 50),
('PR0086', 2, 7, 'MYB LIPSTICK COLOR SENSATIONAL ', 'Pcs', 50000, 50),
('PR0087', 2, 7, 'MYB HYPERSHARP LINER ', 'Pcs', 50000, 50),
('PR0088', 2, 7, 'MYB SUPERSTAY MATTE INK ', 'Pcs', 50000, 50),
('PR0089', 2, 7, 'MYB SHADOW ', 'Pcs', 50000, 50),
('PR0090', 2, 7, 'MYB WHITE SUPERFRESH ', 'Pcs', 50000, 50),
('PR0091', 2, 7, 'MYB LIPBALM ', 'Pcs', 50000, 50),
('PR0092', 2, 7, 'MYB BLUSH COLOR SHOW', 'Pcs', 50000, 50),
('PR0093', 2, 7, 'MYB BB CUSHION', 'Pcs', 50000, 50),
('PR0094', 2, 7, 'MYB FIT ME PORE', 'Pcs', 50000, 50),
('PR0095', 2, 7, 'MYB FIT ME DEWY', 'Pcs', 50000, 50),
('PR0096', 2, 7, 'MYB FIT ME CONCEALER ', 'Pcs', 50000, 50),
('PR0097', 2, 7, 'MYB FACE STUDIO SHAPE POWDER', 'Pcs', 50000, 50),
('PR0098', 2, 7, 'MYB EYEBROW PALLETE', 'Pcs', 50000, 50),
('PR0099', 2, 7, 'MYB MICELLAR WATER', 'Pcs', 50000, 50),
('PR0100', 2, 7, 'MYB FASHION BROW POMADE CRAYON ', 'Pcs', 50000, 50),
('PR0101', 2, 7, 'MYB BB CREAM ', 'Pcs', 50000, 50),
('PR0102', 2, 7, 'MYB CONCEALER FACE STROBING ', 'Pcs', 50000, 50),
('PR0103', 2, 8, 'ETN MASCARA ULTRA WATERPROFF', 'Pcs', 50000, 50),
('PR0104', 2, 8, 'ETN SILK EYE LINER PENCIL', 'Pcs', 50000, 50),
('PR0105', 2, 8, 'ETN EYE BROW PENCIL ', 'Pcs', 50000, 50),
('PR0106', 2, 8, 'ETN LIQUID EYE LINER PEN ', 'Pcs', 50000, 50),
('PR0107', 2, 8, 'ETN EYELINER LIQUID', 'Pcs', 50000, 50),
('PR0108', 2, 8, 'ETN HIGH COLOR EYELINER ', 'Pcs', 50000, 50),
('PR0109', 2, 8, 'ETN HIGH COLOR EYE SHADOW', 'Pcs', 50000, 50),
('PR0110', 2, 8, 'ETN MATTE LIP COLOR ', 'Pcs', 50000, 50),
('PR0111', 2, 8, 'ETN LIP SHINE ', 'Pcs', 50000, 50),
('PR0112', 2, 8, 'ETN LIP LINER PENCIL ', 'Pcs', 50000, 50),
('PR0113', 2, 8, 'ETN HIGH COLOR LIPSTICK ', 'Pcs', 50000, 50),
('PR0114', 2, 8, 'ETN HIGH COLOR ULTIMATTE LIPSTICK ', 'Pcs', 50000, 50),
('PR0115', 2, 8, 'ETN HIGH COLOR VELVET MATTE CREAM ', 'Pcs', 50000, 50),
('PR0116', 2, 8, 'ETN NAIL LACQEUR GLITTER ', 'Pcs', 50000, 50),
('PR0117', 2, 8, 'ETN REMOVER PRO VIT B5', 'Pcs', 50000, 50),
('PR0118', 2, 8, 'ETN CUTICLE REMOVER ', 'Pcs', 50000, 50),
('PR0119', 2, 8, 'ETN COAT NAIL POLISH ', 'Pcs', 50000, 50),
('PR0120', 2, 8, 'ETN SILKY MOIST ', 'Pcs', 50000, 50),
('PR0121', 2, 8, 'ETN FRAGRANCE BODY MIST ', 'Pcs', 50000, 50),
('PR0122', 2, 8, 'ETN FEMME ', 'Pcs', 50000, 50),
('PR0123', 2, 8, 'ETN GLAMMOUR ', 'Pcs', 50000, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_table`
--

CREATE TABLE `tmp_table` (
  `id_transaksi` varchar(15) NOT NULL,
  `id_kosmetik` varchar(6) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(15) NOT NULL,
  `id_user` varchar(6) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `grand_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `tgl_transaksi`, `grand_total`) VALUES
('TR-0430-0000001', 'USR-02', '2019-04-28', 450000),
('TR-0430-0000002', 'USR-02', '2019-04-29', 200000),
('TR-0430-0000003', 'USR-02', '2019-05-01', 100000),
('TR-0501-0000004', 'USR-02', '2019-05-01', 250000),
('TR-0501-0000005', 'USR-03', '2019-05-01', 250000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(6) NOT NULL,
  `username` varchar(8) NOT NULL,
  `password` text NOT NULL,
  `nama_user` varchar(20) NOT NULL,
  `tlp_user` varchar(15) NOT NULL,
  `alamat_user` text NOT NULL,
  `email_user` varchar(30) NOT NULL,
  `foto_user` varchar(11) NOT NULL,
  `level` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_user`, `tlp_user`, `alamat_user`, `email_user`, `foto_user`, `level`) VALUES
('USR-01', 'ta-owner', '7c222fb2927d828af22f592134e8932480637c0d', 'Taufik Kurahman', '081263209566', 'Perumnas III Arenjaya Bekasi Timur', 'mrtkurahman@gmail.com', 'USR-01.png', '1'),
('USR-02', 'USR-0204', '7c222fb2927d828af22f592134e8932480637c0d', 'Admin', '081212345678', 'alamat lengkap', 'mrtkurahman@gmail.com', '', '2'),
('USR-03', 'USR-0304', '7c222fb2927d828af22f592134e8932480637c0d', 'Kasir', '123', 'alamat', 'mrtkurahman@gmail.com', '', '3'),
('USR-04', 'USR-0405', '4708f2535284cf8204f62c9a9465c7325af48d5c', 'Rangga Kori L.', '081212345678', 'Slipi', 'korilesmana@gmail.com', '', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_brand`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_kosmetik` (`id_kosmetik`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kosmetik`
--
ALTER TABLE `kosmetik`
  ADD PRIMARY KEY (`id_kosmetik`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_brand` (`id_brand`);

--
-- Indexes for table `tmp_table`
--
ALTER TABLE `tmp_table`
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_kosmetik` (`id_kosmetik`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_kosmetik`) REFERENCES `kosmetik` (`id_kosmetik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kosmetik`
--
ALTER TABLE `kosmetik`
  ADD CONSTRAINT `kosmetik_ibfk_2` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id_brand`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `kosmetik_ibfk_3` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
