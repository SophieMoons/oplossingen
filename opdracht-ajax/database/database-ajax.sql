CREATE DATABASE IF NOT EXISTS `database-ajax` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `database-ajax`;

CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(150) COLLATE utf8_bin NOT NULL,
  `message` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `time_sent` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=34 ;
