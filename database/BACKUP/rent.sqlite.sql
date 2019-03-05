BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS `water_rates` (
	`id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	`created_at`	datetime,
	`updated_at`	datetime
);
CREATE TABLE IF NOT EXISTS `water_bills` (
	`id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	`created_at`	datetime,
	`updated_at`	datetime
);
CREATE TABLE IF NOT EXISTS `users` (
	`id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	`name`	varchar NOT NULL,
	`email`	varchar NOT NULL,
	`email_verified_at`	datetime,
	`password`	varchar NOT NULL,
	`remember_token`	varchar,
	`created_at`	datetime,
	`updated_at`	datetime
);
CREATE TABLE IF NOT EXISTS `rooms` (
	`id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	`name`	varchar NOT NULL,
	`created_at`	datetime,
	`updated_at`	datetime
);
INSERT INTO `rooms` VALUES (1,'101','2019-02-22 15:25:30','2019-02-23 08:57:12');
INSERT INTO `rooms` VALUES (2,'102','2019-02-22 15:25:41','2019-02-22 15:25:41');
INSERT INTO `rooms` VALUES (3,'201','2019-02-22 15:25:53','2019-02-22 15:25:53');
INSERT INTO `rooms` VALUES (4,'202','2019-02-22 15:26:04','2019-02-22 15:26:04');
INSERT INTO `rooms` VALUES (5,'301','2019-02-22 15:26:18','2019-02-22 15:26:18');
INSERT INTO `rooms` VALUES (6,'302','2019-02-22 15:26:29','2019-02-22 15:26:29');
INSERT INTO `rooms` VALUES (7,'B01','2019-02-22 15:28:36','2019-02-22 15:28:36');
INSERT INTO `rooms` VALUES (8,'B02','2019-02-22 15:28:49','2019-02-22 15:28:49');
CREATE TABLE IF NOT EXISTS `residents` (
	`id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	`room_id`	integer NOT NULL,
	`name`	varchar NOT NULL,
	`entrance_date`	date,
	`exit_date`	date,
	`tel`	varchar,
	`mail`	varchar,
	`created_at`	datetime,
	`updated_at`	datetime
);
INSERT INTO `residents` VALUES (1,8,'川崎 高司','2017/11/1',NULL,'090-7189-3816','t.kaw@docomo.ne.jp',NULL,'2019-02-23 23:23:57');
INSERT INTO `residents` VALUES (2,1,'船岡 千穂','2005/11/26',NULL,'090-6606-0640',NULL,NULL,'2019-02-23 23:15:51');
INSERT INTO `residents` VALUES (5,5,'空き','2019/3/1',NULL,NULL,NULL,'2019-02-22 13:59:20','2019-02-23 12:46:50');
INSERT INTO `residents` VALUES (6,7,'川崎 通子','2001/9/1',NULL,NULL,NULL,'2019-02-22 14:55:55','2019-02-23 23:23:28');
INSERT INTO `residents` VALUES (7,4,'吉嶋 忠博','2012/4/11',NULL,'072-924-2014',NULL,'2019-02-23 08:50:56','2019-02-23 23:21:25');
INSERT INTO `residents` VALUES (8,3,'大浦 肇子','2017/7/27',NULL,NULL,NULL,'2019-02-23 08:51:35','2019-02-23 23:19:34');
INSERT INTO `residents` VALUES (9,2,'川崎 晃男','2001/9/1',NULL,NULL,NULL,'2019-02-23 08:52:04','2019-02-23 23:17:24');
INSERT INTO `residents` VALUES (10,6,'前川 亜沙美','2014/10/27',NULL,NULL,NULL,'2019-02-23 12:47:26','2019-02-23 23:22:31');
CREATE TABLE IF NOT EXISTS `password_resets` (
	`email`	varchar NOT NULL,
	`token`	varchar NOT NULL,
	`created_at`	datetime
);
CREATE TABLE IF NOT EXISTS `migrations` (
	`id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	`migration`	varchar NOT NULL,
	`batch`	integer NOT NULL
);
INSERT INTO `migrations` VALUES (25,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` VALUES (26,'2014_10_12_100000_create_password_resets_table',1);
INSERT INTO `migrations` VALUES (27,'2019_02_21_124206_create_residents_table',1);
INSERT INTO `migrations` VALUES (28,'2019_02_21_124225_create_rooms_table',1);
INSERT INTO `migrations` VALUES (29,'2019_02_22_052146_create_water_bills_table',1);
INSERT INTO `migrations` VALUES (30,'2019_02_22_053317_create_water_rates_table',1);
CREATE UNIQUE INDEX IF NOT EXISTS `users_email_unique` ON `users` (
	`email`
);
CREATE INDEX IF NOT EXISTS `password_resets_email_index` ON `password_resets` (
	`email`
);
COMMIT;
