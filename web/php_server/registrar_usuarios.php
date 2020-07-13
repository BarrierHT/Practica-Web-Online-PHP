<?php

function error(){
    echo 'invalid_name';
    die();
}


$decision = true;
//Validar datos...(pendiente)
//die()

if( isset($_POST['name']) && isset($_POST['password']) &&  isset($_POST['email'])
 && isset($_POST['edad']) && isset($_POST['sexo']) && isset($_POST['nacimiento']) ){
$name = $_POST['name']; 
$password = $_POST['password'];
$email = $_POST['email'];
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];
$nacimiento = $_POST['nacimiento'];

//test1

include("../php_server/db_connect.php");

$query = "SELECT username FROM usuarios WHERE username = '$name'";
$response = $conexion->query($query);                   //Preguntar usuario
if($response->num_rows>0 || $conexion->error) error();

$query = "INSERT INTO usuarios VALUES(null,'$name','$password','$edad','$email','$sexo','$nacimiento')";
$response = $conexion->query($query);                   //Insertar
if($conexion->error) error();

$conexion->close();

echo 'Usuario registrado! ';
}
else error();


//test2

//test3

//test4

?>


//!test5

//?test6