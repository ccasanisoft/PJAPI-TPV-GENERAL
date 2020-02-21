<?php

namespace App\Controllers;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use PDO;
use App\Models\GeneralModel;
/*use Firebase\JWT\JWT;
use App\Controllers\Auth;*/
use App\Entity\EntityInfoEmpresa;


class GeneralController {

 protected $container;


 public function __construct($container){
      $this->container = $container;
 }  

 public function __get($property){
    if ($this->container->{$property}) {
        return $this->container->{$property};
    }
 }


/* public function ubigeoCode($request, $response){
    $contentType = isset($_SERVER["CONTENT_TYPE"])? trim($_SERVER["CONTENT_TYPE"]) : '';
    $ctype = strtolower($contentType);

   if($ctype == 'application/json'){
    
     $data = $request->getParsedBody();

       if (!empty($data)) {
          $ubigeo = $data['ubigeo'];
          $db = new GeneralModel();
       
          $d = $db->getUbigeoCodeUbigeo($ubigeo);
          return $this->response->withJson($d);
       }else{

           $rs = [
              "rs" => "data is needed for the query",
              "status" => 404,
             ];

          return $this->response->withJson($rs);
       }

     

    }else{
     $rs = [
            "rs" => "invalid count type",
            "status" => 404,
           ];

        return $this->response->withJson($rs);
    }
   
}*/

public function list_medida(){
	
	$bd=new GeneralModel();
	
	$list_cata_03=$bd->list_cata03();
	
	return $this->response->withJson($list_cata_03);
	
}

public function depart_list(){
	
	$bd=new GeneralModel();
	
	$list_depas=$bd->list_depas();
	
	return $this->response->withJson($list_depas);
	
}

public function list_document_ident(){
	
	$bd=new GeneralModel();
	
	$list_tipoDocument=$bd->list_tipoDocument();
	
	return $this->response->withJson($list_tipoDocument);
	
}

public function select_provincia($request, $response){
	
	$data = $request->getParsedBody();
    $departamento = $data['departamento'];
	
	$bd=new GeneralModel();
	
	$list_provincia=$bd->list_provincia($departamento);
	
	return $this->response->withJson($list_provincia);
	
}

public function select_distrito($request, $response){
	
	$data = $request->getParsedBody();
    $provincia = $data['provincia'];
	$departamento = $data['departamento'];
	
	$bd=new GeneralModel();
	
	$list_distrito=$bd->list_distrito($provincia, $departamento);
	
	return $this->response->withJson($list_distrito);
	
}

public function tipo_Transporte_list(){
	
	$bd=new GeneralModel();
	
	$list_tiposTransporte=$bd->list_tiposTransporte();
	
	return $this->response->withJson($list_tiposTransporte);
	
}

public function tipo_Transporte_consult($request, $response){
	
	$data = $request->getParsedBody();
	$tip_transport = $data['tip_transporte'];
	
	$bd=new GeneralModel();
	
	$consul_tip_transporte=$bd->consul_tip_transporte($tip_transport);
	
	foreach ($consul_tip_transporte as $tip){
		$result['description']=$tip['description'];
	}
	
	return $this->response->withJson($result);
	
}

public function consult_emp($request, $response){
	
	$data = $request->getParsedBody();
	$rucEmpresa = $data['ruc'];
	
	$bd=new GeneralModel();
	
	$consul_emp=$bd->consul_emp($rucEmpresa);
	
	foreach ($consul_emp as $emp){
		$dataEmp['ruc']=$emp['ruc'];
		$dataEmp['razon_social']=$emp['razon_social'];
		$dataEmp['usuario_sol']=$emp['usuario_sol'];
		$dataEmp['clave_secundario']=$emp['clave_secundario'];
		$dataEmp['password_firma']=$emp['password_firma'];
		$dataEmp['host_BD']=$emp['host_BD'];
		$dataEmp['BD_sistema']=$emp['BD_sistema'];
		$dataEmp['usuario_BD']=$emp['usuario_BD'];
		$dataEmp['password_BD']=$emp['password_BD'];
	}
	
	return $this->response->withJson($dataEmp);
	
	
}

public function consult_depProvDist_consul($request, $response){
	
	$data = $request->getParsedBody();
	$ubigeo = $data['ubigeo'];
	
	$bd=new GeneralModel();
	
	$consul_ubigeo=$bd->consul_ubigeo($ubigeo);
	
	foreach ($consul_ubigeo as $dataUbigeo){
		$result['distrito']=$dataUbigeo['distrito'];
		$result['provincia']=$dataUbigeo['provincia'];
		$result['departamento']=$dataUbigeo['departamento'];
	}
	
	return $this->response->withJson($result);
	
}

}