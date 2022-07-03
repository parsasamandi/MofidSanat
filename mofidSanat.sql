-- MySQL dump 10.13  Distrib 8.0.11, for macos10.13 (x86_64)
--
-- Host: localhost    Database: mofidSanat
-- ------------------------------------------------------
-- Server version	8.0.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (44,'بهترین ها');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `media_url` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `type` int NOT NULL,
  `media_id` int NOT NULL,
  `media_type` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (194,'موتور.jpeg',0,162,'App\\Models\\Product'),(198,'موتور-خودرو-1.jpeg',0,163,'App\\Models\\Product'),(199,'saa',0,61,'App\\Models\\Team'),(206,'personal-picture1.jpeg',0,82,'App\\Models\\Team'),(209,'https://www.aparat.com/video/video/embed/videohash/kCsvo/vt/frame',1,162,'App\\Models\\Product'),(210,'تست.jpeg',0,85,'App\\Models\\Team'),(211,'personal-picture2.jpeg',0,86,'App\\Models\\Team');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2020_10_21_084618_create_cat_table',0),(4,'2020_10_21_084618_create_media_table',0),(5,'2020_10_21_084618_create_password_resets_table',0),(6,'2020_10_21_084618_create_product_table',0),(7,'2020_10_21_084618_create_sub_cat_table',0),(8,'2020_10_21_084618_create_users_table',0),(9,'2020_10_21_084619_add_foreign_keys_to_media_table',0),(10,'2020_10_21_084619_add_foreign_keys_to_product_table',0),(11,'2020_10_21_084619_add_foreign_keys_to_sub_cat_table',0),(12,'2020_11_08_122352_create_cat_table',0),(13,'2020_11_08_122352_create_home_setting_table',0),(14,'2020_11_08_122352_create_media_table',0),(15,'2020_11_08_122352_create_password_resets_table',0),(16,'2020_11_08_122352_create_phone_number_table',0),(17,'2020_11_08_122352_create_product_table',0),(18,'2020_11_08_122352_create_sub_cat_table',0),(19,'2020_11_08_122352_create_team_table',0),(20,'2020_11_08_122352_create_users_table',0),(21,'2020_11_08_122353_add_foreign_keys_to_media_table',0),(22,'2020_11_08_122353_add_foreign_keys_to_phone_number_table',0),(23,'2020_11_08_122353_add_foreign_keys_to_product_table',0),(24,'2020_11_08_122353_add_foreign_keys_to_sub_cat_table',0),(25,'2020_11_26_133644_create_cat_table',0),(26,'2020_11_26_133644_create_home_setting_table',0),(27,'2020_11_26_133644_create_media_table',0),(28,'2020_11_26_133644_create_password_resets_table',0),(29,'2020_11_26_133644_create_phone_number_table',0),(30,'2020_11_26_133644_create_product_table',0),(31,'2020_11_26_133644_create_product_setting_table',0),(32,'2020_11_26_133644_create_sub_cat_table',0),(33,'2020_11_26_133644_create_team_table',0),(34,'2020_11_26_133644_create_users_table',0),(35,'2020_11_26_133645_add_foreign_keys_to_media_table',0),(36,'2020_11_26_133645_add_foreign_keys_to_phone_number_table',0),(37,'2020_11_26_133645_add_foreign_keys_to_product_table',0),(38,'2020_11_26_133645_add_foreign_keys_to_sub_cat_table',0),(39,'2021_01_29_113129_create_cat_table',0),(40,'2021_01_29_113129_create_home_setting_table',0),(41,'2021_01_29_113129_create_media_table',0),(42,'2021_01_29_113129_create_password_resets_table',0),(43,'2021_01_29_113129_create_phone_number_table',0),(44,'2021_01_29_113129_create_product_table',0),(45,'2021_01_29_113129_create_product_setting_table',0),(46,'2021_01_29_113129_create_sub_cat_table',0),(47,'2021_01_29_113129_create_team_table',0),(48,'2021_01_29_113129_create_users_table',0),(49,'2021_01_29_113130_add_foreign_keys_to_media_table',0),(50,'2021_01_29_113130_add_foreign_keys_to_phone_number_table',0),(51,'2021_01_29_113130_add_foreign_keys_to_product_table',0),(52,'2021_01_29_113130_add_foreign_keys_to_sub_cat_table',0),(53,'2021_03_10_124514_create_cat_table',0),(54,'2021_03_10_124514_create_home_setting_table',0),(55,'2021_03_10_124514_create_media_table',0),(56,'2021_03_10_124514_create_password_resets_table',0),(57,'2021_03_10_124514_create_phone_number_table',0),(58,'2021_03_10_124514_create_product_table',0),(59,'2021_03_10_124514_create_product_setting_table',0),(60,'2021_03_10_124514_create_sub_cat_table',0),(61,'2021_03_10_124514_create_team_table',0),(62,'2021_03_10_124514_create_users_table',0),(63,'2021_03_10_124515_add_foreign_keys_to_media_table',0),(64,'2021_03_10_124515_add_foreign_keys_to_phone_number_table',0),(65,'2021_03_10_124515_add_foreign_keys_to_product_table',0),(66,'2021_03_10_124515_add_foreign_keys_to_sub_cat_table',0),(67,'2021_03_10_125006_create_cat_table',0),(68,'2021_03_10_125006_create_home_setting_table',0),(69,'2021_03_10_125006_create_media_table',0),(70,'2021_03_10_125006_create_password_resets_table',0),(71,'2021_03_10_125006_create_phone_number_table',0),(72,'2021_03_10_125006_create_product_table',0),(73,'2021_03_10_125006_create_product_setting_table',0),(74,'2021_03_10_125006_create_sub_cat_table',0),(75,'2021_03_10_125006_create_team_table',0),(76,'2021_03_10_125006_create_users_table',0),(77,'2021_03_10_125007_add_foreign_keys_to_media_table',0),(78,'2021_03_10_125007_add_foreign_keys_to_phone_number_table',0),(79,'2021_03_10_125007_add_foreign_keys_to_product_table',0),(80,'2021_03_10_125007_add_foreign_keys_to_sub_cat_table',0),(81,'2018_08_08_100000_create_telescope_entries_table',2),(82,'2021_05_08_142442_create_categories_table',0),(83,'2021_05_08_142442_create_media_table',0),(84,'2021_05_08_142442_create_password_resets_table',0),(85,'2021_05_08_142442_create_phone_numbers_table',0),(86,'2021_05_08_142442_create_product_settings_table',0),(87,'2021_05_08_142442_create_products_table',0),(88,'2021_05_08_142442_create_settings_table',0),(89,'2021_05_08_142442_create_status_table',0),(90,'2021_05_08_142442_create_subCategories_table',0),(91,'2021_05_08_142442_create_teams_table',0),(92,'2021_05_08_142442_create_users_table',0),(93,'2021_05_08_142443_add_foreign_keys_to_media_table',0),(94,'2021_05_08_142443_add_foreign_keys_to_phone_numbers_table',0),(95,'2021_05_08_142443_add_foreign_keys_to_products_table',0);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `phone_numbers`
--

DROP TABLE IF EXISTS `phone_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `phone_numbers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number` bigint NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `phoneNumber_ibfk1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone_numbers`
--

LOCK TABLES `phone_numbers` WRITE;
/*!40000 ALTER TABLE `phone_numbers` DISABLE KEYS */;
/*!40000 ALTER TABLE `phone_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_settings`
--

DROP TABLE IF EXISTS `product_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `product_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_settings`
--

LOCK TABLES `product_settings` WRITE;
/*!40000 ALTER TABLE `product_settings` DISABLE KEYS */;
INSERT INTO `product_settings` VALUES (1,'header_image','advertisement2.jpg'),(2,'header_text','adsada'),(3,'header_desc','sadsadsa');
/*!40000 ALTER TABLE `product_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(35) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(35) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `size` int NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `category_id` int DEFAULT NULL,
  `subcategory_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_cat` (`subcategory_id`,`category_id`),
  KEY `cat` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`subcategory_id`) REFERENCES `subCategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (162,'موتور s500','s500',12000000,6,'sdfsdfds',44,NULL),(163,'موتور s200','s200',1000000,6,'sdfsdfds',44,NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `font_awesome` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (12,'مشاهده محصولات','در مفید صنعت، شما در هر زمان و مکانی میتوانید محصولات ما را مشاهده کنید','fa fa-desktop'),(13,'محصولات با تغییر کم','محصولات و نرخ قیمت های آنان در مفید صنعت تغییر زیادی نخواهند کرد','fas fa-chart-area'),(14,'مشاوره','مشاوره درباره تک تک محصولات از خدمات ما است','fa fa-road');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'header_image','civil-engineering.jpeg'),(2,'header','مفید صنعت'),(3,'sub_header','جایی برای رشد و موفقیت'),(6,'about_us_header','خریدی ارزان'),(7,'about_us_text','مفید صنعت همواره در تلاش است تا بتواند برای مشتری، راحت ترین و بهترین خرید را فراهم آورد.'),(8,'about_us_header2','عکس محصول'),(9,'about_us_text2','عکس محصول با جزئیات بیشتر برای اعتماد شما به ما، در هر زمان قابل فرستاده شدن است.'),(10,'about_us_header3','کیفیت بالا'),(11,'about_us_text3','افتخار ما این است که محصولی با کیفیت همزمان با نگه داشتن قیمت مناسب برای شما وجود داشته باشد.'),(12,'why_us_imageSize','6'),(13,'why_us_image','265767486.de509627afec3e8283d150634a74395c.jpeg'),(14,'why_us_text','مفید صنعت همواره در پی تلاش شایانی برای خدمتگذاری به شما بزرگوران است.\r\nامید است در این راه به توان همواره پله های موفقیت را طی کرد.\r\nمفید صنعت در سال ۱۳۹۶ در اسفند ماه جذاب به دنیا آمد و اکنون حدود ۵ سال فعالیت کرده است.\r\nاین تیم شامل ۴ نفر عضو با تجربه و جوان میباشد.'),(30,'address','تهران، مرزدارات، سی و پنج متری لاله، بوستان سوم شرقی، پلاک یازده، واحد هفت'),(31,'email_footer','parsasamandizadeh@gmail.com'),(32,'phone_number','989375261250+'),(33,'about_us_image','pexels-andrea-piacquadio-3755440.jpg'),(34,'about_us_imageSize','4'),(35,'header_text','لیست محصولات'),(37,'header_description',NULL),(38,'header_image2','shopping.jpeg');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL COMMENT '0 = VISIBLE | 1 = INVISIBLE ',
  `status_id` int NOT NULL,
  `status_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (10,0,147,'App\\Models\\Product'),(11,0,43,'App\\Models\\Category'),(12,0,148,'App\\Models\\Product'),(13,0,44,'App\\Models\\Category'),(14,0,45,'App\\Models\\Category'),(15,0,149,'App\\Models\\Product'),(16,0,150,'App\\Models\\Product'),(17,0,151,'App\\Models\\Product'),(18,0,152,'App\\Models\\Product'),(19,0,153,'App\\Models\\Product'),(20,0,154,'App\\Models\\Product'),(21,0,155,'App\\Models\\Product'),(27,0,161,'App\\Models\\Product'),(28,0,162,'App\\Models\\Product'),(29,0,163,'App\\Models\\Product');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subCategories`
--

DROP TABLE IF EXISTS `subCategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `subCategories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `c_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subCategories`
--

LOCK TABLES `subCategories` WRITE;
/*!40000 ALTER TABLE `subCategories` DISABLE KEYS */;
INSERT INTO `subCategories` VALUES (34,'sadsadas',0,38);
/*!40000 ALTER TABLE `subCategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `teams` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(55) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `responsibility` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `linkedin_address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `size` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (82,'پارسا سمندی','برنامه نویس ارشد','https://music.youtube.com/playlist?list=OLAK5uy_nOFOZds71WrGjhKToiFK0JGd1Lxwh6Vxk',4),(85,'محمد مهدی فاتحی','تياتر و بازی','https://www.xiaomishop.ir/',4),(86,'فائزه محمدی','مدرس','https://www.ieltsadvantage.com/2015/07/02/how-to-plan-an-ielts-essay/',4);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (12,'Parsa Samandi','parsasamandizadeh@gmail.com','$2y$10$VRJmVtW4h9rxM5X4XS1TpermM8pPYNbk5JZ6xj.msuQLSwNIV08ma',NULL,'2021-05-31 09:31:49','2021-06-07 07:25:32');
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

-- Dump completed on 2022-06-30 10:58:24
