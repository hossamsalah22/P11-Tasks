-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2021 at 12:21 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task5-ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `street` varchar(100) NOT NULL,
  `building` varchar(100) NOT NULL,
  `flat` tinyint(3) NOT NULL,
  `floor` tinyint(2) NOT NULL,
  `notes` mediumtext DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `building`, `flat`, `floor`, `notes`, `user_id`, `region_id`, `created_at`, `updated_at`) VALUES
(1, 'P.O. Box 645, 5228 Molestie Street', 'Cras interdum. Nunc sollicitudin', 4, 5, NULL, 14, 2, '2021-10-22 14:32:28', '2021-10-22 14:32:28'),
(2, '592-9815 Facilisis Av.', 'pede et risus. Quisque', 9, 7, NULL, 33, 3, '2021-10-22 14:32:28', '2021-10-22 14:32:28'),
(3, 'Ap #379-9758 Enim Avenue', 'in faucibus orci luctus', 4, 7, NULL, 26, 7, '2021-10-22 14:32:28', '2021-10-22 14:32:28'),
(4, '854-1543 Sed Ave', 'Donec egestas. Duis ac', 1, 7, NULL, 28, 4, '2021-10-22 14:32:28', '2021-10-22 14:32:28'),
(5, '4257 Arcu. St.', 'dolor vitae dolor. Donec', 6, 10, NULL, 19, 1, '2021-10-22 14:32:28', '2021-10-22 14:32:28'),
(6, '605 Aenean Rd.', 'cursus et, eros. Proin', 4, 9, NULL, 34, 7, '2021-10-22 14:32:28', '2021-10-22 14:32:28'),
(7, '4973 Nibh St.', 'consequat nec, mollis vitae,', 3, 6, NULL, 19, 8, '2021-10-22 14:32:28', '2021-10-22 14:32:28'),
(8, '793-2765 Arcu Ave', 'Nunc pulvinar arcu et', 8, 6, NULL, 19, 8, '2021-10-22 14:32:28', '2021-10-22 14:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(100) NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `image` varchar(20) NOT NULL DEFAULT 'default.jpg',
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=>notAvailable\r\n1=>Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name_ar`, `name_en`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'أبل', 'Apple', 'apple.png', '1', '2021-10-20 17:49:54', '2021-10-20 18:06:29'),
(2, 'اتش بي', 'hp', 'hp.png', '1', '2021-10-20 17:51:40', '2021-10-20 18:06:37'),
(3, 'اسوس', 'asus', 'asus.jpg', '1', '2021-10-20 17:51:40', '2021-10-20 18:06:43'),
(4, 'الدمياطي', 'el-domiaty', 'default.jpg', '1', '2021-10-22 12:25:19', '2021-10-22 12:25:19'),
(5, 'نارس', 'NARS', 'default.jpg', '1', '2021-10-22 12:25:19', '2021-10-22 12:28:18'),
(6, 'تايجر', 'tiger', 'tiger.jpg', '1', '2021-10-22 12:48:43', '2021-10-22 12:48:43');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` tinyint(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(100) NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `image` varchar(20) NOT NULL DEFAULT 'default.jpg',
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=>notAvailable\r\n1=>Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_ar`, `name_en`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'الكترونيات', 'electronics', 'default.jpg', '1', '2021-10-20 17:52:19', '2021-10-20 17:54:56'),
(2, 'طعام', 'food', 'default.jpg', '1', '2021-10-20 17:54:20', '2021-10-20 17:55:10'),
(3, 'ملابس', 'clothes', 'default.jpg', '1', '2021-10-20 17:54:20', '2021-10-20 20:06:42'),
(5, 'عناية بالبشرة', 'skin care', 'default.jpg', '1', '2021-10-20 17:54:20', '2021-10-20 17:59:09');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(100) NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=> not Available ,\r\n1=> Avaialable',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name_ar`, `name_en`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Leganés', 'Leganés', '1', '2021-10-22 14:18:58', '2021-10-22 14:18:58'),
(2, 'Ceuta', 'Ceuta', '1', '2021-10-22 14:18:58', '2021-10-22 14:18:58'),
(3, 'Goulburn', 'Goulburn', '1', '2021-10-22 14:18:58', '2021-10-22 14:18:58'),
(4, 'Ollagüe', 'Ollagüe', '1', '2021-10-22 14:18:58', '2021-10-22 14:18:58'),
(5, 'San Pedro de Atacama', 'San Pedro de Atacama', '1', '2021-10-22 14:18:58', '2021-10-22 14:18:58'),
(6, 'Heidelberg', 'Heidelberg', '1', '2021-10-22 14:18:58', '2021-10-22 14:18:58'),
(7, 'Märsta', 'Märsta', '1', '2021-10-22 14:18:58', '2021-10-22 14:18:58'),
(8, 'Kano', 'Kano', '1', '2021-10-22 14:18:58', '2021-10-22 14:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(8) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `discount` tinyint(3) NOT NULL,
  `discount_type` enum('%','EGP') NOT NULL,
  `max_user_usage` tinyint(2) NOT NULL DEFAULT 1,
  `max_usage_count` tinyint(2) NOT NULL DEFAULT 1,
  `mini_order_price` float(7,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coupons_products`
--

CREATE TABLE `coupons_products` (
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coupons_users`
--

CREATE TABLE `coupons_users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(100) NOT NULL,
  `title_en` varchar(100) NOT NULL,
  `desc_ar` longtext NOT NULL,
  `desc_en` longtext NOT NULL,
  `image` varchar(20) NOT NULL DEFAULT 'default.png',
  `discount` int(3) NOT NULL,
  `discount_type` enum('%','EGP') NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `title_ar`, `title_en`, `desc_ar`, `desc_en`, `image`, `discount`, `discount_type`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'العرض 1', 'Offer 1', 'لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.\r\n\r\nو سأعرض مثال حي لهذا، من منا لم يتحمل جهد بدني شاق إلا من أجل الحصول على ميزة أو فائدة؟ ولكن من لديه الحق أن ينتقد شخص ما أراد أن يشعر بالسعادة التي لا تشوبها عواقب أليمة أو آخر أراد أن يتجنب الألم الذي ربما تنجم عنه بعض المتعة ؟ \r\nعلي الجانب الآخر نشجب ونستنكر هؤلاء الرجال المفتونون بنشوة اللحظة الهائمون في رغباتهم فلا يدركون ما يعقبها من الألم والأسي المحتم، واللوم كذلك يشمل هؤلاء الذين أخفقوا في واجباتهم نتيجة لضعف إرادتهم فيتساوي مع هؤلاء الذين يتجنبون وينأون عن تحمل الكدح والألم .\r\n	       ', 'Sed eu nibh vulputate mauris sagittis placerat. Cras dictum ultricies ligula. Nullam enim. Sed nulla ante, iaculis nec, eleifend non, dapibus rutrum, justo. Praesent luctus. Curabitur egestas nunc sed libero. Proin sed turpis nec mauris blandit mattis. Cras eget nisi dictum augue malesuada malesuada. Integer id magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo hendrerit. Donec porttitor tellus non magna. Nam ligula elit, pretium et, rutrum non, hendrerit id, ante. Nunc mauris sapien, cursus in, hendrerit consectetuer, cursus et, magna. Praesent interdum ligula eu enim. Etiam imperdiet dictum magna. Ut tincidunt orci quis lectus. Nullam suscipit, est ac facilisis facilisis, magna tellus faucibus leo, in lobortis tellus justo sit amet nulla. Donec non justo. Proin non massa non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus urna convallis erat, eget tincidunt dui augue eu tellus. Phasellus elit pede, malesuada', 'electronic.jpg', 22, '%', '2021-10-22', '2021-11-01', '2021-10-22 17:11:37', '2021-10-22 20:20:21'),
(2, 'العرض 2', 'Offer 2', 'لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.\r\n\r\nو سأعرض مثال حي لهذا، من منا لم يتحمل جهد بدني شاق إلا من أجل الحصول على ميزة أو فائدة؟ ولكن من لديه الحق أن ينتقد شخص ما أراد أن يشعر بالسعادة التي لا تشوبها عواقب أليمة أو آخر أراد أن يتجنب الألم الذي ربما تنجم عنه بعض المتعة ؟ \r\nعلي الجانب الآخر نشجب ونستنكر هؤلاء الرجال المفتونون بنشوة اللحظة الهائمون في رغباتهم فلا يدركون ما يعقبها من الألم والأسي المحتم، واللوم كذلك يشمل هؤلاء الذين أخفقوا في واجباتهم نتيجة لضعف إرادتهم فيتساوي مع هؤلاء الذين يتجنبون وينأون عن تحمل الكدح والألم .\r\n	       ', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravida non, sollicitudin a, malesuada id, erat. Etiam vestibulum massa rutrum magna. Cras convallis convallis dolor. Quisque tincidunt pede ac urna. Ut tincidunt vehicula risus. Nulla eget metus eu erat semper rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus libero mauris, aliquam eu, accumsan sed, facilisis vitae, orci. Phasellus dapibus quam quis diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce aliquet magna a neque. Nullam ut nisi a odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio. Nam interdum enim non nisi. Aenean eget metus. In nec orci. Donec nibh. Quisque nonummy ipsum non arcu.', 'food.jpg', 40, '%', '2021-10-22', '2021-11-01', '2021-10-22 17:11:37', '2021-10-22 20:18:59'),
(3, 'العرض 3', 'Offer 3', 'لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.\r\n\r\nو سأعرض مثال حي لهذا، من منا لم يتحمل جهد بدني شاق إلا من أجل الحصول على ميزة أو فائدة؟ ولكن من لديه الحق أن ينتقد شخص ما أراد أن يشعر بالسعادة التي لا تشوبها عواقب أليمة أو آخر أراد أن يتجنب الألم الذي ربما تنجم عنه بعض المتعة ؟ \r\nعلي الجانب الآخر نشجب ونستنكر هؤلاء الرجال المفتونون بنشوة اللحظة الهائمون في رغباتهم فلا يدركون ما يعقبها من الألم والأسي المحتم، واللوم كذلك يشمل هؤلاء الذين أخفقوا في واجباتهم نتيجة لضعف إرادتهم فيتساوي مع هؤلاء الذين يتجنبون وينأون عن تحمل الكدح والألم .\r\n	       ', 'lacus pede sagittis augue, eu tempor erat neque non quam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam fringilla cursus purus. Nullam scelerisque neque sed sem egestas blandit. Nam nulla magna, malesuada vel, convallis in, cursus et, eros. Proin ultrices. Duis volutpat nunc sit amet metus. Aliquam erat volutpat. Nulla facilisis. Suspendisse commodo tincidunt nibh. Phasellus nulla. Integer vulputate, risus a ultricies adipiscing, enim mi tempor lorem, eget mollis lectus pede et risus. Quisque libero lacus, varius et, euismod et, commodo at, libero. Morbi accumsan laoreet ipsum. Curabitur consequat, lectus sit amet luctus vulputate, nisi sem semper erat, in consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum accumsan neque et nunc. Quisque ornare tortor at risus. Nunc ac sem ut dolor dapibus gravida. Aliquam tincidunt, nunc ac mattis ornare, lectus ante dictum mi, ac mattis velit justo nec ante. Maecenas mi felis, adipiscing fringilla,', 'default.jpg', 20, '%', '2021-10-22', '2021-11-01', '2021-10-22 17:11:37', '2021-10-22 20:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `offers_products`
--

CREATE TABLE `offers_products` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `price` float(7,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers_products`
--

INSERT INTO `offers_products` (`product_id`, `offer_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 91.00, '2021-10-22 18:10:45', '2021-10-22 18:10:45'),
(2, 1, 102.00, '2021-10-22 18:10:45', '2021-10-22 18:10:45'),
(3, 1, 214.00, '2021-10-22 18:10:45', '2021-10-22 18:10:45'),
(4, 2, 8.00, '2021-10-22 18:10:45', '2021-10-22 18:21:49'),
(5, 2, 204.00, '2021-10-22 18:10:45', '2021-10-22 21:32:49'),
(6, 1, 126.00, '2021-10-22 18:10:45', '2021-10-22 18:10:45'),
(6, 3, 147.00, '2021-10-22 18:10:45', '2021-10-22 18:10:45');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=>notDelivered\r\n1=>Delivered',
  `deliver_date` timestamp NULL DEFAULT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status`, `deliver_date`, `address_id`, `coupon_id`, `created_at`, `updated_at`) VALUES
(1, '1', '2021-10-22 14:41:57', 5, NULL, '2021-10-22 14:41:57', '2021-10-22 14:41:57'),
(2, '1', '2021-10-22 14:41:57', 6, NULL, '2021-10-22 14:41:57', '2021-10-22 14:41:57'),
(3, '1', '2021-10-22 14:41:57', 7, NULL, '2021-10-22 14:41:57', '2021-10-22 14:41:57'),
(4, '1', '2021-10-22 14:41:57', 3, NULL, '2021-10-22 14:41:57', '2021-10-22 14:41:57'),
(5, '1', '2021-10-22 14:41:57', 7, NULL, '2021-10-22 14:41:57', '2021-10-22 14:41:57'),
(6, '1', '2021-10-22 14:41:57', 3, NULL, '2021-10-22 14:41:57', '2021-10-22 14:41:57'),
(7, '1', '2021-10-22 14:41:57', 7, NULL, '2021-10-22 14:41:57', '2021-10-22 14:41:57'),
(8, '1', '2021-10-22 14:41:57', 4, NULL, '2021-10-22 14:41:57', '2021-10-22 14:41:57'),
(9, '1', '2021-10-22 14:41:57', 2, NULL, '2021-10-22 14:41:57', '2021-10-22 14:41:57'),
(10, '1', '2021-10-22 14:41:57', 6, NULL, '2021-10-22 14:41:57', '2021-10-22 14:41:57'),
(11, '1', '2021-10-22 14:41:57', 3, NULL, '2021-10-22 14:41:57', '2021-10-22 14:41:57'),
(12, '1', '2021-10-22 14:41:57', 7, NULL, '2021-10-22 14:41:57', '2021-10-22 14:41:57'),
(13, '1', '2021-10-22 14:41:57', 6, NULL, '2021-10-22 14:41:57', '2021-10-22 14:41:57'),
(14, '1', '2021-10-22 14:41:57', 8, NULL, '2021-10-22 14:41:57', '2021-10-22 14:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` tinyint(2) NOT NULL DEFAULT 1,
  `price` float(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`product_id`, `order_id`, `quantity`, `price`) VALUES
(1, 1, 2, 7090.00),
(1, 12, 11, 1863.00),
(2, 12, 11, 5181.00),
(2, 13, 7, 5819.00),
(4, 4, 17, 603.00),
(4, 9, 10, 2556.00),
(5, 6, 10, 716.00),
(5, 7, 22, 8071.00),
(5, 13, 24, 6720.00),
(5, 14, 21, 9969.00),
(6, 4, 6, 9951.00),
(6, 5, 28, 3365.00),
(6, 7, 8, 6847.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(100) NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `price` float(7,2) NOT NULL,
  `image` varchar(20) NOT NULL DEFAULT 'default.jpg',
  `desc_ar` longtext NOT NULL,
  `desc_en` longtext NOT NULL,
  `quantity` smallint(4) NOT NULL DEFAULT 1,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=>notAvailable\r\n1=>Available',
  `views` int(6) DEFAULT 0,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name_ar`, `name_en`, `price`, `image`, `desc_ar`, `desc_en`, `quantity`, `status`, `views`, `subcategory_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(1, ' 15 اتش بي بافليون', 'hp pavilion 15', 50000.00, 'hp-pavilion.jpg', 'لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.\r\n\r\nو سأعرض مثال حي لهذا، من منا لم يتحمل جهد بدني شاق إلا من أجل الحصول على ميزة أو فائدة؟ ولكن من لديه الحق أن ينتقد شخص ما أراد أن يشعر بالسعادة التي لا تشوبها عواقب أليمة أو آخر أراد أن يتجنب الألم الذي ربما تنجم عنه بعض المتعة ؟ \r\nعلي الجانب الآخر نشجب ونستنكر هؤلاء الرجال المفتونون بنشوة اللحظة الهائمون في رغباتهم فلا يدركون ما يعقبها من الألم والأسي المحتم، واللوم كذلك يشمل هؤلاء الذين أخفقوا في واجباتهم نتيجة لضعف إرادتهم فيتساوي مع هؤلاء الذين يتجنبون وينأون عن تحمل الكدح والألم .\r\n	       ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam exercitationem dicta earum vero assumenda? Cum fugiat, sapiente atque rem possimus assumenda porro provident debitis deserunt nemo corporis quam quisquam quo nam, vero minus illum iste ipsam, quis sed sunt nisi consectetur recusandae. Quas laborum cupiditate delectus enim dicta nobis, cum doloribus commodi, perferendis sapiente adipisci repellendus iure maxime hic soluta, officiis non. Ipsam nemo ut aspernatur ab molestias aliquid facere ex possimus. Praesentium dolores ut exercitationem. Quasi incidunt laborum eos totam unde iure facere est ipsam tempora, itaque repellat excepturi voluptatibus optio dicta accusantium minus nihil! Amet ratione molestiae velit?', 10, '1', 43, 2, 2, '2021-10-20 18:01:31', '2021-10-22 22:03:28'),
(2, 'ماك بوك', 'Mac Book Pro', 25000.00, 'macbook-pro.jpg', 'لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.\r\n\r\nو سأعرض مثال حي لهذا، من منا لم يتحمل جهد بدني شاق إلا من أجل الحصول على ميزة أو فائدة؟ ولكن من لديه الحق أن ينتقد شخص ما أراد أن يشعر بالسعادة التي لا تشوبها عواقب أليمة أو آخر أراد أن يتجنب الألم الذي ربما تنجم عنه بعض المتعة ؟ \r\nعلي الجانب الآخر نشجب ونستنكر هؤلاء الرجال المفتونون بنشوة اللحظة الهائمون في رغباتهم فلا يدركون ما يعقبها من الألم والأسي المحتم، واللوم كذلك يشمل هؤلاء الذين أخفقوا في واجباتهم نتيجة لضعف إرادتهم فيتساوي مع هؤلاء الذين يتجنبون وينأون عن تحمل الكدح والألم .\r\n	       ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam exercitationem dicta earum vero assumenda? Cum fugiat, sapiente atque rem possimus assumenda porro provident debitis deserunt nemo corporis quam quisquam quo nam, vero minus illum iste ipsam, quis sed sunt nisi consectetur recusandae. Quas laborum cupiditate delectus enim dicta nobis, cum doloribus commodi, perferendis sapiente adipisci repellendus iure maxime hic soluta, officiis non. Ipsam nemo ut aspernatur ab molestias aliquid facere ex possimus. Praesentium dolores ut exercitationem. Quasi incidunt laborum eos totam unde iure facere est ipsam tempora, itaque repellat excepturi voluptatibus optio dicta accusantium minus nihil! Amet ratione molestiae velit?', 5, '1', 7, 2, 1, '2021-10-20 18:01:31', '2021-10-22 22:04:53'),
(3, 'بريداتور', 'asus Predator', 33000.00, 'asus-predator.jpg', 'لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.\r\n\r\nو سأعرض مثال حي لهذا، من منا لم يتحمل جهد بدني شاق إلا من أجل الحصول على ميزة أو فائدة؟ ولكن من لديه الحق أن ينتقد شخص ما أراد أن يشعر بالسعادة التي لا تشوبها عواقب أليمة أو آخر أراد أن يتجنب الألم الذي ربما تنجم عنه بعض المتعة ؟ \r\nعلي الجانب الآخر نشجب ونستنكر هؤلاء الرجال المفتونون بنشوة اللحظة الهائمون في رغباتهم فلا يدركون ما يعقبها من الألم والأسي المحتم، واللوم كذلك يشمل هؤلاء الذين أخفقوا في واجباتهم نتيجة لضعف إرادتهم فيتساوي مع هؤلاء الذين يتجنبون وينأون عن تحمل الكدح والألم .\r\n	       ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam exercitationem dicta earum vero assumenda? Cum fugiat, sapiente atque rem possimus assumenda porro provident debitis deserunt nemo corporis quam quisquam quo nam, vero minus illum iste ipsam, quis sed sunt nisi consectetur recusandae. Quas laborum cupiditate delectus enim dicta nobis, cum doloribus commodi, perferendis sapiente adipisci repellendus iure maxime hic soluta, officiis non. Ipsam nemo ut aspernatur ab molestias aliquid facere ex possimus. Praesentium dolores ut exercitationem. Quasi incidunt laborum eos totam unde iure facere est ipsam tempora, itaque repellat excepturi voluptatibus optio dicta accusantium minus nihil! Amet ratione molestiae velit?', 15, '1', 37, 2, 3, '2021-10-20 18:03:21', '2021-10-22 22:17:41'),
(4, 'جبنة', 'Cheese', 15.00, 'cheese.jpg', 'لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.\r\n\r\nو سأعرض مثال حي لهذا، من منا لم يتحمل جهد بدني شاق إلا من أجل الحصول على ميزة أو فائدة؟ ولكن من لديه الحق أن ينتقد شخص ما أراد أن يشعر بالسعادة التي لا تشوبها عواقب أليمة أو آخر أراد أن يتجنب الألم الذي ربما تنجم عنه بعض المتعة ؟ \r\nعلي الجانب الآخر نشجب ونستنكر هؤلاء الرجال المفتونون بنشوة اللحظة الهائمون في رغباتهم فلا يدركون ما يعقبها من الألم والأسي المحتم، واللوم كذلك يشمل هؤلاء الذين أخفقوا في واجباتهم نتيجة لضعف إرادتهم فيتساوي مع هؤلاء الذين يتجنبون وينأون عن تحمل الكدح والألم .\r\n	       ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam exercitationem dicta earum vero assumenda? Cum fugiat, sapiente atque rem possimus assumenda porro provident debitis deserunt nemo corporis quam quisquam quo nam, vero minus illum iste ipsam, quis sed sunt nisi consectetur recusandae. Quas laborum cupiditate delectus enim dicta nobis, cum doloribus commodi, perferendis sapiente adipisci repellendus iure maxime hic soluta, officiis non. Ipsam nemo ut aspernatur ab molestias aliquid facere ex possimus. Praesentium dolores ut exercitationem. Quasi incidunt laborum eos totam unde iure facere est ipsam tempora, itaque repellat excepturi voluptatibus optio dicta accusantium minus nihil! Amet ratione molestiae velit?', 13, '1', 9, 4, 4, '2021-10-22 12:22:59', '2021-10-22 21:31:31'),
(5, 'ايفون 6اس بلس', 'Iphone 6S plus', 6500.00, 'iphone6s.jpg', 'لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.\r\n\r\nو سأعرض مثال حي لهذا، من منا لم يتحمل جهد بدني شاق إلا من أجل الحصول على ميزة أو فائدة؟ ولكن من لديه الحق أن ينتقد شخص ما أراد أن يشعر بالسعادة التي لا تشوبها عواقب أليمة أو آخر أراد أن يتجنب الألم الذي ربما تنجم عنه بعض المتعة ؟ \r\nعلي الجانب الآخر نشجب ونستنكر هؤلاء الرجال المفتونون بنشوة اللحظة الهائمون في رغباتهم فلا يدركون ما يعقبها من الألم والأسي المحتم، واللوم كذلك يشمل هؤلاء الذين أخفقوا في واجباتهم نتيجة لضعف إرادتهم فيتساوي مع هؤلاء الذين يتجنبون وينأون عن تحمل الكدح والألم .\r\n	       ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam exercitationem dicta earum vero assumenda? Cum fugiat, sapiente atque rem possimus assumenda porro provident debitis deserunt nemo corporis quam quisquam quo nam, vero minus illum iste ipsam, quis sed sunt nisi consectetur recusandae. Quas laborum cupiditate delectus enim dicta nobis, cum doloribus commodi, perferendis sapiente adipisci repellendus iure maxime hic soluta, officiis non. Ipsam nemo ut aspernatur ab molestias aliquid facere ex possimus. Praesentium dolores ut exercitationem. Quasi incidunt laborum eos totam unde iure facere est ipsam tempora, itaque repellat excepturi voluptatibus optio dicta accusantium minus nihil! Amet ratione molestiae velit?', 5, '1', 20, 1, 1, '2021-10-22 12:23:15', '2021-10-22 22:05:54'),
(6, 'بودرة', 'powder', 12.00, 'powder.jpg', 'لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.\n\nو سأعرض مثال حي لهذا، من منا لم يتحمل جهد بدني شاق إلا من أجل الحصول على ميزة أو فائدة؟ ولكن من لديه الحق أن ينتقد شخص ما أراد أن يشعر بالسعادة التي لا تشوبها عواقب أليمة أو آخر أراد أن يتجنب الألم الذي ربما تنجم عنه بعض المتعة ؟ \nعلي الجانب الآخر نشجب ونستنكر هؤلاء الرجال المفتونون بنشوة اللحظة الهائمون في رغباتهم فلا يدركون ما يعقبها من الألم والأسي المحتم، واللوم كذلك يشمل هؤلاء الذين أخفقوا في واجباتهم نتيجة لضعف إرادتهم فيتساوي مع هؤلاء الذين يتجنبون وينأون عن تحمل الكدح والألم .\n	       ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam exercitationem dicta earum vero assumenda? Cum fugiat, sapiente atque rem possimus assumenda porro provident debitis deserunt nemo corporis quam quisquam quo nam, vero minus illum iste ipsam, quis sed sunt nisi consectetur recusandae. Quas laborum cupiditate delectus enim dicta nobis, cum doloribus commodi, perferendis sapiente adipisci repellendus iure maxime hic soluta, officiis non. Ipsam nemo ut aspernatur ab molestias aliquid facere ex possimus. Praesentium dolores ut exercitationem. Quasi incidunt laborum eos totam unde iure facere est ipsam tempora, itaque repellat excepturi voluptatibus optio dicta accusantium minus nihil! Amet ratione molestiae velit?', 7, '1', 1, 5, 5, '2021-10-22 12:23:27', '2021-10-22 21:31:54'),
(7, 'تايجر فلفل حلو', 'tiger sweet chili flavor', 5.00, 'tiger.png', 'لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.\n', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias quia et veritatis minima iure quam facilis harum hic voluptatibus similique?', 25, '1', 14, 3, 6, '2021-10-22 12:50:12', '2021-10-22 21:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `products_specs`
--

CREATE TABLE `products_specs` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `spec_id` bigint(20) UNSIGNED NOT NULL,
  `spec_value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_specs`
--

INSERT INTO `products_specs` (`product_id`, `spec_id`, `spec_value`) VALUES
(1, 2, '25-10-2015'),
(1, 3, '2 TB'),
(2, 1, 'USA'),
(3, 1, 'German'),
(3, 2, '12-5-2021'),
(3, 3, '1 TB');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(100) NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=> notAvailable\r\n1=> Available',
  `distance` double(10,8) NOT NULL,
  `latitude` double(10,8) NOT NULL,
  `longitude` double(10,8) NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name_ar`, `name_en`, `status`, `distance`, `latitude`, `longitude`, `city_id`, `created_at`, `updated_at`) VALUES
(1, 'Baden Württemberg', 'Baden Württemberg', '1', 4.00000000, 83.47059446, 71.18668974, 4, '2021-10-22 14:25:01', '2021-10-22 14:25:01'),
(2, 'Manitoba', 'Manitoba', '1', 33.00000000, 48.23642860, 99.99999999, 7, '2021-10-22 14:25:01', '2021-10-22 14:25:01'),
(3, 'Pará', 'Pará', '1', 32.00000000, -52.29397770, -52.08688456, 6, '2021-10-22 14:25:01', '2021-10-22 14:25:01'),
(4, 'Goiás', 'Goiás', '1', 8.00000000, 2.69600471, 40.26735043, 5, '2021-10-22 14:25:01', '2021-10-22 14:25:01'),
(5, 'Sląskie', 'Sląskie', '1', 7.00000000, -38.70581371, -99.99999999, 4, '2021-10-22 14:25:01', '2021-10-22 14:25:01'),
(6, 'Central Kalimantan', 'Central Kalimantan', '1', 20.00000000, -82.69322660, 50.87115121, 2, '2021-10-22 14:25:01', '2021-10-22 14:25:01'),
(7, 'Araucanía', 'Araucanía', '1', 9.00000000, 71.56269466, -76.19263037, 7, '2021-10-22 14:25:01', '2021-10-22 14:25:01'),
(8, 'Indiana', 'Indiana', '1', 27.00000000, -5.89886730, -30.66407219, 4, '2021-10-22 14:25:01', '2021-10-22 14:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `value` enum('1','2','3','4','5') NOT NULL DEFAULT '5' COMMENT '1=>bad\r\n2=>accepted\r\n3=>good\r\n4=>veryGood\r\n5=>Excellent',
  `comment` mediumtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`product_id`, `user_id`, `value`, `comment`, `created_at`, `updated_at`) VALUES
(1, 14, '2', '', '2021-10-21 18:55:11', '2021-10-21 18:55:11'),
(1, 15, '2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque esse similique cum reprehenderit ex! Accusantium veritatis, vitae natus architecto eum consequatur eius perspiciatis deserunt aliquam.', '2021-10-21 18:55:54', '2021-10-21 19:26:40'),
(1, 22, '1', 'Phasellus vitae mauris sit amet lorem semper auctor. Mauris vel turpis. Aliquam adipiscing lobortis risus. In mi pede, nonummy ut, molestie in, tempus eu, ligula. Aenean euismod mauris eu elit. Nulla facilisi. Sed neque. Sed eget lacus. Mauris non dui nec urna suscipit nonummy. Fusce fermentum fermentum arcu. Vestibulum', '2021-10-22 22:20:23', '2021-10-22 22:20:23'),
(1, 26, '4', 'faucibus lectus, a sollicitudin orci sem eget massa. Suspendisse eleifend. Cras sed leo. Cras vehicula aliquet libero. Integer in magna. Phasellus dolor elit,', '2021-10-22 22:20:23', '2021-10-22 22:20:23'),
(2, 14, '3', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque esse similique cum reprehenderit ex! Accusantium veritatis, vitae natus architecto eum consequatur eius perspiciatis deserunt aliquam.', '2021-10-21 18:55:54', '2021-10-21 18:55:54'),
(2, 30, '1', 'et,', '2021-10-22 22:20:23', '2021-10-22 22:20:23'),
(2, 33, '3', 'vitae aliquam eros turpis non enim. Mauris quis turpis', '2021-10-22 22:20:23', '2021-10-22 22:20:23'),
(2, 34, '2', 'tempus, lorem fringilla ornare placerat, orci lacus vestibulum', '2021-10-22 22:20:23', '2021-10-22 22:20:23'),
(3, 14, '5', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque esse similique cum reprehenderit ex! Accusantium veritatis, vitae natus architecto eum consequatur eius perspiciatis deserunt aliquam.', '2021-10-21 18:55:11', '2021-10-21 18:55:11'),
(3, 15, '2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque esse similique cum reprehenderit ex! Accusantium veritatis, vitae natus architecto eum consequatur eius perspiciatis deserunt aliquam.', '2021-10-21 18:55:11', '2021-10-21 18:55:11'),
(4, 21, '1', 'lacinia vitae, sodales at, velit. Pellentesque ultricies dignissim lacus. Aliquam rutrum lorem ac risus. Morbi metus. Vivamus euismod urna. Nullam lobortis quam a felis ullamcorper viverra. Maecenas iaculis aliquet diam. Sed diam lorem, auctor quis, tristique ac, eleifend vitae, erat. Vivamus nisi. Mauris nulla. Integer urna. Vivamus', '2021-10-22 22:20:23', '2021-10-22 22:20:23'),
(4, 29, '2', 'nascetur ridiculus mus. Donec dignissim magna a tortor. Nunc commodo auctor velit. Aliquam nisl. Nulla eu neque pellentesque', '2021-10-22 22:20:23', '2021-10-22 22:20:23'),
(4, 30, '5', 'eget tincidunt dui augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel, faucibus id, libero. Donec consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia at, iaculis quis, pede. Praesent eu dui.', '2021-10-22 22:20:23', '2021-10-22 22:20:23'),
(5, 29, '1', 'lacus. Mauris non dui nec urna suscipit nonummy. Fusce fermentum fermentum arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Phasellus ornare. Fusce mollis. Duis sit amet diam eu dolor egestas rhoncus. Proin nisl sem, consequat nec, mollis vitae,', '2021-10-22 22:20:23', '2021-10-22 22:20:23'),
(6, 21, '2', 'consectetuer euismod est arcu ac orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam', '2021-10-22 22:20:23', '2021-10-22 22:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `specs`
--

CREATE TABLE `specs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(50) NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specs`
--

INSERT INTO `specs` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'صنع في ', 'made in', '2021-10-20 23:09:16', '2021-10-20 23:09:16'),
(2, 'تاريخ الصنع', 'Manufacture date ', '2021-10-20 23:09:16', '2021-10-20 23:09:16'),
(3, 'حجم الهارد', 'Hard Disk size', '2021-10-20 23:09:51', '2021-10-20 23:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(100) NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `image` varchar(20) NOT NULL DEFAULT 'default.jpg',
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=>notAvailable\r\n1=>Available',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name_ar`, `name_en`, `image`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'موبايل', 'mobile', 'mobile.jpg', '1', 1, '2021-10-20 17:56:47', '2021-10-20 21:55:20'),
(2, 'لابتوب', 'laptop', 'laptop.jpg', '1', 1, '2021-10-20 17:57:42', '2021-10-20 21:55:26'),
(3, 'شيبسي', 'chepsi', 'chepsi.jpg', '1', 2, '2021-10-20 17:58:13', '2021-10-22 12:31:19'),
(4, 'جبن', 'cheese', 'cheese.jpg', '1', 2, '2021-10-20 17:58:26', '2021-10-22 12:31:55'),
(5, 'ميكب اب', 'Makeup', 'makeup.jpg', '1', 5, '2021-10-20 17:58:50', '2021-10-22 12:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `gender` enum('m','f') NOT NULL COMMENT 'f=>Female\r\nm=>Male',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=>not verified\r\n1=>verified',
  `code` varchar(5) DEFAULT NULL,
  `image` varchar(100) NOT NULL DEFAULT 'default.png',
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `gender`, `status`, `code`, `image`, `verified_at`, `created_at`, `updated_at`) VALUES
(14, 'hossam', 'salah', 'hossam_m200917@yahoo.comm', 'c301e9d360379ba83148dc82465053e25b7b5824', '01012512599', 'f', 1, '49179', '1634917196-14.jpg', '2021-10-22 15:40:18', '2021-10-18 21:13:58', '2021-10-22 15:40:18'),
(15, 'Mohammed', 'Abbas', 'hossamsalahabbas@gmail.com', 'c301e9d360379ba83148dc82465053e25b7b5824', '01012512588', 'm', 1, '42566', 'default.png', '2021-10-19 23:38:29', '2021-10-19 22:52:35', '2021-10-21 19:43:35'),
(17, 'Benedict', 'Jensen', 'enim.suspendisse@turpis.com', 'PDQ57PUU6IY', '01038932654', 'm', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(18, 'Hadassah', 'Travis', 'tellus@convallis.ca', 'JQX44PAI1AJ', '01044643315', 'f', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(19, 'Keelie', 'Watts', 'lorem.ipsum@ametfaucibus.com', 'XJI57GNL5RH', '01048642772', 'f', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(20, 'Palmer', 'Tyler', 'et@ultrices.ca', 'EMV06HKE4UO', '01030540355', 'm', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(21, 'Charissa', 'Torres', 'urna.ut@necmalesuadaut.co.uk', 'MZI53HSK1PQ', '01020983042', 'm', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(22, 'Colton', 'Ramos', 'proin.sed@mitempor.co.uk', 'MIC77SQK0QT', '01039243624', 'm', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(23, 'Xavier', 'Fowler', 'aliquam.enim@ornarelectusjusto.com', 'KJU33WXB8CR', '01056815385', 'm', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(24, 'Baxter', 'Middleton', 'tempor.erat.neque@etmagnis.net', 'KXT78ZJQ1JS', '01074126387', 'f', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(25, 'Ciara', 'Buckner', 'massa@euismod.org', 'WGK06HYI1ZL', '01077824719', 'f', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(26, 'Chaney', 'Ford', 'sed.dui@nequesed.ca', 'IZI74KFF1QR', '01087745802', 'f', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(27, 'Bo', 'Middleton', 'eget.mollis@nectellus.net', 'JLJ51ITC9FV', '01044834842', 'm', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(28, 'Dillon', 'Dotson', 'placerat.orci@mus.net', 'LJV06XOS3RU', '01073470439', 'f', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(29, 'Noble', 'Mckee', 'vivamus@porttitortellus.net', 'QJJ47VJY1TV', '01024124167', 'f', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(30, 'Mark', 'Ward', 'ultrices.sit@nonbibendum.ca', 'YFR66VMX1XP', '01051501766', 'f', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(31, 'Tara', 'Parsons', 'in@lorem.net', 'VXI34GFN9IJ', '01072073844', 'm', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(32, 'Courtney', 'Woodard', 'dolor@arcuac.com', 'FMO26UUM0RV', '01071869423', 'm', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(33, 'Amity', 'Valdez', 'nunc@maurisanunc.co.uk', 'OUX62HNO2BG', '01010128038', 'f', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(34, 'Colette', 'Forbes', 'lacus@placerat.ca', 'XLR38LUM4QW', '01031228847', 'm', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(35, 'Damon', 'Garrett', 'tempor.lorem@ligulaaenean.edu', 'ZRJ96WSF2TC', '01056637083', 'm', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53'),
(36, 'Ramona', 'Burris', 'lorem.ut@arcu.org', 'GQG57JMZ8EV', '01025165167', 'm', 0, NULL, 'default.png', NULL, '2021-10-22 11:56:53', '2021-10-22 11:56:53');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_addresses_fk` (`user_id`),
  ADD KEY `regions_addresses_fk` (`region_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `users_cart_fk` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `coupons_products`
--
ALTER TABLE `coupons_products`
  ADD PRIMARY KEY (`coupon_id`,`product_id`),
  ADD KEY `products_coupons_products_fk` (`product_id`);

--
-- Indexes for table `coupons_users`
--
ALTER TABLE `coupons_users`
  ADD PRIMARY KEY (`user_id`,`coupon_id`),
  ADD KEY `coupons_coupons_users` (`coupon_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers_products`
--
ALTER TABLE `offers_products`
  ADD PRIMARY KEY (`product_id`,`offer_id`),
  ADD KEY `offers_offers_products_fk` (`offer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_orders_fk` (`address_id`),
  ADD KEY `coupons_orders_fk` (`coupon_id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`product_id`,`order_id`),
  ADD KEY `orders_orders_products_fk` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brands_products_fk` (`brand_id`),
  ADD KEY `subcategories_products_fk` (`subcategory_id`);

--
-- Indexes for table `products_specs`
--
ALTER TABLE `products_specs`
  ADD PRIMARY KEY (`product_id`,`spec_id`),
  ADD KEY `specs_products_specs_fk` (`spec_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_regions_fk` (`city_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `users_reviews_fk` (`user_id`);

--
-- Indexes for table `specs`
--
ALTER TABLE `specs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_subcategories_fk` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `products_wishlist_fk` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `specs`
--
ALTER TABLE `specs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `regions_addresses_fk` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `users_addresses_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `products_cart_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_cart_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coupons_products`
--
ALTER TABLE `coupons_products`
  ADD CONSTRAINT `coupons_coupons_products_fk` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_coupons_products_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coupons_users`
--
ALTER TABLE `coupons_users`
  ADD CONSTRAINT `coupons_coupons_users` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_coupons_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offers_products`
--
ALTER TABLE `offers_products`
  ADD CONSTRAINT `offers_offers_products_fk` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_offers_products_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `addresses_orders_fk` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coupons_orders_fk` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `orders_orders_products_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_orders_products_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `brands_products_fk` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subcategories_products_fk` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_specs`
--
ALTER TABLE `products_specs`
  ADD CONSTRAINT `products_products_specs_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `specs_products_specs_fk` FOREIGN KEY (`spec_id`) REFERENCES `specs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `cities_regions_fk` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `products_reviews_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_reviews_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `categories_subcategories_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `products_wishlist_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_wishlist_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
