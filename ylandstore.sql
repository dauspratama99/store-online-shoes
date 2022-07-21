-- phpMyAdmin SQL Dump
-- version 3.1.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 20, 2022 at 07:56 PM
-- Server version: 5.1.35
-- PHP Version: 5.2.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `ylandstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'andi', 'ce0e5bf55e4f71749eade7a8b95c4e46');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `kd_barang` char(5) NOT NULL,
  `nm_barang` varchar(100) NOT NULL,
  `harga_modal` int(12) NOT NULL,
  `harga_jual` int(12) NOT NULL,
  `stok` int(4) NOT NULL,
  `keterangan` text NOT NULL,
  `file_gambar` varchar(100) NOT NULL,
  `kd_kategori` char(4) NOT NULL,
  PRIMARY KEY (`kd_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nm_barang`, `harga_modal`, `harga_jual`, `stok`, `keterangan`, `file_gambar`, `kd_kategori`) VALUES
('B0015', 'Sepatu Vans', 50000, 70000, 10, '<p>*Kualitas OK</p>\r\n<p>*Harga Bersahabat</p>\r\n<p>*Bahan Tahan</p>\r\n<p>*Trendi</p>', 'B0015.1658310017728.jpg', 'K001'),
('B0016', 'Sepatu Pria Sneaker ', 25000, 50000, 10, '<p>*Kualitas OK</p>\r\n<p>*Harga Bersahabat</p>\r\n<p>*Bahan Tahan</p>\r\n<p>*Trendi</p>', '7391961658310627790.jpg', 'K001'),
('B0018', 'Sepatu Pria Sneaker Import', 50000, 100000, 10, '<p>*Kualitas OK</p>\r\n<p>*Harga Bersahabat</p>\r\n<p>*Bahan Tahan</p>\r\n<p>*Trendi</p>\r\n<p>&nbsp;</p>', '6950371658310627836.jpg', 'K001'),
('B0019', 'Sepatu Pria Olahraga', 30000, 80000, 10, '<p>*Kualitas OK</p>\r\n<p>*Harga Bersahabat</p>\r\n<p>*Bahan Tahan</p>\r\n<p>*Trendi</p>\r\n<p>&nbsp;</p>', '1997371658310627856.jpg', 'K001'),
('B0020', 'Sepatu Sneaker', 50000, 90000, 10, '<p>*Kualitas OK</p>\r\n<p>*Harga Bersahabat</p>\r\n<p>*Bahan Tahan</p>\r\n<p>*Trendi</p>\r\n<p>&nbsp;</p>', 'B0020.1658310627816.jpg', 'K001');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `kd_kategori` char(4) NOT NULL,
  `nm_kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`kd_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kd_kategori`, `nm_kategori`) VALUES
('K001', 'Sepatu');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE IF NOT EXISTS `konfirmasi` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `no_pemesanan` varchar(8) NOT NULL,
  `nm_pelanggan` varchar(100) NOT NULL,
  `jumlah_transfer` int(12) NOT NULL,
  `file_gambar` text NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `konfirmasi`
--


-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `kd_pelanggan` char(6) NOT NULL,
  `nm_pelanggan` varchar(100) NOT NULL,
  `kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tgl_daftar` date NOT NULL,
  PRIMARY KEY (`kd_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`kd_pelanggan`, `nm_pelanggan`, `kelamin`, `email`, `no_telepon`, `username`, `password`, `tgl_daftar`) VALUES
('P00006', 'rapi', 'Laki-laki', 'Raoi@gmail.com', '1234567890', 'rapi', 'e31c5a0181a5e1fe184484d900cc7811', '2022-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE IF NOT EXISTS `pemesanan` (
  `no_pemesanan` char(8) NOT NULL,
  `kd_pelanggan` char(6) NOT NULL,
  `tgl_pemesanan` date NOT NULL DEFAULT '0000-00-00',
  `nama_penerima` varchar(60) NOT NULL,
  `alamat_lengkap` varchar(200) NOT NULL,
  `kd_provinsi` char(3) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `kode_pos` varchar(6) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `status_bayar` enum('Pesan','Lunas','Batal') NOT NULL DEFAULT 'Pesan',
  PRIMARY KEY (`no_pemesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`no_pemesanan`, `kd_pelanggan`, `tgl_pemesanan`, `nama_penerima`, `alamat_lengkap`, `kd_provinsi`, `kota`, `kode_pos`, `no_telepon`, `status_bayar`) VALUES
('PS000001', 'P00004', '2021-02-10', 'admin', 'jl. myamin', 'P31', 'padang', '25662', '086543', 'Lunas'),
('PS000002', 'P00006', '2022-07-20', 'andi', 'lubeg', 'P31', 'padang', '09897', '082267767798', 'Pesan'),
('PS000003', 'P00006', '2022-07-20', 'andi', 'padang', 'P02', 'bandung', '23455', '088232344', 'Pesan'),
('PS000004', 'P00006', '2022-07-20', 'nanda', 'brunie', 'P01', 'jogja', '34534', '2357235235', 'Pesan');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_item`
--

CREATE TABLE IF NOT EXISTS `pemesanan_item` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `no_pemesanan` char(8) NOT NULL,
  `kd_barang` char(5) NOT NULL,
  `harga` int(12) NOT NULL,
  `jumlah` int(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `pemesanan_item`
--

INSERT INTO `pemesanan_item` (`id`, `no_pemesanan`, `kd_barang`, `harga`, `jumlah`) VALUES
(51, 'PS000001', 'B0001', 100000, 2),
(52, 'PS000002', 'B0012', 70000, 1),
(53, 'PS000003', 'B0014', 130000, 1),
(54, 'PS000004', 'B0015', 25000, 1),
(55, 'PS000005', 'B0015', 25000, 2),
(56, 'PS000002', 'B0015', 25000, 2),
(57, 'PS000003', 'B0015', 25000, 3),
(58, 'PS000004', 'B0016', 50000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE IF NOT EXISTS `provinsi` (
  `kd_provinsi` char(3) NOT NULL,
  `nm_provinsi` varchar(100) NOT NULL,
  `biaya_kirim` int(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kd_provinsi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('P32', 'Sumatera Selatan', 35000),
('P33', 'Sumatera Utara', 25000);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_keranjang`
--

CREATE TABLE IF NOT EXISTS `tmp_keranjang` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kd_barang` char(5) NOT NULL,
  `harga` int(12) NOT NULL,
  `jumlah` int(3) NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL DEFAULT '0000-00-00',
  `kd_pelanggan` char(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `tmp_keranjang`
--

INSERT INTO `tmp_keranjang` (`id`, `kd_barang`, `harga`, `jumlah`, `tanggal`, `kd_pelanggan`) VALUES
(71, 'B0015', 25000, 1, '2022-07-06', 'P00005'),
(78, 'B0015', 70000, 2, '2022-07-20', 'P00006');
