<?php

$host_db = "127.0.0.1";
$username_db = "root";
$password_db = "";
$db_name = "administrador";
$port_db =  "3308";

$conexion = @new mysqli( $host_db , $username_db , $password_db , $db_name , $port_db );
if($conexion -> connect_error) echo $conexion -> connect_error;
$conexion->set_charset('UTF-8');




?>