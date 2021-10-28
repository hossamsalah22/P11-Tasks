-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2021 at 01:28 AM
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
-- Database: `task6-ecommerce`
--

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
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '2014_10_12_000000_create_users_table', 1),
(14, '2014_10_12_100000_create_password_resets_table', 1),
(15, '2019_08_19_000000_create_failed_jobs_table', 1),
(16, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(26, 'App\\Models\\User', 1, 'iphone', '1d1d5016185af33a0cb233cb2a82df7f0f3e17e4a78dccbb0f09469b85790d04', '[\"*\"]', '2021-10-28 23:13:19', '2021-10-28 22:40:25', '2021-10-28 23:13:19'),
(27, 'App\\Models\\User', 1, 'iphone', '5475cd6f7c6e7d78d0b9518dec867130e0a65b69a08bad5f6fead9e08183e305', '[\"*\"]', NULL, '2021-10-28 23:13:41', '2021-10-28 23:13:41'),
(28, 'App\\Models\\User', 1, 'iphone', 'f6ba9182e0698493181a041267c39c9e67a5e5f7e8b7d9582b7b25bbe48eaa48', '[\"*\"]', '2021-10-28 23:20:36', '2021-10-28 23:15:30', '2021-10-28 23:20:36'),
(29, 'App\\Models\\User', 1, 'iphone', '3ccfea0dadc1f6e3ad92bd85f3ddf0ea4f1831a2eba7ac21885c2a924bac3e97', '[\"*\"]', NULL, '2021-10-28 23:15:43', '2021-10-28 23:15:43');

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
  `quantity` smallint(4) DEFAULT 1,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=>notAvailable\r\n1=>Available',
  `views` int(6) DEFAULT 0,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name_ar`, `name_en`, `price`, `image`, `desc_ar`, `desc_en`, `quantity`, `status`, `views`, `subcategory_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(3, 'بريداتور', 'asus Predator', 33000.00, 'asus-predator.jpg', 'لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.\r\n\r\nو سأعرض مثال حي لهذا، من منا لم يتحمل جهد بدني شاق إلا من أجل الحصول على ميزة أو فائدة؟ ولكن من لديه الحق أن ينتقد شخص ما أراد أن يشعر بالسعادة التي لا تشوبها عواقب أليمة أو آخر أراد أن يتجنب الألم الذي ربما تنجم عنه بعض المتعة ؟ \r\nعلي الجانب الآخر نشجب ونستنكر هؤلاء الرجال المفتونون بنشوة اللحظة الهائمون في رغباتهم فلا يدركون ما يعقبها من الألم والأسي المحتم، واللوم كذلك يشمل هؤلاء الذين أخفقوا في واجباتهم نتيجة لضعف إرادتهم فيتساوي مع هؤلاء الذين يتجنبون وينأون عن تحمل الكدح والألم .\r\n	       ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam exercitationem dicta earum vero assumenda? Cum fugiat, sapiente atque rem possimus assumenda porro provident debitis deserunt nemo corporis quam quisquam quo nam, vero minus illum iste ipsam, quis sed sunt nisi consectetur recusandae. Quas laborum cupiditate delectus enim dicta nobis, cum doloribus commodi, perferendis sapiente adipisci repellendus iure maxime hic soluta, officiis non. Ipsam nemo ut aspernatur ab molestias aliquid facere ex possimus. Praesentium dolores ut exercitationem. Quasi incidunt laborum eos totam unde iure facere est ipsam tempora, itaque repellat excepturi voluptatibus optio dicta accusantium minus nihil! Amet ratione molestiae velit?', 15, '1', 37, 2, 3, '2021-10-20 18:03:21', '2021-10-22 22:17:41'),
(4, 'جبنة', 'Cheese', 15.00, 'cheese.jpg', 'لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.\r\n\r\nو سأعرض مثال حي لهذا، من منا لم يتحمل جهد بدني شاق إلا من أجل الحصول على ميزة أو فائدة؟ ولكن من لديه الحق أن ينتقد شخص ما أراد أن يشعر بالسعادة التي لا تشوبها عواقب أليمة أو آخر أراد أن يتجنب الألم الذي ربما تنجم عنه بعض المتعة ؟ \r\nعلي الجانب الآخر نشجب ونستنكر هؤلاء الرجال المفتونون بنشوة اللحظة الهائمون في رغباتهم فلا يدركون ما يعقبها من الألم والأسي المحتم، واللوم كذلك يشمل هؤلاء الذين أخفقوا في واجباتهم نتيجة لضعف إرادتهم فيتساوي مع هؤلاء الذين يتجنبون وينأون عن تحمل الكدح والألم .\r\n	       ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam exercitationem dicta earum vero assumenda? Cum fugiat, sapiente atque rem possimus assumenda porro provident debitis deserunt nemo corporis quam quisquam quo nam, vero minus illum iste ipsam, quis sed sunt nisi consectetur recusandae. Quas laborum cupiditate delectus enim dicta nobis, cum doloribus commodi, perferendis sapiente adipisci repellendus iure maxime hic soluta, officiis non. Ipsam nemo ut aspernatur ab molestias aliquid facere ex possimus. Praesentium dolores ut exercitationem. Quasi incidunt laborum eos totam unde iure facere est ipsam tempora, itaque repellat excepturi voluptatibus optio dicta accusantium minus nihil! Amet ratione molestiae velit?', 13, '1', 9, 4, 4, '2021-10-22 12:22:59', '2021-10-22 21:31:31'),
(5, 'ايفون 6اس بلس', 'Iphone 6S plus', 6500.00, 'iphone6s.jpg', 'لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.\r\n\r\nو سأعرض مثال حي لهذا، من منا لم يتحمل جهد بدني شاق إلا من أجل الحصول على ميزة أو فائدة؟ ولكن من لديه الحق أن ينتقد شخص ما أراد أن يشعر بالسعادة التي لا تشوبها عواقب أليمة أو آخر أراد أن يتجنب الألم الذي ربما تنجم عنه بعض المتعة ؟ \r\nعلي الجانب الآخر نشجب ونستنكر هؤلاء الرجال المفتونون بنشوة اللحظة الهائمون في رغباتهم فلا يدركون ما يعقبها من الألم والأسي المحتم، واللوم كذلك يشمل هؤلاء الذين أخفقوا في واجباتهم نتيجة لضعف إرادتهم فيتساوي مع هؤلاء الذين يتجنبون وينأون عن تحمل الكدح والألم .\r\n	       ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam exercitationem dicta earum vero assumenda? Cum fugiat, sapiente atque rem possimus assumenda porro provident debitis deserunt nemo corporis quam quisquam quo nam, vero minus illum iste ipsam, quis sed sunt nisi consectetur recusandae. Quas laborum cupiditate delectus enim dicta nobis, cum doloribus commodi, perferendis sapiente adipisci repellendus iure maxime hic soluta, officiis non. Ipsam nemo ut aspernatur ab molestias aliquid facere ex possimus. Praesentium dolores ut exercitationem. Quasi incidunt laborum eos totam unde iure facere est ipsam tempora, itaque repellat excepturi voluptatibus optio dicta accusantium minus nihil! Amet ratione molestiae velit?', 5, '1', 20, 1, 1, '2021-10-22 12:23:15', '2021-10-22 22:05:54'),
(6, 'بودرة', 'powder', 12.00, 'powder.jpg', 'لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.\n\nو سأعرض مثال حي لهذا، من منا لم يتحمل جهد بدني شاق إلا من أجل الحصول على ميزة أو فائدة؟ ولكن من لديه الحق أن ينتقد شخص ما أراد أن يشعر بالسعادة التي لا تشوبها عواقب أليمة أو آخر أراد أن يتجنب الألم الذي ربما تنجم عنه بعض المتعة ؟ \nعلي الجانب الآخر نشجب ونستنكر هؤلاء الرجال المفتونون بنشوة اللحظة الهائمون في رغباتهم فلا يدركون ما يعقبها من الألم والأسي المحتم، واللوم كذلك يشمل هؤلاء الذين أخفقوا في واجباتهم نتيجة لضعف إرادتهم فيتساوي مع هؤلاء الذين يتجنبون وينأون عن تحمل الكدح والألم .\n	       ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam exercitationem dicta earum vero assumenda? Cum fugiat, sapiente atque rem possimus assumenda porro provident debitis deserunt nemo corporis quam quisquam quo nam, vero minus illum iste ipsam, quis sed sunt nisi consectetur recusandae. Quas laborum cupiditate delectus enim dicta nobis, cum doloribus commodi, perferendis sapiente adipisci repellendus iure maxime hic soluta, officiis non. Ipsam nemo ut aspernatur ab molestias aliquid facere ex possimus. Praesentium dolores ut exercitationem. Quasi incidunt laborum eos totam unde iure facere est ipsam tempora, itaque repellat excepturi voluptatibus optio dicta accusantium minus nihil! Amet ratione molestiae velit?', 7, '1', 2, 5, 5, '2021-10-22 12:23:27', '2021-10-22 22:25:56'),
(7, 'تايجر فلفل حلو', 'tiger sweet chili flavor', 5.00, 'tiger.png', 'لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.\n', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias quia et veritatis minima iure quam facilis harum hic voluptatibus similique?', 25, '1', 14, 3, 6, '2021-10-22 12:50:12', '2021-10-22 21:32:21'),
(9, 'hsdfh', 'API Test', 500.00, '1635352544.jpg', 'sfh', 'sfh', NULL, '1', 0, 2, 1, '2021-10-27 14:35:44', '2021-10-27 14:35:44'),
(10, 'hsdfh', 'API Test', 500.00, '1635353185.jpg', 'sfh', 'sfh', NULL, '1', 0, 2, 1, '2021-10-27 14:46:25', '2021-10-27 14:46:25'),
(11, 'hsdfh', 'API Test', 500.00, '1635358569.jpg', 'sfh', 'sfh', NULL, '1', 0, 2, 1, '2021-10-27 16:16:09', '2021-10-27 16:16:09'),
(12, 'hsdfh', 'API Test', 500.00, '1635442654.jpg', 'sfh', 'sfh', NULL, '1', 0, 2, 1, '2021-10-28 15:37:34', '2021-10-28 15:37:34');

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
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` mediumint(6) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `code`, `email_verified_at`, `password`, `device_name`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hossam', 'Salah', 'hossamsalahabbas@gmail.com', '01012512599', 23665, NULL, '$2y$10$WbpJbqsZqi2Adt5jlevk/.XuuBguFnX05/Ik0TtORj0CEUtJcb9kC', 'hossam\'s Iphone', NULL, '2021-10-28 17:20:26', '2021-10-28 23:13:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brands_products_fk` (`brand_id`),
  ADD KEY `subcategories_products_fk` (`subcategory_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `brands_products_fk` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subcategories_products_fk` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `categories_subcategories_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
