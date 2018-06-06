-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: daycarepro
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

--
-- Table structure for table `calendar`
--

DROP TABLE IF EXISTS `calendar`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendar` (
  `id`          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(255)     NOT NULL,
  `start`       DATE             NOT NULL,
  `start_t`     TIME             NOT NULL,
  `end`         DATE                      DEFAULT NULL,
  `end_t`       TIME             NOT NULL,
  `description` TEXT             NOT NULL,
  `allDay`      TINYINT(4)       NOT NULL DEFAULT '0',
  `user_id`     INT(11) UNSIGNED NOT NULL,
  `created_at`  DATETIME         NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar`
--

LOCK TABLES `calendar` WRITE;
/*!40000 ALTER TABLE `calendar`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `calendar`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `child_allergy`
--

DROP TABLE IF EXISTS `child_allergy`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `child_allergy` (
  `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `child_id`   INT(11) UNSIGNED NOT NULL,
  `allergy`    VARCHAR(100)     NOT NULL,
  `reaction`   VARCHAR(100)     NOT NULL,
  `notes`      TEXT             NOT NULL,
  `user_id`    INT(11) UNSIGNED NOT NULL,
  `created_at` DATETIME         NOT NULL,
  PRIMARY KEY (`id`),
  KEY `child_id` (`child_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `child_allergy_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `child_allergy_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `child_allergy`
--

LOCK TABLES `child_allergy` WRITE;
/*!40000 ALTER TABLE `child_allergy`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `child_allergy`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `child_checkin`
--

DROP TABLE IF EXISTS `child_checkin`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `child_checkin` (
  `id`           INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `child_id`     INT(11) UNSIGNED NOT NULL,
  `time_in`      DATETIME         NOT NULL,
  `time_out`     DATETIME                  DEFAULT NULL,
  `in_guardian`  VARCHAR(100)     NOT NULL,
  `out_guardian` VARCHAR(100)              DEFAULT NULL,
  `in_staff_id`  INT(11) UNSIGNED NOT NULL,
  `out_staff_id` INT(11) UNSIGNED          DEFAULT NULL,
  `remarks`      TEXT,
  PRIMARY KEY (`id`),
  KEY `child_id` (`child_id`),
  KEY `in_staff_id` (`in_staff_id`),
  KEY `out_staff_id` (`out_staff_id`),
  CONSTRAINT `child_checkin_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `child_checkin_ibfk_2` FOREIGN KEY (`in_staff_id`) REFERENCES `users` (`id`)
    ON UPDATE CASCADE,
  CONSTRAINT `child_checkin_ibfk_3` FOREIGN KEY (`out_staff_id`) REFERENCES `users` (`id`)
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `child_checkin`
--

LOCK TABLES `child_checkin` WRITE;
/*!40000 ALTER TABLE `child_checkin`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `child_checkin`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `child_contacts`
--

DROP TABLE IF EXISTS `child_contacts`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `child_contacts` (
  `id`           INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `child_id`     INT(11) UNSIGNED NOT NULL,
  `contact_name` VARCHAR(100)     NOT NULL,
  `relation`     VARCHAR(20)      NOT NULL,
  `phone`        VARCHAR(20)               DEFAULT NULL,
  `address`      VARCHAR(255)              DEFAULT NULL,
  `user_id`      INT(11) UNSIGNED NOT NULL,
  `created_at`   DATETIME         NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `child_id` (`child_id`),
  CONSTRAINT `child_contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON UPDATE CASCADE,
  CONSTRAINT `child_contacts_ibfk_2` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `child_contacts`
--

LOCK TABLES `child_contacts` WRITE;
/*!40000 ALTER TABLE `child_contacts`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `child_contacts`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `child_foodpref`
--

DROP TABLE IF EXISTS `child_foodpref`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `child_foodpref` (
  `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `child_id`   INT(11) UNSIGNED NOT NULL,
  `food`       VARCHAR(50)      NOT NULL,
  `food_time`  VARCHAR(20)      NOT NULL,
  `comment`    TEXT             NOT NULL,
  `user_id`    INT(11) UNSIGNED NOT NULL,
  `created_at` DATETIME         NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `child_id` (`child_id`),
  CONSTRAINT `child_foodpref_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON UPDATE CASCADE,
  CONSTRAINT `child_foodpref_ibfk_2` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `child_foodpref`
--

LOCK TABLES `child_foodpref` WRITE;
/*!40000 ALTER TABLE `child_foodpref`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `child_foodpref`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `child_incident`
--

DROP TABLE IF EXISTS `child_incident`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `child_incident` (
  `id`            INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `child_id`      INT(11) UNSIGNED NOT NULL,
  `title`         VARCHAR(100)     NOT NULL,
  `location`      VARCHAR(100)              DEFAULT NULL,
  `incident_type` VARCHAR(100)              DEFAULT NULL,
  `description`   TEXT,
  `actions_taken` TEXT,
  `witnesses`     TEXT,
  `remarks`       TEXT,
  `user_id`       INT(11) UNSIGNED NOT NULL,
  `date_occurred` DATETIME         NOT NULL,
  `created_at`    DATETIME         NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `child_id` (`child_id`),
  CONSTRAINT `child_incident_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON UPDATE CASCADE,
  CONSTRAINT `child_incident_ibfk_2` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `child_incident`
--

LOCK TABLES `child_incident` WRITE;
/*!40000 ALTER TABLE `child_incident`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `child_incident`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `child_incident_photos`
--

DROP TABLE IF EXISTS `child_incident_photos`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `child_incident_photos` (
  `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `child_id`   INT(11) UNSIGNED NOT NULL,
  `photo`      VARCHAR(100)     NOT NULL,
  `user_id`    INT(11) UNSIGNED NOT NULL,
  `created_at` DATETIME         NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `child_id` (`child_id`),
  CONSTRAINT `child_incident_photos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON UPDATE CASCADE,
  CONSTRAINT `child_incident_photos_ibfk_2` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `child_incident_photos`
--

LOCK TABLES `child_incident_photos` WRITE;
/*!40000 ALTER TABLE `child_incident_photos`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `child_incident_photos`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `child_meds`
--

DROP TABLE IF EXISTS `child_meds`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `child_meds` (
  `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `child_id`   INT(11) UNSIGNED NOT NULL,
  `med_name`   VARCHAR(30)      NOT NULL,
  `med_notes`  TEXT             NOT NULL,
  `user_id`    INT(11) UNSIGNED NOT NULL,
  `created_at` DATETIME         NOT NULL,
  PRIMARY KEY (`id`),
  KEY `child_id` (`child_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `child_meds_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `child_meds_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `child_meds`
--

LOCK TABLES `child_meds` WRITE;
/*!40000 ALTER TABLE `child_meds`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `child_meds`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `child_notes`
--

DROP TABLE IF EXISTS `child_notes`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `child_notes` (
  `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `child_id`   INT(11) UNSIGNED NOT NULL,
  `title`      VARCHAR(100)     NOT NULL,
  `content`    TEXT             NOT NULL,
  `user_id`    INT(11) UNSIGNED NOT NULL,
  `created_at` DATETIME         NOT NULL,
  PRIMARY KEY (`id`),
  KEY `child_id` (`child_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `child_notes_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `child_notes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `child_notes`
--

LOCK TABLES `child_notes` WRITE;
/*!40000 ALTER TABLE `child_notes`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `child_notes`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `child_parents`
--

DROP TABLE IF EXISTS `child_parents`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `child_parents` (
  `child_id` INT(11) UNSIGNED NOT NULL,
  `user_id`  INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`child_id`, `user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `child_parents_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `child_parents_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `child_parents`
--

LOCK TABLES `child_parents` WRITE;
/*!40000 ALTER TABLE `child_parents`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `child_parents`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `child_pickup`
--

DROP TABLE IF EXISTS `child_pickup`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `child_pickup` (
  `id`          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `child_id`    INT(11) UNSIGNED NOT NULL,
  `first_name`  VARCHAR(50)      NOT NULL,
  `last_name`   VARCHAR(50)      NOT NULL,
  `cell`        VARCHAR(20)      NOT NULL,
  `other_phone` VARCHAR(20)      NOT NULL,
  `address`     TEXT             NOT NULL,
  `pin`         INT(11)          NOT NULL,
  `relation`    VARCHAR(20)      NOT NULL,
  `photo`       VARCHAR(100)     NOT NULL,
  `status`      INT(11)          NOT NULL,
  `user_id`     INT(11) UNSIGNED NOT NULL,
  `created_at`  DATETIME         NOT NULL,
  PRIMARY KEY (`id`),
  KEY `child_id` (`child_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `child_pickup_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `child_pickup_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `child_pickup`
--

LOCK TABLES `child_pickup` WRITE;
/*!40000 ALTER TABLE `child_pickup`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `child_pickup`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `child_providers`
--

DROP TABLE IF EXISTS `child_providers`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `child_providers` (
  `id`            INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `child_id`      INT(11) UNSIGNED NOT NULL,
  `provider_name` VARCHAR(100)     NOT NULL,
  `type_role`     VARCHAR(50)      NOT NULL,
  `phone`         VARCHAR(20)               DEFAULT NULL,
  `address`       VARCHAR(100)              DEFAULT NULL,
  `notes`         TEXT,
  `user_id`       INT(11) UNSIGNED NOT NULL,
  `created_at`    DATETIME         NOT NULL,
  PRIMARY KEY (`id`),
  KEY `child_id` (`child_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `child_providers_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `child_providers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `child_providers`
--

LOCK TABLES `child_providers` WRITE;
/*!40000 ALTER TABLE `child_providers`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `child_providers`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `children`
--

DROP TABLE IF EXISTS `children`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `children` (
  `id`          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name`  VARCHAR(20)      NOT NULL,
  `last_name`   VARCHAR(20)      NOT NULL,
  `national_id` VARCHAR(255)     NOT NULL,
  `bday`        DATETIME         NOT NULL,
  `gender`      VARCHAR(20)      NOT NULL,
  `blood_type`  VARCHAR(20)      NOT NULL,
  `last_update` DATETIME         NOT NULL,
  `status`      TINYINT(1)       NOT NULL,
  `photo`       VARCHAR(100)     NOT NULL,
  `created_at`  DATETIME         NOT NULL,
  `user_id`     INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `children_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `children`
--

LOCK TABLES `children` WRITE;
/*!40000 ALTER TABLE `children`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `children`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_log`
--

DROP TABLE IF EXISTS `event_log`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_log` (
  `id`      INT(11)      NOT NULL AUTO_INCREMENT,
  `user_id` INT(11)      NOT NULL,
  `date`    DATETIME     NOT NULL,
  `event`   VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_log`
--

LOCK TABLES `event_log` WRITE;
/*!40000 ALTER TABLE `event_log`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `event_log`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id`          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(100)     NOT NULL,
  `description` VARCHAR(100)     NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 6
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups`
  DISABLE KEYS */;
INSERT INTO `groups` VALUES (1, 'admin', ''), (2, 'manager', ''), (3, 'staff', ''), (4, 'parent', '');
/*!40000 ALTER TABLE `groups`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_items`
--

DROP TABLE IF EXISTS `invoice_items`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_items` (
  `id`          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id`  INT(11) UNSIGNED NOT NULL,
  `item_name`   VARCHAR(100)     NOT NULL,
  `description` TEXT             NOT NULL,
  `price`       FLOAT            NOT NULL,
  `qty`         INT(11)          NOT NULL,
  `discount`    FLOAT            NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`),
  CONSTRAINT `invoice_items_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_items`
--

LOCK TABLES `invoice_items` WRITE;
/*!40000 ALTER TABLE `invoice_items`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_items`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_payments`
--

DROP TABLE IF EXISTS `invoice_payments`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_payments` (
  `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` INT(11) UNSIGNED NOT NULL,
  `amount`     FLOAT            NOT NULL,
  `method`     VARCHAR(50)      NOT NULL,
  `remarks`    TEXT             NOT NULL,
  `user_id`    INT(11) UNSIGNED NOT NULL,
  `created_at` DATETIME                  DEFAULT NULL,
  `date_paid`  DATE             NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`),
  CONSTRAINT `invoice_payments_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_payments`
--

LOCK TABLES `invoice_payments` WRITE;
/*!40000 ALTER TABLE `invoice_payments`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_payments`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id`             INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `child_id`       INT(11) UNSIGNED NOT NULL,
  `date_due`       DATE             NOT NULL,
  `invoice_terms`  TEXT,
  `invoice_status` INT(11)          NOT NULL,
  `user_id`        INT(11) UNSIGNED NOT NULL,
  `created_at`     DATETIME         NOT NULL,
  PRIMARY KEY (`id`),
  KEY `child_id` (`child_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(15)      NOT NULL,
  `login`      VARCHAR(100)     NOT NULL,
  `time`       INT(11) UNSIGNED          DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `version` BIGINT(20) NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations`
  DISABLE KEYS */;
INSERT INTO `migrations` VALUES (22);
/*!40000 ALTER TABLE `migrations`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id`           INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id`      INT(11) UNSIGNED NOT NULL,
  `order`        INT(5)           NOT NULL,
  `article_name` VARCHAR(50)      NOT NULL,
  `article_body` TEXT             NOT NULL,
  `publish_date` DATETIME         NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `news`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id`                      INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name`              VARCHAR(100)     NOT NULL,
  `last_name`               VARCHAR(100)     NOT NULL,
  `email`                   VARCHAR(100)     NOT NULL,
  `password`                VARCHAR(255)     NOT NULL,
  `active`                  TINYINT(1) UNSIGNED       DEFAULT NULL,
  `forgotten_password_code` VARCHAR(100)              DEFAULT NULL,
  `forgotten_password_time` INT(11) UNSIGNED          DEFAULT NULL,
  `activation_code`         VARCHAR(100)              DEFAULT NULL,
  `last_login`              DATETIME                  DEFAULT NULL,
  `ip_address`              VARCHAR(100)              DEFAULT NULL,
  `phone`                   VARCHAR(20)               DEFAULT NULL,
  `phone2`                  VARCHAR(20)               DEFAULT NULL,
  `address`                 TEXT,
  `pin`                     INT(11)                   DEFAULT NULL,
  `photo`                   VARCHAR(100)              DEFAULT NULL,
  `created_at`              DATETIME         NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users`
  DISABLE KEYS */;
INSERT INTO `users` VALUES
  (1, 'Admin', 'Admin', 'admin@app.com', '$2y$10$TY3xMxRdO4Ow0huFSk0RoeqCAlKRbBBWncFfbRBGEUa5wQkJbDotC', 1, NULL, NULL,
      NULL, '0000-00-00 00:00:00', NULL, NULL, NULL, '1233', 8267, NULL, '2017-12-26 12:53:10');
/*!40000 ALTER TABLE `users`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_groups` (
  `id`       INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id`  INT(11) UNSIGNED NOT NULL,
  `group_id` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_group_id` (`user_id`, `group_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `users_groups_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `users_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups`
  DISABLE KEYS */;
INSERT INTO `users_groups` VALUES (1, 1, 1);
/*!40000 ALTER TABLE `users_groups`
  ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE `payment_methods` (
  `id`    INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100)     NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;


LOCK TABLES `payment_methods` WRITE;
/*!40000 ALTER TABLE `payment_methods`
  DISABLE KEYS */;
INSERT INTO payment_methods (title) VALUES ('Check');
INSERT INTO payment_methods (title) VALUES ('Credit');
/*!40000 ALTER TABLE `payment_methods`
  ENABLE KEYS */;
UNLOCK TABLES;

CREATE TABLE child_problems (
  id         INT AUTO_INCREMENT
    PRIMARY KEY,
  child_id   INT          NOT NULL,
  name       VARCHAR(255) NOT NULL,
  notes      TEXT         NOT NULL,
  user_id    INT          NOT NULL,
  created_at DATETIME     NOT NULL,
  CONSTRAINT child_problems_ibfk_1
  FOREIGN KEY (child_id) REFERENCES children (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT child_problems_ibfk_2
  FOREIGN KEY (user_id) REFERENCES users (id)
    ON UPDATE CASCADE
);

CREATE INDEX child_id
  ON child_problems (child_id);
CREATE INDEX user_id
  ON child_problems (user_id);

/*!40103 SET TIME_ZONE = @OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;

-- version 2.0.8
ALTER TABLE children
  ADD COLUMN ethnicity VARCHAR(100) NULL;
ALTER TABLE children
  ADD COLUMN religion VARCHAR(100) NULL;
ALTER TABLE children
  ADD COLUMN birthplace VARCHAR(100) NULL;

-- version 2.0.9
ALTER TABLE users
  ADD stripe_customer_id VARCHAR(100) NULL;
CREATE UNIQUE INDEX users_stripe_customer_id_uindex
  ON users (stripe_customer_id);
ALTER TABLE invoices
  MODIFY invoice_status VARCHAR(100) NOT NULL;

-- version 2.1.0
CREATE TABLE photos
(
  id          INT AUTO_INCREMENT
    PRIMARY KEY,
  child_id    INT          NOT NULL,
  name        VARCHAR(100) NOT NULL,
  caption     VARCHAR(100) NOT NULL,
  position    INT          NOT NULL,
  category    VARCHAR(50)  NULL,
  uploaded_by INT          NOT NULL,
  created_at  DATETIME     NOT NULL,
  CONSTRAINT photos_ibfk_1
  FOREIGN KEY (child_id) REFERENCES children (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT photos_ibfk_2
  FOREIGN KEY (uploaded_by) REFERENCES users (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

CREATE INDEX child_id
  ON photos (child_id);

CREATE INDEX uploaded_by
  ON photos (uploaded_by);

ALTER TABLE children
  ADD COLUMN nickname VARCHAR(100) NULL;

ALTER TABLE child_incident_photos
  ADD COLUMN incident_id INT UNSIGNED NOT NULL;

ALTER TABLE child_incident_photos
  ADD FOREIGN KEY (incident_id) REFERENCES child_incident (id)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

CREATE INDEX incident_id
  ON child_incident_photos (incident_id);

