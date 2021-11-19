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

    //$data = json_decode(file_get_contents("php://input"));
   
    if(isset($_GET["nombre"]) && isset($_GET["apellidos"]) && isset($_GET["edad"])){
		$nombre=$_GET['nombre'];
		$apellidos=$_GET['apellidos'];
		$edad=$_GET['edad'];

        echo $nombre;
        
        $item->nombre =$nombre;
        $item->apellidos = $apellidos;
        $item->edad = $edad;
    }
   
    
    if($item->createEmployee()){
        echo 'Empleado creado.';
    } else{
        echo 'Empleado no creado.';
    }
?>