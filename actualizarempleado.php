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
    
    $item->id = $data->id;

    // Valores de la clase empleado
    $item->nombre = $data->nombre;
    $item->apellidos = $data->apellidos;
    $item->edad = $data->edad;
  
    
    if($item->updateEmployee()){
        echo json_encode("Empleado actualizado.");
    } else{
        echo json_encode("Empleado no actualizado");
    }
?>