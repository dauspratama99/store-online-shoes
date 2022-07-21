-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2021 at 03:41 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `busana`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_barang` char(5) NOT NULL,
  `nm_barang` varchar(100) NOT NULL,
  `harga_modal` int(12) NOT NULL,
  `harga_jual` int(12) NOT NULL,
  `stok` int(4) NOT NULL,
  `keterangan` text NOT NULL,
  `file_gambar` varchar(100) NOT NULL,
  `kd_kategori` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nm_barang`, `harga_modal`, `harga_jual`, `stok`, `keterangan`, `file_gambar`, `kd_kategori`) VALUES
('B0010', 'Sepatu 10', 140000, 160000, 7, '<p>kualitas ok</p>', '33319010.png', 'K001'),
('B0011', 'Sepatu 01', 100000, 140000, 7, '<ul>\r\n<li>kualitas ok</li>\r\n<li>harga bersahabat</li>\r\n<li>bahan tahan</li>\r\n<li>trendi</li>\r\n</ul>', '17227111.png', 'K001'),
('B0012', 'Baju01', 50000, 70000, 34, '<ul>\r\n<li style="text-align: left;">kualitas ok</li>\r\n<li style="text-align: left;">design menarik</li>\r\n<li style="text-align: left;">bahan adem tidak panas</li>\r\n<li style="text-align: left;">tidak cepat pudar</li>\r\n</ul>', '308441B0021.kameja5.jpg', 'K002'),
('B0013', 'Baju02', 100000, 120000, 32, '<p>baju kualitas OK</p>', '281646B0019.kameja3.jpg', 'K002'),
('B0014', 'Sepatu 12', 100000, 130000, 30, '<ul>\r\n<li>kualitas ok</li>\r\n<li>bahan tahan lama</li>\r\n</ul>', '90487613.png', 'K001');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kd_kategori` char(4) NOT NULL,
  `nm_kategori` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kd_kategori`, `nm_kategori`) VALUES
('K001', 'Sepatu'),
('K002', 'Baju Wanita');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `id` int(4) NOT NULL,
  `no_pemesanan` varchar(8) NOT NULL,
  `nm_pelanggan` varchar(100) NOT NULL,
  `jumlah_transfer` int(12) NOT NULL,
  `file_gambar` text NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfirmasi`
--

INSERT INTO `konfirmasi` (`id`, `no_pemesanan`, `nm_pelanggan`, `jumlah_transfer`, `file_gambar`, `keterangan`, `tanggal`) VALUES
(93, 'PS000002', 'ajo', 120000, '281646B0019.kameja3.jpg', 'atas nama ajo membeli baju kemeja blouse warna pink', '2021-02-11'),
(92, 'PS000001', 'admin', 100000, 'WhatsApp-Image-2021-01-31-at-16.15.55.jpeg', 'sudah', '2021-02-10'),
(94, 'PS000003', 'admin', 130000, 'RE4wB5l.jpg', 'atas nama faiz', '2021-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `kd_pelanggan` char(6) NOT NULL,
  `nm_pelanggan` varchar(100) NOT NULL,
  `kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`kd_pelanggan`, `nm_pelanggan`, `kelamin`, `email`, `no_telepon`, `username`, `password`, `tgl_daftar`) VALUES
('P00004', 'admin', 'Laki-laki', 'admin@official.com', '088765432', 'admin@official.com', '21232f297a57a5a743894a0e4a801fc3', '2021-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `no_pemesanan` char(8) NOT NULL,
  `kd_pelanggan` char(6) NOT NULL,
  `tgl_pemesanan` date NOT NULL DEFAULT '0000-00-00',
  `nama_penerima` varchar(60) NOT NULL,
  `alamat_lengkap` varchar(200) NOT NULL,
  `kd_provinsi` char(3) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `kode_pos` varchar(6) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `status_bayar` enum('Pesan','Lunas','Batal') NOT NULL DEFAULT 'Pesan'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`no_pemesanan`, `kd_pelanggan`, `tgl_pemesanan`, `nama_penerima`, `alamat_lengkap`, `kd_provinsi`, `kota`, `kode_pos`, `no_telepon`, `status_bayar`) VALUES
('PS000003', 'P00004', '2021-02-11', 'fais', 'padang', 'P31', 'padang', '25662', '086543', 'Pesan'),
('PS000002', 'P00004', '2021-02-11', 'ajo', 'siteba', 'P31', 'padang', '25662', '086543', 'Lunas'),
('PS000001', 'P00004', '2021-02-10', 'admin', 'jl. myamin', 'P31', 'padang', '25662', '086543', 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_item`
--

CREATE TABLE `pemesanan_item` (
  `id` int(4) NOT NULL,
  `no_pemesanan` char(8) NOT NULL,
  `kd_barang` char(5) NOT NULL,
  `harga` int(12) NOT NULL,
  `jumlah` int(3) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan_item`
--

INSERT INTO `pemesanan_item` (`id`, `no_pemesanan`, `kd_barang`, `harga`, `jumlah`) VALUES
(53, 'PS000003', 'B0014', 130000, 1),
(52, 'PS000002', 'B0012', 70000, 1),
(51, 'PS000001', 'B0001', 100000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `kd_provinsi` char(3) NOT NULL,
  `nm_provinsi` varchar(100) NOT NULL,
  `biaya_kirim` int(12) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`kd_provinsi`, `nm_provinsi`, `biaya_kirim`) VALUES
('P01', 'Jawa Tengah', 15000),
('P02', 'Jawa Barat', 10000),
('P03', 'Jawa Timur', 15000),
('P04', 'DKI Jakarta', 15000),
('P05', 'Yogyakarta, D.I', 30000),
('P06', 'Bali', 20000),
('P07', 'Bengkulu', 20000),
('P08', 'Banten', 20000),
('P09', 'Gorontalo', 35000),
('P10', 'Irian Jaya Barat', 35000),
('P11', 'Jambi', 25000),
('P12', 'Kalimantan Barat', 30000),
('P13', 'Kalimantan Tengah', 30000),
('P14', 'Kalimantan Timur', 30000),
('P15', 'Kalimantan Selatan', 30000),
('P16', 'Kepulauan Bangka Belitung', 30000),
('P17', 'Lampung', 20000),
('P18', 'Maluku', 25000),
('P19', 'Maluku Utara', 25000),
('P20', 'Aceh, D.I', 30000),
('P21', 'Nusa Tenggara Barat', 25000),
('P22', 'Nusa Tenggara Timur', 25000),
('P23', 'Papua', 35000),
('P24', 'Riau', 25000),
('P25', 'Kepulauan Riau', 25000),
('P26', 'Sulawesi Barat', 25000),
('P27', 'Sulawesi Tengah', 25000),
('P28', 'Sulawesi Tenggara', 25000),
('P29', 'Sulawesi Selatan', 25000),
('P30', 'Sulawesi Utara', 25000),
('P31', 'Sumatera Barat', 0),
('P32', 'Sumatera Selatan', 35000);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_keranjang`
--

CREATE TABLE `tmp_keranjang` (
  `id` int(5) NOT NULL,
  `kd_barang` char(5) NOT NULL,
  `harga` int(12) NOT NULL,
  `jumlah` int(3) NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL DEFAULT '0000-00-00',
  `kd_pelanggan` char(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kd_kategori`);

--
-- Indexes for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`kd_pelanggan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`no_pemesanan`);

--
-- Indexes for table `pemesanan_item`
--
ALTER TABLE `pemesanan_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`kd_provinsi`);

--
-- Indexes for table `tmp_keranjang`
--
ALTER TABLE `tmp_keranjang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `pemesanan_item`
--
ALTER TABLE `pemesanan_item`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `tmp_keranjang`
--
ALTER TABLE `tmp_keranjang`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
