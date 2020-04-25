<?php

//Preguntar todos usuarios online de la db
function error(){
    echo 'Error...';
    die();
}


include("../php_server/db_connect.php");

$query = "SELECT * FROM usuarios_online";
$response = $conexion->query($query);
if($conexion->error) error();

$datos = array();
$time =  time() ;

if($response->num_rows >0){
    while( $row = $response->fetch_assoc()){
        $id =  $row['id'];
        $username = $row['username'];
        if( $row['time']+14  < $time ){
            $query = "DELETE FROM usuarios_online WHERE id = '$id'";
            $responses = $conexion->query($query);
        }   
        else{
            $datos[] = ["id"=>$id,"username"=>$username];
        }
    }
}
echo json_encode($datos,JSON_FORCE_OBJECT);
$conexion->close();
?>