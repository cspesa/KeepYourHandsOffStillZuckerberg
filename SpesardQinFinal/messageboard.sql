-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2017 at 07:39 PM
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
-- Database: `messageboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `pointer` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `content` varchar(120) NOT NULL,
  `author` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(300) NOT NULL,
  `author` varchar(20) NOT NULL,
  `rating` int(11) NOT NULL,
  `categorie` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `date`, `title`, `content`, `author`, `rating`, `categorie`) VALUES
(1, 100417, 'New Ghostbusters Movie Opinion', 'Hey all, I was wondering what you all thought of the latest Ghostbusters movie. Asking for a friend of course. I thought', 'theOGbuster', 7, 'movies'),
(2, 100317, 'New Phil Collins Album Soon', 'Heard there\'s a new Phill Collins album coming this winter. Does anyone know anything about that?', 'bobbyD', 18, 'music'),
(3, 100317, 'Just had the best pizza', 'I was just downtown and I had the best pizza of my life! You guys should really check it out sometime. You get to choose', 'pcols', 8, 'food'),
(4, 100217, 'Robbed Again', 'Just got back from the awards. Yet again my genius has been failed to be realized! I feel sorry that the judges can\'t un', 'OneOscarAndCounting', 0, 'movies');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `picture` varchar(30) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fname`, `lname`, `username`, `password`, `email`, `banned`, `picture`, `admin`) VALUES
('Bill', 'Murray', 'theOGbuster', 'whoyagonnacall?', 'bmurray@gmail.com', 0, 'pic3.jpeg', 1),
('Bob', 'Dylan', 'bobbyD', 'likearollingstone', 'bdylan@gmail.com', 0, 'pic2.jpeg', 0),
('Leonardo', 'DiCaprio', 'OneOscarAndCounting', 'myheartwillgoon', 'lcapo@aol.com', 1, 'pic3.jpeg', 0),
('Phil', 'Collins', 'pcolls', 'password', 'phil@gmail.com', 0, 'pic1.jpeg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `fname` (`fname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
