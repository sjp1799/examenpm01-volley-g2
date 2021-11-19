<?php
    class Empleados{

        // Conexion
        private $conn;

        // Tabla
        private $db_table = "empleados";

        // Columnas
        public $id;
        public $nombre;
        public $apellidos;
        public $edad;
    

        // Constructor de clae
        public function __construct($db){
            $this->conn = $db;
        }

        // GET todos los empleados
        public function getEmployees(){
            $sqlQuery = "SELECT id, nombre, apellidos, edad FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // Crear un empleados
        public function createEmployee(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    nombre = :nombre, 
                    apellidos = :apellidos, 
                    edad = :edad";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nombre=htmlspecialchars(strip_tags($this->nombre));
            $this->apellidos=htmlspecialchars(strip_tags($this->apellidos));
            $this->edad=htmlspecialchars(strip_tags($this->edad));
          
        
            // bind data
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":apellidos", $this->apellidos);
            $stmt->bindParam(":edad", $this->edad);
           
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleEmployee(){
            $sqlQuery = "SELECT
                        id, 
                        nombre, 
                        apellidos, 
                        edad
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->nombre = $dataRow['nombre'];
            $this->apellidos = $dataRow['apellidos'];
            $this->edad = $dataRow['edad'];
          
        }        

        // UPDATE
        public function updateEmployee(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    nombre = :nombre, 
                    apellidos = :apellidos, 
                        edad = :edad
                    WHERE 
                        id = :id";

            //echo $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery);
           
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->nombre=htmlspecialchars(strip_tags($this->nombre));
            $this->apellidos=htmlspecialchars(strip_tags($this->apellidos));
            $this->edad=htmlspecialchars(strip_tags($this->edad));
            
        
            // bind data
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":apellidos", $this->apellidos);
            $stmt->bindParam(":edad", $this->edad);
         
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteEmployee(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>