DELIMITER $$
CREATE PROCEDURE `sp_alm_emp_consult`(IN `rucEmp` VARCHAR(11))
    NO SQL
BEGIN

SELECT ruc, razon_social, usuario_sol, 	clave_secundario, password_firma, host_BD, 	BD_sistema, usuario_BD, password_BD 
FROM clients
WHERE ruc = rucEmp;

END$$
DELIMITER ;