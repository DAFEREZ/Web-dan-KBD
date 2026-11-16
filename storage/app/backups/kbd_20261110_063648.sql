-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: kbd
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anggota`
--

DROP TABLE IF EXISTS `anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anggota` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iv` varbinary(16) NOT NULL,
  `nik` varbinary(255) NOT NULL,
  `no_hp` varbinary(255) DEFAULT NULL,
  `alamat` varbinary(512) DEFAULT NULL,
  `status_iuran` enum('lunas','belum') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anggota`
--

LOCK TABLES `anggota` WRITE;
/*!40000 ALTER TABLE `anggota` DISABLE KEYS */;
INSERT INTO `anggota` VALUES (1,'Siti Aminah','Ketua',_binary 'Hè	\Í€™¡T~8±DA6',_binary 'ñ∂\–)÷π.˙\Â\Zª(<\Õb©\…Ÿé\Í§\r?¶ü]pÖ¢',_binary 'z©\Ô\—Móå<|M1ú∏\n',_binary 'g\Û-µBMﬂÜ\Â!Õ®>$Õ°¡<£\Ÿ	à\ﬂ\ÛI∑$&Ωp®\ﬂ\Û’∫\√M\€\Ûi\—F\Œ\÷','belum','2026-11-09 17:47:46','2026-11-09 17:47:46'),(2,'Dewi Lestari','Sekretaris',_binary '\Êæ⁄≤Q∏Nvb√ê=Ÿ≠˝±',_binary '∞%T9\Œ8\Z3µ\”‘ß≥¢lKá¥\Ô+\ˆ¶d\ıP\øDªm¿',_binary '8à\„\rUcç\n ∑3ì#\¬',_binary 'A`\Õ)H\Î\"aÄ\È$Bã«π\„csu≤zã\Ó\›;mfmWyÅ:(èY]vqî','belum','2026-11-09 17:47:46','2026-11-09 17:47:46'),(3,'Rina Marlina','Bendahara',_binary 'G∫{Cig\ E`Ö\ﬁ.@ws',_binary '{4\Û\\nû°NYUu´\nºá\Î>\”Q\„ c\À¿852Q\ÚLæ',_binary '&gw;\ÍD9¶2∫\˜¥©=\‡',_binary '>@®ì\‡Üä\¬\œ6åπ)\nñ\r∞òô\‹\Ëú5g≤\œEçScdJ´E}>\ﬂ~%]M,\⁄h&','belum','2026-11-09 17:47:46','2026-11-09 17:47:46'),(4,'Yuni Astuti','Anggota',_binary 'ï\Ù\‚qbCì∞B\‚´ó∫;π',_binary 'Dqf¿[ì\‚–Ö>¶<ö\ˆ;íÆ=\Ùk(ÉJé¯\¬PÆ',_binary '†\ÁCuiùB∏\”5$D∫\‡',_binary '(:1ΩWdI\‚\€SÜÑ\Ìå$¢\≈h´‘∂+	Ö\Â5“Æ˙Å§\–X*ïp\·Tn\Ô`ºU,ö','belum','2026-11-09 17:47:46','2026-11-09 17:47:46'),(5,'Ratna Sari','Anggota',_binary 'uy}koPN\◊[¡dór|\»',_binary 'CG¨ß.¡\ﬁ¸|\"\‹\'HéwXº\r∏xø\Z\„2≠¿',_binary '	\„\ÙLkH¡nm&Rwñ',_binary 'ëb\÷SG\Á4E4±,\Ë\À;¥\Â∞@;ΩàRXn®\\j˛ù@m˚ì\»=”éöﬁ¶≤F','belum','2026-11-09 17:47:46','2026-11-09 17:47:46');
/*!40000 ALTER TABLE `anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_log`
--

DROP TABLE IF EXISTS `audit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `aksi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tabel` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `record_id` int unsigned DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `audit_log_user_id_index` (`user_id`),
  CONSTRAINT `audit_log_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_log`
--

LOCK TABLES `audit_log` WRITE;
/*!40000 ALTER TABLE `audit_log` DISABLE KEYS */;
INSERT INTO `audit_log` VALUES (1,2,'LOGIN','users',2,'Login berhasil','127.0.0.1','2026-11-10 05:27:55'),(2,2,'BACKUP_GAGAL',NULL,NULL,'mysqldump: Got error: 2004: Can\'t create TCP/IP socket (10106) when trying to connect','127.0.0.1','2026-11-10 05:27:56'),(3,2,'LOGOUT','users',2,'Logout','127.0.0.1','2026-11-10 05:41:53'),(4,1,'LOGIN','users',1,'Login berhasil','127.0.0.1','2026-11-10 05:42:26'),(5,1,'BACKUP',NULL,NULL,'kbd_20261110_054226.sql (12 KB)','127.0.0.1','2026-11-10 05:42:26'),(6,1,'LOGOUT','users',1,'Logout','127.0.0.1','2026-11-10 05:46:32'),(7,5,'LOGIN','users',5,'Login berhasil','127.0.0.1','2026-11-10 05:47:22'),(8,5,'BACKUP',NULL,NULL,'kbd_20261110_054722.sql (12 KB)','127.0.0.1','2026-11-10 05:47:22'),(9,5,'LOGIN','users',5,'Login berhasil','127.0.0.1','2026-11-10 05:49:51'),(10,5,'BACKUP',NULL,NULL,'kbd_20261110_054951.sql (12 KB)','127.0.0.1','2026-11-10 05:49:51'),(11,5,'LOGOUT','users',5,'Logout','127.0.0.1','2026-11-10 05:59:57'),(12,5,'LOGIN','users',5,'Login berhasil','127.0.0.1','2026-11-10 06:00:25'),(13,5,'BACKUP',NULL,NULL,'kbd_20261110_060025.sql (12 KB)','127.0.0.1','2026-11-10 06:00:25'),(14,5,'LIHAT','anggota',4,'Melihat profil sendiri (data terdekripsi)','127.0.0.1','2026-11-10 06:00:57'),(15,5,'LOGOUT','users',5,'Logout','127.0.0.1','2026-11-10 06:04:57'),(16,1,'LOGIN','users',1,'Login berhasil','127.0.0.1','2026-11-10 06:05:05'),(17,1,'BACKUP',NULL,NULL,'kbd_20261110_060505.sql (13 KB)','127.0.0.1','2026-11-10 06:05:05'),(18,1,'LOGOUT','users',1,'Logout','127.0.0.1','2026-11-10 06:24:32'),(19,2,'LOGIN','users',2,'Login berhasil','127.0.0.1','2026-11-10 06:24:39'),(20,2,'BACKUP',NULL,NULL,'kbd_20261110_062439.sql (13 KB)','127.0.0.1','2026-11-10 06:24:40'),(21,2,'LIHAT','anggota',1,'Melihat profil sendiri (data terdekripsi)','127.0.0.1','2026-11-10 06:24:48'),(22,2,'LOGOUT','users',2,'Logout','127.0.0.1','2026-11-10 06:35:45'),(23,2,'LOGIN','users',2,'Login berhasil','127.0.0.1','2026-11-10 06:35:55'),(24,2,'BACKUP',NULL,NULL,'kbd_20261110_063555.sql (13 KB)','127.0.0.1','2026-11-10 06:35:56'),(25,2,'LIHAT','anggota',1,'Melihat profil sendiri (data terdekripsi)','127.0.0.1','2026-11-10 06:36:03'),(26,2,'LIHAT','anggota',NULL,'Melihat daftar anggota (data penuh)','127.0.0.1','2026-11-10 06:36:07'),(27,2,'LOGOUT','users',2,'Logout','127.0.0.1','2026-11-10 06:36:35'),(28,3,'LOGIN','users',3,'Login berhasil','127.0.0.1','2026-11-10 06:36:48');
/*!40000 ALTER TABLE `audit_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026_11_09_172122_create_roles_table',1),(2,'2026_11_09_172130_create_anggota_table',1),(3,'2026_11_09_172138_create_users_table',1),(4,'2026_11_09_172146_create_audit_log_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_nama_role_unique` (`nama_role`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Kelola user & role, lihat audit log, tanpa akses data pribadi'),(2,'ketua','Lihat & kelola semua data anggota'),(3,'sekretaris','Input & edit data anggota'),(4,'bendahara','Lihat data iuran saja, tanpa data pribadi sensitif'),(5,'anggota','Lihat data diri sendiri');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int unsigned NOT NULL,
  `anggota_id` int unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_anggota_id_foreign` (`anggota_id`),
  CONSTRAINT `users_anggota_id_foreign` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$12$IPhpNbPyg.1PRKW3bwDsC.6/4i1jGUcfpKrMBRg5OSVk.TY3f.osO',1,NULL,1,'2026-11-10 06:05:05','2026-11-09 17:47:46'),(2,'siti','$2y$12$IPhpNbPyg.1PRKW3bwDsC.6/4i1jGUcfpKrMBRg5OSVk.TY3f.osO',2,1,1,'2026-11-10 06:35:55','2026-11-09 17:47:46'),(3,'dewi','$2y$12$IPhpNbPyg.1PRKW3bwDsC.6/4i1jGUcfpKrMBRg5OSVk.TY3f.osO',3,2,1,'2026-11-10 06:36:48','2026-11-09 17:47:46'),(4,'rina','$2y$12$IPhpNbPyg.1PRKW3bwDsC.6/4i1jGUcfpKrMBRg5OSVk.TY3f.osO',4,3,1,NULL,'2026-11-09 17:47:46'),(5,'yuni','$2y$12$IPhpNbPyg.1PRKW3bwDsC.6/4i1jGUcfpKrMBRg5OSVk.TY3f.osO',5,4,1,'2026-11-10 06:00:25','2026-11-09 17:47:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `v_iuran_anggota`
--

DROP TABLE IF EXISTS `v_iuran_anggota`;
/*!50001 DROP VIEW IF EXISTS `v_iuran_anggota`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_iuran_anggota` AS SELECT 
 1 AS `id`,
 1 AS `nama`,
 1 AS `jabatan`,
 1 AS `status_iuran`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'kbd'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_tambah_anggota` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_tambah_anggota`(
    IN p_nama VARCHAR(100), IN p_jabatan VARCHAR(50),
    IN p_nik VARCHAR(16), IN p_hp VARCHAR(20), IN p_alamat VARCHAR(255))
BEGIN
  DECLARE v_iv VARBINARY(16);
  SET v_iv = RANDOM_BYTES(16);
  INSERT INTO anggota (nama, jabatan, iv, nik, no_hp, alamat)
  VALUES (p_nama, p_jabatan, v_iv,
          AES_ENCRYPT(p_nik,    @kunci, v_iv),
          AES_ENCRYPT(p_hp,     @kunci, v_iv),
          AES_ENCRYPT(p_alamat, @kunci, v_iv));
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `v_iuran_anggota`
--

/*!50001 DROP VIEW IF EXISTS `v_iuran_anggota`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_iuran_anggota` AS select `anggota`.`id` AS `id`,`anggota`.`nama` AS `nama`,`anggota`.`jabatan` AS `jabatan`,`anggota`.`status_iuran` AS `status_iuran` from `anggota` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-10 13:36:48
