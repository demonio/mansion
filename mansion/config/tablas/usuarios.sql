SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(111) DEFAULT NULL,
  `clave` varchar(111) DEFAULT NULL,
  `terminos` tinyint(1) DEFAULT '0',
  `tocado` datetime DEFAULT NULL,
  `ip` varchar(111) DEFAULT NULL,
  `browser` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


SET FOREIGN_KEY_CHECKS = 1;
