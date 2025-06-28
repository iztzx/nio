-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2023 at 11:33 AM
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
-- Database: `nio`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` varchar(12) NOT NULL,
  `namaadmin` varchar(20) NOT NULL,
  `katalaluan` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `namaadmin`, `katalaluan`) VALUES
('000000000000', 'ISAAC TEO', '00000000');

-- --------------------------------------------------------

--
-- Table structure for table `bandingan`
--

CREATE TABLE `bandingan` (
  `idbandingan` int(12) NOT NULL,
  `nokp` varchar(12) NOT NULL,
  `idproduk` varchar(4) NOT NULL,
  `kuantiti` int(12) NOT NULL,
  `tarikh` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bandingan`
--

INSERT INTO `bandingan` (`idbandingan`, `nokp`, `idproduk`, `kuantiti`, `tarikh`) VALUES
(18, '101010101010', '0074', 1, '2023-07-08'),
(19, '222211112222', '0066', 1, '2023-07-08'),
(21, '101010101010', '0218', 1, '2023-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `nokp` varchar(12) NOT NULL,
  `emelpembeli` varchar(255) NOT NULL,
  `namapembeli` varchar(20) NOT NULL,
  `katalaluan` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`nokp`, `emelpembeli`, `namapembeli`, `katalaluan`) VALUES
('101010101010', 'philips1012@gmail.com', 'PHILIPS', '1234'),
('222211112222', 'sena@gmail.com', 'Senna', 'sena');

-- --------------------------------------------------------

--
-- Table structure for table `penjual`
--

CREATE TABLE `penjual` (
  `idpenjual` varchar(12) NOT NULL,
  `namapenjual` varchar(20) NOT NULL,
  `katalaluan` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjual`
--

INSERT INTO `penjual` (`idpenjual`, `namapenjual`, `katalaluan`) VALUES
('012345678901', 'CORBUSIER', '12'),
('060708010203', 'Rachel', '18260222'),
('060723010713', 'RAZALI', '12345678'),
('061206010415', 'RAVINA', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idproduk` varchar(4) NOT NULL,
  `namaproduk` varchar(70) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `category` enum('MOBILE','AUDIO','COMPUTERS_LAPTOPS','TV_MONITORS','HOME_APPLIANCES','ACCESSORIES') NOT NULL,
  `brand` varchar(30) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `harga` double(10,2) NOT NULL,
  `idpenjual` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `namaproduk`, `keterangan`, `category`, `brand`, `gambar`, `harga`, `idpenjual`) VALUES
('0002', 'Sony Xperia PRO-I', 'Be creative, with Xperia PRO-I\'s redefined camera.', 'MOBILE', 'Sony', 'pimg2-1.jpg', 6299.00, '061206010415'),
('0003', 'iPhone 14 Pro Max', 'Pro. Beyond. (1TB)', 'MOBILE', 'Apple', 'pimg3.jpg', 8299.00, '061206010415'),
('0005', 'Xiaomi 13 Pro', 'Behind the masterpiece.', 'MOBILE', 'Xiaomi', 'pimg7.png', 5999.00, '061206010415'),
('0007', 'Vivo X90 Pro+', 'Pro Photography in Pocket, now with Snapdragon 8 Gen2.', 'MOBILE', 'Vivo', 'pimg6.png', 5999.00, '061206010415'),
('0010', 'Asus Zenbook Pro Duo 15 OLED', 'The laptop of tomorrow.', 'COMPUTERS_LAPTOPS', 'Asus', 'DM_20230214131846_001.png', 14999.00, '061206010415'),
('0011', 'Asus Zenbook Pro 16X OLED', 'Smaller. Simpler. Stronger.', 'COMPUTERS_LAPTOPS', 'Asus', 'DM_20230214131914_001.png', 11999.00, '061206010415'),
('0012', 'Acer Swift Edge 16', 'Where Performance Meets Portability.', 'COMPUTERS_LAPTOPS', 'Acer', 'acer-swift-edge-2022-03-1140x695.webp', 5999.00, '061206010415'),
('0013', 'Acer Predator Helios 18', 'Empowered to excel.', 'COMPUTERS_LAPTOPS', 'Acer', 'DM_20230214134235_001.jpg', 6.00, '061206010415'),
('0014', 'Acer Nitro 17', 'Beyond Performance.', 'COMPUTERS_LAPTOPS', 'Acer', 'DM_20230214134247_001.jpg', 8699.00, '061206010415'),
('0015', 'HP OMEN 16', 'Your game is ready to go.', 'COMPUTERS_LAPTOPS', 'HP', 'DM_20230214134442_001.png', 12699.00, '061206010415'),
('0016', 'HP Elite x360 1040', 'Elite mobility and versatility.', 'COMPUTERS_LAPTOPS', 'HP', 'DM_20230214134138_001.png', 8199.00, '061206010415'),
('0017', 'HP Elite Dragonfly G3', 'Light, powerful, long-lasting.', 'COMPUTERS_LAPTOPS', 'HP', 'DM_20230214134158_001.png', 8899.00, '061206010415'),
('0018', 'DELL XPS 15', 'Premium design, Immersive audio and visuals, Maximum performance, Created for Creators.', 'COMPUTERS_LAPTOPS', 'Dell', 'DM_20230214132252_001.png', 12499.00, '061206010415'),
('0019', 'Alienware x15 R2', 'Sophisticated, Unmatched Performance.', 'COMPUTERS_LAPTOPS', 'Dell', 'product3.png', 14299.00, '061206010415'),
('0020', 'ROG Zephyrus Duo 15 SE', '4K 120HZ/FHD 300HZ with Dual Screen and Liquid Metal Cooling.', 'COMPUTERS_LAPTOPS', 'Asus', 'DM_20230214132356_001.png', 18999.00, '061206010415'),
('0021', 'ROG Strix Scar 18', 'Beat the Best. Break all Limits.', 'COMPUTERS_LAPTOPS', 'Asus', 'DM_20230214132715_001.png', 18999.00, '061206010415'),
('0022', 'Samsung HW-Q990B', 'Wireless Dolby Atmos, True 11.1.4ch.', 'AUDIO', 'Samsung', 'product2.png', 5299.00, '061206010415'),
('0023', 'Bang & Olufsen Beoplay A9', 'Fidelity comes in full circle.', 'AUDIO', 'Bang & Olufsen', 'download (1).png', 20999.00, '061206010415'),
('0024', 'Nakamichi Shockwafe Ultra 9.2 eARC', 'Soundbar Supercharged, Best for larger spaces.', 'AUDIO', 'Nakamichi', '100011.png', 13999.00, '061206010415'),
('0025', 'SONOS Beam (Gen 2)', 'High Definition Sound.', 'AUDIO', 'Sonos', '10001.png', 2999.00, '061206010415'),
('0026', 'Sony HT-A9', 'A new frontier of surround sound.', 'AUDIO', 'Sony', '10001.jpg', 7299.00, '061206010415'),
('0027', 'Sony SA-SW5 300W', 'Additional Wireless Subwoofer. Deep, Explosive Bass.', 'AUDIO', 'Sony', '10001-1.jpg', 2799.00, '061206010415'),
('0028', 'SONOS Arc', 'Cinematic Sound.', 'AUDIO', 'Sonos', '63eb6bd5e2c0b.png', 4999.00, '061206010415'),
('0029', 'Sony HT-A7000', '7.1.2ch Dolby Atmos®, Sony\'s Flagship Soundbar.', 'AUDIO', 'Sony', '63eb6cf7e036c.jpg', 5999.00, '061206010415'),
('0030', 'Bang & Olufsen Beolab 28', 'Poise meets power.', 'AUDIO', 'Bang & Olufsen', '63eb6d446ac85.webp', 79999.00, '061206010415'),
('0031', 'Bang & Olufsen Beosound Balance', 'Sound. Sculpted.', 'AUDIO', 'Bang & Olufsen', '63eb6e85d4774.png', 17499.00, '061206010415'),
('0032', 'Bang & Olufsen Beosound 2', 'Home is where the music is.', 'AUDIO', 'Bang & Olufsen', '63eb6ee70c132.png', 16999.00, '061206010415'),
('0033', 'Devialet Phantom I 108 dB Opera de Paris', 'Monumental, wherever you\'re seated.', 'AUDIO', 'Devialet', '63eb6f39e653c.png', 20000.00, '061206010415'),
('0034', 'Devialet Phantom I 108 dB', 'Absolute fidelity, quintessential.', 'AUDIO', 'Devialet', '63eb6f705f53b.png', 13000.00, '061206010415'),
('0035', 'Devialet Phantom II 98 dB Opera de Paris', 'Monumental, wherever you\'re seated.', 'AUDIO', 'Devialet', '63eb6fbf7ab75.png', 9000.00, '061206010415'),
('0036', 'Devialet Phantom II 98 dB', 'Ultimate compactness/power ratio.', 'AUDIO', 'Devialet', '63eb6ff8576b4.png', 8000.00, '061206010415'),
('0037', 'Bowers & Wilkins 801D4 (pair)', 'An icon reborn, 40 years of excellence, sets the standard.', 'AUDIO', 'Bowers & Wilkins', '63eb72437452f.png', 199999.00, '061206010415'),
('0038', 'Bowers & Wilkins Panorama 3', 'Experience movies and music as they should be.', 'AUDIO', 'Bowers & Wilkins', '63eb746d79000.png', 4899.00, '061206010415'),
('0039', 'Bowers & Wilkins Formation Duo (pair)', 'Inimitable Bowers & Wilkins sound - wirelessly.', 'AUDIO', 'Bowers & Wilkins', '63eb774ebae89.png', 26099.00, '061206010415'),
('0040', 'Bowers & Wilkins Zeppelin', 'Beautiful design meets best-in-class sound.', 'AUDIO', 'Bowers & Wilkins', '63eb7b9b536ff.png', 3999.00, '061206010415'),
('0041', 'Marantz AV 10', 'Reference 15.4 Channel Home Theatre Preamp/Processor, Peerless Performance.', 'AUDIO', 'Marantz', '63eb9b8eb9207.png', 36999.00, '061206010415'),
('0042', 'Marantz AMP 10', 'Reference 16-Channel 200W/Channel Amplifier, Peerless Performance.', 'AUDIO', 'Marantz', '63eb9be460bc4.png', 36999.00, '061206010415'),
('0043', 'Emotiva XPA-11 Gen3', '11 Channel Audiophile Home Theater Power Amplifier.', 'AUDIO', 'Emotiva', '63eb9c1696368.png', 10399.00, '061206010415'),
('0044', 'Emotiva RMC-1', '16 Channel Dolby Atmos & DTS:X Cinema Processor.', 'AUDIO', 'Emotiva', '63eb9c7265b46.png', 18099.00, '061206010415'),
('0045', 'Anthem MRX 1140 8K', 'Pure Performance, Pure Value.', 'AUDIO', 'Anthem', '63eb9d25ba12c.png', 29000.00, '061206010415'),
('0046', 'Anthem AVM 90', 'Demand Excellence, Demand Anthem. Anthem\'s most sophisticated audio-video processor.', 'AUDIO', 'Anthem', '63eb9de40e0e3.png', 42999.00, '061206010415'),
('0047', 'NAD M33', 'BluOS Streaming Integrated Amplifier / DAC.', 'AUDIO', 'NAD', '63eb9f35e57c0.jpg', 29999.00, '061206010415'),
('0048', 'NAD Master Series M17 V2i', 'Home theatre Preamp/Processor.', 'AUDIO', 'NAD', '63eb9fc41aadc.png', 39999.00, '061206010415'),
('0049', 'Yamaha GT5000', 'A sound for both the ears and the soul.', 'AUDIO', 'Yamaha', '63eba0b8194d3.jpg', 50000.00, '061206010415'),
('0050', 'Yamaha RX-A8A', 'AVENTAGE 11.2-Channel AV Receiver with 8K HDMI and MusicCast, Home Cinema, Perfected.', 'AUDIO', 'Yamaha', '63eba1a628ab0.png', 18999.00, '061206010415'),
('0051', 'Cambridge Audio Edge A', 'Cambridge Audio\'s Most Detailed Integrated Amplifier.', 'AUDIO', 'Cambridge Audio', '63eba20b914c3.png', 35699.00, '061206010415'),
('0052', 'Cambridge Audio Edge NQ', 'Impressively Revealing.', 'AUDIO', 'Cambridge Audio', '63eba26376b06.png', 24999.00, '061206010415'),
('0053', 'Cambridge Audio ALVA TT V2', 'Direct Drive Turntable with Bluetooth® aptX HD.', 'AUDIO', 'Cambridge Audio', '63eba2880589d.png', 10699.00, '061206010415'),
('0054', 'Perlisten Audio D215S Subwoofer', 'The Subwoofer that will surprise you with its accuracy.', 'AUDIO', 'Perlisten Audio', '63eba2f714b47.png', 43899.00, '061206010415'),
('0055', 'KEF Reference 5 Meta', 'The benchmark of HiFi speakers.', 'AUDIO', 'KEF', '63eba3464618c.png', 129999.00, '061206010415'),
('0056', 'Bang & Olufsen Beolab 90', 'State-of-the-art floor standing speakers.', 'AUDIO', 'Bang & Olufsen', '63eba399eaa0b.png', 569999.00, '061206010415'),
('0057', 'KEF Blade One Meta', 'The world\'s first Single Apparent Source speaker.', 'AUDIO', 'KEF', '63eba4db582ff.png', 169999.00, '061206010415'),
('0058', 'KEF LS50 Meta', 'The World\'s First Speakers with Metamaterial.', 'AUDIO', 'KEF', '63eba54acecf9.png', 7699.00, '061206010415'),
('0059', 'Sennheiser HD660S', 'The perfect blend of power and control.', 'AUDIO', 'Sennheiser', '63eba6948a9e3.jpg', 2399.00, '061206010415'),
('0061', 'Sennheiser HD820', 'Completely Closed, Outrageously Open.', 'AUDIO', 'Sennheiser', '63eba75570058.jpg', 8499.00, '061206010415'),
('0064', 'Sennheiser Momentum True Wireless 3', 'For the ultimate listening experience.', 'AUDIO', 'Sennheiser', '63eba81e8c535.jpg', 999.00, '061206010415'),
('0065', 'Sony WH-1000XM5', 'Your world, nothing else.', 'AUDIO', 'Sony', '63eba88ca491a.png', 1599.00, '061206010415'),
('0066', 'AirPods Pro (2nd generation)', 'Rebuilt from the sound up.', 'AUDIO', 'Apple', '63eba8e778d6c.jpg', 1099.00, '061206010415'),
('0067', 'Sony WF-1000XM4 ', 'Industry-leading Noise Cancellation, now even better.', 'AUDIO', 'Sony', '63eba95932448.png', 769.00, '061206010415'),
('0068', 'AirPods Max', 'A perfect balance of exhilarating high-fidelity audio and the effortless magic of AirPods.', 'AUDIO', 'Apple', '63eba9cf8daf2.png', 2499.00, '061206010415'),
('0069', 'HIFIMAN Arya', 'Neutral, Clear.', 'AUDIO', 'HIFIMAN', '63ebaa6d9f5f1.jpg', 6299.00, '061206010415'),
('0071', 'ZTE nubia Red Magic 8 Pro+', '93.7% screen-to-body ratio, 8Gen2, LPDDR5x, UFS4.0.', 'MOBILE', 'ZTE', '63ec5de441f65.png', 5099.00, '061206010415'),
('0072', 'ROG Phone 6 Pro', 'For those who dare.', 'MOBILE', 'Asus', '63ec5e88312ed.png', 4999.00, '061206010415'),
('0073', 'ROG Phone 6D Ultimate', 'For those who dare, now with Dimensity 9000+.', 'MOBILE', 'Asus', '63ec5f1aef18f.png', 4999.00, '061206010415'),
('0074', 'Asus Zenfone 9', 'Compact Size. BIG Possibilities.', 'MOBILE', 'Asus', '63ec5fa497542.png', 4099.00, '061206010415'),
('0075', 'Huawei Mate 50 Pro', 'Your glamorous mate.', 'MOBILE', 'Huawei', '63ec6038c9e92.png', 5299.00, '061206010415'),
('0078', 'Sony Xperia 1 IV', '4K HDR 120fps, true optical zoom 85-125mm.', 'MOBILE', 'Sony', '63ec64d24ae4a.png', 5299.00, '061206010415'),
('0079', 'Lenovo ThinkPad X1 Carbon Gen 10', 'Redesigned with collaboration in mind.', 'COMPUTERS_LAPTOPS', 'Lenovo', '63ec6d7d43e08.png', 7499.00, '061206010415'),
('0080', 'Lenovo ThinkPad X1 Titanium Yoga', 'Flexibility to the max.', 'COMPUTERS_LAPTOPS', 'Lenovo', '63ec6df00327a.png', 12699.00, '061206010415'),
('0081', 'Lenovo ThinkPad P1 Gen 5', 'The power you need, the machine you want.', 'COMPUTERS_LAPTOPS', 'Lenovo', '63ec6fb74c856.png', 10999.00, '061206010415'),
('0082', 'Lenovo ThinkPad Z16', 'Possibilities are limitless to what you can do.', 'COMPUTERS_LAPTOPS', 'Lenovo', '63ec709ec35d0.png', 9599.00, '061206010415'),
('0083', 'Lenovo ThinkPad X1 Extreme Gen 4', 'Take your imagination to the extreme.', 'COMPUTERS_LAPTOPS', 'Lenovo', '63ec70e44b40a.png', 9699.00, '061206010415'),
('0084', 'MacBook Pro 16\"', 'Mover. Maker. Boundary breaker.', 'COMPUTERS_LAPTOPS', 'Apple', '63ec734718a1e.jpg', 14799.00, '061206010415'),
('0085', 'MacBook Air', 'Don\'t take it lightly.', 'COMPUTERS_LAPTOPS', 'Apple', '63ec73ad81091.jpg', 6699.00, '061206010415'),
('0086', 'Surface Laptop Studio', 'Incredibly powerful, infinitely flexible.', 'COMPUTERS_LAPTOPS', 'Microsoft', '63ec75b701c3e.jpg', 7599.00, '061206010415'),
('0087', 'Surface Pro 9', 'Laptop power, tablet flexibility.', 'COMPUTERS_LAPTOPS', 'Microsoft', '63ec78488d3d5.png', 5799.00, '061206010415'),
('0088', 'Lenovo Legion Pro 7i Gen 8', 'The world\'s most powerful AI-tuned gaming laptop.', 'COMPUTERS_LAPTOPS', 'Lenovo', '63ec797d23763.png', 14099.00, '061206010415'),
('0089', 'Lenovo Legion 5 Pro Gen 7', 'Calibrated for competition.', 'COMPUTERS_LAPTOPS', 'Lenovo', '63ec7a59268ec.png', 6999.00, '061206010415'),
('0090', 'Lenovo Legion 5i Pro Gen 7', 'Bigger, better, & born to conquer.', 'COMPUTERS_LAPTOPS', 'Lenovo', '63ec7ad47cd18.png', 7999.00, '061206010415'),
('0091', 'LG Signature Z2 88\"', 'The one. The only. 8K OLED.', 'TV_MONITORS', 'LG', '63ec90fc5af66.jpg', 129999.00, '061206010415'),
('0092', 'Sony A80K 77\"', 'Next generation picture and sound with Cognitive Intelligence.', 'TV_MONITORS', 'Sony', '63ec92e57e1d4.jpg', 18999.00, '061206010415'),
('0093', 'Samsung S95B 65\"', 'Experience the difference. By Samsung.', 'TV_MONITORS', 'Samsung', '63ec93d0799c9.png', 12309.00, '061206010415'),
('0094', 'TCL 6-Series 8K 75\"', 'TCL: Welcome to The Future of TV.', 'TV_MONITORS', 'TCL', '63ec9430636be.png', 14099.00, '061206010415'),
('0095', 'LG G2 77\"', 'The pinnacle of bright beauty and sleek design.', 'TV_MONITORS', 'LG', '63ec95a627e48.png', 16299.00, '061206010415'),
('0096', 'Hisense U8H 75\"', 'The Best Affordable All-Around TV.', 'TV_MONITORS', 'Hisense', '63ec977d95cd5.jpg', 6599.00, '061206010415'),
('0097', 'Sony A95K 65\"', 'Sony\'s brightest and widest range of OLED colours ever.', 'TV_MONITORS', 'Sony', '63ec98550349e.png', 15999.00, '061206010415'),
('0098', 'Sony A90J 65\'\'', 'World\'s first cognitive intelligence TV.', 'TV_MONITORS', 'Sony', '63ec9a595b149.jpg', 10999.00, '061206010415'),
('0099', 'Samsung QN90B 85\'\'', 'Samsung\'s most advanced 4K experience.', 'TV_MONITORS', 'Samsung', '63ec9b3861c72.png', 22999.00, '061206010415'),
('0100', 'LG C2 83\'\'', 'Your window to a bright new world.', 'TV_MONITORS', 'LG', '63ec9d3c12897.png', 28999.00, '061206010415'),
('0101', 'Sony X95K 85\'\'', 'Next generation picture and sound with Cognitive Intelligence.', 'TV_MONITORS', 'Sony', '63eca0297bff4.jpg', 26999.00, '061206010415'),
('0102', 'Samsung The Frame 85\'\'', 'Make your own TV.', 'TV_MONITORS', 'Samsung', '63eca14b61410.png', 15999.00, '061206010415'),
('0103', 'Klipsch RP-600M II', 'Reference Premiere, High-Fidelity Home Audio.', 'AUDIO', 'Klipsch', '63ecba6974096.png', 0.00, '061206010415'),
('0104', 'Sennheiser HD660S2', 'Icon, reborn.', 'AUDIO', 'Sennheiser', '63ecbadc874cd.png', 2899.00, '061206010415'),
('0105', 'Focal Utopia', 'Sound Purity At Its Finest', 'AUDIO', 'Focal', '63ecbb815a35c.png', 23999.00, '061206010415'),
('0106', 'Bowers & Wilkins 805 D4 (pair)', 'Little Diamond. (without stand)', 'AUDIO', 'Bowers & Wilkins', '63ecbf7516172.png', 39999.00, '061206010415'),
('0107', 'Bowers & Wilkins FS-805 D4', 'Achieve best performance for 805 D4 loudspeakers with these dedicated stands.', 'AUDIO', 'Bowers & Wilkins', '63ecbfd1b2696.png', 6099.00, '061206010415'),
('0108', 'Dynaudio Confidence 20 (pair)', 'Compact size. Masterful performance.', 'AUDIO', 'NAD', '63ecc141b8a30.png', 57999.00, '061206010415'),
('0109', 'Focal Diablo Utopia Colour EVO (pair)', 'Utopia III EVO in a bookshelf.', 'AUDIO', 'Focal', '63ecc3d69f296.png', 96999.00, '061206010415'),
('0110', 'Focal Diablo Utopia Colour EVO Stand', 'Listen to your music in the best conditions.', 'AUDIO', 'Focal', '63ecc432a7c71.png', 6799.00, '061206010415'),
('0111', 'KEF Reference 1 Meta', 'The benchmark of bookshelf speakers.', 'AUDIO', 'KEF', '63ecc579051b2.png', 42999.00, '061206010415'),
('0112', 'S-RF1 Floor Stand for Reference 1 Meta', 'Stands that perform.', 'AUDIO', 'KEF', '63ecc6c68aa30.png', 5699.00, '061206010415'),
('0113', 'S2 Floor Stand for LS50 Meta', 'Stand that delivers.', 'AUDIO', 'KEF', '63ecc73955e4d.png', 2999.00, '061206010415'),
('0114', 'Sonus Faber Olympica Nova I (pair)', 'Pure sound quality.', 'AUDIO', 'Sonus Faber', '63ecc9e470b02.jpg', 32999.00, '061206010415'),
('0115', 'Sonus Faber Olympica Nova I Stand (pair)', 'Stand for Olympica Nova I.', 'AUDIO', 'Sonus Faber', '63eccac3d8da1.jpg', 5699.00, '061206010415'),
('0116', 'Sonus Faber Guarneri G5 (pair)', 'Pristine design, cutting-edge technology.', 'AUDIO', 'Sonus Faber', '63ecce18128f2.jpg', 85999.00, '061206010415'),
('0117', 'Sonus Faber Amati G5 (pair)', 'Channels the visionary brilliance of Nicolo Amati, link between artistic form and musical function.', 'AUDIO', 'Sonus Faber', '63eccff20b8f7.jpg', 179999.00, '061206010415'),
('0118', 'Sonus Faber Aida Reference Speaker', 'Limitless Immersion, The merger of timeless beauty and magnificent sound reproduction.', 'AUDIO', 'Sonus Faber', '63ecd1d3039d9.png', 659999.00, '061206010415'),
('0119', 'Magico S7', 'Derived from the engineering triumphs in the M-Pro loudspeaker.', 'AUDIO', 'Magico', '63ecd3bcd190e.png', 299999.00, '061206010415'),
('0120', 'Magico M9', 'Establishes new benchmarks in musicality, transparency, and fidelity.', 'AUDIO', 'Magico', '63ecd5a7df8f7.png', 3359999.00, '061206010415'),
('0121', 'Miele WWV980 WPS Passion 9kg', 'The economical all-rounder that meets the highest expectations.', 'HOME_APPLIANCES', 'Miele', 'download (2).png', 17999.00, '061206010415'),
('0122', 'Miele WTR 860 WT1 8kg/5kg (Washer Dryer)', 'with TwinDos and QuickPower, ready-to-wear clothes at the touch of a button.', 'HOME_APPLIANCES', 'Miele', 'download.png', 17399.00, '061206010415'),
('0123', 'Miele TWV 780 WP Passion T1 heat pump dryer', 'The Miele all-rounder for the highest demands and very gentle laundry care.', 'HOME_APPLIANCES', 'Miele', 'download (1)-1.png', 17999.00, '061206010415'),
('0124', 'Miele B 4847 FashionMaster Steam ironing', 'with display and steamer for perfect ironing results and convenience.', 'HOME_APPLIANCES', 'Miele', 'download (2)-1.png', 13999.00, '061206010415'),
('0125', 'Miele B 995 D Rotary ironer', 'with steam function for optimum results and even more convenience.', 'HOME_APPLIANCES', 'Miele', 'download (3).png', 16999.00, '061206010415'),
('0126', 'smeg Blast Chiller 45cm Compact', 'Dolce Stil Novo Aesthetic with copper trim.\r\n', 'HOME_APPLIANCES', 'smeg', 'SBC4604WNR.jpg', 23999.00, '061206010415'),
('0127', 'smeg Built-in Wine Cooler (38)', 'Dolce Stil Novo Aesthetic, right hinged.', 'HOME_APPLIANCES', 'smeg', 'CVI638RN3.jpg', 16999.00, '061206010415'),
('0128', 'Technics SA-C600', 'Compact Network CD Receiver,brings you a wealth of music content with a single device.', 'AUDIO', 'Technics', 'DM_20230217141454_001.jpg', 4899.00, '061206010415'),
('0129', 'Technics SL-1000RE-S', 'Direct Drive Turntable System, Exquisite, reference-class direct drive turntable system.', 'AUDIO', 'Technics', 'DM_20230217141337_001.jpg', 89999.00, '061206010415'),
('0130', 'Technics SL-1200G-S', 'Direct Drive Turntable System, Created by Technics in pursuit of true analog record sound.', 'AUDIO', 'Technics', 'DM_20230217143614_001.jpg', 19399.00, '061206010415'),
('0131', 'Technics SL-1210GR', 'Direct Drive Turntable System, Fusing Technics\'s traditional analog and digital technologies.', 'AUDIO', 'Technics', 'DM_20230217141254_001.jpg', 8099.00, '061206010415'),
('0132', 'Technics SL-G700M2', 'Network / Super Audio CD Player,  brings out rich details and tones in music files, no matter what t', 'AUDIO', 'Technics', 'DM_20230217141317_001.jpg', 15699.00, '061206010415'),
('0133', 'Technics SU-R1000', 'Equipped with the next evolution of Technics\'s full digital amplifier technology', 'AUDIO', 'Technics', 'DM_20230217144003_001.jpg', 45099.00, '061206010415'),
('0134', 'smeg Omnichef Single Oven 60cm', 'Dolce Stil Novo Aesthetic with copper trim.', 'HOME_APPLIANCES', 'smeg', 'DM_20230217150022_001.jpg', 19999.00, '061206010415'),
('0135', 'smeg AREA Induction Hob Silver 90cm', 'Full area cooking zone, A hob designed for the ultimate in flexibility and freedom of movement.', 'HOME_APPLIANCES', 'smeg', 'DM_20230217150838_001.jpg', 25699.00, '061206010415'),
('0136', 'smeg Venting Induction Hob 83cm', 'Dolce Stil Novo Aesthetic with Copper trim.', 'HOME_APPLIANCES', 'smeg', 'DM_20230217151206_001.jpg', 15999.00, '061206010415'),
('0137', 'smeg Induction Hob with Auto Vent 80cm', 'Flexi4zone cooking for maximum flexibility, Auto vent function to connect with your hood and vent automatically.', 'HOME_APPLIANCES', 'smeg', 'DM_20230217151744_001.jpg', 8699.00, '061206010415'),
('0138', 'smeg Gas Hob 80cm', 'Dolce Stil Novo Aesthetic with Copper Trim.', 'HOME_APPLIANCES', 'smeg', 'download (4).png', 8299.00, '061206010415'),
('0139', 'smeg Ceramic Hob 90cm', 'Ceramic Hob with 5 cook zones.', 'HOME_APPLIANCES', 'smeg', 'DM_20230217153600_001.jpg', 3599.00, '061206010415'),
('0140', 'smeg Built-in Wine Cooler (21)', 'Dolce Stil Novo Aesthetic with copper trim.', 'HOME_APPLIANCES', 'smeg', 'Smeg-cvi621nr3-1-1343629065.jpg', 10999.00, '061206010415'),
('0141', 'smeg Maxi Height Dishwasher 60cm', 'Fully Integrated, High load flexibility, greater performance.', 'HOME_APPLIANCES', 'smeg', 'download (5).png', 4399.00, '061206010415'),
('0142', 'smeg Angled Chimney Hood Auto vent 2.0 90cm', 'Linea Aesthetic, Universal design, controllable wirelessly via Auto Vent technology only with a Smeg hob.', 'HOME_APPLIANCES', 'smeg', 'DM_20230316105447_001.jpg', 6599.00, '061206010415'),
('0143', 'smeg Angled Chimney Hood Auto vent 2.0 90cm', 'Dolce Stil Novo Aesthetics, Smeg\'s most advanced collection to date.', 'HOME_APPLIANCES', 'smeg', 'DM_20230316105906_001.jpg', 7799.00, '061206010415'),
('0144', 'smeg Alta Island Hood Auto vent 2.0 120cm', 'Large, beautiful, controllable wirelessly via Auto Vent 2.0 technology only with a Smeg hob.', 'HOME_APPLIANCES', 'smeg', 'DM_20230217155537_001.jpg', 10999.00, '061206010415'),
('0146', 'smeg Portofino Electric Range Cooker Anthracite', 'Excellent cooking performance, spacious wide oven', 'HOME_APPLIANCES', 'smeg', 'DM_20230217155611_001.jpg', 19999.00, '061206010415'),
('0147', 'La Pavoni Esperto Edotto Lever Coffee Machine', 'Italian excellence in the production of coffee machines, 1.6l water tank.', 'HOME_APPLIANCES', 'La Pavoni', 'DM_20230217155619_001.jpg', 10299.00, '061206010415'),
('0148', 'La Pavoni Domus Bar', 'The semi professional choice for an espresso and cappuccino.', 'HOME_APPLIANCES', 'La Pavoni', 'download (6).png', 3799.00, '061206010415'),
('0149', 'La Pavoni Botticelli Speciality', 'Semi-professional Domestic Coffee Machine.', 'HOME_APPLIANCES', 'La Pavoni', 'DM_20230217155646_001.jpg', 14699.00, '061206010415'),
('0150', 'La Pavoni Cilindro Prosumer', 'Coffee Grinder, preserves all the delicious coffee aromas without altering flavour.', 'HOME_APPLIANCES', 'La Pavoni', 'DM_20230217155634_001.jpg', 3199.00, '061206010415'),
('0151', 'smeg Portofino Electric Range Cooker Anthracite(2)', 'Includes a large oven and a smaller auxiliary oven providing all the space you could need for your Christmas turkey and trimmings.', 'HOME_APPLIANCES', 'smeg', 'DM_20230217163530_001.jpg', 19999.00, '061206010415'),
('0152', 'DeLonghi Clessidra Pour Over Coffee Maker', 'Automatically replicates the pour-over coffee method at the touch of a button .', 'HOME_APPLIANCES', 'DeLonghi', 'DM_20230217163929_001.jpg', 599.00, '061206010415'),
('0153', 'DeLonghi Dedica Conical Burr Grinder', 'With a digital LCD display and 18 variable settings for espresso, drip coffee/pour-over and French press, customize your grind like a professional.', 'HOME_APPLIANCES', 'DeLonghi', 'DM_20230217163954_001.jpg', 899.00, '061206010415'),
('0154', 'DeLonghi La Specialista Prestigio', 'Crafted in science to give you the confidence to brew your perfect cup of coffee. Created for coffee lovers.', 'HOME_APPLIANCES', 'DeLonghi', 'DM_20230217163920_001.jpg', 4499.00, '061206010415'),
('0155', 'DeLonghi Magnifica Evo Titanium Black', 'Stylish automatic coffee maker for the best in-cup results and a wide range of recipes.', 'HOME_APPLIANCES', 'DeLonghi', 'DM_20230217163915_001.jpg', 3599.00, '061206010415'),
('0156', 'DeLonghi Dinamica Plus', 'Elevate your senses and satisfy your coffee desires with Dinamica Plus Fully Automatic Coffee Machine.', 'HOME_APPLIANCES', 'DeLonghi', 'DM_20230217163910_001.jpg', 4999.00, '061206010415'),
('0157', 'DeLonghi PrimaDonna Elite Experience', 'Transform your coffee experience into an art form with elegant Italian design and state-of-the-art technology.', 'HOME_APPLIANCES', 'DeLonghi', 'DM_20230217163850_001.jpg', 10000.00, '061206010415'),
('0158', 'DeLonghi Maestosa Fully Automatic Coffee Machine', 'The luxurious automatic coffee machine that redefines your coffee experience.', 'HOME_APPLIANCES', 'DeLonghi', 'DM_20230217163855_001.jpg', 20000.00, '061206010415'),
('0159', 'Electrolux 11kg UltimateCare 900 front load washer ', 'Perfect dose, gentle care.', 'HOME_APPLIANCES', 'Electrolux', 'DM_20230217165201_001.png', 5669.00, '061206010415'),
('0160', 'Electrolux 11kg UltimateCare 700 front load washer ', 'Removes 49 visible stains.', 'HOME_APPLIANCES', 'Electrolux', 'DM_20230217165212_001.png', 4789.00, '061206010415'),
('0161', 'Electrolux 9kg UltimateCare 700 front load washing machine', 'Fast, flexible cycles.', 'HOME_APPLIANCES', 'Electrolux', 'DM_20230217165244_001.png', 3649.00, '061206010415'),
('0162', 'Electrolux 11kg/7kg UltimateCare 700 washer dryer', 'Clean with added hygiene.', 'HOME_APPLIANCES', 'Electrolux', 'DM_20230217165404_001.png', 4849.00, '061206010415'),
('0163', 'Electrolux 60cm UltimateCare 300 freestanding dishwasher', 'With 13 place settings.', 'HOME_APPLIANCES', 'Electrolux', 'DM_20230217165432_001.png', 4579.00, '061206010415'),
('0164', 'Logitech MX Master 3S', 'An Icon. Remastered.', 'ACCESSORIES', 'Logitech', 'DM_20230217200533_001.png', 569.00, '061206010415'),
('0165', 'Perlisten Audio R7t (pair)', 'Based on the trickle-down technology from the S-Series.', 'AUDIO', 'Perlisten Audio', 'download-1.png', 46999.00, '061206010415'),
('0166', 'iFi ZEN DAC V2 & iSilencer+', 'Your best in class desktop DAC with background noise remover.', 'AUDIO', 'iFi Audio', 'DM_20230221110752_001.jpg', 1099.00, '061206010415'),
('0167', 'Meze Elite', 'Combining an exclusive aesthetic with state-of-the-art engineering.', 'AUDIO', 'Meze Audio', '3-MezeElitesemiprofile_1024x1024.png', 17899.00, '061206010415'),
('0168', 'Meze Empyrean', 'A blend of premium materials, exquisite craftsmanship and detailing that’s unmistakably Meze.', 'AUDIO', 'Meze Audio', 'Empyrean_BlackCopper_Semiprofile_1024x1024.png', 13599.00, '061206010415'),
('0169', 'Meze Liric', 'A blend of high build quality, excellent comfort, and a life-like, immersive sound.', 'AUDIO', 'Meze Audio', 'Liric-semiprofil-premium-copper_1024x1024.png', 8999.00, '061206010415'),
('0170', 'Meze 99 Classics', 'Delivers perfect natural sound even to the pickiest of audio lovers.', 'AUDIO', 'Meze Audio', '99CL-WG-main_1024x1024-PhotoRoom.png-PhotoRoom.png', 1399.00, '061206010415'),
('0171', 'Meze Lina System', 'With a dedicated Network DAC, Headphone Amplifier and Master Clock, Lina is the first dCS system purpose-built for headphone listening.', 'AUDIO', 'Meze Audio', 'Lina-stack-semiprofile_1024x1024.png', 140999.00, '061206010415'),
('0172', 'Meze 109 Pro', 'The first dynamic open-back headphone from Meze Audio.', 'AUDIO', 'Meze Audio', '3699.png', 3699.00, '061206010415'),
('0173', 'Bang & Olufsen Beoplay H95', 'Like nothing you\'ve heard before.', 'AUDIO', 'Bang & Olufsen', 'B&O H95 4399.png', 4399.00, '061206010415'),
('0174', 'Bose QuietComfort® 45', 'Iconic quiet, comfort, and sound.', 'AUDIO', 'Bose', 'Bose QuietComfort® 45 1599.png', 1599.00, '061206010415'),
('0175', 'Willsenton R8', 'Affordable, uncompromising.', 'AUDIO', 'Willsenton', 'Willsenton R8 6999.jpg', 6999.00, '061206010415'),
('0176', 'Klipsch Cornwall IV', 'Fill your room with crystal-clear sound, right down to the most minute details.', 'AUDIO', 'Klipsch', '32999.jpg', 32999.00, '061206010415'),
('0177', 'Klipsch Forte IV', 'High performance is Klipsch\'s Forte.', 'AUDIO', 'Klipsch', '25099 HIGH PERFORMANCE IS OUR FORTE.png', 25099.00, '061206010415'),
('0178', 'Klipsch Heresy IV', 'A little Heresy is good for the Soul.', 'AUDIO', 'Klipsch', '15999 A LITTLE HERESY IS GOOD FOR THE SOUL.jpg', 15999.00, '061206010415'),
('0179', 'Klipsch RP-8000F II 2.0', 'Bigger horn, better sound.', 'AUDIO', 'Klipsch', '8999.jpg', 8999.00, '061206010415'),
('0180', 'Klipsch RP-8060FA II 2.0.2', 'Reach new heights.', 'AUDIO', 'Klipsch', '7099.jpg', 7099.00, '061206010415'),
('0181', 'Klipsch RP-504C II', 'Bigger horn, better sound.', 'AUDIO', 'Klipsch', '3799.jpg', 3799.00, '061206010415'),
('0182', 'Klipsch RP-500SA II', 'Best-in-class versatility.', 'AUDIO', 'Klipsch', '3299.jpg', 3299.00, '061206010415'),
('0183', 'Klipsch RP-502S II', 'Bigger horn, better sound.', 'AUDIO', 'Klipsch', '3799-1.jpg', 3799.00, '061206010415'),
('0184', 'Topping DX7 Pro+', 'Continues the legacy of Topping DX7, powerful amplification in a compact form at an unbeatable price.', 'AUDIO', 'Topping', 'Topping DX 7 Pro+3299.png', 3299.00, '061206010415'),
('0185', 'Bose Noise Cancelling Headphones 700', 'Premium quiet, bold sound.', 'AUDIO', 'Bose', '1759.png', 1759.00, '061206010415'),
('0186', 'PrimaLuna Evo 400', 'Premium Integrated and Headphone tube amplifier.', 'AUDIO', 'PrimaLuna', '25999.jpg', 25999.00, '061206010415'),
('0187', 'Focal Bathys', 'High-fidelity and sound immersion.', 'AUDIO', 'Focal', 'FOCAL BATHYS.jpg', 3899.00, '061206010415'),
('0188', 'Sonus Faber Omnia', 'The high-fidelity wireless speaker from Sonus faber.', 'AUDIO', 'Sonus Faber', 'DM_20230221145917_001.png', 10699.00, '061206010415'),
('0189', 'iFi Pro iDSD Signature', 'Standalone. Streamer. DAC/amp. All with the X-factor.', 'AUDIO', 'iFi Audio', '12999.jpg', 12999.00, '061206010415'),
('0190', 'Bluesound Vault 2i', 'High-Res 2TB Network Hard Drive CD Ripper and Streamer.', 'AUDIO', 'Bluesound', '6599.jpg', 6599.00, '061206010415'),
('0191', 'Panasonic TH-65JZ2000K 65\'\'', 'Picture and Sound Mastered, for Total Home Cinema.', 'TV_MONITORS', 'Panasonic', '16999 65\'\' pnsc-TH-65JZ2000K.jpg', 16999.00, '061206010415'),
('0192', 'Toshiba Regza 65X9900L 65\'\'', 'Natural and immersive image quality.', 'TV_MONITORS', 'Toshiba', '65X9900L TOSHIBA REGZA 20999.jpg', 20999.00, '061206010415'),
('0193', 'Toshiba Regza X779400 77\'\'', 'Regza makes this world more beautiful.', 'TV_MONITORS', 'Toshiba', '77X9400 TOSHIBA REGZA 18999.png', 18999.00, '061206010415'),
('0194', 'Panasonic TX-77LZ2000B 77\'\'', 'State of the art picture & sound to transform your home cinema.', 'TV_MONITORS', 'Panasonic', 'DM_20230221153443_001.jpg', 23699.00, '061206010415'),
('0195', 'LG Objet Collection - Posé 55\"', 'Experience a new side of life, from any angle, in any space.', 'TV_MONITORS', 'LG', '12999-1.jpg', 8699.00, '061206010415'),
('0197', 'Samsung Galaxy Z Fold 4', 'Powerful. Productive.', 'MOBILE', 'Samsung', 'Z Fold 4.jpg', 6899.00, '061206010415'),
('0198', 'Samsung Galaxy Z Flip 4', 'Capture life with new perspective.', 'MOBILE', 'Samsung', 'Z Flip 4.png', 4499.00, '061206010415'),
('0200', 'Bowers & Wilkins Formation Wedge', 'Wedge is the shape of hi-res stereo sound.', 'AUDIO', 'Bowers & Wilkins', 'DM_20230227213324_001.png', 4899.00, '061206010415'),
('0201', 'Bowers & Wilkins Formation Audio', 'Give your hi-fi a whole new dimension.', 'AUDIO', 'Bowers & Wilkins', 'DM_20230227213722_001.png', 3999.00, '061206010415'),
('0202', 'Bowers & Wilkins Formation Flex', 'Flex is performance and flexibility.', 'AUDIO', 'Bowers & Wilkins', 'DM_20230227214152_001.png', 2999.00, '061206010415'),
('0203', 'Anthem MDX-16', 'Most advanced and versatile distribution solution ever.', 'AUDIO', 'Anthem', 'DM_20230304115000_001.png', 18999.00, '061206010415'),
('0204', 'Anthem STR Power Amplifier', 'Two-Channel Revolution.', 'AUDIO', 'Anthem', 'DM_20230304120221_001.jpg', 39999.00, '061206010415'),
('0205', 'Anthem STR Preamplifier', 'Push the Power of Audio Control.', 'AUDIO', 'Anthem', 'DM_20230304120400_001.jpg', 26999.00, '061206010415'),
('0206', 'Focal Naim 10th Anniversary Edition', 'A streaming-savvy system of reputable stature.', 'AUDIO', 'Focal Naim', 'DM_20230315122205_001.jpg', 220000.00, '061206010415'),
('0207', 'Focal Stella Utopia EM EVO Loudspeakers', 'Embodying exceptional musicality.', 'AUDIO', 'Focal', 'DM_20230315122730_001.jpg', 335699.00, '061206010415'),
('0208', 'Focal Grande Utopia EM EVO Loudspeakers', 'Ultimate Acoustics.', 'AUDIO', 'Focal', 'DM_20230315122845_001.jpg', 625999.00, '061206010415'),
('0209', 'smeg Sommelier Drawer', 'beautifully presented with a Slavonia durmast wooden shelf which is equipped with must have accessories for true wine connoisseurs.', 'HOME_APPLIANCES', 'smeg', 'DM_20230316104138_001.jpg', 5299.00, '061206010415'),
('0210', 'smeg Fully Integrated Dishwasher 60cm', 'High load flexibility, greater performance, ideal for medium households.', 'HOME_APPLIANCES', 'smeg', 'DM_20230316111151_001.jpg', 4699.00, '061206010415'),
('0211', 'Panasonic Electric Bidet', 'Personal Hygiene Made Easy.', 'HOME_APPLIANCES', 'Panasonic', '1799.png', 1799.00, '061206010415'),
('0212', 'Panasonic CARE+ Edition Washer Dryer 10kg/6kg', 'Gentle Drying Prevents Clothes from Shrinking.', 'HOME_APPLIANCES', 'Panasonic', '5249 10kg-6kg.png', 5249.00, '061206010415'),
('0213', 'Panasonic CARE+ Edition Washing Machine 10kg', 'Hygiene Wash for Baby Clothes with Dry Assist.', 'HOME_APPLIANCES', 'Panasonic', '4015 10kg.png', 4015.00, '061206010415'),
('0214', 'Panasonic CARE+ Edition Washing Machine 9kg', 'Improves Hygiene in Your Everyday Laundry.', 'HOME_APPLIANCES', 'Panasonic', '3695 9kg.png', 3695.00, '061206010415'),
('0215', 'Panasonic Home Shower (Jet Pump)', 'A Splash Of Goodness In Every Shower', 'HOME_APPLIANCES', 'Panasonic', '1079.png', 1079.00, '061206010415'),
('0216', 'Panasonic U Series Jet Pump Water Heater', 'Blissful Showers for Comfort & Wellbeing', 'HOME_APPLIANCES', 'Panasonic', '818.png', 818.00, '061206010415'),
('0217', 'Panasonic High-pressure Boiler Type Steam Generator', 'Professional Quality Ironing with High-pressure Penetrating Steam', 'HOME_APPLIANCES', 'Panasonic', '1699.png', 1699.00, '061206010415'),
('0218', 'Panasonic 1550W Cordless Steam Iron', 'Freestyle Ironing!', 'HOME_APPLIANCES', 'Panasonic', '370.png', 370.00, '061206010415'),
('0219', 'Panasonic 2800W Optimal Iron', 'Ideal Ironing Results without Troublesome Temperature Setting.', 'HOME_APPLIANCES', 'Panasonic', '452.png', 452.00, '061206010415'),
('0220', 'Panasonic 2200W Cyclone Bagless Canister Vacuum Cleaner', 'Clean Exhaust Air, Your Cat Won’t Mind at All.', 'HOME_APPLIANCES', 'Panasonic', '799.png', 799.00, '061206010415'),
('0223', 'Panasonic Cyclone Cordless Stick Vacuum Cleaner 2.0kg', 'Tangle-free, Hygienic Cleaning with Long-lasting Performance (for Pet Hair and Long Hair).', 'HOME_APPLIANCES', 'Panasonic', '\'2799.png', 2799.00, '061206010415'),
('0224', 'Panasonic Tangle-free Cyclone Cordless Stick Vacuum Cleaner', 'Tangle-free nozzle and smooth movement for a quick clean (for Pet Hair and Long Hair).', 'HOME_APPLIANCES', 'Panasonic', '1699-1.png', 1699.00, '061206010415'),
('0225', 'Panasonic Cordless Stick Vacuum Cleaner', 'Lightweight Stress-free Cleaning.', 'HOME_APPLIANCES', 'Panasonic', '749.png', 749.00, '061206010415'),
('0226', 'Panasonic Lightweight Cyclone Cordless Stick Vacuum Cleaner', 'Light and smooth movement for a quick clean (for Carpet, Hardwood and Tile Floors).', 'HOME_APPLIANCES', 'Panasonic', '1349.png', 1349.00, '061206010415'),
('0227', 'Panasonic Garment Steamer with Soleplate', 'Power steaming with hot pressing, fulfil your needs.', 'HOME_APPLIANCES', 'Panasonic', '545.png', 545.00, '061206010415'),
('0228', 'Panasonic Garment Steamer', 'Quick and Gentle Wrinkle Removal.', 'HOME_APPLIANCES', 'Panasonic', '406.png', 406.00, '061206010415'),
('0229', 'Panasonic nanoe™ X Air Purifier 52m²', 'Purify The Air Your Loved Ones Breathe.', 'HOME_APPLIANCES', 'Panasonic', '2399.png', 2399.00, '061206010415'),
('0230', 'Panasonic Portable Air Purifier nanoe™ X Generator', 'Enjoy the Clean Air Surrounds You', 'ACCESSORIES', 'Panasonic', '599.png', 599.00, '061206010415'),
('0231', 'Panasonic ECONAVI Humidifying nanoe™ Air Purifier 52m²', 'Enjoy healthy and comfortable living environment.', 'HOME_APPLIANCES', 'Panasonic', '2295.png', 2295.00, '061206010415'),
('0232', 'Panasonic PRIME+ Edition 2-door Refrigerator', 'Fresh and Hygienic Food Storage For Healthy Eating.', 'HOME_APPLIANCES', 'Panasonic', '4999.png', 4999.00, '061206010415'),
('0233', 'Panasonic PRIME+ Edition 4-door Refrigerator', 'Fresh and Hygienic Food Storage For Healthy Eating.', 'HOME_APPLIANCES', 'Panasonic', '6699.png', 6699.00, '061206010415'),
('0234', 'Panasonic PRIME+ Edition 3-door Refrigerator', 'Fresh and Hygienic Food Storage For Healthy Eating.', 'HOME_APPLIANCES', 'Panasonic', '5899.png', 5899.00, '061206010415'),
('0235', 'Panasonic Steam Convection Cubie Oven 20L', 'Healthy and Delicious Meals Everyday.', 'HOME_APPLIANCES', 'Panasonic', '2059.png', 2059.00, '061206010415'),
('0236', 'Panasonic Superheated Steam Convection Oven 30L', 'Advanced Steam Technology “Superheated Steam Oven”.', 'HOME_APPLIANCES', 'Panasonic', '2999.png', 2999.00, '061206010415'),
('0237', 'Panasonic Multifunctional Baby Bottle Steam Steriliser and Dryer', 'Protects your baby items with all-in-one hygiene care for your peace of mind.', 'HOME_APPLIANCES', 'Panasonic', '399.png', 399.00, '061206010415'),
('0238', 'Panasonic IH Rice Cooker (1.8L)', 'Happy moments begin with hearty rice (Made In Japan)', 'HOME_APPLIANCES', 'Panasonic', '1779.png', 1779.00, '061206010415'),
('0239', 'Panasonic Low Sugar IH Rice Cooker (1.5L)', 'Healthy & Delicious Low Sugar Rice, Just A Touch Away.', 'HOME_APPLIANCES', 'Panasonic', '1099.png', 1099.00, '061206010415'),
('0240', 'Panasonic X-Premium Inverter R32 aircond', '24-Hour Quality Air', 'HOME_APPLIANCES', 'Panasonic', '4968.png', 4968.00, '061206010415'),
('0241', 'Panasonic X-Deluxe Inverter R32 aircond', '24-Hour Quality Air.', 'HOME_APPLIANCES', 'Panasonic', '3639.png', 3639.00, '061206010415'),
('0242', 'Panasonic WIFAN Wifi 5-Blade LED Ceiling Fan', 'Leading Innovation in Comfort.', 'HOME_APPLIANCES', 'Panasonic', '1139.png', 1139.00, '061206010415'),
('0243', 'Panasonic nanoe™ X 5-Blade ceiling Fan', 'Leading Innovation in Comfort.', 'HOME_APPLIANCES', 'Panasonic', '1129.png', 1129.00, '061206010415'),
('0244', 'Panasonic Undersink Alkaline Water Ionizer', 'A Stylish Alkaline Ionizer That Generates Multi-functional Water to Support Your Life.', 'HOME_APPLIANCES', 'Panasonic', '6999-1.png', 6999.00, '061206010415'),
('0245', 'Panasonic Ultra Filtration Alkaline Ionizer', 'Bringing You a Healthy Lifestyle with Safe Alkaline Ionized Water.', 'HOME_APPLIANCES', 'Panasonic', '5999.png', 5999.00, '061206010415'),
('0246', 'Panasonic Tankless Undersink Water Purifier', 'Purify Your Water with Ultrafiltration and Start a Worry-free Life.', 'HOME_APPLIANCES', 'Panasonic', '2199.png', 2199.00, '061206010415'),
('0247', 'Panasonic Faucet Water Purifier', 'Secure, Clear Water for 1 Year for a Sustainable, Healthier Life.', 'ACCESSORIES', 'Panasonic', '579.png', 579.00, '061206010415'),
('0248', 'Panasonic ECONAVI Induction Heating IH Cooktop', 'Enjoy fast, precise and controllable cooking.', 'HOME_APPLIANCES', 'Panasonic', '3579.png', 3579.00, '061206010415'),
('0249', 'DENON AVC-X8500HA', ' The world’s first 13.2Ch 8K AV amplifier.', 'AUDIO', 'Denon', '23999.png', 23999.00, '061206010415'),
('0250', 'Bose QuietComfort® Earbuds II', 'Sound shaped to you.', 'AUDIO', 'Bose', '1999.png', 1999.00, '061206010415'),
('0251', 'Denon Home 350', 'Powerful Hi-Res Engineering.', 'AUDIO', 'Denon', '3699.jpg', 3699.00, '061206010415'),
('0252', 'Denon Home Sound Bar 550', 'Upgrade your TV Sound.', 'AUDIO', 'Denon', '3699-1.jpg', 3699.00, '061206010415'),
('0253', 'Denon Home 250', 'Powerful Hi-Res Engineering.', 'AUDIO', 'Denon', '2659.jpg', 2659.00, '061206010415'),
('0254', 'Denon Home 150', 'Any Room, Any Song.', 'AUDIO', 'Denon', '1369.jpg', 1369.00, '061206010415'),
('0255', 'Denon Home Subwoofer', 'Wireless Denon Home Subwoofer with HEOS Built-in.', 'AUDIO', 'Denon', '2659-1.jpg', 2659.00, '061206010415'),
('0256', 'Wall Mount for Denon Home 150', 'Custom-made wall mount for the Denon Home 150 Wireless Speaker.', 'AUDIO', 'Denon', '369.jpg', 369.00, '061206010415'),
('0257', 'Wall Mount for Denon Home 250', 'Custom-made wall mount for the Denon Home 250 Wireless Speaker.', 'AUDIO', 'Denon', '469.jpg', 469.00, '061206010415'),
('0258', 'Wall Mount for Denon Home 350', 'Custom-made wall mount for the Denon Home 350 Wireless Speaker.', 'AUDIO', 'Denon', '569.jpg', 569.00, '061206010415'),
('0259', 'Floor Stand for Denon Home 150', 'Custom-made floor stand for the Denon Home 150 Wireless Speaker.', 'AUDIO', 'Denon', '609.jpg', 609.00, '061206010415'),
('0260', 'Floor stand for Denon Home 350', 'Custom-made floor stand for the Denon Home 350 Wireless Speaker.', 'AUDIO', 'Denon', '869.jpg', 869.00, '061206010415'),
('0261', 'Floor stand for Denon Home 250', 'Custom-made floor stand for the Denon Home 250 Wireless Speaker.', 'AUDIO', 'Denon', '709.jpg', 709.00, '061206010415'),
('0262', 'Devialet Dione Opéra de Paris', 'Bring the show to life.', 'AUDIO', 'Devialet', '15490.png', 15490.00, '061206010415'),
('0263', 'Devialet Dione', 'A true all-in-one soundbar.', 'AUDIO', 'Devialet', '12990.JPG', 12990.00, '061206010415'),
('0264', 'BenQ EX480UZ', 'MOBIUZ 4K 48 inch True HDMI 2.1 OLED Gaming Monitor.', 'TV_MONITORS', 'BenQ', '7099.png', 7099.00, '061206010415'),
('0265', 'Paradigm Founder 120H (pair)', 'Precision. Control. Dynamics.', 'AUDIO', 'Paradigm', '50999.jpg', 50999.00, '061206010415'),
('0266', 'Perlisten Audio S7t', 'Hear what\'s hidden in the music you love.', 'AUDIO', 'Perlisten Audio', 's7t.png', 90000.00, '061206010415'),
('0267', 'BenQ SW321C', '32-inch 4K AdobeRGB USB-C Photographer Monitor.', 'TV_MONITORS', 'BenQ', '9399.webp', 9399.00, '061206010415'),
('0268', 'BenQ SW271C', '27-inch 4K AdobeRGB USB-C Photographer Monitor.', 'TV_MONITORS', 'BenQ', '7699.webp', 7699.00, '061206010415'),
('0269', 'BenQ PD3205UA', '32-inch Ergo Arm 4K UHD sRGB HDR10 USB-C Designer Monitor.', 'TV_MONITORS', 'BenQ', '3699.webp', 3699.00, '061206010415'),
('0270', 'BenQ PD3420Q', '34-inch 2K WQHD P3 USB-C Mac® Compatible Designer Monitor.', 'TV_MONITORS', 'BenQ', '3999.webp', 3999.00, '061206010415'),
('0271', 'BenQ PD3220U', '32-inch 4K UHD P3 Thunderbolt 3 Mac® Compatible Designer Monitor.', 'TV_MONITORS', 'BenQ', '5399.webp', 5399.00, '061206010415'),
('0272', 'BenQ EX3210U', 'MOBIUZ 4K 32 inch True HDMI 2.1 (48Gbps) Gaming Monitor.', 'TV_MONITORS', 'BenQ', '4399.webp', 4399.00, '061206010415'),
('0273', 'BenQ EW3880R', '37.5\" IPS WQHD+ Ultrawide Curved Monitor.', 'TV_MONITORS', 'BenQ', '4799.webp', 4799.00, '061206010415'),
('0274', 'Audio-Technica ATH-TWX9', 'A Premium Listening Experience.', 'AUDIO', 'Audio-Technica', '1699-2.png', 1699.00, '061206010415'),
('0275', 'Philips 65OLED937', 'Superb. From what you see to what you hear.', 'TV_MONITORS', 'Philips', '2899.webp', 19999.00, '061206010415'),
('0276', 'Luxman SQ-N150', 'Music reproduction of uncanny warmth and beauty.', 'AUDIO', 'Luxman', 'sq n150.jpg', 17999.00, '061206010415'),
('0277', 'Primare A35.8', 'Primare’s most powerful and flexible multi-channel amplifier.', 'AUDIO', 'Primare', '25999-1.jpg', 25999.00, '061206010415'),
('0278', 'Stax SR-X9000', 'New flagship earspeakers equipped with newly fixed electrode MLER-3 technology.', 'AUDIO', 'Stax Audio', '6200.jpg', 29999.00, '061206010415'),
('0279', 'Focal Stellia', 'Acoustic Sound Purity.', 'AUDIO', 'Focal', '16999.jpg', 16999.00, '061206010415'),
('0280', 'Sony MDR-Z1R', 'Signature Series Premium Hi-Res Headphones.', 'AUDIO', 'Sony', '1800.png', 9000.00, '061206010415'),
('0281', 'SPL Phonitor X', 'Both an outstanding headphone amplifier and an excellent preamplifier', 'AUDIO', 'SPL Audio', 'SPL Phonitor X.png', 12999.00, '061206010415'),
('0282', 'Anker USB C 747 GaNPrime 150W', 'All the Power You Need.', 'ACCESSORIES', 'Anker', '569-1.jpg', 569.00, '061206010415'),
('0283', 'Anker 737 Power Bank', '24,000mAh, 140W Two-Way Fast Charging.', 'ACCESSORIES', 'Anker', '150.png', 759.00, '061206010415'),
('0284', 'Anker 733 Power Bank', '2-in-1 Hybrid Charger (65W wall charger and 10,000mAh portable charger)', 'ACCESSORIES', 'Anker', '469.png', 469.00, '061206010415'),
('0285', 'Anker 727 Charging Station', 'GaNPrime 100W High-Speed Charging', 'ACCESSORIES', 'Anker', '469-1.png', 469.00, '061206010415'),
('0286', 'Anker 765 USB-C to USB-C Cable', '140W, Nylon, 1.8m (6ft)', 'ACCESSORIES', 'Anker', '189.jpg', 189.00, '061206010415'),
('0287', 'Netgear Orbi™ 960 Series Quad-Band WiFi 6E Satellite (White)', 'A Masterpiece of connectivity.', 'ACCESSORIES', 'Netgear', '2899-1.jpg', 2899.00, '061206010415'),
('0288', 'Netgear Orbi™ 960 Series Quad-Band WiFi 6E Mesh Satellite (Black)', 'A Masterpiece of connectivity.', 'ACCESSORIES', 'Netgear', '2899.jpg', 2899.00, '061206010415'),
('0289', 'Netgear Orbi™ 960 Series Quad-Band WiFi 6E Mesh System (Black)', 'The world\'s most powerful WiFi system. (3pack, 9000 sqft)', 'ACCESSORIES', 'Netgear', '7099-1.jpg', 7099.00, '061206010415'),
('0290', 'Netgear Orbi™ 960 Series Quad-Band WiFi 6E Mesh System (White)', 'The world\'s most powerful WiFi system. (3pack, 9000 sqft)', 'ACCESSORIES', 'Netgear', '7099-1-1.jpg', 7099.00, '061206010415'),
('0291', 'Asus ROG Rapture GT-AXE16000', 'World\'s first quad-band WiFi 6E gaming router.', 'ACCESSORIES', 'Asus', 'DM_20230317230803_001.png', 3499.00, '061206010415'),
('0292', 'Sonos One (Gen 2)', 'The powerful smart speaker with voice control built-in.', 'AUDIO', 'Sonos', '1299.png', 1299.00, '061206010415'),
('0293', 'KEF LS60 Wireless', 'The Future Wireless HiFi.', 'AUDIO', 'KEF', '35999.png', 35999.00, '061206010415'),
('0294', 'KEF LSX II', 'The Definitive Compact Wireless HiFi.', 'AUDIO', 'KEF', 'LSX 2.png', 8569.00, '061206010415'),
('0295', 'Naim Mu-So 2nd Generation', 'Excellence Remastered.', 'AUDIO', 'Naim', 'NAIM Mu So.jpg', 8999.00, '061206010415'),
('0296', 'Naim Mu-So Qb 2nd Generation', 'The Premium Compact Wireless Speaker Your Music Deserves.', 'AUDIO', 'Naim', '6099.jpg', 6099.00, '061206010415'),
('0297', 'Anthem Statement P5', 'Performance From The Heart.', 'AUDIO', 'Anthem', 'DM_20230304120827_001.png', 45999.00, '061206010415'),
('0298', 'Naim Statement (Full Set)', 'STATEMENT. Without Compromise.', 'AUDIO', 'Naim', 'Naim Statement.jpg', 1199999.00, '061206010415'),
('0299', 'Trinnov ST2-HiFi', 'The room correction of the ST2-HiFi will elevate the performance of your high-end system to a level you have never before experienced.', 'AUDIO', 'Trinnov', '35099.png', 35099.00, '061206010415'),
('0300', 'Trinnov Amethyst', 'The Amethyst preamplifier is Trinnov’s flagship high-end stereo product.', 'AUDIO', 'Trinnov', '58999.png', 58999.00, '061206010415'),
('0301', 'Trinnov Altitude³²', 'Unchallenged reference processor for Immersive home theater systems.', 'AUDIO', 'Trinnov', '239999.jpg', 239999.00, '061206010415'),
('0302', 'Huawei Mate Xs 2', ' Ultra Light, Ultra Flat, Super Durable.', 'MOBILE', 'Huawei', '7999.png', 7999.00, '061206010415'),
('0303', 'Huawei FreeBuds Pro 2', 'Listening as You\'ve Never Heard It.', 'AUDIO', 'Huawei', '849.jpg', 849.00, '061206010415'),
('0305', 'Audio Pro Addon C10MKII', ' Get Your Music Wirelessly, Quickly And Easily.', 'AUDIO', 'Audio Pro', '2399.jpg', 2399.00, '061206010415'),
('0306', 'Audio Pro Drumfire', 'The loudest playing multiroom speaker', 'AUDIO', 'Audio Pro', '4499.jpg', 4399.00, '061206010415'),
('0308', 'Huawei Sound X Gold Edition', 'With Devialet, now with 18K Gold plating.', 'AUDIO', 'Huawei', '1899.png', 1899.00, '061206010415'),
('0309', 'Naim Uniti Nova', 'For the ultimate in room-filling power, no other music-streaming player beats a Naim Uniti Nova.', 'AUDIO', 'Naim', '26999.jpg', 26999.00, '061206010415'),
('0310', 'Naim Solstice Special Edition', 'A New Dawn For Music, limited to just 500 units.', 'AUDIO', 'Naim', '85999.png', 85999.00, '061206010415'),
('0311', 'Naim NAC 552 including 552PS DR', 'Performance without limits.', 'AUDIO', 'Naim', '150699.png', 150699.00, '061206010415'),
('0312', 'NAP 500 DR', 'The devil is in the detail.', 'AUDIO', 'Naim', '150699.jpg', 150699.00, '061206010415'),
('0313', 'Naim 555 PS DR', 'The ultimate upgrade.', 'AUDIO', 'Naim', '46999.jpg', 46999.00, '061206010415'),
('0314', 'Naim ND555', 'Pure musicality with Naim\'s most advanced streaming platform.', 'AUDIO', 'Naim', '92999.png', 92999.00, '061206010415'),
('0315', 'HIFIMAN Susvara', 'A Heavenly Melody.', 'AUDIO', 'HIFIMAN', '29999 HIFIMAN.jpg', 29999.00, '061206010415'),
('0316', 'HIFIMAN HE1000 V2', 'Newly Upgraded Version of the HE1000.', 'AUDIO', 'HIFIMAN', 'HIFIMAN 10999.jpg', 10999.00, '061206010415'),
('0317', 'HIFIMAN HE-R10D', 'Closed-back Dynamic Headphones.', 'AUDIO', 'HIFIMAN', 'HIFIMAN ClosedBack DYN.jpg', 6399.00, '061206010415'),
('0318', 'HIFIMAN HE-R10P', 'Closed-back Planar Headphone.', 'AUDIO', 'HIFIMAN', '27999.jpg', 27999.00, '061206010415'),
('0319', 'Astell & Kern A&ultima SP3000', 'Luxury Meets Innovation, SP3000', 'AUDIO', 'Astell & Kern', '17999.png', 17999.00, '061206010415'),
('0320', 'Audeze CRBN Electrostatic Headphones', 'Designed with Purpose.', 'AUDIO', 'Audeze', '23999-1.png', 23999.00, '061206010415'),
('0321', 'Audeze MM-500 Professional Headphones', 'A Serious Tool for Every Situation.', 'AUDIO', 'Audeze', '7999.jpg', 7999.00, '061206010415'),
('0322', 'Audeze LCD-5 Flagship Headphones', 'Transparency, Resolution, and Speed.', 'AUDIO', 'Audeze', '23999.jpg', 23999.00, '061206010415'),
('0323', 'Audeze LCD-4z', 'Experience the unrivaled audio quality of our Flagship LCD-4 without the need for an amplifier.', 'AUDIO', 'Audeze', '19999.jpg', 19999.00, '061206010415'),
('0324', 'Audeze LCDi4 Open-Back In-Ear Headphones', ' Pinnacle of both audio quality and technological innovation.', 'AUDIO', 'Audeze', 'Audeze IEM.jpg', 13999.00, '061206010415'),
('0325', 'HiBy RS8', 'Hi-Res Flagship Darwin-based R2R Digital Audio Player DAP', 'AUDIO', 'HiBy', '16999.png', 16999.00, '061206010415'),
('0326', 'Sony WM1Z Walkman® Signature Series', 'Delight in pure detail, one Signature Sound.', 'AUDIO', 'Sony', '18999.jpg', 18999.00, '061206010415'),
('0327', 'Lotoo PAW Gold Touch TITANIUM', 'Sound matters. (Limited Titanium Edition)', 'AUDIO', 'Lotoo', '17999.jpg', 17999.00, '061206010415'),
('0328', 'iBasso DX320', 'iBasso\'s fully evolved new flagship reference digital audio player.', 'AUDIO', 'iBasso', '7699.jpg', 6999.00, '061206010415'),
('0329', 'Monolith Liquid Gold Balanced Headphone Amplifier and DAC', 'Miniaturized version of the original and popular Cavalli Audio® Liquid Gold Amplifier.', 'AUDIO', 'Monolith', '1000USD.jpg', 4699.00, '061206010415'),
('0330', 'Monolith Liquid Platinum Balanced Headphone Amplifier', 'Balanced version of the highly regarded Cavalli Audio® Liquid Crimson amplifier.', 'AUDIO', 'Monolith', 'AMP.jpg', 1699.00, '061206010415');
INSERT INTO `produk` (`idproduk`, `namaproduk`, `keterangan`, `category`, `brand`, `gambar`, `harga`, `idpenjual`) VALUES
('0331', 'Monolith Liquid Platinum Balanced Limited Edition DAC', 'A compact Digital‑to‑Analog Converter developed by Alex Cavalli', 'AUDIO', 'Monolith', 'DAC.jpg', 3699.00, '061206010415'),
('0332', 'FiiO M17', 'Portable Desktop-Class Player.', 'AUDIO', 'FiiO', '8999-1.jpg', 8999.00, '061206010415'),
('0334', 'Xiaomi MIX Fold 2', 'Powerful, unruffled, the thinnest foldable available.', 'MOBILE', 'Xiaomi', 'b9086dfd-8d5d-4ab9-b095-7ffbb6c15dac.jpg', 7699.00, '061206010415'),
('0335', 'Hitachi BD-90XAV', '9kg, 510 Powered Inverter.', 'HOME_APPLIANCES', 'Hitachi', '3100.jpg', 3100.00, '061206010415'),
('0337', 'Samsung Galaxy S23+', 'Galaxy Reborn.', 'MOBILE', 'Samsung', 'S23-plus.jpg', 5199.00, '061206010415'),
('0338', 'Samsung Galaxy S23 Ultra', 'Ultra Reborn.', 'MOBILE', 'Samsung', 'S23-Ultra.jpg', 6199.00, '061206010415'),
('0339', 'Google Pixel 7', 'Simply powerful. Super helpful.', 'MOBILE', 'Google', '7.png', 3599.00, '061206010415'),
('0340', 'Google Pixel 7 Pro', 'The all-pro Google phone.', 'MOBILE', 'Google', '7 Pro.png', 4899.00, '061206010415'),
('0341', 'iPhone 14 Pro', 'Pro. Beyond. (1TB)', 'MOBILE', 'Apple', '14 Pro.jpg', 7799.00, '061206010415'),
('0342', 'iPad Pro', 'Supercharged by M2.', 'MOBILE', 'Apple', 'DM_20230415155208_001.jpg', 11649.00, '061206010415'),
('0343', 'Magico Titan 15', '6500W of earth-shaking bass.', 'AUDIO', 'Magico', 'Magico Titan15.jpg', 176999.00, '061206010415'),
('0344', 'Gryphon Audio Kodo', 'Exclusive. Danish. Peak performance.', 'AUDIO', 'Gryphon Audio Designs', 'KODO.jpg', 1869999.00, '061206010415'),
('0345', 'Gryphon Audio Trident II', 'Breaks new ground in audio performance.', 'AUDIO', 'Gryphon Audio Designs', 'TRIDENT2.jpg', 769999.00, '061206010415'),
('0346', 'LG 45\'\' UltraGear™ OLED Curved Gaming Monitor', 'The Blinding Speed You Need, unprecedented 240Hz refresh rate and 0.03ms response time on an OLED.', 'TV_MONITORS', 'LG', '10001-2.jpg', 7699.00, '061206010415'),
('0347', 'LG 27\'\' UltraFine 4K OLED pro Monitor', 'OLED Pixel Dimming HDR, 1M : 1 Contrast Ratio, Perfect Your Craft.', 'TV_MONITORS', 'LG', '10001-3.jpg', 9099.00, '061206010415'),
('0348', 'LG 38” UltraGear™ 21:9 Curved WQHD+ Nano IPS', 'Geared Up for Victory', 'TV_MONITORS', 'LG', '10001-4.jpg', 8199.00, '061206010415'),
('0349', 'LG 32\'\' LG UltraFine™ OLED Pro 4K', 'Details Mastered, The OLED Display for Design and Video Professionals.', 'TV_MONITORS', 'LG', '10001-5.jpg', 18099.00, '061206010415'),
('0350', ' Alienware 34 Curved QD-OLED Gaming Monitor', 'INFINITELY IMMERSIVE. STUTTER-FREE SPEED. IMPECCABLE DESIGN.', 'TV_MONITORS', 'Dell', '10002.jpeg', 4999.00, '061206010415'),
('0351', 'GAGGENAU Ceiling ventilation 105 cm', '200 Series, Height adjustable', 'HOME_APPLIANCES', 'GAGGENAU', '33699.jpg', 33699.00, '060723010713'),
('0352', 'GAGGENAU Combi-Steam Oven 76×45 cm', '400 series, Stainless Steel, Handleless door', 'HOME_APPLIANCES', 'GAGGENAU', '36999.jpg', 36999.00, '060723010713');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `bandingan`
--
ALTER TABLE `bandingan`
  ADD PRIMARY KEY (`idbandingan`),
  ADD KEY `nokp` (`nokp`,`idproduk`),
  ADD KEY `idproduk` (`idproduk`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`nokp`);

--
-- Indexes for table `penjual`
--
ALTER TABLE `penjual`
  ADD PRIMARY KEY (`idpenjual`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `idpenjual` (`idpenjual`),
  ADD KEY `idpenjual_2` (`idpenjual`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bandingan`
--
ALTER TABLE `bandingan`
  MODIFY `idbandingan` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bandingan`
--
ALTER TABLE `bandingan`
  ADD CONSTRAINT `bandingan_ibfk_1` FOREIGN KEY (`nokp`) REFERENCES `pembeli` (`nokp`),
  ADD CONSTRAINT `bandingan_ibfk_2` FOREIGN KEY (`idproduk`) REFERENCES `produk` (`idproduk`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`idpenjual`) REFERENCES `penjual` (`idpenjual`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
