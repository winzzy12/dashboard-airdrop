-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 28, 2026 at 12:39 AM
-- Server version: 8.0.35
-- PHP Version: 8.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `pin`) VALUES
(1, 'admin', '$2y$10$kn2X4gsPCks0q4SYaSVq.Ohd3W81IhH80sy/v6vUE6KW8RqpcWPoS', '$2y$10$f3NOQF9bdxkXwPj.Su0CvOU1RQRqNLzv/3Lzg9u2Pr8UangiR3nzK');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `project_link` text,
  `task_type` varchar(100) DEFAULT NULL,
  `update_status` varchar(100) DEFAULT NULL,
  `reward_type` varchar(100) DEFAULT NULL,
  `raise_amount` varchar(100) DEFAULT NULL,
  `wallet_address` text,
  `private_key` text,
  `logo` varchar(255) DEFAULT NULL,
  `status` enum('active','hidden','finished','vesting','waitlist') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `project_status` enum('active','waitlist','vesting','hidden','finished') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'active',
  `earn` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `project_link`, `task_type`, `update_status`, `reward_type`, `raise_amount`, `wallet_address`, `private_key`, `logo`, `status`, `created_at`, `project_status`, `earn`) VALUES
(3, 'T54 Beta Access', 'https://www.t54.ai/', 'Waitlist', 'Waitlist', '', '', '', '', '1772073780_AfWNQOuz_400x400.png', 'waitlist', '2026-02-26 02:43:00', 'active', 0.00),
(4, 'ICN Network', 'https://console.icn.global/airdrop', 'Node', 'Hold', 'Token', '', '0x9625a73c5adf1bfd6fc390b7ddc3844c853c244f', 'b712442c2e23dc6058cedfd4b51a815e8722a66fa652a3c93c8ac9274371171e', '1772097563_Screenshot 2026-02-26 at 16.17.55.png', 'vesting', '2026-02-26 09:19:23', 'active', 26.84),
(5, 'NodeOps', 'https://claims.nodeops.network/', 'Node', 'Finish', 'Token', '', '0x253eb0903af13d2dc77818990627f0eff977a88a', 'f6b93b4801aeb59af2a50fe04a9dbf2c3c0281dc2c2fa3a8daf93bfa84d0ac84', '1772123994_UK5SC3Dd_400x400.png', 'finished', '2026-02-26 16:39:54', 'active', 39.00),
(6, 'Fraction AI', 'https://fractionai.xyz/dapp/fractals', 'Mainnet', 'Confirmed', 'Airdrop', '', '0x4a048e4b69fd3da66195af69f6f37aaaaed6846b', '5a1f1bc908a8f91294a17581013b3f5c311319a618214719fe28ebfcf01eaa45', '1772127937_fraction_ai1734594023233.png', 'active', '2026-02-26 16:45:16', 'active', 1073.00),
(7, 'Grass', 'https://app.grass.io/dashboard', 'Node Exstension', 'Confirmed', 'Token', '', 'FaGf6SDXx1xRU8bkRN8CVAPKyJWeHpSS7b3M3eK6Sts4', '58HXSUcGystqYJUSsjXYwi9KFBet1MXDzYJGK6aHY1ZRLd9BQMK5aXy5YmTt7ox13yRQfQUJ1qnbLYg7r7r34G4z', '1772125126_wILJU3d6_400x400.png', 'active', '2026-02-26 16:57:30', 'active', 0.00),
(8, 'Kaskad', 'https://testnet.kaskad.live/', 'Tesnet', 'Potential', 'Airdrop', '', '0x922ee6660b8710cc0ee90e885ffb53ebad4401f1', '0x7ad5c29b17848e4b96015a6699f5037eb2cd892bb56c4cd905b5d971be293b3a', '1772126284_0J2eRE5J_400x400.png', 'active', '2026-02-26 17:18:04', 'active', 0.00),
(9, 'Degen NFT', 'https://dream.degen.tips/dashboard', 'Waitlist', 'Potential', 'Airdrop', '', '0xaf836adc838e73276946eb31da7268ce52730181', '0x60bc05b082e265732f8bc1a0d41b6bf42c0048b2b374d49de465efa59a52b000', '1772160325_degen.png', 'waitlist', '2026-02-27 02:45:25', 'active', 0.00),
(10, 'Chasm', 'https://scout.chasm.net/airdrop', 'Node', 'Finish', 'Token', '', '0x88F6FB83E598D506111F457eB2f25DE565006658', '', '1772197983_QEnmWBe-_400x400.png', 'finished', '2026-02-27 13:13:03', 'active', 71.00);

-- --------------------------------------------------------

--
-- Table structure for table `project_notes`
--

CREATE TABLE `project_notes` (
  `id` int NOT NULL,
  `project_id` int NOT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `project_notes`
--

INSERT INTO `project_notes` (`id`, `project_id`, `note`, `created_at`) VALUES
(5, 6, 'Discord Account\r\nusername : wanz6996\r\nEmail : wirasaputra1211@gmail.com\r\nPass : Nusan3T_Open\r\nRole : OG,Samurai,Master Of Instagram, Master Of Tiktok, Master Of Faps, Master Of The Mic,Fraction Family, Viking Warior, Legend, Pioner,\r\n           Fraction All Star, Based Rocsktar, Fearles Pilot\r\n\r\n#Annoucment Discord\r\nhttps://discord.com/channels/1226860543529451561/1226861967755579484', '2026-02-26 16:53:01'),
(6, 3, 'Email : wirasaputra3005@gmail.com', '2026-02-26 17:00:31'),
(7, 8, '➖ Connect with new wallet & add RPC\r\n➖ Click on $ icon then claim all faucet\r\n➖ Try to supply & withdraw, borrow & repay\r\n➖ Done', '2026-02-26 17:18:33'),
(8, 8, 'Set RPC Galleon Testnet\r\nNetwork Name IGRA : Galleon Testnet\r\nChain ID : 38836\r\nChain ID (hex) : 0x97B4\r\nCurrency Symbol : iKAS\r\nDecimals : 18\r\nRPC URL : https://galleon-testnet.igralabs.com:8545\r\nBlock Explorer : https://explorer.galleon-testnet.igralabs.com', '2026-02-26 17:18:59'),
(10, 8, 'Kasperia wallet : https://chromewebstore.google.com/detail/kastle/oambclflhjfppdmkghokjmpppmaebego\r\nAddress : kaspa:qrfkfuxep28quj25aulgv3qzpdksajvnzuyrdgzpujv8tjg8yl9fctc60x665\r\nAddess Tesnet : kaspatest:qrfkfuxep28quj25aulgv3qzpdksajvnzuyrdgzpujv8tjg8yl9fc27u5fyts\r\nFaucet : https://faucet-tn10.kaspanet.io/\r\nPharase : stairs lucky trophy dignity utility cable pyramid abstract antenna dream reduce inflict\r\n\r\nBridge TKAS to iKAS \r\nhttps://galleon-tn-kas.katbridge.com/', '2026-02-26 17:33:33'),
(11, 8, 'https://explorer.galleon-testnet.igralabs.com/address/0x922eE6660B8710CC0EE90e885Ffb53EbAD4401F1?tab=index', '2026-02-26 17:35:55'),
(12, 8, 'X : https://x.com/AppKaskad', '2026-02-26 17:38:04'),
(13, 6, '[ALFA FractionAI]\r\nhttps://fractionai.xyz/dapp/alfa\r\nNEAR WALLET : 6a623874643f35914eea3e823ce7c24b756826bfd03e48827f550a9bb5d4b0e9\r\nPrivate Key Near : ed25519:3Rug5EDod33NiYhrUSgGwKXN9R95J8ysgVXamnqwEcACJ55bqusMs5oxKqpTYoR77MBG3ppBWQhQAuL4ynyZjeNc\r\n----\r\nTotal Profit : 1074$\r\n\r\nProject Alfa End\r\nThanks You Alfa Fraction :)', '2026-02-26 17:49:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_notes`
--
ALTER TABLE `project_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `project_notes`
--
ALTER TABLE `project_notes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project_notes`
--
ALTER TABLE `project_notes`
  ADD CONSTRAINT `project_notes_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
