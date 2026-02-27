# dashboard-airdrop
web dashboard for airdrop crypto


1. Install PHP
   ```bash
   sudo apt update
   sudo apt install php -y
   ```
   ```bash
   php -v
   ```
   ```bash
   cd /var/www/html
   ```
   
   ```bash
   git clone https://github.com/winzzy12/dashboard-airdrop.git
   ```


2. Install MySQL
   ```bash
   sudo apt update && sudo apt upgrade -y
   sudo apt install mysql-server -y
   ```
   ```
   sudo systemctl start mysql
   sudo systemctl enable mysql
   ```
   ```
   sudo mysql_secure_installation
   ```

   
4. Config Database & Create Database
   ```
   sudo mysql -u root -p
   ```
   ```
   CREATE DATABASE database_db;
   ```
   ```
   CREATE USER 'database_db'@'localhost' IDENTIFIED BY 'Password123';
   ```
   ```
   GRANT ALL PRIVILEGES ON database_db.* TO 'database_db'@'localhost';
   FLUSH PRIVILEGES;
   EXIT;
   ```
   ```
   mysql -u database_db -p
   ```
   ```
   Password123
   ```
   ```
   SHOW DATABASES;
   ```
   ```
   USE database_db;
   ```
   ```
   SHOW TABLES;
   ```
5. Export Database
```
   -- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 28, 2026 at 12:40 AM
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
(1, 'admin', '$2a$12$BkTExnIYeeLg1WM7BohGT.DAW5RMhWmk35KPkhbIb7nVbp/BAKZTS', '$2a$12$.zyfBzMbeoQFdab5Fi1Wgun2SebGCSF6m3y6NgiMyiOnM2RnNh2Nm');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_notes`
--
ALTER TABLE `project_notes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

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
```
6. Setting Database PHP & change password mysql
   ```
   nano /var/www/html/dashboard-airdrop/config/database.php
   ```
7. Running PHP Server
   ```
   php -S 0.0.0.0:8000
   ```
   ```
   php -S localhost:8000
   ```
   
   
