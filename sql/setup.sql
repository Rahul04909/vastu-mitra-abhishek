-- Database Setup SQL for Vastu Mitra Abhishek

-- Set SQL mode
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Dumping data for table `admin`
--

-- Default Admin Credentials:
-- Username: admin
-- Email: admin@vastumitra.com
-- Password: admin123
-- (Password is hashed using standard PHP password_hash PASSWORD_DEFAULT)
INSERT INTO `admin` (`username`, `email`, `password`) VALUES
('admin', 'admin@vastumitra.com', '$2y$10$wTdS5XG5HlUItnpmcdgbNOO26MF7w6r0i/TiQgRWI1IkxUgIkE/O');

COMMIT;
