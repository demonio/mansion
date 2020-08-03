SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `elementos`;

CREATE TABLE `elementos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elementos_id` int(11) DEFAULT NULL,
  `nombre` varchar(111) DEFAULT NULL,
  `tipo` varchar(111) DEFAULT NULL,
  `imagen` varchar(111) DEFAULT NULL,
  `ampliacion` varchar(111) DEFAULT NULL,
  `ancho_miniatura` smallint(4) DEFAULT NULL,
  `alto_miniatura` smallint(4) DEFAULT NULL,
  `ancho` smallint(4) DEFAULT NULL,
  `alto` smallint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=345 DEFAULT CHARSET=utf8;

insert into `elementos` values('5','15','Callejón 2','suelos','tile_alley_2_mad20','20','180','90','540','270'),
 ('4','14','Callejón 1','suelos','tile_alley_1_mad20','20','180','90','540','270'),
 ('6',null,'Esquina de callejón 1','suelos','tile_alley_corner_1_mad20','20','180','90','540','270'),
 ('7','34','Esquina de callejón 2','suelos','tile_alley_corner_2_mad20','20','180','90','540','270'),
 ('8','46','Trastero del desván (almacenaje)','suelos','tile_attic_storage_mad23','23','180','90','540','270'),
 ('9','11','Balcón','suelos','tile_balcony_mad23','23','180','90','540','270'),
 ('10','21','Parcela del granero / Granero','suelos','tile_barn_mad09','09','270','180','810','540'),
 ('11','9','Trastero del sótano (almacenaje)','suelos','tile_basement_storage_mad23','23','180','90','540','270'),
 ('12','61','Esquina de pasillo 3 / Cuarto de baño','suelos','tile_bathroom_mad20','20','180','90','540','270'),
 ('13','70','Playa / Caseta mohosa','suelos','tile_beach_mad20','20','180','90','540','270'),
 ('14','4','Dormitorio 1','suelos','tile_bedroom_1_mad20','20','180','90','540','270'),
 ('15','5','Dormitorio 2','suelos','tile_bedroom_2_mad20','20','180','90','540','270'),
 ('16','44','Dormitorio','suelos','tile_bedroom_mad23','23','180','90','540','270'),
 ('17','63','Campanario','suelos','tile_bell_tower_mad20','20','180','90','540','270'),
 ('18',null,'Sala de billar','suelos','tile_billiards_room_mad20','20','180','90','540','270'),
 ('19',null,'Entrada de la cueva','suelos','tile_cave_entrance_mad09','09','180','90','540','270'),
 ('20','49','Sala de ceremonias','suelos','tile_ceremony_room_mad01','01','180','90','540','270'),
 ('21','10','Paso fluvial 1 y 2 / Puente cubierto','suelos','tile_covered_bridge_mad09','09','270','180','810','540'),
 ('22',null,'Cripta','suelos','tile_crypt_mad01','01','180','90','540','270'),
 ('23','35','Comedor','suelos','tile_dining_room_mad23','23','180','90','540','270'),
 ('24','32','Muelle 1','suelos','tile_dock_1_mad20','20','180','90','540','270'),
 ('25',null,'Muelle 2','suelos','tile_dock_2_mad20','20','180','90','540','270'),
 ('26','64','Pasillo de entrada','suelos','tile_entry_hall_mad20','20','180','90','540','270'),
 ('27','55','Pasillo de entrada','suelos','tile_entry_hall_mad23','23','180','90','540','270'),
 ('28','47','Cuarto de la caldera','suelos','tile_furnace_room_mad01','01','180','90','540','270'),
 ('29','42','Cementerio 2','suelos','tile_graveyard_2_mad06','06','180','90','540','270'),
 ('30',null,'Dormitorio de invitados / Armario trastero','suelos','tile_guest_bedroom_mad01','01','180','90','540','270'),
 ('31',null,'Pasillo 1','suelos','tile_hall_1_mad20','20','180','90','540','270'),
 ('32','24','Pasillo 2','suelos','tile_hall_2_mad20','20','180','90','540','270'),
 ('33',null,'tile_hall_corner_1_mad20','suelos','tile_hall_corner_1_mad20','20','180','90','540','270'),
 ('34','7','Esquina de pasillo 2','suelos','tile_hall_corner_2_mad20','20','180','90','540','270'),
 ('35','23','Esquina de pasillo','suelos','tile_hall_corner_mad23','23','180','90','540','270'),
 ('36','65','Final del pasillo','suelos','tile_hall_end_mad20','20','180','90','540','270'),
 ('37','62','Escalera de pasillo','suelos','tile_hall_stairs_mad20','20','180','90','540','270'),
 ('38','69','Escalera de pasillo','suelos','tile_hall_stairs_mad23','23','180','90','540','270'),
 ('39',null,'Pasillo 2','suelos','tile_hallway_2_mad01','01','180','90','540','270'),
 ('40',null,'Pasillo 3','suelos','tile_hallway_3_mad01','01','180','90','540','270'),
 ('41',null,'Pasillo 4','suelos','tile_hallway_4_mad01','01','180','90','540','270'),
 ('42','29','Pasillo 5','suelos','tile_hallway_5_mad06','06','180','90','540','270'),
 ('43','51','Casa flotante / Camarote','suelos','tile_house_boat_mad20','20','180','90','540','270'),
 ('44','16','Cocina','suelos','tile_kitchen_mad23','23','180','90','540','270'),
 ('45','68','Biblioteca','suelos','tile_library_mad20','20','180','90','540','270'),
 ('46','8','Biblioteca','suelos','tile_library_mad23','23','180','90','540','270'),
 ('47','28','Dormitorio principal','suelos','tile_master_bedroom_mad01','01','180','90','540','270'),
 ('48',null,'Almacén médico','suelos','tile_medical_storage_mad06','06','180','90','540','270'),
 ('49','20','Cuarto del bebé / Cuarto de baño 2','suelos','tile_nursery_mad01','01','180','90','540','270'),
 ('50',null,'Despacho','suelos','tile_office_mad06','06','180','90','540','270'),
 ('51','43','Despacho','suelos','tile_office_mad20','20','180','90','540','270'),
 ('52','69','Viejo bosque / Lindero del bosque','suelos','tile_old_forest_mad09','09','270','180','810','540'),
 ('53',null,'Viejo roble','suelos','tile_old_oak_mad09','09','180','90','540','270'),
 ('54',null,'Viejo pozo','suelos','tile_old_well_mad09','09','180','90','540','270'),
 ('55','27','Parcela 2','suelos','tile_porch_mad23','23','180','90','540','270'),
 ('56','66','Puesto / Botes de alquiler','suelos','tile_rental_dock_mad20','20','180','90','540','270'),
 ('57',null,'Rápidos 1 / 2','suelos','tile_river_rapids_mad09','09','180','90','540','270'),
 ('58','60','Camino / Porche ruinoso','suelos','tile_rotted_porch_mad09','09','180','90','540','270'),
 ('59',null,'Espantapájaros','suelos','tile_scarecrow_mad09','09','180','90','540','270'),
 ('60','58','Arboleda','suelos','tile_spruce_grove_mad09','09','180','90','540','270'),
 ('61','12','Calle 1','suelos','tile_street_1_mad20','20','180','90','540','270'),
 ('62','37','Calle 2','suelos','tile_street_2_mad20','20','180','90','540','270'),
 ('63','17','Esquina de calle 1','suelos','tile_street_corner_1_mad20','20','180','90','540','270'),
 ('64','26','Esquina de calle 2','suelos','tile_street_corner_2_mad20','20','180','90','540','270'),
 ('65','36','Esquina de calle 3','suelos','tile_street_corner_3_mad20','20','180','90','540','270'),
 ('66','56','Estudio','suelos','tile_study_mad20','20','180','90','540','270'),
 ('67','52','Parcela de la serrería / Aserradero / Molino de agua','suelos','tile_waterwheel_mad09','09','270','180','810','540'),
 ('68','45','Parcela 1','suelos','tile_yard_1_mad20','20','180','90','540','270'),
 ('69','38','Parcela 1','suelos','tile_yard_1_mad23','23','180','90','540','270'),
 ('70','13','Parcela 2','suelos','tile_yard_2_mad20','20','180','90','540','270'),
 ('71',null,'Exploración','accesos','exploracion',null,'30','30','90','90'),
 ('72',null,'Vistazo','accesos','vistazo',null,'30','30','90','90'),
 ('73',null,'Busqueda','fichas','busqueda',null,'30','30','90','90'),
 ('74',null,'Interación','fichas','interaccion',null,'30','30','90','90'),
 ('75',null,'Viejo huerto / Cabaña abandonada','suelos','tile_abandoned_shack_mad09','09','180','180','540','540'),
 ('76',null,'Buhardilla / Escalera del desván','suelos','tile_attic_loft_mad01','01','180','180','540','540'),
 ('77','99','Desván / Escalera del desván','suelos','tile_attic_mad20','20','180','180','540','540'),
 ('78','112','Sala de baile ','suelos','tile_ballroom_mad20','20','180','180','540','540'),
 ('79','110','Rellano / Escalera / Trastero del sótano','suelos','tile_basement_landing_mad01','01','180','180','540','540'),
 ('80',null,'Sótano / Escalera del sótano','suelos','tile_basement_mad20','20','180','180','540','540'),
 ('81',null,'Capilla','suelos','tile_chapel_mad01','01','180','180','540','540'),
 ('82','107','Vivero / Parterre','suelos','tile_conservatory_mad20','20','180','180','540','540'),
 ('83','89','Comedor / Despensa / Cocina','suelos','tile_dining_room_mad01','01','180','180','540','540'),
 ('84','111','Comedor / Cocina','suelos','tile_dining_room_mad20','20','180','180','540','540'),
 ('85',null,'Porche / Camino delantero ','suelos','tile_front_porch_mad01','01','180','180','540','540'),
 ('86','106','Guarda ropa / Sala de estar','suelos','tile_gallery_mad01','01','180','180','540','540'),
 ('87','94','Recibidor / Jardín','suelos','tile_garden_mad01','01','180','180','540','540'),
 ('88',null,'Cuarto del generador','suelos','tile_generator_room_mad06','06','180','180','540','540'),
 ('89','83','Cementerio','suelos','tile_graveyard_mad01','01','180','180','540','540'),
 ('90','91','Camino trasero / Invernadero','suelos','tile_greenhouse_mad06','06','180','180','540','540'),
 ('91','90','Laboratorio secreto / Sala de control','suelos','tile_hidden_laboratory_mad06','06','180','180','540','540'),
 ('92',null,'Cima de la colina','suelos','tile_hilltop_mad09','09','180','180','540','540'),
 ('93',null,'Antecámara (pasillo) / Dormitorio pequeño 1 y 2','suelos','tile_interior_hall_mad20','20','180','180','540','540'),
 ('94','87','Biblioteca / Estudio','suelos','tile_library_mad01','01','180','180','540','540'),
 ('95','108','Hall','suelos','tile_lobby_mad20','20','180','180','540','540'),
 ('96','100','Salón','suelos','tile_lounge_mad20','20','180','180','540','540'),
 ('97','102','Pantano','suelos','tile_marshland_mad09','09','180','180','540','540'),
 ('98','103','Depósito de cadáveres / Sala de cuarentena','suelos','tile_morgue_mad06','06','180','180','540','540'),
 ('99','77','Estanque','suelos','tile_park_pond_mad20','20','180','180','540','540'),
 ('100','96','Embarcadero / Quiosco','suelos','tile_pier_mad20','20','180','180','540','540'),
 ('101','109','Charca','suelos','tile_pond_mad09','09','180','180','540','540'),
 ('102','97','Círculo ritual','suelos','tile_ritual_site_mad09','09','180','180','540','540'),
 ('103','98','Azotea','suelos','tile_rooftop_mad06','06','180','180','540','540'),
 ('104',null,'Terraza / Fresquera','suelos','tile_root_cellar_mad01','01','180','180','540','540'),
 ('105',null,'Fresquera / Parcela 3','suelos','tile_root_cellar_mad20','20','180','180','540','540'),
 ('106','86','Cobertizo / Parcela trasera','suelos','tile_storage_shed_mad01','01','180','180','540','540'),
 ('107','82','Tienda / Calle delantera','suelos','tile_storefront_mad20','20','180','180','540','540'),
 ('108','95','Parcela 4 / Cobertizo','suelos','tile_tool_shed_mad20','20','180','180','540','540'),
 ('109','101','Camara de torturas / Celda / Mazmorra','suelos','tile_torture_chamber_mad09','09','180','180','540','540'),
 ('110','79','Cuarto / Escalera del altillo / Trastero del desván','suelos','tile_tower_room_mad01','01','180','180','540','540'),
 ('111','84','Plaza mayor','suelos','tile_town_square_mad20','20','180','180','540','540'),
 ('112','78','Almacén','suelos','tile_warehouse_mad20','20','180','180','540','540'),
 ('113','114','Vestíbulo','suelos','tile_foyer_mad01','01','270','180','810','540'),
 ('114','113','Entrada de servicio / Parcela delantera','suelos','tile_front_yard_mad01','01','270','180','810','540'),
 ('115',null,'Inicio','general','inicio',null,'60','60','180','180'),
 ('116','0','Pared con cuadro','fichas','pared_cu','20','30','30','90','90'),
 ('117',null,'Alcantarilla','fichas','alcantarilla','20','30','30','90','90'),
 ('118',null,'Barriles','fichas','barriles','20','30','30','90','90'),
 ('119',null,'Fuego','fichas','fuego','20','30','30','90','90'),
 ('120',null,'Linterna apagada','fichas','linterna_ap','20','30','30','90','90'),
 ('121',null,'Mueble','fichas','mueble','20','30','30','90','90'),
 ('122',null,'Pared con exterior','fichas','pared_ex','20','30','30','90','90'),
 ('123',null,'Pared interior','fichas','pared_in','20','30','30','90','90'),
 ('124',null,'Pared con mueble','fichas','pared_mu','20','30','30','90','90'),
 ('125',null,'Pared rota','fichas','pared_ro','20','30','30','90','90'),
 ('126',null,'Pared con tuberia','fichas','pared_tu','20','30','30','90','90'),
 ('127',null,'Puerta exterior','fichas','puerta_ex','20','30','30','90','90'),
 ('128',null,'Trampilla','fichas','trampilla','20','30','30','90','90'),
 ('129',null,'Puerta secreta','fichas','puerta_secreta','20','30','30','90','90'),
 ('130',null,'Bloqueado','accesos','bloqueado',null,'30','30','90','90'),
 ('179',null,'Turba','criaturas','monster_riot','20','45','45','180','180'),
 ('178',null,'Sacerdote de Dagón','criaturas','monster_priest_of_dagon','20','45','45','180','180'),
 ('177',null,'Ágel descarnado','criaturas','monster_nightgaunt','09','45','45','180','180'),
 ('176',null,'Mi-Go','criaturas','monster_mi_go','01','45','45','180','180'),
 ('175',null,'Maniaco','criaturas','monster_maniac','01','45','45','180','180'),
 ('174',null,'Horrendo cazador','criaturas','monster_hunting_horror','20','45','45','180','180'),
 ('173',null,'Perro de Tindalos','criaturas','monster_hound_of_tindalos','01','45','45','180','180'),
 ('172',null,'Engendro cabrío','criaturas','monster_goat_spawn','09','45','45','180','180'),
 ('171',null,'Fantasma','criaturas','monster_ghost','20','45','45','180','180'),
 ('170',null,'Horror de Dunwuch','criaturas','monster_dunwich_horror','06','45','45','180','180'),
 ('169',null,'Hibrido de Profundo','criaturas','monster_deep_one_hybrid','20','45','45','180','180'),
 ('168',null,'Profundo','criaturas','monster_deep_one','20','45','45','180','180'),
 ('167',null,'Retoño oscuro','criaturas','monster_dark_young','06','45','45','180','180'),
 ('166',null,'Druida oscuro','criaturas','monster_dark_druid','09','45','45','180','180'),
 ('165',null,'Sectario','criaturas','monster_cultist','01 20','45','45','180','180'),
 ('164',null,'Lider de secta','criaturas','monster_cult_leader','01','45','45','180','180'),
 ('163',null,'Cthonian','criaturas','monster_cthonian','01','45','45','180','180'),
 ('162',null,'Reptante','criaturas','monster_crawling_one','06','45','45','180','180'),
 ('161',null,'Hijo de la cabra','criaturas','monster_child_of_the_goat','09','45','45','180','180'),
 ('160',null,'Hijo de Dagón','criaturas','monster_child_of_dagon','20','45','45','180','180'),
 ('159',null,'Byakhee','criaturas','monster_byakhee','06','45','45','180','180'),
 ('180',null,'Shoggoth','criaturas','monster_shoggoth','01','45','45','180','180'),
 ('181',null,'Semilla estelar','criaturas','monster_star_spawn','20','45','45','180','180'),
 ('182',null,'Subyugado','criaturas','monster_thrall','06','45','45','180','180'),
 ('183',null,'Bruja','criaturas','monster_witch','01','45','45','180','180'),
 ('184',null,'Brujo','criaturas','monster_wizard','06','45','45','180','180'),
 ('185',null,'Zombi','criaturas','monster_zombie','01','45','45','180','180'),
 ('186',null,'Agente Craven','pnjs','agente_craven','20','30','30','90','90'),
 ('187',null,'Bobby Foster','pnjs','bobby_foster','20','30','30','90','90'),
 ('188',null,'Bruce Darzi','pnjs','bruce_darzi','23','30','30','90','90'),
 ('189',null,'Edna Hughes','pnjs','edna_hughes','20','30','30','90','90'),
 ('190',null,'Elizabeth Fairview','pnjs','elizabeth_fairview','23','30','30','90','90'),
 ('191',null,'Eugene Clemens','pnjs','eugene_clemens','20','30','30','90','90'),
 ('192',null,'Grace Bechman','pnjs','grace_bechman','20','30','30','90','90'),
 ('193',null,'Hombre Azul','pnjs','hombre_azul','20','30','30','90','90'),
 ('194',null,'Hombre Cobre','pnjs','hombre_cobre','20','30','30','90','90'),
 ('195',null,'Hombre Dorado','pnjs','hombre_dorado','20','30','30','90','90'),
 ('196',null,'Hombre Gris','pnjs','hombre_gris','20','30','30','90','90'),
 ('197',null,'Hombre Morado','pnjs','hombre_morado','20','30','30','90','90'),
 ('198',null,'Hombre Negro','pnjs','hombre_negro','20','30','30','90','90'),
 ('199',null,'Hombre Rojo','pnjs','hombre_rojo','20','30','30','90','90'),
 ('200',null,'Hombre Verde','pnjs','hombre_verde','20','30','30','90','90'),
 ('201',null,'Howard Bechman','pnjs','howard_bechman','20','30','30','90','90'),
 ('202',null,'Jean Spencer','pnjs','jean_spencer','23','30','30','90','90'),
 ('203',null,'Joyce Little','pnjs','joyce_little','20','30','30','90','90'),
 ('204',null,'Leland Williams','pnjs','leland_williams','23','30','30','90','90'),
 ('205',null,'May Nguyen','pnjs','may_nguyen','23','30','30','90','90'),
 ('206',null,'Mildred Bechman','pnjs','mildred_bechman','20','30','30','90','90'),
 ('207',null,'Mujer Azul','pnjs','mujer_azul','20','30','30','90','90'),
 ('208',null,'Mujer Cobre','pnjs','mujer_cobre','20','30','30','90','90'),
 ('209',null,'Mujer Dorado','pnjs','mujer_dorado','20','30','30','90','90'),
 ('210',null,'Mujer Gris','pnjs','mujer_gris','20','30','30','90','90'),
 ('211',null,'Mujer Morado','pnjs','mujer_morado','20','30','30','90','90'),
 ('212',null,'Mujer Negro','pnjs','mujer_negro','20','30','30','90','90'),
 ('213',null,'Mujer Rojo','pnjs','mujer_rojo','20','30','30','90','90'),
 ('214',null,'Mujer Verde','pnjs','mujer_verde','20','30','30','90','90'),
 ('215',null,'Othera Gilman','pnjs','othera_gilman','20','30','30','90','90'),
 ('216',null,'Perro Der','pnjs','perro_der','20','30','30','90','90'),
 ('217',null,'Perro Izq','pnjs','perro_izq','20','30','30','90','90'),
 ('218',null,'Richard Bachman','pnjs','richard_bachman','20','30','30','90','90'),
 ('219',null,'Sylvia Marsh','pnjs','sylvia_marsh','20','30','30','90','90'),
 ('220',null,'Tetsuo Mori','pnjs','tetsuo_mori','23','30','30','90','90'),
 ('221',null,'Thomas Carvey','pnjs','thomas_carvey','23','30','30','90','90'),
 ('222',null,'Victor Blake','pnjs','victor_blake','20','30','30','90','90'),
 ('223',null,'Zadok Allen','pnjs','zadok_allen','20','30','30','90','90'),
 ('224',null,'Zebulon Whateley','pnjs','zebulon_whateley','09','30','30','90','90'),
 ('225',null,'Ammi Pierce','pnjs','ammi_pierce','09','30','30','90','90'),
 ('226',null,'Eric Colt','pnjs','eric_colt','09','30','30','90','90'),
 ('227',null,'Corrina Jones','pnjs','corrina_jones','09','30','30','90','90'),
 ('228',null,'Derringer del .18','objetos','commonitem_18derringer','20','45','45','180','180'),
 ('229',null,'Automática del .25','objetos','commonitem_25_automatic','20','45','45','180','180'),
 ('230',null,'Tablón de madera','objetos','commonitem_2x4','20','45','45','180','180'),
 ('231',null,'Revólver del .38','objetos','commonitem_38revolver','20','45','45','180','180'),
 ('232',null,'Automática del .45','objetos','commonitem_45automatics','20','45','45','180','180'),
 ('233',null,'Manuscrito arcano','objetos','commonitem_arcanemanuscript','20','45','45','180','180'),
 ('234',null,'Hacha','objetos','commonitem_axe','20','45','45','180','180'),
 ('235',null,'Vendas','objetos','commonitem_bandages','20','45','45','180','180'),
 ('236',null,'Cachiporra','objetos','commonitem_blackjack','20','45','45','180','180'),
 ('237',null,'Nudilleras','objetos','commonitem_brassknuckles','20','45','45','180','180'),
 ('238',null,'Linterna sorda','objetos','commonitem_bullseyelantern','20','45','45','180','180'),
 ('239',null,'Velas','objetos','commonitem_candles','20','45','45','180','180'),
 ('240',null,'Carabina','objetos','commonitem_carbinerifle','20','45','45','180','180'),
 ('241',null,'Palanca','objetos','commonitem_crowbar','20','45','45','180','180'),
 ('242',null,'Cruz sagrada','objetos','commonitem_crucifix','20','45','45','180','180'),
 ('243',null,'Dinamita','objetos','commonitem_dynamite','20','45','45','180','180'),
 ('244',null,'Colgante con símbolo arcano ','objetos','commonitem_eldersignpendant','20','45','45','180','180'),
 ('245',null,'Talismán protector','objetos','commonitem_elderward','20','45','45','180','180'),
 ('246',null,'Espada encantada','objetos','commonitem_enchantedblade','20','45','45','180','180'),
 ('247',null,'Ropa elegante','objetos','commonitem_fineclothes','20','45','45','180','180'),
 ('248',null,'Extintor','objetos','commonitem_fireextinguisher','20','45','45','180','180'),
 ('249',null,'Pistola de bengalas','objetos','commonitem_flaregun','20','45','45','180','180'),
 ('250',null,'Agua bendita','objetos','commonitem_holywater','20','45','45','180','180'),
 ('251',null,'Lámpra de queroseno','objetos','commonitem_kerosenelantern','20','45','45','180','180'),
 ('252',null,'Biblia del rey Jaime','objetos','commonitem_kingjamesbible','20','45','45','180','180'),
 ('253',null,'Cuchillo','objetos','commonitem_knife','20','45','45','180','180'),
 ('254',null,'Tubiría de plomo','objetos','commonitem_leadpipe','20','45','45','180','180'),
 ('255',null,'Pitillera de la suerte','objetos','commonitem_luckycigarettecase','20','45','45','180','180'),
 ('256',null,'Pata de conejo','objetos','commonitem_luckyrabbitsfoot','20','45','45','180','180'),
 ('257',null,'Machete','objetos','commonitem_machete','20','45','45','180','180'),
 ('258',null,'Lupa','objetos','commonitem_magnifyingglass','20','45','45','180','180'),
 ('259',null,'Cuchillo de carnicero','objetos','commonitem_meatcleaver','20','45','45','180','180'),
 ('260',null,'Manual de medicina','objetos','commonitem_medicaltextbook','20','45','45','180','180'),
 ('261',null,'Pico','objetos','commonitem_pickaxe','20','45','45','180','180'),
 ('262',null,'Reloj de bolsillo','objetos','commonitem_pocketwatch','20','45','45','180','180'),
 ('263',null,'Navaja de afeitar','objetos','commonitem_razor','20','45','45','180','180'),
 ('264',null,'Daga ritual','objetos','commonitem_ritualdagger','20','45','45','180','180'),
 ('265',null,'Diario de escriba','objetos','commonitem_scribesjournal','20','45','45','180','180'),
 ('266',null,'Sedante','objetos','commonitem_sedative','20','45','45','180','180'),
 ('267',null,'Escopeta','objetos','commonitem_shotgun','20','45','45','180','180'),
 ('268',null,'Pala','objetos','commonitem_shovel','20','45','45','180','180'),
 ('269',null,'Almádena','objetos','commonitem_sledgehammer','20','45','45','180','180'),
 ('270',null,'Tomo de los Horrores','objetos','commonitem_tomeofhorrors','20','45','45','180','180'),
 ('271',null,'Tomo de los Secretos','objetos','commonitem_tomeofsecrets','20','45','45','180','180'),
 ('272',null,'Metralleta','objetos','commonitem_tommygun','20','45','45','180','180'),
 ('273',null,'Antorcha','objetos','commonitem_torch','20','45','45','180','180'),
 ('274',null,'Whisky','objetos','commonitem_whiskey','20','45','45','180','180'),
 ('275',null,'Llave inglesa','objetos','commonitem_wrench','20','45','45','180','180'),
 ('276',null,'Inspiración arcana','objetos','spell_arcaneinsight','20','45','45','180','180'),
 ('277',null,'Aimentar la mente','objetos','spell_feedthemind','20','45','45','180','180'),
 ('278',null,'Protección corporal','objetos','spell_fleshward','20','45','45','180','180'),
 ('279',null,'Inspirar valor','objetos','spell_instillbravery','20','45','45','180','180'),
 ('280',null,'Niebla venenosa','objetos','spell_poisonmist','20','45','45','180','180'),
 ('281',null,'Consunción','objetos','spell_shriveling','20','45','45','180','180'),
 ('282',null,'Ajar','objetos','spell_wither','20','45','45','180','180'),
 ('283',null,'Atormentar','objetos','spell_wrack','20','45','45','180','180'),
 ('284',null,'Llave de latón','objetos','uniqueitem_brasskey','20','45','45','180','180'),
 ('285',null,'Prueba circunstancial','objetos','uniqueitem_circumstantialevidence','20','45','45','180','180'),
 ('286',null,'Prueba concluyente','objetos','uniqueitem_conclusiveevidence','20','45','45','180','180'),
 ('287',null,'Diario de sectario','objetos','uniqueitem_cultistsjournal','20','45','45','180','180'),
 ('288',null,'Emblema de sectario','objetos','uniqueitem_cultsigil','20','45','45','180','180'),
 ('289',null,'Duque','objetos','uniqueitem_dukethedog','20','45','45','180','180'),
 ('290',null,'Estabilizador de flujo','objetos','uniqueitem_fluxstabilizer','20','45','45','180','180'),
 ('291',null,'Prueba forense','objetos','uniqueitem_forensicevidence','20','45','45','180','180'),
 ('292',null,'Llave de oro','objetos','uniqueitem_goldkey','20','45','45','180','180'),
 ('293',null,'Escultura grotesta','objetos','uniqueitem_grotesquestone','20','45','45','180','180'),
 ('294',null,'Esposas','objetos','uniqueitem_handcuffs','20','45','45','180','180'),
 ('295',null,'Prueba incriminatoria','objetos','uniqueitem_incriminatingevidence','20','45','45','180','180'),
 ('296',null,'Información reveladora','objetos','uniqueitem_missinglink','20','45','45','180','180'),
 ('297',null,'Lámpara de aceite','objetos','uniqueitem_oillamp','20','45','45','180','180'),
 ('298',null,'Viejo diario','objetos','uniqueitem_oldjournal','20','45','45','180','180'),
 ('299',null,'Llaves antiguas','objetos','uniqueitem_oldkeys','20','45','45','180','180'),
 ('300',null,'Prueba fotográfica','objetos','uniqueitem_photographicevidence','20','45','45','180','180'),
 ('301',null,'Caja enigmática','objetos','uniqueitem_puzzlebox','20','45','45','180','180'),
 ('302',null,'Componentes de ritual','objetos','uniqueitem_ritualcomponents','20','45','45','180','180'),
 ('303',null,'Soga','objetos','uniqueitem_rope','20','45','45','180','180'),
 ('304',null,'Llave de plata','objetos','uniqueitem_silverkey','20','45','45','180','180'),
 ('305',null,'Laboratorio','suelos','tile_laboratory_mad01','01','180','180','540','540'),
 ('308','309','Atril en arena','fichas','atril_arena','01','30','30','90','90'),
 ('309','308','Atril en jardín','fichas','atril_jardin','01','30','30','90','90'),
 ('310','311','Atril en arena','fichas','atril_arena','01','30','30','90','90'),
 ('311','310','Atril en madera','fichas','atril_madera','01','30','30','90','90'),
 ('312','313','Escalera en madera','fichas','escalera_madera','01','30','30','90','90'),
 ('313','312','Escalera en hierba','fichas','escalera_hierba','01','30','30','90','90'),
 ('314','315','Escalera en arena','fichas','escalera_arena','01','30','30','90','90'),
 ('315','314','Escalera en madera','fichas','escalera_madera','01','30','30','90','90'),
 ('316','317','Cofre en madera clara','fichas','cofre_madera_clara','01','30','30','90','90'),
 ('317','316','Cofre en arena','fichas','cofre_arena','01','30','30','90','90'),
 ('318','319','Cofre en madera oscura','fichas','cofre_madera_oscura','01','30','30','90','90'),
 ('319','318','Cofre en arena','fichas','cofre_arena','01','30','30','90','90'),
 ('320','321','Conducto en madera clara','fichas','conducto_madera_clara','01','30','30','90','90'),
 ('321','320','Conducto en arena','fichas','conducto_arena','01','30','30','90','90'),
 ('322','321','Conducto en madera oscura','fichas','conducto_madera_oscura','01','30','30','90','90'),
 ('323','322','Conducto en arena','fichas','conducto_arena','01','30','30','90','90'),
 ('324','325','Obstaculo en madera clara','fichas','obstaculo_madera_clara','01','30','30','90','90'),
 ('325','324','Obstaculo en arena','fichas','obstaculo_arena','01','30','30','90','90'),
 ('326','325','Obstaculo en madera oscura','fichas','obstaculo_madera_oscura','01','30','30','90','90'),
 ('327','326','Obstaculo en arena','fichas','obstaculo_arena','01','30','30','90','90'),
 ('328','329','Hoguera en arena','fichas','hoguera_arena','01','30','30','90','90'),
 ('329','328','Hoguera en hierba','fichas','hoguera_hierba','01','30','30','90','90'),
 ('330','331','Hoguera en arena','fichas','hoguera_arena','01','30','30','90','90'),
 ('331','330','Hoguera en hierba','fichas','hoguera_hierba','01','30','30','90','90'),
 ('332','336','Muerto en hierba','fichas','muerto_hierba','01','30','30','90','90'),
 ('333','337','Muerto en hierba','fichas','muerto_hierba','01','30','30','90','90'),
 ('334','338','Muerto en hierba','fichas','muerto_hierba','01','30','30','90','90'),
 ('335','339','Muerto en hierba','fichas','muerto_hierba','01','30','30','90','90'),
 ('336','332','Muerto en arena','fichas','muerto_arena','01','30','30','90','90'),
 ('337','333','Muerto en madera','fichas','muerto_madera','01','30','30','90','90'),
 ('338','334','Muerto en arena','fichas','muerto_arena','01','30','30','90','90'),
 ('339','335','Muerto en madera','fichas','muerto_madera','01','30','30','90','90'),
 ('341','342','Muerto en arena','fichas','muerto_arena','01','30','30','90','90'),
 ('342','341','Muerto en madera','fichas','muerto_madera','01','30','30','90','90'),
 ('343','344','Muerto en arena','fichas','muerto_arena','01','30','30','90','90'),
 ('344','343','Muerto en madera','fichas','muerto_madera','01','30','30','90','90');

SET FOREIGN_KEY_CHECKS = 1;