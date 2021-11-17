<?php
// API URL
$url = 'http://www.api_de_SAP';

// Crear url
$ch = curl_init($url);

// acomodar datos
$data = array(
    'usuario' => 'blabla',
    'campo1' => '123456',
    'campo2' => '123456',
    'campo3' => '123456',
    'campo4' => '123456',
    'campo5' => '123456',
    'campo6' => '123456',
    'campo7' => '123456'
    
);
$payload = json_encode(array("embajador" => $data));

// agregar el json del objeto al request
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// poner el campo content type como application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

// retornar respuesta en lugar de renderizar
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// ejecutar el POST
$result = curl_exec($ch);

// cerrar
curl_close($ch);