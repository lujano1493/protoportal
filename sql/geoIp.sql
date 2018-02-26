CREATE TABLE `nimx`.`ipgeo_pais` (
  `ip_inicio` VARCHAR(15) NULL,
  `ip_fin` VARCHAR(15) NULL,
  `ip_numero_inicio` INT NOT NULL,
  `ip_numero_fin` INT NOT NULL,
  `pais_codigo` VARCHAR(2) NULL,
  `pais_nombre` VARCHAR(50) NULL,
  PRIMARY KEY (`ip_numero_inicio`, `ip_numero_fin`));

-- CARGA de Archivo con relacion de rangos de ip por pais  descarga de archivo  https://dev.maxmind.com/geoip/legacy/csv/
  LOAD DATA LOCAL INFILE "GeoIPCountryWhois.csv"
  INTO TABLE  nimx.catalogo_ipgeo_pais
  FIELDS TERMINATED BY ','
  ENCLOSED BY '\"'
  LINES TERMINATED BY '\n';
