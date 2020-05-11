drop database if exists coronachan;
create database coronachan;
use coronachan;

DROP TABLE IF EXISTS `paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paises` (
  `clave_pais` varchar(60) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `iso2` varchar(100) NOT NULL,
  PRIMARY KEY (`clave_pais`),
  KEY `indice_nombre` (`nombre`),
  KEY `indice_iso` (`iso2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `registro_dia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registro_dia` (
  `id_dia` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `confirmados` bigint(20) NOT NULL,
  `muertes` bigint(20) NOT NULL,
  `recuperados` bigint(20) NOT NULL,
  `clave_pais` varchar(60) NOT NULL,
  PRIMARY KEY (`id_dia`),
  KEY `fk_clave_pais` (`clave_pais`),
  CONSTRAINT `fk_clave_pais` FOREIGN KEY (`clave_pais`) REFERENCES `paises` (`clave_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=30016 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET character_set_client = @saved_cs_client */;
