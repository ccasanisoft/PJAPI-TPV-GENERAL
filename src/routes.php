<?php


$app->get('/', function ($request, $response, $args) {
  return $this->renderer->render($response, 'index.phtml', $args);
});



$app->group('/api/v1',function()use($app){
   
    $app->group('/ubigeo',function()use($app){
	$app->get('/distrito','App\Controllers\GeneralController:select_distrito');
    $app->get('/provincia','App\Controllers\GeneralController:select_provincia');
    $app->get('/ub','App\Controllers\GeneralController:ubigeoCode');
	$app->get('/departamentos','App\Controllers\GeneralController:depart_list');
	$app->get('/direccion','App\Controllers\GeneralController:consult_depProvDist_consul');
    });
	
	$app->group('/catalogo03',function()use($app){
    $app->get('/medida','App\Controllers\GeneralController:list_medida');
    });
	
	$app->group('/catalogo06',function()use($app){
    $app->get('/tipoDocumento','App\Controllers\GeneralController:list_document_ident');
    });
	
	$app->group('/catalogo18',function()use($app){
    $app->get('/tipoTransporte','App\Controllers\GeneralController:tipo_Transporte_list');
	$app->get('/tipoTransporte_consult','App\Controllers\GeneralController:tipo_Transporte_consult');
    });
	
	$app->group('/Empresa',function()use($app){
    $app->post('/datos','App\Controllers\GeneralController:consult_emp');
    });

    
});