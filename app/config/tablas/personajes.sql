SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `personajes`;

CREATE TABLE `personajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(111) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(111) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ampliacion` varchar(111) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

insert into `personajes` values('1','Agatha Crane','agatha_crane.png','20'),
 ('2','Amanda Sharpe','amanda_sharpe.png','09'),
 ('3','Bob Jenkins','bob_jenkins.png','09'),
 ('4','Carolyn Fern','carolyn_fern.png','06'),
 ('5','Carson Sinclair','carson_sinclair.png','20'),
 ('6','Darrell Simmons','darrell_simmons.png','06'),
 ('7','Dexter Drake','dexter_drake.png','06'),
 ('8','Harvey Walters','harvey_walters.png','01'),
 ('9','Hermana Mary','sister_mary.png','01'),
 ('10','Jenny Barnes','jenny_barnes.png','01'),
 ('11','Joe Diamond','joe_diamond.png','01'),
 ('12','Kate Winthrop','kate_winthrop.png','01'),
 ('13','Mandy Thompson','mandy_thompson.png','09'),
 ('14','Michael McGlen','michael_mcglen.png','01'),
 ('15','Minh Thi Phan','minh_thi_phan.png','20'),
 ('16','Monterey Jack','monterey_jack.png','09'),
 ('17','Padre Mateo','father_mateo.png','20'),
 ('18','Pete Cubo de Basura','ashcan_pete.png','01'),
 ('19','Preston Fairmont','preston_fairmont.png','20'),
 ('20','Rita Young','rita_young.png','20'),
 ('21','Vincent Lee','vincent_lee.png','06'),
 ('22','Wendy Adams','wendy_adams.png','20'),
 ('23','William Yorick','william_yorick.png','20'),
 ('25','Gloria Goldberg','gloria_goldberg.png','01'),
 ('26','Akachi Onyele','akachi_onyele.png','23'),
 ('27','Wilson Richards','wilson_richards.png','23');

SET FOREIGN_KEY_CHECKS = 1;
