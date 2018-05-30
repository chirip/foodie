-- MySQL dump 10.13  Distrib 5.5.57, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: c9
-- ------------------------------------------------------
-- Server version	5.5.57-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (6,'2014_10_12_000000_create_users_table',1),(7,'2014_10_12_100000_create_password_resets_table',1),(8,'2018_04_21_234752_create_shops_table',2),(9,'2018_05_23_155316_add_column_photo',3),(10,'2018_05_23_161837_change_column_photo',4),(11,'2018_05_23_172014_change_column_photo',5),(12,'2018_05_26_214455_change_column_photo',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shops` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shop_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formatted_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` double(8,6) NOT NULL,
  `lng` double(9,6) NOT NULL,
  `photo` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shops`
--

LOCK TABLES `shops` WRITE;
/*!40000 ALTER TABLE `shops` DISABLE KEYS */;
INSERT INTO `shops` VALUES (2,0,'権八渋谷','日本、〒150-0044 東京都 渋谷区円山町３−６ E・ペースタワー 14F','6fa60a1ad0d339fc3eb56c1f2705a2adc3b828fd',35.657511,139.695524,'','2018-05-01 17:01:21','2018-05-01 17:01:21'),(3,0,'小諸そば 渋谷新南口店','日本、〒150-0002 東京都渋谷区渋谷３丁目１７−４','86aeef794ab120be820d208f76ab335eb9508256',35.656550,139.704616,'','2018-05-02 01:06:20','2018-05-02 01:06:20'),(4,0,'永坂更科','日本、〒150-0043 東京都渋谷区道玄坂2-24-1','3c9724d317c941ef483f5916b12835c8b2bee9b8',35.660787,139.696262,'','2018-05-02 01:06:29','2018-05-02 01:06:29'),(5,1,'蕎麦 冷麦 嵯峨谷 渋谷道玄坂店','日本、〒150-0043 東京都渋谷区道玄坂２丁目２５−７ プラザ道玄坂','8e802805926faed05ecf62382a27660cde3e0e27',35.660295,139.696705,'','2018-05-02 04:57:41','2018-05-02 04:57:41'),(6,1,'蕎麦 冷麦 嵯峨谷 渋谷道玄坂店','日本、〒150-0043 東京都渋谷区道玄坂２丁目２５−７ プラザ道玄坂','8e802805926faed05ecf62382a27660cde3e0e27',35.660295,139.696705,'','2018-05-02 05:24:45','2018-05-02 05:24:45'),(7,1,'蕎麦 冷麦 嵯峨谷 渋谷道玄坂店','日本、〒150-0043 東京都渋谷区道玄坂２丁目２５−７ プラザ道玄坂','8e802805926faed05ecf62382a27660cde3e0e27',35.660295,139.696705,'','2018-05-02 05:59:02','2018-05-02 05:59:02'),(8,1,'野郎ラーメン 渋谷センター街総本店','日本、〒150-0042 東京都渋谷区宇田川町２５−３ プリンスビル','d5082ca310bb1bff8c2b016acd1232aea40d35ad',35.660274,139.699143,'','2018-05-02 06:00:49','2018-05-02 06:00:49'),(9,1,'本家しぶそば','日本、〒150-0002 東京都渋谷区渋谷２丁目２４−１','c30f76fee25ee3815036ee72d18196244cbabc06',35.658476,139.701184,'','2018-05-05 03:11:15','2018-05-05 03:11:15'),(10,1,'多心','日本、〒150-0032 東京都渋谷区桜丘町２１−４ 桜ヶ丘町ビル','d6a5f913b1d85f7ee71d3aa1b2b56ed4e4245ee9',35.654306,139.700840,'','2018-05-05 04:58:40','2018-05-05 04:58:40'),(11,1,'小諸そば 渋谷新南口店','日本、〒150-0002 東京都渋谷区渋谷３丁目１７−４','86aeef794ab120be820d208f76ab335eb9508256',35.656550,139.704616,'','2018-05-08 04:54:33','2018-05-08 04:54:33'),(12,1,'ムルギー','日本、〒150-0043 東京都渋谷区道玄坂２丁目１９−２','6835fdea1962d0ef4b027a5bec1316d3e8fb2508',35.658972,139.696565,'','2018-05-10 06:11:52','2018-05-10 06:11:52'),(13,1,'手造り 釜あげうどん・そば 澤乃井','日本、〒150-0002 東京都渋谷区渋谷１丁目８−５ 渋谷パークプラザ','5f0bca358a6147758bfe6bd59be2c698d2f88601',35.660228,139.705527,'','2018-05-10 20:38:00','2018-05-10 20:38:00'),(14,2,'カレー屋パク森 渋谷店','日本、〒150-0043 東京都渋谷区道玄坂２丁目１６−８ ビジネスVIP渋谷道玄坂坂本ビル','fb4fcd9b5e8b2fc0e3829c1ba257fe567928ba48',35.658109,139.696488,'','2018-05-11 04:54:31','2018-05-11 04:54:31'),(16,2,'アヒルストア','日本、〒151-0063 東京都渋谷区富ヶ谷１丁目１９−４','575b2ab7d46c03a921754e542045f23edbda4b30',35.665805,139.692026,'','2018-05-11 05:14:41','2018-05-11 05:14:41'),(17,3,'アヒルストア','日本、〒151-0063 東京都渋谷区富ヶ谷１丁目１９−４','575b2ab7d46c03a921754e542045f23edbda4b30',35.665805,139.692026,'','2018-05-11 05:40:55','2018-05-11 05:40:55'),(22,2,'福田屋 道玄坂','日本、〒150-0043 東京都渋谷区道玄坂２丁目２５−１５ 福田ビル','ce3588477804e44648c948d0187b9f4eb3175b29',35.659807,139.697666,'','2018-05-11 10:15:38','2018-05-11 10:15:38'),(23,2,'Abura','日本、〒150-0002 東京都渋谷区渋谷３丁目１８−１０','2935205785ab916a1d4faccb6de0f9ce199dfad0',35.656947,139.703992,'','2018-05-11 13:25:45','2018-05-11 13:25:45'),(24,2,'小諸そば 渋谷新南口店','日本、〒150-0002 東京都渋谷区渋谷３丁目１７−４','86aeef794ab120be820d208f76ab335eb9508256',35.656550,139.704616,'','2018-05-11 14:23:00','2018-05-11 14:23:00'),(25,3,'渋谷更科','日本、〒150-0042 東京都渋谷区宇田川町２２−４','939d221538733372ec66f3a5f079ff8384d0df7a',35.659936,139.699815,'','2018-05-11 17:40:09','2018-05-11 17:40:09'),(26,3,'永坂更科','日本、〒150-0043 東京都 渋谷区道玄坂2-24-1','3c9724d317c941ef483f5916b12835c8b2bee9b8',35.660787,139.696262,'','2018-05-11 17:48:27','2018-05-11 17:48:27'),(32,2,'福田屋 道玄坂','日本、〒150-0043 東京都渋谷区道玄坂２丁目２５−１５ 福田ビル','ce3588477804e44648c948d0187b9f4eb3175b29',35.659807,139.697666,'','2018-05-14 05:08:03','2018-05-14 05:08:03'),(33,3,'手打そば おくむら','日本、〒150-0047 東京都 渋谷区 神山町5-7','e87606c13ef14436729cfa6e173716fbaac43942',35.665203,139.694129,'','2018-05-16 03:55:46','2018-05-16 03:55:46'),(35,3,'DRAGON 純豆腐 青山店 宴会/居酒屋/外苑前','日本、〒107-0061 東京都 港区北青山2-7-29 2F','00934f198bc42c6f7894e25f8eab0e2cab2cd4bd',35.671913,139.717091,'','2018-05-16 06:26:30','2018-05-16 06:26:30'),(36,3,'カリー カイラス','日本、〒150-0043 東京都渋谷区道玄坂１丁目１９−１','aa71c1d52994322bb11280a91ae685a08aee4ed6',35.657187,139.696314,'','2018-05-16 06:37:48','2018-05-16 06:37:48'),(37,3,'東京油組総本店 広尾組','日本、〒150-0012 東京都渋谷区広尾５丁目３−１２','422e27cf3e27eeb2b4419c659efa744dc0d837b5',35.650535,139.721441,'','2018-05-22 13:30:19','2018-05-22 13:30:19'),(38,3,'本家しぶそば','日本、〒150-0002 東京都渋谷区渋谷２丁目２４−１','c30f76fee25ee3815036ee72d18196244cbabc06',35.658476,139.701184,'','2018-05-23 03:46:29','2018-05-23 03:46:29'),(41,3,'神山','日本、〒150-0047 東京都渋谷区神山町１０−８','d8fd561a14881fc37be667dad911b0c4736f51c1',35.663370,139.694791,'','2018-05-23 04:58:31','2018-05-23 04:58:31'),(42,2,'多心','日本、〒150-0032 東京都渋谷区桜丘町２１−４ 桜ヶ丘町ビル','d6a5f913b1d85f7ee71d3aa1b2b56ed4e4245ee9',35.654306,139.700840,'','2018-05-23 05:14:03','2018-05-23 05:14:03'),(43,2,'本家しぶそば','日本、〒150-0002 東京都渋谷区渋谷２丁目２４−１','c30f76fee25ee3815036ee72d18196244cbabc06',35.658476,139.701184,'','2018-05-23 14:43:21','2018-05-23 14:43:21'),(44,2,'本家しぶそば','日本、〒150-0002 東京都渋谷区渋谷２丁目２４−１','c30f76fee25ee3815036ee72d18196244cbabc06',35.658476,139.701184,'https://maps.googleapis.com/maps/api/place/js/PhotoService.GetPhoto?1sCmRaAAAAjFfQ3R3moCcB-HFVBFFpxoxfDE0E2FilsvdbIg1D9Zta0xnOnMMNplaL3IoyCyMCBozCHoSNHUaOfus_fNQL7RPjeBuJ8qNKjwPzJsYS99oM4HFzFAXA0Lidy2EymmDkEhDUpAn2pcS8IZF95RrsXCPtGhQnx0jII53FBdvSVMfPuKhjpT3Ozg&3u100&4u100&5m1&2e1&key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=none&token=126034','2018-05-23 17:21:57','2018-05-23 17:21:57'),(45,2,'蕎麦 冷麦 嵯峨谷 渋谷道玄坂店','日本、〒150-0043 東京都渋谷区道玄坂２丁目２５−７ プラザ道玄坂','8e802805926faed05ecf62382a27660cde3e0e27',35.660295,139.696705,'https://maps.googleapis.com/maps/api/place/js/PhotoService.GetPhoto?1sCmRaAAAAzvH1CEfCpeWT8dlt7bGjDQgtn0OoKkMfXZRUJZmtvRLpoQ_u6k55icmg_qijVD_8DMj7JWLb6Pq_D0ik97XXA9OlN5HUi-3cTCwTnrzZbqnoM8ybny8UtTNHDD0Ni3c0EhAbDVtKisRpbMgMVlHzkUuqGhT1HoUKxJ_1JHa_0J2_T5gE21YaCA&3u200&4u200&5m1&2e1&key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=none&token=71221','2018-05-24 04:30:43','2018-05-24 04:30:43'),(46,3,'広尾のカレー','日本、〒150-0012 東京都渋谷区広尾５丁目１７−８','f5c3d6523f18198cc0b8a9ed577bfd87e5f05e6a',35.649430,139.720444,'https://maps.googleapis.com/maps/api/place/js/PhotoService.GetPhoto?1sCmRaAAAAbneG3PwokGOGe8k9EEUlRiLtttcbfQhG7d9ojeoXi5-8GbBf6N1g9_w1lCe_OI78vjk3V3SbuuC8ZA6esxbcnY1yFK4kD6T2SYYompQ8l7yXpZgnupt2a1bPBR6D67IGEhAGdgcf1kLuNTA0GOn0dydeGhQi3MPmHVOHqPjvaVyuXvO8UtG5tQ&3u200&4u200&5m1&2e1&key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=none&token=48758','2018-05-25 14:09:59','2018-05-25 14:09:59'),(47,3,'福田屋 道玄坂','日本、〒150-0043 東京都渋谷区道玄坂２丁目２５−１５ 福田ビル','ce3588477804e44648c948d0187b9f4eb3175b29',35.659807,139.697666,'https://maps.googleapis.com/maps/api/place/js/PhotoService.GetPhoto?1sCmRaAAAAi8410_id6YKYUwKzUEOkgbr4zl7nNh3hxp0wZdiJQ1iCYLSMokqNXzartU-EbksTyepokh5g1dzOm947Z_F660yVmWMqs4QWG9wXzRpyyBjbqIVy_nNiM1qLruLYLr-JEhCbxC1z082KtPT4Bg9Ng9qJGhTxQrQe0IzWEZLiGPjjQCmxw2-sIA&3u200&4u200&5m1&2e1&key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=none&token=117925','2018-05-25 15:21:37','2018-05-25 15:21:37'),(51,4,'ケニックカレー','日本、〒150-0043 東京都渋谷区道玄坂２丁目２５−７−5Ｆ プラザ道玄坂','4cbdef9df702a6ba65b1f19ab089e59b1e5bdcde',35.660321,139.696704,'https://maps.googleapis.com/maps/api/place/js/PhotoService.GetPhoto?1sCmRaAAAADfTvGjlYxuwqfGpTKF9mhffcQyy7U29JqwD-LlCk-76TcPXyNOzcUt_DuF5IJdIcJZb1JQTZM92HxYW3kAC_c7o5yybQc1cFSiZtyzfLnlqHyRQrPRB9RlId8a_EJvfkEhBb_cuO01WPSm9GizyC8uABGhRSWfXGRpGKywCu8fvuNhrYC_f4YA&3u200&4u200&5m1&2e1&key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=none&token=109645','2018-05-25 17:41:54','2018-05-25 17:41:54'),(53,4,'吉そば 渋谷店','日本、〒150-0043 東京都渋谷区道玄坂２丁目６−１２','ed5bd70f4acb2a94fe3bf9dcf145647d85c5c62d',35.658901,139.698397,'https://maps.googleapis.com/maps/api/place/js/PhotoService.GetPhoto?1sCmRaAAAALZ3OIIJiKU7PfcbUdtlH3ztpuVqPEuYbRSjsERc6Qc71qOmbq0Fw8V_JZKYzmYJwI9znt_5QNmWgQbqzmwo1ys-2b6Oj79YCH4wipZ9FfKWLLGrkasK8MzRY0MtFc4gHEhCt5QwEGOb15h0Leoi1GZUrGhTlsUQ6jppKXIh9cq2G_oyyvZ_nvg&3u200&4u200&5m1&2e1&key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=none&token=123033','2018-05-26 21:14:56','2018-05-26 21:14:56'),(54,4,'本家しぶそば','日本、〒150-0002 東京都渋谷区渋谷２丁目２４−１','c30f76fee25ee3815036ee72d18196244cbabc06',35.658476,139.701184,'https://maps.googleapis.com/maps/api/place/js/PhotoService.GetPhoto?1sCmRaAAAAvKE06LQvE3pCLazqIm0mMXEUJ6XaXFf7J278eV261aJqtH9ds-cgm3SxUp0694Ip-WI-MlONa-q4mDy7oR2b-H8cl4vsGVWRsj8InI460sCNLRF6U8oMBSTYxze8b4OIEhBQUOsk78VKLff05ogqR4D-GhTI_iPMsGwEDIsYOiL6JOF9TAzU-w&3u200&4u200&5m1&2e1&key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=none&token=97679','2018-05-26 21:15:28','2018-05-26 21:15:28'),(55,4,'本家しぶそば','日本、〒150-0002 東京都渋谷区渋谷２丁目２４−１','c30f76fee25ee3815036ee72d18196244cbabc06',35.658476,139.701184,NULL,'2018-05-26 21:47:01','2018-05-26 21:47:01'),(57,3,'すごい煮干ラーメン凪 渋谷東口店','日本、〒150-0002 東京都渋谷区渋谷３丁目７−２','eb85493d2015bf18f8b6c30fd89011cdf9c6dbd4',35.657920,139.704650,'https://maps.googleapis.com/maps/api/place/js/PhotoService.GetPhoto?1sCmRaAAAA0j86JVz6lmbyNamRRBm7TanaUaEMcHHMUy2JwH47tioHUT2ej1emFqofuiMqR5Mqrifg3TDrtJf-6Ed9V5Ng0y1DhkBn2u9JEhk0FMF0YN9dsJKyovheChaCZDQNCaQZEhBvgpV-5XCHpk2DsYbnAoJjGhSIugzws7NOxe9lvv6W5s8T3iewCA&3u200&4u200&5m1&2e1&key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=none&token=40657','2018-05-27 14:01:35','2018-05-27 14:01:35'),(58,3,'ムルギー','日本、〒150-0043 東京都 渋谷区道玄坂２丁目１９−２','6835fdea1962d0ef4b027a5bec1316d3e8fb2508',35.658972,139.696565,'https://maps.googleapis.com/maps/api/place/js/PhotoService.GetPhoto?1sCmRaAAAA97hP8eMinqzN5dwhtlx1lh-8QI66m7attlmuq9vi5ttgVENJPoQF621DtoMO2aKrkO5t-2SNOSk5e1n_VCqkzWU4CBIkcfhdVuon8spevlOTOPOjsSDCVbkow3nIwEGOEhBS_We2pu6REKZNx02UMvSEGhQRkxtgyBnr7_iRKqM_svn2hspHrg&3u200&4u200&5m1&2e1&key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=none&token=50917','2018-05-27 14:35:00','2018-05-27 14:35:00'),(59,3,'アートマサシヤ','日本、〒150-0036 東京都渋谷区南平台町２−８ 日興 パレス 南平台 アヅマ 101','69aab796312abe01a73f87e9124c6afc3dd54612',35.655413,139.695995,'https://maps.googleapis.com/maps/api/place/js/PhotoService.GetPhoto?1sCmRaAAAA3aDAUyPHo0OFpRqfE5IRn3ocZFjX6_-Yy6d-ApOF0sgqPKjt3xHPxttVELzAE0heEbEXbtkKMMwDnZ4mYk3azbTiNVUdwm1OTuMCuWP0smKSIKuIZVtRDKTw2ZMb4po6EhD99qX317j-YDGJnF6aVropGhSOeFLj0B7J_I80Y4lVv013DvCn8w&3u200&4u200&5m1&2e1&key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=none&token=5728','2018-05-27 14:36:46','2018-05-27 14:36:46'),(60,3,'名代 富士そば 明治通り店','日本、東京都渋谷区渋谷１丁目１４−１５ 森ビル1F','649c99bb3b29cf01b63e28718f1793c55849e8cf',35.660175,139.702510,'https://maps.googleapis.com/maps/api/place/js/PhotoService.GetPhoto?1sCmRaAAAA3Nhdb6eqRMXsHd5cYZVX5f7miK865E9bPiq2HR5dmy3W14XZOZdPOQyGjvQltKPMRSOsdCqW8jFVUjLKTpSwLJYG85rK4g35lyq683Epk94j_OlLZeqfrMcrwIuRPq_AEhAG20Sm8we_0YUUv6x0bXWdGhSQOH3pakiA0s05sg5GbMT6tf3LaA&3u200&4u200&5m1&2e1&key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=none&token=101234','2018-05-27 16:31:26','2018-05-27 16:31:26'),(61,3,'牛丸－GYUMARU－','日本、〒150-0042 東京都 渋谷区 宇田川町 ３０ ５ 渋谷ＪＯＷビル８F','ab5055a12e321e134a9f704b16d0a590cbe3e4df',35.660915,139.697968,'https://maps.googleapis.com/maps/api/place/js/PhotoService.GetPhoto?1sCmRaAAAAycymjvJN33lXesihbcLLD6grhBWivfk6kNq_xNTfrchdShi2DnexPpFkutMWdZ0PIRUtz0nHE1ZrzAYiAzx7cIzpw_vvLBOgbih9Vwx-X9_ut7BYOkEQWK5I9nx5hDtGEhBRQv0h2m6ohxteJtLKshqyGhQSFpE3ZygigVhaxqfwWjmRzstu3A&3u200&4u200&5m1&2e1&key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=none&token=33781','2018-05-27 16:51:07','2018-05-27 16:51:07');
/*!40000 ALTER TABLE `shops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@co.jp','$2y$10$HgE/5DCA18hp4lvk6UCM6u5XhKuZVZG1umVz0ea0c3I2BqQXnXeoq','7nyfna4DaieRel1InjvvmoGXAfkRlAImracFETKUUMuGZLbDMbofT1h0FQbO','2018-05-02 04:30:24','2018-05-02 04:30:24'),(2,'test2','test2@co.jp','$2y$10$vfILRhVMIUxF5sJZO/DPFu1XmNhfMHjyZBtb6zwkagx1fC5l3irju','GhdZHBNvhbDQcWkqCarrtpxneC8PPn1y2mEWv2QR7YwqXqctC3SrTank5QNT','2018-05-11 04:52:00','2018-05-11 04:52:00'),(3,'test3','test3@co.jp','$2y$10$IxMgIPqdDwsy53kp22hrHOSi65HvKi19C5NajDQhFBZsBqS9emNcq','t2jM6lWGgg6boo1bTqMBcvZJPLlNZt5qxeCehFXRUPMC8AafbmOywkkodVYt','2018-05-11 05:40:21','2018-05-11 05:40:21'),(4,'test4','test4@co.jp','$2y$10$x67k4POS7EqNqmzES5G68eORlWN1xrR6wzePiEJq5UtBccyapCMui','5MRBC0mgGR9Mui00xUwOpV1R7G4WW0pyXD20DdlPn3Yl1EvRoBs4Qf08gBF9','2018-05-25 17:39:11','2018-05-25 17:39:11');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-30 18:32:37
