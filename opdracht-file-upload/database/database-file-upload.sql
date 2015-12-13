CREATE DATABASE IF NOT EXISTS `database-file-upload` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `database-file-upload`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(150) COLLATE utf8_bin NOT NULL,
  `salt` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `hash_password` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_login_time` datetime NOT NULL,
  `profile_picture` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=34 ;
