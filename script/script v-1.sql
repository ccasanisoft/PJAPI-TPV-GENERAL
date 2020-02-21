CREATE TABLE `catalogo_03` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `catalogo_03` (`id`, `code`, `description`) VALUES
(1, 'KGM', 'kilogram'),
(2, 'LTR', 'Litre');

ALTER TABLE `catalogo_03`  ADD PRIMARY KEY (`id`);

ALTER TABLE `catalogo_03`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
  
-- **************************************************************

CREATE TABLE `catalogo_06` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `catalogo_06` (`id`, `code`, `description`) VALUES
(1, '1', 'DNI'),
(2, '6', 'RUC'),
(3, '4', 'CARNET DE EXTRANJERIA'),
(4, '7', 'PASAPORTE');

ALTER TABLE `catalogo_06`  ADD PRIMARY KEY (`id`);

ALTER TABLE `catalogo_06`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

-- ************************************************************

CREATE TABLE `catalogo_18` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `catalogo_18` (`id`, `code`, `description`) VALUES
(1, '1', 'Transporte publico'),
(2, '2', 'Transporte privado');

ALTER TABLE `catalogo_18`  ADD PRIMARY KEY (`id`);

ALTER TABLE `catalogo_18`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- ***************************************************************

DELIMITER $$
CREATE   PROCEDURE `sp_listCatalogo03_list`()
    NO SQL
SELECT code, description FROM catalogo_03;$$
DELIMITER ;

-- **************************************************************

DELIMITER $$
CREATE   PROCEDURE `sp_listCatalogo06_list`()
    NO SQL
BEGIN

SELECT code, description FROM catalogo_06;

END$$
DELIMITER ;

-- *************************************************************

DELIMITER $$
CREATE   PROCEDURE `sp_listCatalogo18_list`()
    NO SQL
BEGIN

SELECT code, description FROM catalogo_18;

END$$
DELIMITER ;

-- **********************************************************

DELIMITER $$
CREATE   PROCEDURE `sp_ubigeoDepartam_list`()
    NO SQL
BEGIN

SELECT DISTINCT(departamento) as depas FROM ubigeo;

END$$
DELIMITER ;

-- ************************************************************

DELIMITER $$
CREATE   PROCEDURE `sp_ubigeoDistrito_list`(IN `provin` VARCHAR(50), IN `depa` VARCHAR(50))
    NO SQL
BEGIN

SELECT ubigeo, distrito FROM ubigeo WHERE provincia = provin and  departamento = depa;

END$$
DELIMITER ;

-- ****************************************************************

DELIMITER $$
CREATE   PROCEDURE `sp_ubigeoProvincia_list`(IN `depart` VARCHAR(100))
    NO SQL
BEGIN

SELECT DISTINCT(Provincia) as Provin FROM ubigeo WHERE departamento = depart;

END$$
DELIMITER ;

-- ***************************************************************

DELIMITER $$
CREATE   PROCEDURE `sp_alm_tipoTransporte_consult`(IN `tip_transporte` INT)
    NO SQL
BEGIN

SELECT description FROM `catalogo_18` WHERE id=tip_transporte;

END$$
DELIMITER ;


