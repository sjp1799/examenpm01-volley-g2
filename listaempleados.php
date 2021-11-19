<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once 'Database.php';
    include_once 'Empleados.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Empleados($db);

    $stmt = $items->getEmployees();
    $itemCount = $stmt->rowCount();


    //echo json_encode($itemCount);

   
    if($itemCount > 0){
        
        $employeeArr = array();
        $employeeArr["empleado"] = array();
        //$employeeArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "nombre" => $nombre,
                "apellidos" => $apellidos,
                "edad" => $edad
            );

            array_push($employeeArr["empleado"], $e);
        }
        echo json_encode($employeeArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
    
?>