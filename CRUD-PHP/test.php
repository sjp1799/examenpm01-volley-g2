<?php

if(isset($_GET["nombre"]) /*&& isset($_GET["apellidos"]) && isset($_GET["edad"])*/){
    $documento=$_GET['nombre'];
    $nombre=$_GET['apellidos'];
    $profesion=$_GET['edad'];
    echo $documento;
}


?>