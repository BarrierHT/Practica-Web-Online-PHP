<?php


function error(){
    echo 'no_user';
    die();
}

if( isset($_POST['name']) && isset($_POST['password']) ){
    $name = $_POST['name'];
    $password = $_POST['password'];

    include("../php_server/db_connect.php");
    
    $query = "SELECT * FROM usuarios WHERE username = '$name' AND password = '$password'";
    $response = $conexion->query($query);
    if($conexion->error) error();

    if($response->num_rows === 0)    error();
    else{
        $datos = array(
            "name" => $name,
            "password" => $password
        );
        echo json_encode($datos,JSON_FORCE_OBJECT);
    }
    
}
else{
    error();
}





?>