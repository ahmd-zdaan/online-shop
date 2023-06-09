-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2023 at 09:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_shop`
--

DROP DATABASE IF EXISTS online_shop;
CREATE DATABASE IF NOT EXISTS online_shop;
USE online_shop;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`) VALUES
(78, 18, 60, 1),
(82, 18, 69, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Electronics'),
(2, 'Gaming'),
(3, 'Fashion'),
(4, 'Kitchen'),
(6, 'Books'),
(7, 'Household'),
(8, 'Smartphone & Tablet');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'Indonesia'),
(2, 'Singapore');

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE `discussion` (
  `discussion_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `discussion` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `user_id`, `product_id`, `date`) VALUES
(2, 18, 60, '14-06-2023');

-- --------------------------------------------------------

--
-- Table structure for table `manifacturer`
--

CREATE TABLE `manifacturer` (
  `manifacturer_id` int(11) NOT NULL,
  `manifacturer_name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manifacturer`
--

INSERT INTO `manifacturer` (`manifacturer_id`, `manifacturer_name`, `slug`) VALUES
(3, 'Nike', 'nike'),
(12, 'Adidas', 'adidas'),
(15, 'SONY', 'sony'),
(18, 'IKEA', 'ikea'),
(20, 'Canon', 'canon'),
(21, 'Karisma', 'karisma'),
(22, 'Microsoft', 'microsoft'),
(25, 'Utopia Kitchen', 'utopia-kitchen');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `manifacturer_id` int(11) NOT NULL,
  `variant` varchar(100) NOT NULL,
  `weight` float NOT NULL,
  `report` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `category_id`, `subcategory_id`, `price`, `stock`, `sold`, `description`, `manifacturer_id`, `variant`, `weight`, `report`) VALUES
(60, 'PlayStation 4', 2, 3, '3999000', 1, 3, 'RPlay Play-Station 4 PS4 1TB Slim Edition Jet Black With 1 Wireless Controller', 15, '1', 0.7, 4),
(62, 'Adilette Aqua Slides', 3, 11, '390000', 5, 2, '1', 12, '1', 1, 0),
(64, 'ADILS / LINNMON', 7, 1, '579000', 3, 0, 'tabl', 18, '1', 2, 0),
(66, 'Canon EOS Rebel T7 DSLR', 1, 13, '5799000', 9, 0, 'Canon EOS Rebel T7 DSLR Camera with 18-55mm Lens | Built-in Wi-Fi | 24.1 MP CMOS Sensor | DIGIC 4+ Image Processor and Full HD Videos', 20, '1', 1, 0),
(68, 'Belajar PHP', 6, 12, '49000', 31, 0, 'Belajar PHP', 21, '1', 0, 0),
(69, 'Xbox Series S', 2, 3, '389000', 3, 1, '- Go all digital with Xbox Series S and experience next-gen speed and performance at a great price.\r\n- Bundle includes: Xbox Series S console, one Xbox Wireless Controller, a high-speed HDMI cable, power cable, and 2 AA batteries.\r\n- Make the most of every gaming minute with Quick Resume, lightning-fast load times, and gameplay of up to 120 FPS—all powered by Xbox Velocity Architecture.\r\n- Enjoy digital games from four generations of Xbox, with hundreds of optimized titles that look and play better than ever.\r\n- Add Xbox Game Pass Ultimate (membership sold separately) to play new games day one. Enjoy hundreds of high-quality games with friends on console, PC, and cloud. Plus, now you can skip the install and jump in with cloud gaming.\r\n- Hardware-accelerated ray tracing gives your games a heightened level of realism. Bring your games and movies to life with advanced 3D Spatial Sound, which produces rich, dynamic audio environments.', 22, '1', 1, 0),
(70, 'Nike Air Force 1 \'07 LV8', 3, 5, '1909000', 5, 0, 'The radiance lives on in the Air Force 1 \'07 LV8. Crossing hardwood comfort with off-court flair, these kicks add a touch of crafty style to a hoops original. Mixed materials and era-echoing \'80s construction add nothing-but-net style.', 3, 'EU 39, EU 40, EU 41, EU 42, EU 43', 1, 0),
(71, 'Nike Air Max Impact 4', 3, 5, '1349000', 13, 0, 'Elevate your game and your hops. Charged with Max Air cushioning in the heel, this lightweight, secure shoe helps you get off the ground confidently and land comfortably. Plus, rubber wraps up the sides for added durability and stability.', 3, 'EU 39, EU 40, EU 41, EU 42, EU 43', 1, 0),
(80, 'Utopia Kitchen 11 Inch Nonstick Frying Pan', 4, 17, '250000', 15, 0, 'The wobble-free bakelite handle is ergonomically designed and riveted strongly to the pan so you can have a safe cooking experience without worrying about the handle getting loose ever\r\nThe induction bottom of the frying pan is suitable for all types of cooking; including electric and ceramic cook tops\r\nFormed with multi-layered nonstick and top rated aluminum alloy which is used for highly durable professional grade frying pans\r\nHigh quality nonstick interior allows for easier cooking and cleanup; PFOA, lead and Cadmium-free\r\nFor hand cleaning, first use a paper towel, wooden, or plastic spatula to remove off any loose food from the pan; then use a soft nylon scrubber, sponge, or paper towel sprinkled with a few drops of dish-washing soap to wipe the nonstick surface clean', 25, '1', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `image_name`, `product_id`) VALUES
(26, '1683340528.jpg', 60),
(27, '1683343410.jpg', 62),
(29, '1683343673.jpg', 64),
(31, '1683348283.jpg', 68),
(32, '1683954755.jpg', 66),
(33, '1683955244.jpg', 69),
(34, '1684146099.png', 70),
(35, '1684146152.png', 71),
(37, '1686983118.jpg', 80);

-- --------------------------------------------------------

--
-- Table structure for table `product_report`
--

CREATE TABLE `product_report` (
  `product_report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `report` longtext NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_report`
--

INSERT INTO `product_report` (`product_report_id`, `user_id`, `product_id`, `report`, `date`) VALUES
(7, 18, 60, 'okoko', '19-06-2023');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` longtext NOT NULL,
  `date` varchar(100) NOT NULL,
  `report` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `product_id`, `user_id`, `rating`, `review`, `date`, `report`) VALUES
(14, 60, 18, 5, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iure vitae debitis soluta quidem ab esse inventore? Impedit soluta, sit enim optio possimus iusto unde laudantium, quia vitae facere laboriosam praesentium!', '17-05-2023', 0),
(15, 60, 16, 1, 'badbabadbadb', '17-05-2023', 2),
(17, 60, 18, 5, 'best', '03-06-2023', 0);

-- --------------------------------------------------------

--
-- Table structure for table `review_image`
--

CREATE TABLE `review_image` (
  `review_image_id` int(11) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `review_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_report`
--

CREATE TABLE `review_report` (
  `review_report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `report` longtext NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sale` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `product_id`, `sale`) VALUES
(4, 62, '50%'),
(5, 60, '5%');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcategory_id`, `subcategory_name`, `category_id`) VALUES
(1, 'Furniture', 7),
(2, 'Decoration', 7),
(3, 'Console', 2),
(5, 'Shoes', 3),
(6, 'Bags', 3),
(10, 'Audio', 1),
(11, 'Sandals', 3),
(12, 'Education', 6),
(13, 'Camera', 1),
(14, 'Fantasy', 6),
(15, 'Comedy', 6),
(16, 'Cutlery', 4),
(17, 'Cooking', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `country_id` int(11) NOT NULL,
  `telephone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `role`, `user_name`, `email`, `password`, `address`, `country_id`, `telephone`) VALUES
(16, '', 'User1', 'user1@user.com', '$2y$10$GtYTk7dsgDr3W96pZDBUqO6DMkMCC3nIvhMkG9dnVKB.o94mj6/Ya', 'Jl. Jalan No. 0', 1, '123'),
(17, '', 'User2', 'user2@user.com', '$2y$10$gZmQMloIoQtAoJ3NrgdMFOkn0zTNUpvNxo30G7GsRRd8z.mftZkBC', 'Jl. Jalan', 1, '123'),
(18, 'admin', 'Karisma', 'karisma@karisma.com', '$2y$10$CKKJx7i5ZISxJQXoCcCAXuahHZLqNoBPyRLs66xIY.3cZ22i9V9hS', 'Jl. Watu Gong No.18, Ketawanggede, Kec. Lowokwaru, Kota Malang, Jawa Timur 65145', 1, '123'),
(20, '', 'User3', 'user3@gmail.com', '$2y$10$KlNwNC8ump/EPFjTuBM/GeCpkRNHZbXrNxXdlpx8C8Gdi.BQ/DJwW', 'Jl. Jalan no. 0', 1, '08123456789'),
(26, 'user', 'User4', 'user4@user.com', '$2y$10$JMzYAe7TQ2tAuTFT395M4OPxHVNZRkd3xfmMikQ.NV0mm42mIF2xq', 'Jl. Jalan', 1, '12312323212');

-- --------------------------------------------------------

--
-- Table structure for table `user_image`
--

CREATE TABLE `user_image` (
  `id` int(11) NOT NULL,
  `user_image` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_image`
--

INSERT INTO `user_image` (`id`, `user_image`, `user_id`) VALUES
(18, '1684313889.png', 16),
(20, '1686815359.png', 18);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_cart_product_id` (`product_id`),
  ADD KEY `fk_cart_user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`discussion_id`),
  ADD KEY `fk_discussion_product_id` (`product_id`),
  ADD KEY `fk_discussion_user_id` (`user_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `fk_history_user_id` (`user_id`),
  ADD KEY `fk_history_product_id` (`product_id`);

--
-- Indexes for table `manifacturer`
--
ALTER TABLE `manifacturer`
  ADD PRIMARY KEY (`manifacturer_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_manifacturer_id_id` (`manifacturer_id`),
  ADD KEY `fk_subcategory_id_subcategory_id` (`subcategory_id`),
  ADD KEY `fk_product_category_id_category_id` (`category_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_image_product_id_product_id` (`product_id`);

--
-- Indexes for table `product_report`
--
ALTER TABLE `product_report`
  ADD PRIMARY KEY (`product_report_id`),
  ADD KEY `fk_product_report_product_id` (`product_id`),
  ADD KEY `fk_product_report_user_id` (`user_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_user_id_id` (`user_id`),
  ADD KEY `fk_product_id_id` (`product_id`);

--
-- Indexes for table `review_image`
--
ALTER TABLE `review_image`
  ADD PRIMARY KEY (`review_image_id`);

--
-- Indexes for table `review_report`
--
ALTER TABLE `review_report`
  ADD PRIMARY KEY (`review_report_id`),
  ADD KEY `fk_review_report_review_id` (`review_id`),
  ADD KEY `fk_review_report_user_id` (`user_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sale_product_id` (`product_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD KEY `fk_category_id_category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_country_id_id` (`country_id`);

--
-- Indexes for table `user_image`
--
ALTER TABLE `user_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_image_user_id_user_id` (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `fk_wishlist_user_id_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `discussion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manifacturer`
--
ALTER TABLE `manifacturer`
  MODIFY `manifacturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `product_report`
--
ALTER TABLE `product_report`
  MODIFY `product_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `review_image`
--
ALTER TABLE `review_image`
  MODIFY `review_image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review_report`
--
ALTER TABLE `review_report`
  MODIFY `review_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_image`
--
ALTER TABLE `user_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discussion`
--
ALTER TABLE `discussion`
  ADD CONSTRAINT `fk_discussion_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_discussion_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_history_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_manifacturer_id_id` FOREIGN KEY (`manifacturer_id`) REFERENCES `manifacturer` (`manifacturer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_category_id_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_subcategory_id_subcategory_id` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`subcategory_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `fk_product_image_product_id_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_report`
--
ALTER TABLE `product_report`
  ADD CONSTRAINT `fk_product_report_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_report_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_product_id_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review_report`
--
ALTER TABLE `review_report`
  ADD CONSTRAINT `fk_review_report_review_id` FOREIGN KEY (`review_id`) REFERENCES `review` (`review_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_review_report_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `fk_sale_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `fk_category_id_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_country_id_id` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_image`
--
ALTER TABLE `user_image`
  ADD CONSTRAINT `fk_user_image_user_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_wishlist_user_id_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
