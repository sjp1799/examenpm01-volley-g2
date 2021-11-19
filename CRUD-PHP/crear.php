<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once 'Database.php';
    include_once 'Empleados.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Empleados($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->nombre = $data->nombre;
    $item->apellidos = $data->apellidos;
    $item->edad = $data->edad;
   
    
    if($item->createEmployee()){
        $RespuestaArr["respuesta"] = array();
        array_push($RespuestaArr["respuesta"], array("message" => "Creado"));
        echo json_encode($RespuestaArr);
    } else{
        echo json_encode(
            array("message" => "No Creado"));
    }
?>