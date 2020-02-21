<?php 


namespace App\Models;

use App\Entity\EntityReferralGuide;
use App\Entity\EntityReferralGuideItems;
use App\Entity\EntityInfoEmpresa;
use App\Entity\EntitySendInvoiceGR;

class GeneralModel extends Db
{
    
/* consulta empresa x ruc*/
public function getEmpresasRuc($ruc){

        //$con=Db::conectarBd("mysql5022.site4now.net","db_a4d0c2_actecpe","a4d0c2_actecpe","ActecPeru123");
		$con=Db::conectarBd(getenv('localhost'),getenv('dbname'),getenv('db_user_name'),getenv('db_password'));//"localhost","BDEmpresasTPV","root","123");
        $sth = $con->prepare("SELECT usuario_sol, password_firma, clave_secundario, host_BD, BD_sistema, usuario_BD, password_BD, razon_social FROM clients WHERE ruc = ?");
        $sth->execute(array($ruc));
        $rs  = $sth->fetchAll();
        if(empty($rs)){

        $statusError = [
            "rs" => "no se encontraron datos con el ruc -> ".$ruc,
            "status" => 404,
       ];
       
            return $statusError;
        }else{
        	return $rs;
        }
        
}

/*consultar ubigeo x distrito*/
public function getUbigeoDistrito($district){

        //$con=Db::conectarBd("mysql5022.site4now.net","db_a4d0c2_actecpe","a4d0c2_actecpe","ActecPeru123");
		$con=Db::conectarBd(getenv('localhost'),getenv('dbname'),getenv('db_user_name'),getenv('db_password'));
        $sth = $con->prepare("CALL sp_ubigeoDistrito(?)");
        $sth->execute(array($district));
        $rs  = $sth->fetchAll();
        if(empty($rs)){

            $statusError = [
            "rs" => "no data was found for the district -> ".$district,
            "status" => 404,
            ];
            
            return $statusError;
        }else{
            return $rs;
        }
        
}

/*consultar ubigeo x idubigeo*/
public function getUbigeoCodeUbigeo($code){

        //$con=Db::conectarBd("mysql5022.site4now.net","db_a4d0c2_actecpe","a4d0c2_actecpe","ActecPeru123");
		$con=Db::conectarBd(getenv('localhost'),getenv('dbname'),getenv('db_user_name'),getenv('db_password'));
        $sth = $con->prepare("CALL sp_ubigeoxcode(?)");
        $sth->execute(array($code));
        $rs  = $sth->fetchAll();
        if(empty($rs)){

            $statusError = [
            "rs" => "no data was found for the code -> ".$code,
            "status" => 404,
            ];
            
            return $statusError;
        }else{
            return $rs;
        }
        
}


//*******************************************************

public function list_cata03(){
	
	try{
			$con=Db::conectarBd(getenv('localhost'),getenv('dbname'),getenv('db_user_name'),getenv('db_password'));
			$statement = $con->prepare('CALL `sp_listCatalogo03_list`();');
			$statement->execute();
			
			$row = $statement->fetchAll(\PDO::FETCH_ASSOC);
			$statement->closeCursor();
			return $row;
			
		}catch(PDOException $e){
			$row[0] =0;
			
			return $row;
		}
	
}

public function list_depas(){
	try{
			$con=Db::conectarBd(getenv('localhost'),getenv('dbname'),getenv('db_user_name'),getenv('db_password'));
			$statement = $con->prepare('CALL `sp_ubigeoDepartam_list`();');
			$statement->execute();
			
			$row = $statement->fetchAll(\PDO::FETCH_ASSOC);
			$statement->closeCursor();
			return $row;
			
		}catch(PDOException $e){
			$row[0] =0;
			
			return $row;
		}
}

public function list_tipoDocument(){
	try{
			$con=Db::conectarBd(getenv('localhost'),getenv('dbname'),getenv('db_user_name'),getenv('db_password'));
			$statement = $con->prepare('CALL `sp_listCatalogo06_list`();');
			$statement->execute();
			
			$row = $statement->fetchAll(\PDO::FETCH_ASSOC);
			$statement->closeCursor();
			return $row;
			
		}catch(PDOException $e){
			$row[0] =0;
			
			return $row;
		}
}

public function list_provincia($departamento){
	try{
			$con=Db::conectarBd(getenv('localhost'),getenv('dbname'),getenv('db_user_name'),getenv('db_password'));
			$statement = $con->prepare('CALL sp_ubigeoProvincia_list(
			:depart
			);');
			$statement->execute([
			'depart' => $departamento
			]);
			
			$row = $statement->fetchAll(\PDO::FETCH_ASSOC);
			$statement->closeCursor();
			return $row;
			
		}catch(PDOException $e){
			$row[0] =0;
			
			return $row;
		}
}

public function list_distrito($provincia, $departamento){
	try{
			$con=Db::conectarBd(getenv('localhost'),getenv('dbname'),getenv('db_user_name'),getenv('db_password'));
			$statement = $con->prepare('CALL sp_ubigeoDistrito_list(
			:provin,
			:depa
			);');
			$statement->execute([
			'provin' => $provincia,
			'depa' => $departamento,
			]);
			
			$row = $statement->fetchAll(\PDO::FETCH_ASSOC);
			$statement->closeCursor();
			return $row;
			
		}catch(PDOException $e){
			$row[0] =0;
			
			return $row;
		}
}

public function list_tiposTransporte(){
	
	try{
			$con=Db::conectarBd(getenv('localhost'),getenv('dbname'),getenv('db_user_name'),getenv('db_password'));
			$statement = $con->prepare('CALL `sp_listCatalogo18_list`();');
			$statement->execute();
			
			$row = $statement->fetchAll(\PDO::FETCH_ASSOC);
			$statement->closeCursor();
			return $row;
			
		}catch(PDOException $e){
			$row[0] =0;
			
			return $row;
		}
	
}

public function consul_tip_transporte($tipTransporte){
	try{
			$con=Db::conectarBd(getenv('localhost'),getenv('dbname'),getenv('db_user_name'),getenv('db_password'));
			$statement = $con->prepare('CALL sp_alm_tipoTransporte_consult(
			:tip_transporte
			);');
			$statement->execute([
			'tip_transporte' => $tipTransporte
			]);
			
			$row = $statement->fetchAll(\PDO::FETCH_ASSOC);
			$statement->closeCursor();
			return $row;
			
		}catch(PDOException $e){
			$row[0] =0;
			
			return $row;
		}
}

public function consul_emp($rucEmpresa){
	try{
			$con=Db::conectarBd(getenv('localhost'),getenv('dbname'),getenv('db_user_name'),getenv('db_password'));
			$statement = $con->prepare('CALL sp_alm_emp_consult(
			:rucEmp
			);');
			$statement->execute([
			'rucEmp' => $rucEmpresa
			]);
			
			$row = $statement->fetchAll(\PDO::FETCH_ASSOC);
			$statement->closeCursor();
			return $row;
			
		}catch(PDOException $e){
			$row[0] =0;
			
			return $row;
		}
}

public function consul_ubigeo($codUbigeo){
	try{
			$con=Db::conectarBd(getenv('localhost'),getenv('dbname'),getenv('db_user_name'),getenv('db_password'));
			$statement = $con->prepare('CALL sp_UbigeoDescript_consult(
			:codUbigeo
			);');
			$statement->execute([
			'codUbigeo' => $codUbigeo
			]);
			
			$row = $statement->fetchAll(\PDO::FETCH_ASSOC);
			$statement->closeCursor();
			return $row;
			
		}catch(PDOException $e){
			$row[0] =0;
			
			return $row;
		}
}

}
