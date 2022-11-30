-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2022 at 05:41 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `playlab`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@site.com', 'admin', NULL, '6238276ac25d11647847274.png', '$2y$10$el35r0DVW8rbSEx0xm5xDu5IsbxmiaA1CZe3tfeub4iA4HxD1QSxq', '9qtsaTUWCDCcq8nUYMrxhk4AUl5JiIfHtySKtJwucsWxm0UfYLze0gOWdDjD', NULL, '2022-03-28 08:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_status` tinyint(1) NOT NULL DEFAULT 0,
  `click_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advertises`
--

CREATE TABLE `advertises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `click` int(11) NOT NULL DEFAULT 0,
  `impression` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `subscription_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `method_code` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `method_currency` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `final_amo` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_amo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `try` int(10) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>success, 2=>pending, 3=>cancel',
  `from_api` tinyint(1) NOT NULL DEFAULT 0,
  `admin_feedback` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE `episodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `version` tinyint(1) DEFAULT 0 COMMENT '0 = free, 1 = paid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'object',
  `support` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>enable, 2=>disable',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_big.png', '<script>\r\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n                        (function(){\r\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\n                        s1.async=true;\r\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\r\n                        s1.charset=\"UTF-8\";\r\n                        s1.setAttribute(\"crossorigin\",\"*\");\r\n                        s0.parentNode.insertBefore(s1,s0);\r\n                        })();\r\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'twak.png', 0, NULL, '2019-10-18 23:16:05', '2022-03-22 05:22:24'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha3.png', '\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\n<div class=\"g-recaptcha\" data-sitekey=\"{{site_key}}\" data-callback=\"verifyCaptcha\"></div>\n<div id=\"g-recaptcha-error\"></div>', '{\"site_key\":{\"title\":\"Site Key\",\"value\":\"6LdPC88fAAAAADQlUf_DV6Hrvgm-pZuLJFSLDOWV\"},\"secret_key\":{\"title\":\"Secret Key\",\"value\":\"6LdPC88fAAAAAG5SVaRYDnV2NpCrptLg2XLYKRKB\"}}', 'recaptcha.png', 0, NULL, '2019-10-18 23:16:05', '2022-05-30 05:52:58'),
(3, 'custom-captcha', 'Custom Captcha', 'Just put any random string', 'customcaptcha.png', NULL, '{\"random_key\":{\"title\":\"Random String\",\"value\":\"SecureString\"}}', 'na', 0, NULL, '2019-10-18 23:16:05', '2022-05-30 05:53:07'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google_analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{app_key}}\"></script>\r\n                <script>\r\n                  window.dataLayer = window.dataLayer || [];\r\n                  function gtag(){dataLayer.push(arguments);}\r\n                  gtag(\"js\", new Date());\r\n                \r\n                  gtag(\"config\", \"{{app_key}}\");\r\n                </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'ganalytics.png', 0, NULL, NULL, '2021-05-04 10:19:12');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_keys` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_values` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`) VALUES
(1, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"PlayLab\",\"Movie\",\"Movie Platform\",\"Video On-Demand Movie Streaming Platform\"],\"description\":\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit\",\"social_title\":\"PlayTube - On-Demand Movie Streaming Platform\",\"social_description\":\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit ff\",\"image\":\"62c6efa21035d1657204642.png\"}', '2020-07-04 23:42:52', '2022-07-07 08:37:22'),
(41, 'cookie.data', '{\"short_desc\":\"We may use cookies or any other tracking technologies when you visit our website, including any other media form, mobile website, or mobile application related or connected to help customize the Site and improve your experience.\",\"description\":\"<div class=\\\"mb-5\\\" style=\\\"font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif;\\\"><font color=\\\"#ffffff\\\">What information do we collect?<\\/font><\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\"><font color=\\\"#ffffff\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/font><\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif;\\\"><font color=\\\"#ffffff\\\">How do we protect your information?<\\/font><\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\"><font color=\\\"#ffffff\\\">All provided delicate\\/credit data is sent through Stripe.<br>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/font><\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif;\\\"><font color=\\\"#ffffff\\\">Do we disclose any information to outside parties?<\\/font><\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\"><font color=\\\"#ffffff\\\">We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/font><\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif;\\\"><font color=\\\"#ffffff\\\">Children\'s Online Privacy Protection Act Compliance<\\/font><\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\"><font color=\\\"#ffffff\\\">We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/font><\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif;\\\"><font color=\\\"#ffffff\\\">Changes to our Privacy Policy<\\/font><\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\"><font color=\\\"#ffffff\\\">If we decide to change our privacy policy, we will post those changes on this page.<\\/font><\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif;\\\"><font color=\\\"#ffffff\\\">How long we retain your information?<\\/font><\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\"><font color=\\\"#ffffff\\\">At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/font><\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif;\\\"><font color=\\\"#ffffff\\\">What we don\\u2019t do with your data<\\/font><\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\"><font color=\\\"#ffffff\\\">We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/font><\\/p><\\/div>\",\"status\":1}', '2020-07-04 23:42:52', '2022-07-04 12:48:45'),
(42, 'footer.content', '{\"has_image\":\"1\",\"about_us\":\"Playlab has a broad library of highlight films, narratives, TV shows, anime, and so on! Watch as much as you want, whenever you need it at any time. LabFlix is an American over-the-top content platform streaming service and production company headquartered in Los Gatos, California\",\"subscribe_title\":\"Subscrbe News Letter\",\"background_image\":\"62aad5d5eeb5d1655363029.jpg\"}', '2021-06-06 05:20:03', '2022-06-16 05:33:50'),
(43, 'footer.element', '{\"social_icon\":\"<i class=\\\"lab la-linkedin\\\"><\\/i>\",\"social_link\":\"https:\\/\\/linkedin.com\"}', '2021-06-06 05:23:13', '2021-06-09 17:25:40'),
(44, 'footer.element', '{\"social_icon\":\"<i class=\\\"lab la-instagram\\\"><\\/i>\",\"social_link\":\"www.instagram.com\"}', '2021-06-06 05:23:23', '2021-06-06 05:23:23'),
(45, 'footer.element', '{\"social_icon\":\"<i class=\\\"lab la-twitter\\\"><\\/i>\",\"social_link\":\"www.twitter.com\"}', '2021-06-06 05:23:32', '2021-06-06 05:23:32'),
(46, 'footer.element', '{\"social_icon\":\"<i class=\\\"lab la-facebook-f\\\"><\\/i>\",\"social_link\":\"www.facebook.com\"}', '2021-06-06 05:23:45', '2021-06-06 05:23:45'),
(47, 'policy_pages.element', '{\"title\":\"Terms and Condition\",\"description\":\"<h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Overview<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Nullam turpis dolorem, vivamus placerat in donec est, nonummy tristique massa a, dui felis in. Nulla lorem aenean montes varius massula sed, ut at ante, quis velit, at amet amet placerat. Vestibulum in porttitsum eros vel in, imperdiet amet aliquam et purus dictum. In nunc nulla orci. A massa curabitur, etiam iure ulum, blandit ullamcorper, justo at aenean pulvinar. Felis aliquam hac duis et feugiat eu. Duis feugiat volutpat bibendum, eget a nisl est eros, nibh metus placerat faucibus penatibus, natoque diam.<\\/p><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Consent and Information Collection and Use<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Rictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dtucongue penatibus suspendissjusto, eget adipiscing, eros in donec ligula cursus integer. Accumsan egesttupdebitis, placerat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phaodo audales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie dolor amet peiet feugi nim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus pellentesque augue, leo nisl dis vehicula, vehicula magna. Porttitor praesent facilisis aliquet.<\\/p><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Eictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna diconpbus suspendissjusto, eget adipiscing, eros in donec ligula cursus integer. Accumsan egestas tpurgna debplarat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phasellus ipsum.coogue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie dolor ametperdiet fgiat. Enim lacus eu duisest.<\\/p><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Cookies and Log Files<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Dictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dicongen pebus suspendissjusto, eget adipiscing, eros in donec ligula cursus integer. Accumsan egestas tpmagbitis plarat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phaselsum.coogue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodoostie dolor amet imperdiet feugiat. Enim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus pellentesque augue, leo nisl dis vehicula, vehicula magna.<\\/p><ul class=\\\"cmn-list\\\" style=\\\"margin-top:20px;\\\"><li><span style=\\\"color:rgb(151,175,213);\\\">Aras mi ac facilisis nec turpis maecenas, curabitur penatibus bibendum nibh nec, lorem integer donec a, risus quis ullamcorper, ante sapien wisi integer. Neque accumsan vestibulum. Vestibulum venenatis sem sit. Mauris eu curabitur eros, turpis elit alias in morbi, ac natoque quis, porttitor amet ut, eu eu aenean aliquam augue vel. Sed placat in scelerisque, purus metus est, scelerisque quis purusi<\\/span><\\/li><li><span style=\\\"color:rgb(151,175,213);\\\"><br \\/><\\/span><\\/li><\\/ul><span style=\\\"color:rgb(151,175,213);\\\">Cras mi ac facilisis nec turpis maecenas, curabitur penatibus bibendum nibh nec, lorem integer donec a, risus quis ullamcorper, ante sapien wisi integer. Neque accumiulum. Vestibulum venenatis sem sit. Mauris eu curabitur eros, turpis elit alias in morbi, ac natoque quis, porttitor amet ut, eu eu aenean aliquam augue vel. Sed placerat in scesque, purus metus est, scelerisque quis purusi<\\/span><\\/div><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><font color=\\\"#97afd5\\\"><br \\/><\\/font><span style=\\\"color:rgb(151,175,213);\\\">Qras mi ac facilisis nec turpis maecenas, curabitur penatibus bibendum nibh nec, lorem integer donec a, risus quis ullamcorper, ante sapien wisi integer. Neque accumsan vestibulum. Vestibulum venenatis sem sit. Mauris eu curabitur eros, turpis elit alias in morbi, ac natoque quis, porttitor amet ut, eu eu aenean aliquam augue vel. Sed placerat in scelerisque, purus metus est, scelerisque quis purus i<\\/span><br \\/><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Data Security and Retention<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Aictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dicongue penatibus suspendisjusget adipiscing, eros in donec ligula cursus integer. Accumsan egestas turpis rebiti placerat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phasellus m.modo augue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie doloremrdiet feugiat. Enim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus tesque augue, leo nisl dis vehicula, vehicula magna.<\\/p><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Information Form Customer<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Aictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dtucongue penatibus suspendisjusget adipiscing, eros in donec ligula cursus integer. Accumsan egestas turpis rubiti placerat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phasellus ipsodo augue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie dolemrdiet feugiat. Enim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus pelltesque augue, leo nisl dis vehicula, vehicula magna.<\\/p><\\/div>\"}', '2021-06-06 05:29:14', '2021-06-07 09:10:32'),
(48, 'policy_pages.element', '{\"title\":\"Privacy and Policy\",\"description\":\"<h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Overview<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Nullam turpis dolorem, vivamus placerat in donec est, nonummy tristique massa a, dui felis in. Nulla lorem aenean montes varius massula sed, ut at ante, quis velit, at amet amet placerat. Vestibulum in porttitsum eros vel in, imperdiet amet aliquam et purus dictum. In nunc nulla orci. A massa curabitur, etiam iure ulum, blandit ullamcorper, justo at aenean pulvinar. Felis aliquam hac duis et feugiat eu. Duis feugiat volutpat bibendum, eget a nisl est eros, nibh metus placerat faucibus penatibus, natoque diam.<\\/p><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Consent and Information Collection and Use<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Rictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dtucongue penatibus suspendissjusto, eget adipiscing, eros in donec ligula cursus integer. Accumsan egesttupdebitis, placerat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phaodo audales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie dolor amet peiet feugi nim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus pellentesque augue, leo nisl dis vehicula, vehicula magna. Porttitor praesent facilisis aliquet.<\\/p><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Eictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna diconpbus suspendissjusto, eget adipiscing, eros in donec ligula cursus integer. Accumsan egestas tpurgna debplarat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phasellus ipsum.coogue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie dolor ametperdiet fgiat. Enim lacus eu duisest.<\\/p><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Cookies and Log Files<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Dictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dicongen pebus suspendissjusto, eget adipiscing, eros in donec ligula cursus integer. Accumsan egestas tpmagbitis plarat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phaselsum.coogue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodoostie dolor amet imperdiet feugiat. Enim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus pellentesque augue, leo nisl dis vehicula, vehicula magna.<\\/p><ul class=\\\"cmn-list\\\" style=\\\"margin-top:20px;\\\"><li><span style=\\\"color:rgb(151,175,213);\\\">Aras mi ac facilisis nec turpis maecenas, curabitur penatibus bibendum nibh nec, lorem integer donec a, risus quis ullamcorper, ante sapien wisi integer. Neque accumsan vestibulum. Vestibulum venenatis sem sit. Mauris eu curabitur eros, turpis elit alias in morbi, ac natoque quis, porttitor amet ut, eu eu aenean aliquam augue vel. Sed placat in scelerisque, purus metus est, scelerisque quis purusi<\\/span><\\/li><li><span style=\\\"color:rgb(151,175,213);\\\"><br \\/><\\/span><\\/li><\\/ul><span style=\\\"color:rgb(151,175,213);\\\">Cras mi ac facilisis nec turpis maecenas, curabitur penatibus bibendum nibh nec, lorem integer donec a, risus quis ullamcorper, ante sapien wisi integer. Neque accumiulum. Vestibulum venenatis sem sit. Mauris eu curabitur eros, turpis elit alias in morbi, ac natoque quis, porttitor amet ut, eu eu aenean aliquam augue vel. Sed placerat in scesque, purus metus est, scelerisque quis purusi<\\/span><\\/div><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><font color=\\\"#97afd5\\\"><br \\/><\\/font><span style=\\\"color:rgb(151,175,213);\\\">Qras mi ac facilisis nec turpis maecenas, curabitur penatibus bibendum nibh nec, lorem integer donec a, risus quis ullamcorper, ante sapien wisi integer. Neque accumsan vestibulum. Vestibulum venenatis sem sit. Mauris eu curabitur eros, turpis elit alias in morbi, ac natoque quis, porttitor amet ut, eu eu aenean aliquam augue vel. Sed placerat in scelerisque, purus metus est, scelerisque quis purus i<\\/span><br \\/><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Data Security and Retention<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Aictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dicongue penatibus suspendisjusget adipiscing, eros in donec ligula cursus integer. Accumsan egestas turpis rebiti placerat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phasellus m.modo augue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie doloremrdiet feugiat. Enim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus tesque augue, leo nisl dis vehicula, vehicula magna.<\\/p><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Information Form Customer<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Aictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dtucongue penatibus suspendisjusget adipiscing, eros in donec ligula cursus integer. Accumsan egestas turpis rubiti placerat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phasellus ipsodo augue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie dolemrdiet feugiat. Enim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus pelltesque augue, leo nisl dis vehicula, vehicula magna.<\\/p><\\/div>\"}', '2021-06-06 05:29:27', '2021-06-07 09:10:41'),
(49, 'short_links.element', '{\"title\":\"Our Vision\",\"description\":\"<div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;\\\"><h3 class=\\\"title\\\" style=\\\"margin:0px 0px 15px;font-family:Poppins, sans-serif;font-weight:600;line-height:1.5;color:rgb(255,255,255);font-size:24px;\\\">Overview<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-family:Poppins, sans-serif;font-weight:600;line-height:1.5;color:rgb(255,255,255);font-size:24px;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"color:rgb(33,37,41);font-family:Roboto, sans-serif;font-size:16px;font-weight:400;\\\"><p style=\\\"margin-right:0px;margin-left:0px;font-size:16px;color:rgb(151,175,213);\\\">Nullam turpis dolorem, vivamus placerat in donec est, nonummy tristique massa a, dui felis in. Nulla lorem aenean montes varius massula sed, ut at ante, quis velit, at amet amet placerat. Vestibulum in porttitsum eros vel in, imperdiet amet aliquam et purus dictum. In nunc nulla orci. A massa curabitur, etiam iure ulum, blandit ullamcorper, justo at aenean pulvinar. Felis aliquam hac duis et feugiat eu. Duis feugiat volutpat bibendum, eget a nisl est eros, nibh metus placerat faucibus penatibus, natoque diam.<\\/p><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-family:Poppins, sans-serif;font-weight:600;line-height:1.5;color:rgb(255,255,255);font-size:24px;\\\">Consent and Information Collection and Use<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-family:Poppins, sans-serif;font-weight:600;line-height:1.5;color:rgb(255,255,255);font-size:24px;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"margin-top:25px;color:rgb(33,37,41);font-family:Roboto, sans-serif;font-size:16px;font-weight:400;\\\"><p style=\\\"margin-right:0px;margin-left:0px;font-size:16px;color:rgb(151,175,213);\\\">Rictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dtucongue penatibus suspendissjusto, eget adipiscing, eros in donec ligula cursus integer. Accumsan egesttupdebitis, placerat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phaodo audales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie dolor amet peiet feugi nim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus pellentesque augue, leo nisl dis vehicula, vehicula magna. Porttitor praesent facilisis aliquet.<\\/p><p style=\\\"margin-right:0px;margin-left:0px;font-size:16px;color:rgb(151,175,213);\\\">Eictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna diconpbus suspendissjusto, eget adipiscing, eros in donec ligula cursus integer. Accumsan egestas tpurgna debplarat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phasellus ipsum.coogue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie dolor ametperdiet fgiat. Enim lacus eu duisest.<\\/p><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-family:Poppins, sans-serif;font-weight:600;line-height:1.5;color:rgb(255,255,255);font-size:24px;\\\">Cookies and Log Files<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-family:Poppins, sans-serif;font-weight:600;line-height:1.5;color:rgb(255,255,255);font-size:24px;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"margin-top:25px;color:rgb(33,37,41);font-family:Roboto, sans-serif;font-size:16px;font-weight:400;\\\"><p style=\\\"margin-right:0px;margin-left:0px;font-size:16px;color:rgb(151,175,213);\\\">Dictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dicongen pebus suspendissjusto, eget adipiscing, eros in donec ligula cursus integer. Accumsan egestas tpmagbitis plarat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phaselsum.coogue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodoostie dolor amet imperdiet feugiat. Enim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus pellentesque augue, leo nisl dis vehicula, vehicula magna.<\\/p><ul class=\\\"cmn-list\\\" style=\\\"margin-top:20px;\\\"><li><span style=\\\"color:rgb(151,175,213);\\\">Aras mi ac facilisis nec turpis maecenas, curabitur penatibus bibendum nibh nec, lorem integer donec a, risus quis ullamcorper, ante sapien wisi integer. Neque accumsan vestibulum. Vestibulum venenatis sem sit. Mauris eu curabitur eros, turpis elit alias in morbi, ac natoque quis, porttitor amet ut, eu eu aenean aliquam augue vel. Sed placat in scelerisque, purus metus est, scelerisque quis purusi<\\/span><\\/li><li><span style=\\\"color:rgb(151,175,213);\\\"><br \\/><\\/span><\\/li><\\/ul><span style=\\\"color:rgb(151,175,213);\\\">Cras mi ac facilisis nec turpis maecenas, curabitur penatibus bibendum nibh nec, lorem integer donec a, risus quis ullamcorper, ante sapien wisi integer. Neque accumiulum. Vestibulum venenatis sem sit. Mauris eu curabitur eros, turpis elit alias in morbi, ac natoque quis, porttitor amet ut, eu eu aenean aliquam augue vel. Sed placerat in scesque, purus metus est, scelerisque quis purusi<\\/span><\\/div><div class=\\\"block-content\\\" style=\\\"margin-top:25px;font-family:Roboto, sans-serif;font-size:16px;font-weight:400;\\\"><font color=\\\"#97afd5\\\"><br \\/><\\/font><span style=\\\"color:rgb(151,175,213);\\\">Qras mi ac facilisis nec turpis maecenas, curabitur penatibus bibendum nibh nec, lorem integer donec a, risus quis ullamcorper, ante sapien wisi integer. Neque accumsan vestibulum. Vestibulum venenatis sem sit. Mauris eu curabitur eros, turpis elit alias in morbi, ac natoque quis, porttitor amet ut, eu eu aenean aliquam augue vel. Sed placerat in scelerisque, purus metus est, scelerisque quis purus i<\\/span><br \\/><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-family:Poppins, sans-serif;font-weight:600;line-height:1.5;color:rgb(255,255,255);font-size:24px;\\\">Data Security and Retention<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-family:Poppins, sans-serif;font-weight:600;line-height:1.5;color:rgb(255,255,255);font-size:24px;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"margin-top:25px;color:rgb(33,37,41);font-family:Roboto, sans-serif;font-size:16px;font-weight:400;\\\"><p style=\\\"margin-right:0px;margin-left:0px;font-size:16px;color:rgb(151,175,213);\\\">Aictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dicongue penatibus suspendisjusget adipiscing, eros in donec ligula cursus integer. Accumsan egestas turpis rebiti placerat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phasellus m.modo augue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie doloremrdiet feugiat. Enim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus tesque augue, leo nisl dis vehicula, vehicula magna.<\\/p><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-family:Poppins, sans-serif;font-weight:600;line-height:1.5;color:rgb(255,255,255);font-size:24px;\\\">Information Form Customer<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-family:Poppins, sans-serif;font-weight:600;line-height:1.5;color:rgb(255,255,255);font-size:24px;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"margin-top:25px;color:rgb(33,37,41);font-family:Roboto, sans-serif;font-size:16px;font-weight:400;\\\"><p style=\\\"margin-right:0px;margin-left:0px;font-size:16px;color:rgb(151,175,213);\\\">Aictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dtucongue penatibus suspendisjusget adipiscing, eros in donec ligula cursus integer. Accumsan egestas turpis rubiti placerat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phasellus ipsodo augue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie dolemrdiet feugiat. Enim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus pelltesque augue, leo nisl dis vehicula, vehicula magna.<\\/p><\\/div><\\/div>\"}', '2021-06-06 05:37:50', '2021-06-07 09:09:48'),
(50, 'short_links.element', '{\"title\":\"Our Mission\",\"description\":\"<h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Overview<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Nullam turpis dolorem, vivamus placerat in donec est, nonummy tristique massa a, dui felis in. Nulla lorem aenean montes varius massula sed, ut at ante, quis velit, at amet amet placerat. Vestibulum in porttitsum eros vel in, imperdiet amet aliquam et purus dictum. In nunc nulla orci. A massa curabitur, etiam iure ulum, blandit ullamcorper, justo at aenean pulvinar. Felis aliquam hac duis et feugiat eu. Duis feugiat volutpat bibendum, eget a nisl est eros, nibh metus placerat faucibus penatibus, natoque diam.<\\/p><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Consent and Information Collection and Use<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Rictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dtucongue penatibus suspendissjusto, eget adipiscing, eros in donec ligula cursus integer. Accumsan egesttupdebitis, placerat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phaodo audales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie dolor amet peiet feugi nim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus pellentesque augue, leo nisl dis vehicula, vehicula magna. Porttitor praesent facilisis aliquet.<\\/p><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Eictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna diconpbus suspendissjusto, eget adipiscing, eros in donec ligula cursus integer. Accumsan egestas tpurgna debplarat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phasellus ipsum.coogue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie dolor ametperdiet fgiat. Enim lacus eu duisest.<\\/p><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Cookies and Log Files<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Dictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dicongen pebus suspendissjusto, eget adipiscing, eros in donec ligula cursus integer. Accumsan egestas tpmagbitis plarat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phaselsum.coogue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodoostie dolor amet imperdiet feugiat. Enim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus pellentesque augue, leo nisl dis vehicula, vehicula magna.<\\/p><ul class=\\\"cmn-list\\\" style=\\\"margin-top:20px;\\\"><li><span style=\\\"color:rgb(151,175,213);\\\">Aras mi ac facilisis nec turpis maecenas, curabitur penatibus bibendum nibh nec, lorem integer donec a, risus quis ullamcorper, ante sapien wisi integer. Neque accumsan vestibulum. Vestibulum venenatis sem sit. Mauris eu curabitur eros, turpis elit alias in morbi, ac natoque quis, porttitor amet ut, eu eu aenean aliquam augue vel. Sed placat in scelerisque, purus metus est, scelerisque quis purusi<\\/span><\\/li><li><span style=\\\"color:rgb(151,175,213);\\\"><br \\/><\\/span><\\/li><\\/ul><span style=\\\"color:rgb(151,175,213);\\\">Cras mi ac facilisis nec turpis maecenas, curabitur penatibus bibendum nibh nec, lorem integer donec a, risus quis ullamcorper, ante sapien wisi integer. Neque accumiulum. Vestibulum venenatis sem sit. Mauris eu curabitur eros, turpis elit alias in morbi, ac natoque quis, porttitor amet ut, eu eu aenean aliquam augue vel. Sed placerat in scesque, purus metus est, scelerisque quis purusi<\\/span><\\/div><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><font color=\\\"#97afd5\\\"><br \\/><\\/font><span style=\\\"color:rgb(151,175,213);\\\">Qras mi ac facilisis nec turpis maecenas, curabitur penatibus bibendum nibh nec, lorem integer donec a, risus quis ullamcorper, ante sapien wisi integer. Neque accumsan vestibulum. Vestibulum venenatis sem sit. Mauris eu curabitur eros, turpis elit alias in morbi, ac natoque quis, porttitor amet ut, eu eu aenean aliquam augue vel. Sed placerat in scelerisque, purus metus est, scelerisque quis purus i<\\/span><br \\/><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Data Security and Retention<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Aictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dicongue penatibus suspendisjusget adipiscing, eros in donec ligula cursus integer. Accumsan egestas turpis rebiti placerat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phasellus m.modo augue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie doloremrdiet feugiat. Enim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus tesque augue, leo nisl dis vehicula, vehicula magna.<\\/p><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Information Form Customer<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Aictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dtucongue penatibus suspendisjusget adipiscing, eros in donec ligula cursus integer. Accumsan egestas turpis rubiti placerat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phasellus ipsodo augue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie dolemrdiet feugiat. Enim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus pelltesque augue, leo nisl dis vehicula, vehicula magna.<\\/p><\\/div>\"}', '2021-06-06 05:38:03', '2021-06-07 09:10:15'),
(51, 'short_links.element', '{\"title\":\"About Us\",\"description\":\"<h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Overview<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Nullam turpis dolorem, vivamus placerat in donec est, nonummy tristique massa a, dui felis in. Nulla lorem aenean montes varius massula sed, ut at ante, quis velit, at amet amet placerat. Vestibulum in porttitsum eros vel in, imperdiet amet aliquam et purus dictum. In nunc nulla orci. A massa curabitur, etiam iure ulum, blandit ullamcorper, justo at aenean pulvinar. Felis aliquam hac duis et feugiat eu. Duis feugiat volutpat bibendum, eget a nisl est eros, nibh metus placerat faucibus penatibus, natoque diam.<\\/p><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Consent and Information Collection and Use<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Rictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dtucongue penatibus suspendissjusto, eget adipiscing, eros in donec ligula cursus integer. Accumsan egesttupdebitis, placerat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phaodo audales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie dolor amet peiet feugi nim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus pellentesque augue, leo nisl dis vehicula, vehicula magna. Porttitor praesent facilisis aliquet.<\\/p><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Eictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna diconpbus suspendissjusto, eget adipiscing, eros in donec ligula cursus integer. Accumsan egestas tpurgna debplarat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phasellus ipsum.coogue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie dolor ametperdiet fgiat. Enim lacus eu duisest.<\\/p><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Cookies and Log Files<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Dictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dicongen pebus suspendissjusto, eget adipiscing, eros in donec ligula cursus integer. Accumsan egestas tpmagbitis plarat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phaselsum.coogue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodoostie dolor amet imperdiet feugiat. Enim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus pellentesque augue, leo nisl dis vehicula, vehicula magna.<\\/p><ul class=\\\"cmn-list\\\" style=\\\"margin-top:20px;\\\"><li><span style=\\\"color:rgb(151,175,213);\\\">Aras mi ac facilisis nec turpis maecenas, curabitur penatibus bibendum nibh nec, lorem integer donec a, risus quis ullamcorper, ante sapien wisi integer. Neque accumsan vestibulum. Vestibulum venenatis sem sit. Mauris eu curabitur eros, turpis elit alias in morbi, ac natoque quis, porttitor amet ut, eu eu aenean aliquam augue vel. Sed placat in scelerisque, purus metus est, scelerisque quis purusi<\\/span><\\/li><li><span style=\\\"color:rgb(151,175,213);\\\"><br \\/><\\/span><\\/li><\\/ul><span style=\\\"color:rgb(151,175,213);\\\">Cras mi ac facilisis nec turpis maecenas, curabitur penatibus bibendum nibh nec, lorem integer donec a, risus quis ullamcorper, ante sapien wisi integer. Neque accumiulum. Vestibulum venenatis sem sit. Mauris eu curabitur eros, turpis elit alias in morbi, ac natoque quis, porttitor amet ut, eu eu aenean aliquam augue vel. Sed placerat in scesque, purus metus est, scelerisque quis purusi<\\/span><\\/div><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><font color=\\\"#97afd5\\\"><br \\/><\\/font><span style=\\\"color:rgb(151,175,213);\\\">Qras mi ac facilisis nec turpis maecenas, curabitur penatibus bibendum nibh nec, lorem integer donec a, risus quis ullamcorper, ante sapien wisi integer. Neque accumsan vestibulum. Vestibulum venenatis sem sit. Mauris eu curabitur eros, turpis elit alias in morbi, ac natoque quis, porttitor amet ut, eu eu aenean aliquam augue vel. Sed placerat in scelerisque, purus metus est, scelerisque quis purus i<\\/span><br \\/><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Data Security and Retention<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Aictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dicongue penatibus suspendisjusget adipiscing, eros in donec ligula cursus integer. Accumsan egestas turpis rebiti placerat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phasellus m.modo augue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie doloremrdiet feugiat. Enim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus tesque augue, leo nisl dis vehicula, vehicula magna.<\\/p><\\/div><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\">Information Form Customer<\\/h3><h3 class=\\\"title\\\" style=\\\"margin-bottom:15px;font-weight:600;line-height:1.5;font-size:24px;color:rgb(255,255,255);font-family:Poppins, sans-serif;\\\"><\\/h3><div class=\\\"block-content\\\" style=\\\"font-family:Roboto, sans-serif;margin-top:25px;\\\"><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(151,175,213);font-size:16px;\\\">Aictumst molestie dui nulla bibendum tellus. Purus tincidunt amet pellentesque dis aliquet, urna dtucongue penatibus suspendisjusget adipiscing, eros in donec ligula cursus integer. Accumsan egestas turpis rubiti placerat vestibulum commodo nascetur odio at, tortor dui posuere ornare donec mauris, phasellus ipsodo augue. A sodales venenatis, amet massa fringilla, euismod elit tellus amet. Commodo molestie dolemrdiet feugiat. Enim lacus eu duis est. Risus gravida eget, consequat tortor, felis elit dolor mauris purus pelltesque augue, leo nisl dis vehicula, vehicula magna.<\\/p><\\/div>\"}', '2021-06-06 05:38:30', '2021-06-07 09:10:23'),
(52, 'banner.content', '{\"has_image\":\"1\",\"heading\":\"World\'s Best\",\"sub_heading\":\"MOVIES OF THIS SEASON\",\"button_1\":\"Sign In\",\"button_1_link\":\"user\\/login\",\"button_2\":\"Sign Up\",\"button_2_link\":\"user\\/register\",\"background_image\":\"628a12b93737b1653215929.jpg\"}', '2021-06-06 05:48:22', '2022-05-22 09:10:19'),
(53, 'breadcrumb.content', '{\"has_image\":\"1\",\"background_image\":\"62aacd8125c1b1655360897.png\"}', '2021-06-07 04:47:16', '2022-06-16 04:58:17'),
(54, 'account.content', '{\"has_image\":\"1\",\"background_image\":\"60bdf05f110db1623060575.jpg\"}', '2021-06-07 09:39:35', '2021-06-07 09:39:35'),
(55, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"lab la-facebook-f\\\"><\\/i>\",\"url\":\"https:\\/\\/www.facebook.com\\/\"}', '2022-05-25 10:31:48', '2022-05-25 10:31:48'),
(56, 'social_icon.element', '{\"title\":\"Twitter\",\"social_icon\":\"<i class=\\\"lab la-twitter\\\"><\\/i>\",\"url\":\"https:\\/\\/www.twitter.com\\/\"}', '2022-05-25 10:32:22', '2022-05-25 10:32:22'),
(57, 'social_icon.element', '{\"title\":\"Instagram\",\"social_icon\":\"<i class=\\\"lab la-instagram\\\"><\\/i>\",\"url\":\"https:\\/\\/www.instagram.com\\/\"}', '2022-05-25 10:33:37', '2022-05-25 10:33:37'),
(58, 'social_icon.element', '{\"title\":\"Linkedin\",\"social_icon\":\"<i class=\\\"lab la-linkedin\\\"><\\/i>\",\"url\":\"https:\\/\\/www.linkedin.com\\/\"}', '2022-05-25 10:34:07', '2022-05-25 10:34:07'),
(59, 'login.content', '{\"has_image\":\"1\",\"background_image\":\"62920081836521653735553.jpg\"}', '2022-05-28 09:29:13', '2022-05-28 09:29:13'),
(60, 'register.content', '{\"has_image\":\"1\",\"background_image\":\"62920368a68be1653736296.jpg\"}', '2022-05-28 09:41:36', '2022-05-28 09:41:36'),
(61, 'code_verify.content', '{\"has_image\":\"1\",\"background_image\":\"62920e53857211653739091.jpg\"}', '2022-05-28 10:28:11', '2022-05-28 10:28:11'),
(62, 'email_verify.content', '{\"has_image\":\"1\",\"background_image\":\"62920e56dabf91653739094.jpg\"}', '2022-05-28 10:28:14', '2022-05-28 10:28:15'),
(63, 'reset_password_email.content', '{\"has_image\":\"1\",\"background_image\":\"62920e5d5edfb1653739101.jpg\"}', '2022-05-28 10:28:21', '2022-05-28 10:28:21'),
(64, 'sms_verify.content', '{\"has_image\":\"1\",\"background_image\":\"62920e60e3c0c1653739104.jpg\"}', '2022-05-28 10:28:24', '2022-05-28 10:28:25'),
(65, 'reset_password.content', '{\"has_image\":\"1\",\"background_image\":\"6292131bcf52b1653740315.jpg\"}', '2022-05-28 10:48:35', '2022-05-28 10:48:36');
INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`) VALUES
(66, 'maintenance.data', '{\"description\":\"<div class=\\\"mb-5\\\" style=\\\"font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"text-align: center; font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif;\\\"><font color=\\\"#ffffff\\\">Sorry! we are down for maintenance.<\\/font><\\/h3><p class=\\\"font-18\\\" style=\\\"text-align: center; margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\"><font color=\\\"#ffffff\\\">We will be back soon<\\/font><\\/p><\\/div>\"}', NULL, '2022-06-19 11:09:06'),
(67, 'app_welcome.content', '{\"has_image\":\"1\",\"screen_1_heading\":\"Sit laboriosam inc\",\"screen_1_subheading\":\"Elit elit sit exer\",\"screen_2_heading\":\"Doloremque quis saep\",\"screen_2_subheading\":\"Sunt id earum dolor\",\"screen_3_heading\":\"Asperiores fugiat ve\",\"screen_3_subheading\":\"Aspernatur ratione d\",\"background_image\":\"62c567b3dde201657104307.png\"}', '2022-06-07 05:07:07', '2022-07-06 20:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `code` int(10) DEFAULT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>enable, 2=>disable',
  `gateway_parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supported_currencies` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crypto` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `form_id`, `code`, `name`, `alias`, `status`, `gateway_parameters`, `supported_currencies`, `crypto`, `extra`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 101, 'Paypal', 'Paypal', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"sb-owud61543012@business.example.com\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:04:38'),
(2, 0, 102, 'Perfect Money', 'PerfectMoney', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"hR26aw02Q1eEeUPSIfuwNypXX\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:35:33'),
(3, 0, 103, 'Stripe Hosted', 'Stripe', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:48:36'),
(4, 0, 104, 'Skrill', 'Skrill', 1, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"merchant@skrill.com\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"---\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:30:16'),
(5, 0, 105, 'PayTM', 'Paytm', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"DIY12386817555501617\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"bKMfNxPPf_QdZppa\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"DIYtestingweb\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"Retail\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"WEB\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 03:00:44'),
(6, 0, 106, 'Payeer', 'Payeer', 0, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"866989763\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"7575\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.Payeer\"}}', NULL, '2019-09-14 13:14:22', '2020-12-28 01:26:58'),
(7, 0, 107, 'PayStack', 'Paystack', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"pk_test_cd330608eb47970889bca397ced55c1dd5ad3783\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"sk_test_8a0b1f199362d7acc9c390bff72c4e81f74e2ac3\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.Paystack\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.Paystack\"}}\r\n', NULL, '2019-09-14 13:14:22', '2021-05-21 01:49:51'),
(8, 0, 108, 'VoguePay', 'Voguepay', 1, '{\"merchant_id\":{\"title\":\"MERCHANT ID\",\"global\":true,\"value\":\"demo\"}}', '{\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:22:38'),
(9, 0, 109, 'Flutterwave', 'Flutterwave', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------------------\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"------------------\"}}', '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-06-05 11:37:45'),
(10, 0, 110, 'RazorPay', 'Razorpay', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"rzp_test_kiOtejPbRZU90E\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"osRDebzEqbsE1kbyQJ4y0re7\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:51:32'),
(11, 0, 111, 'Stripe Storefront', 'StripeJs', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:53:10'),
(12, 0, 112, 'Instamojo', 'Instamojo', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_2241633c3bc44a3de84a3b33969\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"test_279f083f7bebefd35217feef22d\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:56:20'),
(13, 0, 501, 'Blockchain', 'Blockchain', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"55529946-05ca-48ff-8710-f279d86b1cc5\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"xpub6CKQ3xxWyBoFAF83izZCSFUorptEU9AF8TezhtWeMU5oefjX3sFSBw62Lr9iHXPkXmDQJJiHZeTRtD9Vzt8grAYRhvbz4nEvBu3QKELVzFK\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, NULL, '2019-09-14 13:14:22', '2022-03-21 07:41:56'),
(15, 0, 503, 'CoinPayments', 'Coinpayments', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"---------------\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"------------\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"93a1e014c4ad60a7980b4a7239673cb4\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"USDT.BEP20\":\"Tether USD (BSC Chain)\",\"USDT.ERC20\":\"Tether USD (ERC20)\",\"USDT.TRC20\":\"Tether USD (Tron/TRC20)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, NULL, '2019-09-14 13:14:22', '2022-05-23 07:51:27'),
(16, 0, 504, 'CoinPayments Fiat', 'CoinpaymentsFiat', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"6515561\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:07:44'),
(17, 0, 505, 'Coingate', 'Coingate', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"6354mwVCEw5kHzRJ6thbGo-N\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-03-30 09:24:57'),
(18, 0, 506, 'Coinbase Commerce', 'CoinbaseCommerce', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"c47cd7df-d8e8-424b-a20a\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"55871878-2c32-4f64-ab66\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.CoinbaseCommerce\"}}', NULL, '2019-09-14 13:14:22', '2021-05-21 02:02:47'),
(24, 0, 113, 'Paypal Express', 'PaypalSdk', 1, '{\"clientId\":{\"title\":\"Paypal Client ID\",\"global\":true,\"value\":\"Ae0-tixtSV7DvLwIh3Bmu7JvHrjh5EfGdXr_cEklKAVjjezRZ747BxKILiBdzlKKyp-W8W_T7CKH1Ken\"},\"clientSecret\":{\"title\":\"Client Secret\",\"global\":true,\"value\":\"EOhbvHZgFNO21soQJT1L9Q00M3rK6PIEsdiTgXRBt2gtGtxwRer5JvKnVUGNU5oE63fFnjnYY7hq3HBA\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-20 23:01:08'),
(25, 0, 114, 'Stripe Checkout', 'StripeV3', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"},\"end_point\":{\"title\":\"End Point Secret\",\"global\":true,\"value\":\"whsec_lUmit1gtxwKTveLnSe88xCSDdnPOt8g5\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, '{\"webhook\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.StripeV3\"}}', NULL, '2019-09-14 13:14:22', '2021-05-21 00:58:38'),
(27, 0, 115, 'Mollie', 'Mollie', 1, '{\"mollie_email\":{\"title\":\"Mollie Email \",\"global\":true,\"value\":\"vi@gmail.com\"},\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_cucfwKTWfft9s337qsVfn5CC4vNkrn\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:44:45'),
(30, 0, 116, 'Cashmaal', 'Cashmaal', 1, '{\"web_id\":{\"title\":\"Web Id\",\"global\":true,\"value\":\"3748\"},\"ipn_key\":{\"title\":\"IPN Key\",\"global\":true,\"value\":\"546254628759524554647987\"}}', '{\"PKR\":\"PKR\",\"USD\":\"USD\"}', 0, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.Cashmaal\"}}', NULL, NULL, '2021-06-22 08:05:04'),
(36, 0, 119, 'Mercado Pago', 'MercadoPago', 1, '{\"access_token\":{\"title\":\"Access Token\",\"global\":true,\"value\":\"3Vee5S2F\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2021-07-17 09:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_code` int(10) DEFAULT NULL,
  `gateway_alias` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `max_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `percent_charge` decimal(5,2) NOT NULL DEFAULT 0.00,
  `fixed_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_parameter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `email_from` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_body` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_color` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'email configuration',
  `sms_config` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `global_shortcodes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kv` tinyint(1) NOT NULL DEFAULT 0,
  `ev` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'mobile verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'sms notification, 0 - dont send, 1 - send',
  `force_ssl` tinyint(1) NOT NULL DEFAULT 0,
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT 0,
  `secure_password` tinyint(1) NOT NULL DEFAULT 0,
  `agree` tinyint(1) NOT NULL DEFAULT 0,
  `registration` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Off	, 1: On',
  `active_template` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ftp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_cron` datetime DEFAULT NULL,
  `system_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `cur_text`, `cur_sym`, `email_from`, `email_template`, `sms_body`, `sms_from`, `base_color`, `secondary_color`, `server`, `mail_config`, `sms_config`, `global_shortcodes`, `kv`, `ev`, `en`, `sv`, `sn`, `force_ssl`, `maintenance_mode`, `secure_password`, `agree`, `registration`, `active_template`, `ftp`, `last_cron`, `system_info`, `created_at`, `updated_at`) VALUES
(1, 'PlayLab', 'USD', '$', 'do-not-reply@viserlab.com', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\">\r\n                          <a href=\"#\">\r\n                            <img style=\"display:block; line-height:0px; font-size:0px; border:0px;\" src=\"https://i.imgur.com/Z1qtvtV.png\" alt=\"img\">\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello {{fullname}} ({{username}})</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\">{{message}}</td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2021 <a href=\"#\">{{site_name}}</a>&nbsp;. All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', 'hi {{fullname}} ({{username}}), {{message}}', 'ViserAdmin', 'D50055', '1B1B3F', 'current', '{\"name\":\"php\"}', '{\"name\":\"nexmo\",\"clickatell\":{\"api_key\":\"----------------\"},\"infobip\":{\"username\":\"------------8888888\",\"password\":\"-----------------\"},\"message_bird\":{\"api_key\":\"-------------------\"},\"nexmo\":{\"api_key\":\"----------------------\",\"api_secret\":\"----------------------\"},\"sms_broadcast\":{\"username\":\"----------------------\",\"password\":\"-----------------------------\"},\"twilio\":{\"account_sid\":\"-----------------------\",\"auth_token\":\"---------------------------\",\"from\":\"----------------------\"},\"text_magic\":{\"username\":\"-----------------------\",\"apiv2_key\":\"-------------------------------\"},\"custom\":{\"method\":\"get\",\"url\":\"https:\\/\\/hostname\\/demo-api-v1\",\"headers\":{\"name\":[\"api_key\"],\"value\":[\"test_api 555\"]},\"body\":{\"name\":[\"from_number\"],\"value\":[\"5657545757\"]}}}', '{\n    \"site_name\":\"Name of your site\",\n    \"site_currency\":\"Currency of your site\",\n    \"currency_symbol\":\"Symbol of currency\"\n}', 0, 1, 1, 0, 1, 0, 0, 0, 1, 1, 'labflix', '{\"domain\":\"https:\\/\\/yourdomain.com\",\"host\":\"yourhost.com\",\"username\":\"username\",\"password\":\"password\",\"port\":\"port\",\"root\":\"\\/public_html\\/foldername\"}', NULL, '[]', NULL, '2022-07-07 08:36:29');

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `item_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `episode_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `sub_category_id` int(11) DEFAULT 0,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preview_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = single item, 2 = Episode Item,3 = trailer',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `single` tinyint(1) NOT NULL DEFAULT 0,
  `trending` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 1,
  `version` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = free, 1 = paid, 2 = episode item',
  `tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ratings` decimal(5,2) NOT NULL DEFAULT 0.00,
  `view` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_align` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: left to right text align, 1: right to left text align',
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: not default language, 1: default language',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `icon`, `text_align`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', '5f15968db08911595250317.png', 0, 1, '2020-07-06 03:47:55', '2022-04-09 03:47:04'),
(5, 'Hindi', 'hn', NULL, 0, 0, '2020-12-29 02:20:07', '2022-04-09 03:47:04'),
(9, 'Bangla', 'bn', NULL, 0, 0, '2021-03-14 04:37:41', '2022-03-30 12:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `live_televisions`
--

CREATE TABLE `live_televisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sender` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_from` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_to` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notification_type` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcodes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_status` tinyint(1) NOT NULL DEFAULT 1,
  `sms_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `act`, `name`, `subj`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`, `created_at`, `updated_at`) VALUES
(3, 'DEPOSIT_COMPLETE', 'Deposit - Automated - Successful', 'Deposit Completed Successfully', '<div>Your deposit of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been completed Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#000000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Received : {{method_amount}} {{method_currency}}<br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} Deposit successfully by {{method_name}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-03 02:25:43'),
(4, 'DEPOSIT_APPROVE', 'Deposit - Manual - Approved', 'Your Deposit is Approved', '<div style=\"font-family: Montserrat, sans-serif;\">Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>is Approved .<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div>', 'Admin Approve Your {{amount}} {{site_currency}} payment request by {{method_name}} transaction : {{trx}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-03 02:26:07'),
(5, 'DEPOSIT_REJECT', 'Deposit - Manual - Rejected', 'Your Deposit Request is Rejected', '<div style=\"font-family: Montserrat, sans-serif;\">Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}} has been rejected</span>.<span style=\"font-weight: bolder;\"><br></span></div><div><br></div><div><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge: {{charge}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number was : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">if you have any queries, feel free to contact us.<br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><br><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">{{rejection_message}}</span><br>', 'Admin Rejected Your {{amount}} {{site_currency}} payment request by {{method_name}}\r\n\r\n{{rejection_message}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"rejection_message\":\"Rejection message by the admin\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-05 03:45:27'),
(6, 'DEPOSIT_REQUEST', 'Deposit - Manual - Requested', 'Deposit Request Submitted Successfully', '<div>Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>submitted successfully<span style=\"font-weight: bolder;\">&nbsp;.<br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}}<br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} Deposit requested by {{method_name}}. Charge: {{charge}} . Trx: {{trx}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-03 02:29:19'),
(7, 'PASS_RESET_CODE', 'Password - Reset - Code', 'Password Reset', '<div style=\"font-family: Montserrat, sans-serif;\">We have received a request to reset the password for your account on&nbsp;<span style=\"font-weight: bolder;\">{{time}} .<br></span></div><div style=\"font-family: Montserrat, sans-serif;\">Requested From IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>.</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><div>Your account recovery code is:&nbsp;&nbsp;&nbsp;<font size=\"6\"><span style=\"font-weight: bolder;\">{{code}}</span></font></div><div><br></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><div><font size=\"4\" color=\"#CC0000\"><br></font></div>', 'Your account recovery code is: {{code}}', '{\"code\":\"Verification code for password reset\",\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:05'),
(8, 'PASS_RESET_DONE', 'Password - Reset - Confirmation', 'You have reset your password', '<p style=\"font-family: Montserrat, sans-serif;\">You have successfully reset your password.</p><p style=\"font-family: Montserrat, sans-serif;\">You changed from&nbsp; IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{time}}</span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><font color=\"#ff0000\">If you did not change that, please contact us as soon as possible.</font></span></p>', 'Your password has been changed successfully', '{\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-05 03:46:35'),
(9, 'ADMIN_SUPPORT_REPLY', 'Support - Reply', 'Reply Support Ticket', '<div><p><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\">A member from our support team has replied to the following ticket:</span></span></p><p><span style=\"font-weight: bolder;\"><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\"><br></span></span></span></p><p><span style=\"font-weight: bolder;\">[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</span></p><p>----------------------------------------------</p><p>Here is the reply :<br></p><p>{{reply}}<br></p></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', 'Your Ticket#{{ticket_id}} :  {{ticket_subject}} has been replied.', '{\"ticket_id\":\"ID of the support ticket\",\"ticket_subject\":\"Subject  of the support ticket\",\"reply\":\"Reply made by the admin\",\"link\":\"URL to view the support ticket\"}', 1, 1, '2021-11-03 12:00:00', '2022-03-20 20:47:51'),
(10, 'EVER_CODE', 'Verification - Email', 'Please verify your email address', '<br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For joining us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Please use the below code to verify your email address.<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your email verification code is:<font size=\"6\"><span style=\"font-weight: bolder;\">&nbsp;{{code}}</span></font></div></div>', '---', '{\"code\":\"Email verification code\"}', 1, 0, '2021-11-03 12:00:00', '2022-04-03 02:32:07'),
(11, 'SVER_CODE', 'Verification - SMS', 'Verify Your Mobile Number', '---', 'Your phone verification code is: {{code}}', '{\"code\":\"SMS Verification Code\"}', 0, 1, '2021-11-03 12:00:00', '2022-03-20 19:24:37'),
(15, 'DEFAULT', 'Default Template', '{{subject}}', '{{message}}', '{{message}}', '{\"subject\":\"Subject\",\"message\":\"Message\"}', 1, 1, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(18, 'SUBSCRIBE_PLAN', 'Subscribe Plan', 'Subscribe Plan', '<div><span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: var(--bs-body-text-align);\"><b>{{plan}}</b>&nbsp;plan&nbsp;</span>subscribed successfully</div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your plan:<br></span></div><div><br></div><div><div>Plan Name: {{plan}}</div></div><div><span style=\"color: rgb(33, 37, 41);\">Package Duration: {{duration}} Days</span><br></div><div>Price: {{price}} {{site_currency}}</div>', '{{plan}} plan subscribed successfully', '{\"plan\":\"plan\",\"price\":\"price\",\"duration\":\"duration\"}', 1, 1, NULL, '2022-05-24 04:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `pagespp`
--

CREATE TABLE `pagespp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'template name',
  `secs` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pagespp`
--

INSERT INTO `pagespp` (`id`, `name`, `slug`, `tempname`, `secs`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'HOME', '/', 'templates.basic.', '[\"about\",\"blog\",\"counter\",\"faq\",\"feature\",\"service\",\"subscribe\"]', 1, '2020-07-11 06:23:58', '2022-03-15 06:56:00'),
(4, 'Blog', 'blog', 'templates.basic.', NULL, 1, '2020-10-22 01:14:43', '2020-10-22 01:14:43'),
(5, 'Contact', 'contact', 'templates.basic.', NULL, 1, '2020-10-22 01:14:53', '2020-10-22 01:14:53'),
(19, 'HOME', 'home', 'templates.basic.', NULL, 0, '2022-05-22 08:37:06', '2022-05-22 08:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pricing` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `duration` int(11) NOT NULL DEFAULT 0,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(10) NOT NULL DEFAULT 0,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption_show` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL DEFAULT 0,
  `plan_id` int(10) NOT NULL DEFAULT 0,
  `expired_date` datetime DEFAULT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_message_id` int(10) UNSIGNED DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_ticket_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) DEFAULT 0,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `firstname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'contains full address',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: banned, 1: active',
  `exp` datetime DEFAULT NULL,
  `ev` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: mobile unverified, 1: mobile verified',
  `reg_step` tinyint(1) NOT NULL DEFAULT 0,
  `ver_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `tsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_ip` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `episode_id` tinyint(1) DEFAULT 0,
  `item_id` int(10) DEFAULT 0,
  `video_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=video,0=link',
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server` tinyint(1) DEFAULT 0 COMMENT '0 = current server, 1 = other server, 2 = link',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `item_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `episode_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertises`
--
ALTER TABLE `advertises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_televisions`
--
ALTER TABLE `live_televisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagespp`
--
ALTER TABLE `pagespp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advertises`
--
ALTER TABLE `advertises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `live_televisions`
--
ALTER TABLE `live_televisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pagespp`
--
ALTER TABLE `pagespp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
