# Host: localhost  (Version 5.5.5-10.4.21-MariaDB-log)
# Date: 2022-05-12 20:33:26
# Generator: MySQL-Front 6.1  (Build 1.26)
CREATE DATABASE db_rh;
USE db_rh;

#
# Structure for table "tbl_caja_compensacion"
#

DROP TABLE IF EXISTS `tbl_caja_compensacion`;
CREATE TABLE `tbl_caja_compensacion` (
  `id_caja_compensacion` tinyint(3) NOT NULL AUTO_INCREMENT,
  `caja_compensacion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_caja_compensacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# Data for table "tbl_caja_compensacion"
#


#
# Structure for table "tbl_cargo"
#

DROP TABLE IF EXISTS `tbl_cargo`;
CREATE TABLE `tbl_cargo` (
  `id_cargo` tinyint(3) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# Data for table "tbl_cargo"
#


#
# Structure for table "tbl_estudios"
#

DROP TABLE IF EXISTS `tbl_estudios`;
CREATE TABLE `tbl_estudios` (
  `id_estudio` tinyint(3) NOT NULL AUTO_INCREMENT,
  `estudios` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_estudio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# Data for table "tbl_estudios"
#


#
# Structure for table "tbl_eventos"
#

DROP TABLE IF EXISTS `tbl_eventos`;
CREATE TABLE `tbl_eventos` (
  `id_eventos` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_evento` date DEFAULT NULL,
  `lugar_evento` varchar(255) DEFAULT NULL,
  `duracion_evento` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_eventos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# Data for table "tbl_eventos"
#


#
# Structure for table "tbl_pension"
#

DROP TABLE IF EXISTS `tbl_pension`;
CREATE TABLE `tbl_pension` (
  `id_pension` tinyint(3) NOT NULL AUTO_INCREMENT,
  `pension` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pension`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# Data for table "tbl_pension"
#


#
# Structure for table "tbl_tipo_contrato"
#

DROP TABLE IF EXISTS `tbl_tipo_contrato`;
CREATE TABLE `tbl_tipo_contrato` (
  `id_tipo_contrato` tinyint(3) NOT NULL AUTO_INCREMENT,
  `tipo_contrato` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_contrato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# Data for table "tbl_tipo_contrato"
#


#
# Structure for table "tbl_personas"
#

DROP TABLE IF EXISTS `tbl_personas`;
CREATE TABLE `tbl_personas` (
  `documento_persona` bigint(11) NOT NULL DEFAULT 0,
  `nombre_persona` varchar(255) NOT NULL DEFAULT '',
  `id_tipo_contrato_persona` tinyint(3) NOT NULL DEFAULT 0,
  `salario_persona` double NOT NULL DEFAULT 0,
  `id_cargo_personas` tinyint(3) NOT NULL DEFAULT 0,
  `id_estudios_personas` tinyint(3) NOT NULL DEFAULT 0,
  `id_pension_persona` tinyint(3) NOT NULL DEFAULT 0,
  `id_caja_de_compensacion_persona` tinyint(3) NOT NULL DEFAULT 0,
  `direccion_persona` varchar(255) NOT NULL DEFAULT '',
  `correo_persona` varchar(255) DEFAULT NULL,
  `telefono_persona` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`documento_persona`),
  KEY `id_tipo_contrato_persona` (`id_tipo_contrato_persona`),
  KEY `id_cargo_personas` (`id_cargo_personas`),
  KEY `id_estudios_personas` (`id_estudios_personas`),
  KEY `id_pension_persona` (`id_pension_persona`),
  KEY `id_caja_de_compensacion_persona` (`id_caja_de_compensacion_persona`),
  CONSTRAINT `tbl_personas_ibfk_1` FOREIGN KEY (`id_tipo_contrato_persona`) REFERENCES `tbl_tipo_contrato` (`id_tipo_contrato`),
  CONSTRAINT `tbl_personas_ibfk_2` FOREIGN KEY (`id_cargo_personas`) REFERENCES `tbl_cargo` (`id_cargo`),
  CONSTRAINT `tbl_personas_ibfk_3` FOREIGN KEY (`id_estudios_personas`) REFERENCES `tbl_estudios` (`id_estudio`),
  CONSTRAINT `tbl_personas_ibfk_4` FOREIGN KEY (`id_pension_persona`) REFERENCES `tbl_pension` (`id_pension`),
  CONSTRAINT `tbl_personas_ibfk_5` FOREIGN KEY (`id_caja_de_compensacion_persona`) REFERENCES `tbl_caja_compensacion` (`id_caja_compensacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# Data for table "tbl_personas"
#


#
# Structure for table "tbl_asistencia_eventos"
#

DROP TABLE IF EXISTS `tbl_asistencia_eventos`;
CREATE TABLE `tbl_asistencia_eventos` (
  `id_asistencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_evento_asistencia` int(3) NOT NULL DEFAULT 0,
  `id_persona_asistencia` bigint(3) NOT NULL DEFAULT 0,
  `estado_asistencia` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_asistencia`),
  KEY `id_evento_asistencia` (`id_evento_asistencia`),
  KEY `fk01` (`id_persona_asistencia`),
  CONSTRAINT `fk01` FOREIGN KEY (`id_persona_asistencia`) REFERENCES `tbl_personas` (`documento_persona`),
  CONSTRAINT `tbl_asistencia_eventos_ibfk_1` FOREIGN KEY (`id_evento_asistencia`) REFERENCES `tbl_eventos` (`id_eventos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# Data for table "tbl_asistencia_eventos"
#

