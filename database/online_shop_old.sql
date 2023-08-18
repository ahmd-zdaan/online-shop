-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2023 at 10:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
(3, 'Fashion'),
(4, 'Kitchen'),
(6, 'Books'),
(7, 'Household'),
(8, 'Smartphone & Tablet'),
(9, 'Sport'),
(11, 'Foods'),
(12, 'Beverages'),
(13, 'Pet'),
(14, 'PC and Laptop'),
(15, 'Gaming');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `code` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`, `code`) VALUES
(1, 'Indonesia', 'IDN'),
(2, 'Singapore', 'SIN'),
(3, 'Malaysia', 'MYS'),
(4, 'Australia', 'AUS'),
(5, 'Japan', 'JPN');

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE `discussion` (
  `discussion_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `user_id`, `product_id`, `quantity`, `date`) VALUES
(4, 16, 91, 3, '22-07-2023'),
(5, 16, 115, 1, '22-07-2023');

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
(25, 'Utopia Kitchen', 'utopia-kitchen'),
(26, 'Under Armour', 'under-armour'),
(27, 'General Mills', 'general-mills'),
(28, 'Nintendo', 'nintendo');

-- --------------------------------------------------------

--
-- Table structure for table `manifacturer_image`
--

CREATE TABLE `manifacturer_image` (
  `manifacturer_image_id` int(11) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `manifacturer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `manifacturer_id` int(11) NOT NULL,
  `variant` varchar(100) NOT NULL,
  `weight` float NOT NULL,
  `date` varchar(100) NOT NULL,
  `sold` int(11) NOT NULL,
  `report` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `seller_id`, `category_id`, `subcategory_id`, `price`, `stock`, `description`, `manifacturer_id`, `variant`, `weight`, `date`, `sold`, `report`) VALUES
(62, 'Adilette Aqua Slides', 28, 3, 5, 380000, 36, 'POST-SWIM SLIDES WITH ENHANCED CUSHIONING\r\nRinse off after the pool in these shower-friendly sandals. Keeping it simple, the smooth slip-ons reveal their adidas DNA with signature 3-Stripes. Soft cushioning rewards tired feet with plush comfort.\r\n\r\nSPECIFICATIONS :\r\n- Regular fit\r\n- One-piece moulded EVA upper\r\n- Soft Cloudfoam footbed\r\n- Product code: F35550\r\n- Slip-on construction\r\n- EVA outsole\r\n- Lightweight feel; Quick-drying material', 12, '1', 1, '14-07-2023', 4, 0),
(64, 'ADILS / LINNMON', 28, 7, 1, 579000, 36, 'Padu padankan pilihan permukaan meja dan kaki - atau pilih kombinasi yang siap pakai. Kuat dan ringan, dibuat dengan teknik yang menggunakan sedikit bahan mentah, mengurangi pengaruh negatif pada lingkungan.\r\n\r\nDaun meja\r\nAtas: Fibreboard, Cat akrilik\r\nRangka: Particleboard, Tepi plastik\r\nBahan pengisi: Isian kertas berstruktur sarang lebah (min. 70% didaur ulang)\r\nBawah: Fibreboard\r\nKaki\r\nBahan dasar: Baja, Dilapisi serbuk epoksi/poliester\r\nKaki: Plastik polipropilena', 18, '1', 2, '14-07-2023', 0, 0),
(70, 'Nike Air Force 1 \'07 LV8', 28, 3, 5, 1909000, 5, 'The radiance lives on in the Air Force 1 \'07 LV8. Crossing hardwood comfort with off-court flair, these kicks add a touch of crafty style to a hoops original. Mixed materials and era-echoing \'80s construction add nothing-but-net style.', 3, 'EU 39, EU 40, EU 41, EU 42, EU 43', 1, '14-07-2023', 0, 0),
(71, 'Nike Air Max Impact 4', 28, 3, 5, 1349000, 13, 'Elevate your game and your hops. Charged with Max Air cushioning in the heel, this lightweight, secure shoe helps you get off the ground confidently and land comfortably. Plus, rubber wraps up the sides for added durability and stability.', 3, 'EU 39, EU 40, EU 41, EU 42, EU 43', 1, '14-07-2023', 0, 0),
(80, 'Utopia Kitchen 11 Inch Nonstick Frying Pan', 28, 4, 17, 250000, 15, 'The wobble-free bakelite handle is ergonomically designed and riveted strongly to the pan so you can have a safe cooking experience without worrying about the handle getting loose ever\r\nThe induction bottom of the frying pan is suitable for all types of cooking; including electric and ceramic cook tops\r\nFormed with multi-layered nonstick and top rated aluminum alloy which is used for highly durable professional grade frying pans\r\nHigh quality nonstick interior allows for easier cooking and cleanup; PFOA, lead and Cadmium-free\r\nFor hand cleaning, first use a paper towel, wooden, or plastic spatula to remove off any loose food from the pan; then use a soft nylon scrubber, sponge, or paper towel sprinkled with a few drops of dish-washing soap to wipe the nonstick surface clean', 25, '1', 1, '14-07-2023', 0, 0),
(87, 'Hollyone Artificial Snake Plant Potted Faux Sansevieria Trifasciata Plants, 13', 28, 7, 1, 199000, 16, 'PREMIUM QUALITY\r\nRealistic artificial sansevieria plants are made of eco-friendly polyester material. Each fake Snake Plant with pot leaf is thick, upright, solid, has its own elegant arc, gives you a touch like a leathery. \"Hollyone\" brand assurance is worthy of your trust.\r\n\r\nPERFECT SIZE\r\nFaux snake plant height approximately: 13.2\", pots: 4.5\"W x 4.1\"H. Please read the measurement more attentively. It\'s a really good size for placing on a tabletop or on the floor. A matte white planter balances the sturdy leaves with the base of the plant, simulation soil makes it looks real enough.\r\n\r\nMAINTENANCE FREE\r\nDecorative 12 full leaves faux plants are a practical alternative to living plants. Our small fake snake plant artificial looks like you\'ve been babied it for years, but never need water or sun. The first choice of housewarming gift! Or present for your friends, family, and loved ones.', 18, '1', 0, '14-07-2023', 0, 0),
(91, 'Reese\'s Puffs', 28, 11, 22, 49000, 147, 'The perfect combination of chocolate and peanut butter flavor in every crunchy bite\r\nSweet and crunchy corn puffs made with real REESE\'S peanut butter\r\nKids breakfast food that provides 15 g of whole grains per serving (at least 48 g recommended daily)\r\nPour REESE\'S PUFFS into your bowl for an epic breakfast cereal or take along the whole box for a sweet and crunchy snack\r\nCONTAINS: 11.5 oz box', 27, '1', 0, '14-07-2023', 3, 0),
(115, 'Xbox Series S', 36, 15, 40, 6000000, 35, 'Experience next-gen speed and performance with our largest digital library yet. Enjoy more dynamic worlds, faster load times, and add Xbox Game Pass Ultimate (membership sold separately) to play new games on day one. Plus, enjoy hundreds of high-quality games like Minecraft, Forza Horizon 5, and Halo Infinite with friends on console, PC, and cloud.', 22, '1', 0, '21-07-2023', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_index` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `image_name`, `product_id`, `image_index`) VALUES
(27, '1683343410.jpg', 62, 1),
(29, '1683343673.jpg', 64, 1),
(34, '1684146099.png', 70, 1),
(35, '1684146152.png', 71, 1),
(37, '1686983118.jpg', 80, 1),
(68, '64a8105a30c81.jpg', 91, 1),
(69, '64a8105a9bbc3.jpg', 91, 2),
(72, '64ba907d088c4.jpg', 115, 1),
(73, '64ba907d168ce.jpg', 115, 2),
(74, '64ba907d24a22.jpg', 115, 3),
(75, '64ba907d361c5.jpg', 115, 4),
(76, '64ba907d4ae9c.jpg', 115, 5),
(77, '64ba907d539a9.jpg', 115, 6),
(95, '64c4b60336d42.jpg', 87, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(18, 62, 18, 3, '3 stars', '2023-06-21', 0),
(19, 64, 18, 1, '1 star', '2023-06-21', 0),
(103, 80, 18, 5, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ea omnis blanditiis aliquam ex quae! Consequuntur quia placeat fugiat deserunt, exercitationem minus maiores optio adipisci quidem consequatur quaerat veritatis officiis aliquid eos, magnam tenetur ducimus, nulla vel eveniet error. Vero error voluptas sed tenetur nam provident officiis hic consequatur non? Excepturieeeeeeeee', '30-06-2023', 0),
(105, 80, 16, 5, 'top', '15-07-2023', 0),
(107, 80, 18, 4, 'ok', '25-07-2023', 0),
(108, 115, 18, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum id architecto laboriosam. Cumque, nulla pariatur doloribus unde neque dolor quam ipsam labore asperiores suscipit minima, odio fugit consequuntur sapiente nostrum.', '27-07-2023', 0),
(109, 62, 16, 5, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Explicabo aspernatur unde cumque. Vel alias enim tenetur, vitae cumque minus provident nobis quasi expedita veniam deserunt illum eveniet illo, praesentium amet itaque placeat nostrum maxime? Tenetur repellat cumque architecto nobis in repellendus quasi inventore a corporis ullam! Molestiae totam beatae necessitatibus.', '29-07-2023', 0),
(110, 62, 17, 1, 'bad', '03-08-2023', 0),
(111, 62, 20, 5, 'best', '03-08-2023', 0),
(112, 62, 26, 4, 'Good! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cupiditate labore quaerat eum asperiores, provident nam fuga et minima molestiae, natus nemo, ipsa laboriosam in blanditiis. Ab consequatur cupiditate dolore vero.', '03-08-2023', 0);

-- --------------------------------------------------------

--
-- Table structure for table `review_helpful`
--

CREATE TABLE `review_helpful` (
  `review_helpful_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_image`
--

CREATE TABLE `review_image` (
  `review_image_id` int(11) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `review_id` int(11) NOT NULL,
  `image_index` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review_image`
--

INSERT INTO `review_image` (`review_image_id`, `image_name`, `review_id`, `image_index`) VALUES
(36, '64c4af3b842cc.jpg', 103, 1);

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
  `sale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `product_id`, `sale`) VALUES
(7, 80, 50);

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
(5, 'Shoes', 3),
(6, 'Bags', 3),
(11, 'Sandals', 3),
(12, 'Education', 6),
(14, 'Fantasy', 6),
(15, 'Comedy', 6),
(16, 'Cutlery', 4),
(17, 'Cooking', 4),
(18, 'Drinking Bottle', 9),
(22, 'Cereal', 11),
(23, 'Soft Drink', 12),
(24, 'Cats', 13),
(25, 'Birds', 13),
(26, 'Fish', 13),
(27, 'Dogs', 13),
(28, 'Smartphone', 8),
(29, 'Tablet', 8),
(31, 'PC', 14),
(32, 'Laptop', 14),
(33, 'Keyboard', 14),
(34, 'Mouse', 14),
(35, 'Mousepad', 14),
(36, 'PC Components', 14),
(40, 'Console', 15),
(41, 'Video Game', 15);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `country_id` int(11) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `role`, `email`, `password`, `address`, `country_id`, `postal_code`, `phone`) VALUES
(16, 'User1', 'user', 'user1@user.com', '$2y$10$GtYTk7dsgDr3W96pZDBUqO6DMkMCC3nIvhMkG9dnVKB.o94mj6/Ya', 'Jl. Jalan No. 0', 1, 65141, '8123456789'),
(17, 'User2', 'user', 'user2@user.com', '$2y$10$gZmQMloIoQtAoJ3NrgdMFOkn0zTNUpvNxo30G7GsRRd8z.mftZkBC', 'Jl. Jalan', 1, 0, '123'),
(18, 'Karisma', 'admin', 'karisma@karisma.com', '$2y$10$CKKJx7i5ZISxJQXoCcCAXuahHZLqNoBPyRLs66xIY.3cZ22i9V9hS', 'Jl. Watu Gong No.18, Ketawanggede, Kec. Lowokwaru, Kota Malang, Jawa Timur', 1, 65145, '8123456789'),
(20, 'User3', 'user', 'user3@user.com', '$2y$10$KlNwNC8ump/EPFjTuBM/GeCpkRNHZbXrNxXdlpx8C8Gdi.BQ/DJwW', 'Jl. Jalan no. 0', 1, 0, '8123456789'),
(26, 'User4', 'user', 'user4@user.com', '$2y$10$JMzYAe7TQ2tAuTFT395M4OPxHVNZRkd3xfmMikQ.NV0mm42mIF2xq', 'Jl. Jalan', 1, 0, '12312323212'),
(28, 'Seller1', 'seller', 'seller1@seller.com', '$2y$10$dhswu6xxr8joZ60Uq4VCJu/AI9OZoKZqFBRXnIXLILUQguWmKM3D.', 'Jl. Jalan Jalan Aja', 2, 12345, '123123123132'),
(36, 'Seller2', 'seller', 'seller2@seller.com', '$2y$10$d4vPchrNLLy6hITA1pUkU.9/YQt8VHku0YDNXCWCbdaGhgiEFoET.', 'Jl. Dasan Pesawat', 1, 1234, '08123456789');

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
(20, '1686815359.png', 18),
(22, '1691048376.jpg', 20),
(23, '1691048799.jpg', 26);

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
  ADD KEY `fk_discussion_user_id` (`user_id`),
  ADD KEY `fk_discussion_seller_id` (`seller_id`);

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
-- Indexes for table `manifacturer_image`
--
ALTER TABLE `manifacturer_image`
  ADD PRIMARY KEY (`manifacturer_image_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_manifacturer_id_id` (`manifacturer_id`),
  ADD KEY `fk_subcategory_id_subcategory_id` (`subcategory_id`),
  ADD KEY `fk_product_category_id_category_id` (`category_id`),
  ADD KEY `fl_product_seller_id` (`seller_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_image_product_id_product_id` (`product_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_product_order_user_id` (`user_id`),
  ADD KEY `fk_product_order_product_id` (`product_id`);

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
-- Indexes for table `review_helpful`
--
ALTER TABLE `review_helpful`
  ADD PRIMARY KEY (`review_helpful_id`),
  ADD KEY `fk_review_helpful_user_id` (`user_id`),
  ADD KEY `fk_review_helpful_review_id` (`review_id`);

--
-- Indexes for table `review_image`
--
ALTER TABLE `review_image`
  ADD PRIMARY KEY (`review_image_id`),
  ADD KEY `fk_review_image_review_id` (`review_id`);

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
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `fk_transaction_user_id` (`user_id`),
  ADD KEY `fk_transaction_product_id` (`product_id`);

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
  ADD KEY `fk_wishlist_user_id_id` (`user_id`),
  ADD KEY `fk_wishlist_product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `discussion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `manifacturer`
--
ALTER TABLE `manifacturer`
  MODIFY `manifacturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `manifacturer_image`
--
ALTER TABLE `manifacturer_image`
  MODIFY `manifacturer_image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_report`
--
ALTER TABLE `product_report`
  MODIFY `product_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `review_helpful`
--
ALTER TABLE `review_helpful`
  MODIFY `review_helpful_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `review_image`
--
ALTER TABLE `review_image`
  MODIFY `review_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `review_report`
--
ALTER TABLE `review_report`
  MODIFY `review_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user_image`
--
ALTER TABLE `user_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
  ADD CONSTRAINT `fk_discussion_seller_id` FOREIGN KEY (`seller_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `fk_subcategory_id_subcategory_id` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`subcategory_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fl_product_seller_id` FOREIGN KEY (`seller_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `fk_product_image_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `fk_product_order_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_order_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `review_helpful`
--
ALTER TABLE `review_helpful`
  ADD CONSTRAINT `fk_review_helpful_review_id` FOREIGN KEY (`review_id`) REFERENCES `review` (`review_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_review_helpful_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review_image`
--
ALTER TABLE `review_image`
  ADD CONSTRAINT `fk_review_image_review_id` FOREIGN KEY (`review_id`) REFERENCES `review` (`review_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `fk_transaction_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaction_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_wishlist_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `fk_wishlist_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
