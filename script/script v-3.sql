DELIMITER $$
CREATE PROCEDURE `sp_UbigeoDescript_consult`(IN `codUbigeo` INT)
    NO SQL
BEGIN

SELECT 	distrito, provincia, departamento FROM ubigeo WHERE ubigeo = codUbigeo;

END$$
DELIMITER ;