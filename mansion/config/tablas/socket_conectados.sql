SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `socket_conectados`;

CREATE TABLE `socket_conectados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(111) DEFAULT NULL,
  `ip` varchar(111) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


SET FOREIGN_KEY_CHECKS = 1;
