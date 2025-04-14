CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `mision` text NOT NULL,
  `vision` text NOT NULL,
  `historia` text NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `horario` varchar(255) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `coordenadas` varchar(100) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 