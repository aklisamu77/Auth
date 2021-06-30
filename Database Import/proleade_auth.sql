-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2021 at 04:32 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proleade_auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `parent` int(11) DEFAULT '0',
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `name`, `parent`, `description`, `image`) VALUES
(1, 'Accessories', NULL, 'acc descrption', '518-173-391.jpg'),
(7, 'computers3', NULL, 'partial list of Walker’s credits could make\r\nP.T. Barnum weak in the knees. He has\r\nproduced spectaculars for world’s fairs at New\r\nYork, Spokane, Knoxville and New Orleans, the\r\n1960 Winter Olympics at Squaw Valley, the 1980\r\nWinter Olympics at Lake Placid, half-time\r\nshows for three Super Bowls and 10 Pro Bowls,\r\ninaugurals for Presidents Nixon and Reagan,\r\nFourth of July shows at stadiums in seven U.S.\r\ncities, the finale to the film “The Music Man”\r\nand the opening ceremonies for Disneyland in', '244-16-414.jpg'),
(9, 'Taplets', NULL, 'fggfdgfdg', '146-556-109.jpg'),
(10, 'Phones', NULL, 'fggfdgfdg', '167-840-803.jpg'),
(11, 'Mics', NULL, 'tgfgfdgfd', '441-958-773.jpg'),
(12, 'Lenovo', 7, 'ffg gfd gf dg', '464-341-362.jpg'),
(13, 'Seri', 11, 'asdsa dsa da s', '287-513-833.jpg'),
(15, 'OCR', 9, 'sfdf dsf dsf ', '592-340-164.png'),
(16, 'sdfdsfsd', NULL, 'dsfsdfd sfds dsfsdf', '880-539-479.jpg'),
(17, 'Hp', 7, 'fdjk jskdh jkdshfjk dshfjk shdkjfhdsk jhfksjd', '710-941-702.jpg'),
(18, 'Comp', 7, 'djfhjk dshfkj shdkjf hsdkjh kfjsdh ', '5-227-684.jpg'),
(19, 'Dell', 7, 'dsfj hjksdh jkfhd jkhdsj ', '937-880-391.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `parent` int(11) DEFAULT '0',
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(5) NOT NULL,
  `sale-price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `name`, `parent`, `description`, `image`, `price`, `sale-price`) VALUES
(16, 'lumi11', 10, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur', '874-501-926.PNG', 55, 0),
(19, 'sam 2 ', 10, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur', '82-408-624.jpg', 43, 25),
(20, 'sam3', 10, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur', '959-692-771.jpg', 43, 0),
(21, 'sam4', 10, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur', '448-31-630.jpg', 33, 20),
(23, 'Hp Z112', 7, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur', '66-755-925.jpg', 12, 10),
(24, 'sjdhfkjsdh', NULL, 'fgdf fdjhgjfd hjgkfhd jkgh fjkdhgjkh kjhgfd kjhgjkfd hjkfd hkjg d', '711-628-439.PNG', 20, 15),
(25, 'new new new', 1, 'new description ', '441-729-98.PNG', 20, 14);

-- --------------------------------------------------------

--
-- Table structure for table `product_album`
--

CREATE TABLE `product_album` (
  `ID` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_album`
--

INSERT INTO `product_album` (`ID`, `product_id`, `image`) VALUES
(1, 25, '195-201-106.PNG'),
(2, 25, '510-923-818.PNG'),
(3, 25, '837-482-529.PNG'),
(4, 20, '273-715-401.jpg'),
(5, 20, '734-798-461.jpg'),
(6, 20, '958-726-585.jpg'),
(7, 20, '660-717-190.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `email` varchar(52) NOT NULL,
  `name` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(14) NOT NULL,
  `created_at` date NOT NULL,
  `created_by` int(5) DEFAULT NULL,
  `role` enum('user','admin','super-admin') DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `email`, `name`, `password`, `mobile`, `created_at`, `created_by`, `role`, `image`) VALUES
(1, 'admin@mail.com', 'islam ahmed', 'e10adc3949ba59abbe56e057f20f883e', '01122244555', '2021-06-14', 1, 'super-admin', ''),
(27, 'finance.mohmmed@proleadersco.com', 'mohamed ibrahim', 'e10adc3949ba59abbe56e057f20f883e', '01274410273', '2021-06-16', 1, 'super-admin', '129-567-349.jpg'),
(30, 'islam@mail.com', 'islam khamis', 'e10adc3949ba59abbe56e057f20f883e', '01122334455', '2021-06-16', 27, 'super-admin', '121-986-549.jpg'),
(36, 'delbar.othman@procallcenter.com', 'Mrs Delber', 'e10adc3949ba59abbe56e057f20f883e', '01274410271', '2021-06-16', 1, 'admin', '350-64-755.jpg'),
(37, 'alex2@mail.com', 'alex alex w', '202cb962ac59075b964b07152d234b70', '11121321321', '2021-06-16', 1, 'user', '445-524-573.jpg'),
(38, 'engy@mail.com', 'mrs engy', 'e10adc3949ba59abbe56e057f20f883e', '11111111111', '2021-06-16', 1, 'admin', '478-373-602.jpg'),
(47, 'user@yahoo.com', 'islam ahmed', 'e10adc3949ba59abbe56e057f20f883e', '12321321322', '2021-06-17', 1, 'user', '167-697-587.png'),
(60, 'islam.ahmedkh11@outlook.com', 'ramy ramy', 'e10adc3949ba59abbe56e057f20f883e', '11111322222', '0000-00-00', 1, 'user', '641-352-835.PNG'),
(61, 'finance.mohmmed1@proleadersco.com', 'avds ahmed', 'e10adc3949ba59abbe56e057f20f883e', '01274410275', '0000-00-00', 1, 'user', '34-783-242.PNG'),
(63, 'finance.mohmmed2@proleadersco.com', 'avds ahmed', 'e10adc3949ba59abbe56e057f20f883e', '01274410272', '0000-00-00', 1, 'user', '876-342-106.PNG'),
(66, 'finance.mohmmed5@proleadersco.com', 'avds ahmedd', 'd41d8cd98f00b204e9800998ecf8427e', '01274410276', '0000-00-00', 1, 'user', '887-733-902.png'),
(67, 'aklisamu77@gmail.com', 'ramy ramy', 'e10adc3949ba59abbe56e057f20f883e', '01274410443', '0000-00-00', 1, 'user', '689-541-645.jpg'),
(69, 'doaa.abdelftah@gmail.com', 'Doaa Abdelfatah', 'e10adc3949ba59abbe56e057f20f883e', '01225738514', '0000-00-00', 1, 'admin', '238-138-572.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `cat_parent_fk` (`parent`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `product_parent_fk` (`parent`);

--
-- Indexes for table `product_album`
--
ALTER TABLE `product_album`
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `image_product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_CreatedBy` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product_album`
--
ALTER TABLE `product_album`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `cat_parent_fk` FOREIGN KEY (`parent`) REFERENCES `category` (`ID`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_parent_fk` FOREIGN KEY (`parent`) REFERENCES `category` (`ID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `product_album`
--
ALTER TABLE `product_album`
  ADD CONSTRAINT `image_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`ID`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_CreatedBy` FOREIGN KEY (`created_by`) REFERENCES `users` (`ID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
