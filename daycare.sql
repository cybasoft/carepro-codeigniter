-- MySQL Distrib 5.7.20
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `version` BIGINT(20) NOT NULL
);

LOCK TABLES `migrations` WRITE;
ALTER TABLE `migrations`
  DISABLE KEYS;
INSERT INTO `migrations` VALUES (22);
ALTER TABLE `migrations`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id`          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(100)     NOT NULL,
  `description` VARCHAR(100)     NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
);

LOCK TABLES `groups` WRITE;
ALTER TABLE `groups`
  DISABLE KEYS;
INSERT INTO `groups`
VALUES (1, 'admin', 'Administrator'), (2, 'manager', 'Manager'), (3, 'staff', 'Staff Member'), (4, 'parent', 'Parent');
ALTER TABLE `groups`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `users`;
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
);

LOCK TABLES `users` WRITE;
ALTER TABLE `users`
  DISABLE KEYS;
INSERT INTO `users` VALUES
  (1, 'Admin', 'Admin', 'admin@app.com', '$2y$10$TY3xMxRdO4Ow0huFSk0RoeqCAlKRbBBWncFfbRBGEUa5wQkJbDotC', 1, NULL, NULL,
      NULL, NULL, NULL, NULL, NULL, '1233', 8267, NULL, '2017-12-26 12:53:10');
ALTER TABLE `users`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `users_groups`;
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
);

LOCK TABLES `users_groups` WRITE;
ALTER TABLE `users_groups`
  DISABLE KEYS;
INSERT INTO `users_groups` VALUES (1, 1, 1);
ALTER TABLE `users_groups`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(15)      NOT NULL,
  `login`      VARCHAR(100)     NOT NULL,
  `time`       INT(11) UNSIGNED          DEFAULT NULL,
  PRIMARY KEY (`id`)
);

LOCK TABLES `login_attempts` WRITE;
ALTER TABLE `login_attempts`
  DISABLE KEYS;
ALTER TABLE `login_attempts`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE `payment_methods` (
  `id`    INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100)     NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
);

LOCK TABLES `payment_methods` WRITE;
ALTER TABLE `payment_methods`
  DISABLE KEYS;
INSERT INTO payment_methods (title) VALUES ('Check');
INSERT INTO payment_methods (title) VALUES ('Credit');
ALTER TABLE `payment_methods`
  ENABLE KEYS;
UNLOCK TABLES;


DROP TABLE IF EXISTS `news`;
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
);

LOCK TABLES `news` WRITE;
ALTER TABLE `news`
  DISABLE KEYS;
ALTER TABLE `news`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `children`;
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
);

LOCK TABLES `children` WRITE;
ALTER TABLE `children`
  DISABLE KEYS;
ALTER TABLE `children`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `event_log`;
CREATE TABLE `event_log` (
  `id`      INT(11)      NOT NULL AUTO_INCREMENT,
  `user_id` INT(11)      NOT NULL,
  `date`    DATETIME     NOT NULL,
  `event`   VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
);

LOCK TABLES `event_log` WRITE;
ALTER TABLE `event_log`
  DISABLE KEYS;
ALTER TABLE `event_log`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `calendar`;
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
);

LOCK TABLES `calendar` WRITE;
ALTER TABLE `calendar`
  DISABLE KEYS;
ALTER TABLE `calendar`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `child_allergy`;
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
);

LOCK TABLES `child_allergy` WRITE;
ALTER TABLE `child_allergy`
  DISABLE KEYS;
ALTER TABLE `child_allergy`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `child_checkin`;
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
);

LOCK TABLES `child_checkin` WRITE;
ALTER TABLE `child_checkin`
  DISABLE KEYS;
ALTER TABLE `child_checkin`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `child_contacts`;
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
);

LOCK TABLES `child_contacts` WRITE;
ALTER TABLE `child_contacts`
  DISABLE KEYS;
ALTER TABLE `child_contacts`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `child_foodpref`;
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
);

LOCK TABLES `child_foodpref` WRITE;
ALTER TABLE `child_foodpref`
  DISABLE KEYS;
ALTER TABLE `child_foodpref`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `child_incident`;
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
);

LOCK TABLES `child_incident` WRITE;
ALTER TABLE `child_incident`
  DISABLE KEYS;
ALTER TABLE `child_incident`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `child_incident_photos`;
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
);

LOCK TABLES `child_incident_photos` WRITE;
ALTER TABLE `child_incident_photos`
  DISABLE KEYS;
ALTER TABLE `child_incident_photos`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `child_meds`;
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
);

LOCK TABLES `child_meds` WRITE;
ALTER TABLE `child_meds`
  DISABLE KEYS;
ALTER TABLE `child_meds`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `child_notes`;
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
);

LOCK TABLES `child_notes` WRITE;
ALTER TABLE `child_notes`
  DISABLE KEYS;
ALTER TABLE `child_notes`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `child_parents`;
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
);

LOCK TABLES `child_parents` WRITE;
ALTER TABLE `child_parents`
  DISABLE KEYS;
ALTER TABLE `child_parents`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `child_pickup`;
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
);

LOCK TABLES `child_pickup` WRITE;
ALTER TABLE `child_pickup`
  DISABLE KEYS;
ALTER TABLE `child_pickup`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `child_providers`;
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
);

LOCK TABLES `child_providers` WRITE;
ALTER TABLE `child_providers`
  DISABLE KEYS;
ALTER TABLE `child_providers`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `invoices`;
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
);

LOCK TABLES `invoices` WRITE;
ALTER TABLE `invoices`
  DISABLE KEYS;
ALTER TABLE `invoices`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `invoice_items`;
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
);

LOCK TABLES `invoice_items` WRITE;
ALTER TABLE `invoice_items`
  DISABLE KEYS;
ALTER TABLE `invoice_items`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS `invoice_payments`;
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
);

LOCK TABLES `invoice_payments` WRITE;
ALTER TABLE `invoice_payments`
  DISABLE KEYS;
ALTER TABLE `invoice_payments`
  ENABLE KEYS;
UNLOCK TABLES;

DROP TABLE IF EXISTS child_problems;
CREATE TABLE child_problems (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  child_id   INT(11) UNSIGNED NOT NULL,
  name       VARCHAR(255)     NOT NULL,
  notes      TEXT             NOT NULL,
  user_id    INT(11) UNSIGNED NOT NULL,
  created_at DATETIME         NOT NULL,
  CONSTRAINT `child_problems_ibfk_1`
  FOREIGN KEY (`child_id`) REFERENCES `children` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `child_problems_ibfk_2`
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE INDEX child_id
  ON child_problems (child_id);
CREATE INDEX user_id
  ON child_problems (user_id);

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
DROP TABLE IF EXISTS `photos`;
CREATE TABLE photos
(
  id          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  child_id    INT(11) UNSIGNED NOT NULL,
  name        VARCHAR(100)     NOT NULL,
  caption     VARCHAR(100)     NOT NULL,
  position    INT              NOT NULL,
  category    VARCHAR(50)      NULL,
  uploaded_by INT              NOT NULL,
  created_at  DATETIME         NOT NULL,
  CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
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

-- version 2.1.1
DROP TABLE IF EXISTS child_group_staff;
DROP TABLE IF EXISTS child_group;
DROP TABLE IF EXISTS child_groups;

DROP TABLE IF EXISTS child_rooms;
CREATE TABLE child_rooms
(
  id          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name        VARCHAR(100)     NOT NULL UNIQUE,
  description VARCHAR(100)     NULL,
  created_at  DATETIME         NOT NULL,
  updated_at  DATETIME         NULL
);

DROP TABLE IF EXISTS child_room;
CREATE TABLE child_room
(
  child_id   INT(11) UNSIGNED NOT NULL,
  room_id   INT(11) UNSIGNED NOT NULL,
  created_at DATETIME         NOT NULL,
  updated_at DATETIME         NULL,
  PRIMARY KEY (child_id, room_id),
  CONSTRAINT child_room_ibfk_1
  FOREIGN KEY (child_id) REFERENCES children (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT child_room_ibfk_2
  FOREIGN KEY (room_id) REFERENCES child_rooms (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

CREATE INDEX room_id
  ON child_room (room_id);

DROP TABLE IF EXISTS child_room_staff;
CREATE TABLE child_room_staff
(
  user_id    INT(11) UNSIGNED NOT NULL,
  room_id   INT(11) UNSIGNED NOT NULL,
  created_at DATETIME         NOT NULL,
  updated_at DATETIME         NOT NULL,
  PRIMARY KEY (user_id, room_id),
  CONSTRAINT child_room_staff_ibfk_1
  FOREIGN KEY (user_id) REFERENCES users (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT child_room_staff_ibfk_2
  FOREIGN KEY (room_id) REFERENCES child_rooms (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

CREATE INDEX room_id
  ON child_room_staff (room_id);

-- version 2.1.2
DROP TABLE IF EXISTS options;
CREATE TABLE options
(
  id           BIGINT(11) UNSIGNED AUTO_INCREMENT
    PRIMARY KEY,
  option_name  VARCHAR(191) NOT NULL,
  option_value LONGTEXT     NULL,
  autoload     VARCHAR(20)  NULL,
  CONSTRAINT option_name UNIQUE (option_name)
);
ALTER TABLE child_problems
  ADD first_event DATE NULL;
ALTER TABLE child_problems
  ADD last_event DATE NULL;
