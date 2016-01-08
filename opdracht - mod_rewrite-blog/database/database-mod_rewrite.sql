CREATE DATABASE IF NOT EXISTS `database-mod_rewrite` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `database-mod_rewrite`;

CREATE TABLE IF NOT EXISTS `artikels`
(
    `index` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `titel` varchar(200) COLLATE utf8_bin NOT NULL,
    `artikel` text COLLATE utf8_bin DEFAULT NULL,
    `kernwoorden` text COLLATE utf8_bin DEFAULT NULL,
    `datum` date NOT NULL,
    
    PRIMARY KEY (`index`)  
) 

ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=34 ;
