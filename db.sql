DROP TABLE IF EXISTS eventphotos;
DROP TABLE IF EXISTS events;
DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS `users` (
	`ID` bigint(20) NOT NULL AUTO_INCREMENT,
	`email` varchar(30) CHARACTER SET utf8 NOT NULL,
	`password` varchar(30) CHARACTER SET utf8 NOT NULL,
	`firstname` varchar(20) CHARACTER SET utf8 NOT NULL,
	`lastname` varchar(20) CHARACTER SET utf8 NOT NULL,
	`phone` varchar(20) CHARACTER SET utf8 NOT NULL,
	PRIMARY KEY (`ID`),
	UNIQUE KEY (`email`)
);

CREATE TABLE IF NOT EXISTS `events` (
	`ID` bigint(20) NOT NULL AUTO_INCREMENT,
	`created_by` bigint(20) NOT NULL,
	`name` varchar(30) CHARACTER SET utf8 NOT NULL,
	`location` varchar(20) CHARACTER SET utf8 NOT NULL,
	`eventdate` TIMESTAMP NOT NULL,
	`status` tinyint(1) NOT NULL COMMENT '0 - Upcoming | 1 - Active | 2 - Past',
	PRIMARY KEY (`ID`),
	FOREIGN KEY (`created_by`) REFERENCES `users`(`ID`)
);

CREATE TABLE IF NOT EXISTS `eventphotos` (
	`ID` bigint(20) NOT NULL AUTO_INCREMENT,
	`event` bigint(20) NOT NULL,
	`photo` varchar(30) CHARACTER SET utf8 NOT NULL,
	`path` varchar(50) CHARACTER SET utf8 NOT NULL,
	PRIMARY KEY (`ID`),
	FOREIGN KEY (`event`) REFERENCES `events`(`ID`)
);
