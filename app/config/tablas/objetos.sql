SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `objetos`;

CREATE TABLE `objetos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuarios_id` int(11) DEFAULT NULL,
  `escenarios_id` int(11) DEFAULT NULL,
  `elementos_configuracion_id` int(11) DEFAULT NULL,
  `nombre` varchar(111) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen` varchar(111) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

insert into `objetos` values('69','5','10','130','Commonitem 2x4','commonitem_2x4'),
 ('70','211','10','124','Commonitem 45automatics','commonitem_45automatics');

SET FOREIGN_KEY_CHECKS = 1;
