<?php

function error(){
    echo json_encode(['error']);
    die();
}
if( isset($_POST['type']) and isset($_POST['value']) ){
    $type = $_POST['type'];
    // if($type == 'users'){
    
    $value = trim($_POST['value']);
    include("../php_server/db_connect.php");

    $query = "SELECT username FROM usuarios WHERE username LIKE '%$value%'";
    $response = $conexion->query($query);
    if($conexion->error) error();
    
    $datos = array();

    if( $response->num_rows > 0){
            while($row = $response->fetch_assoc()){
                $datos[] = $row['username'];
            }
        }   
         echo json_encode($datos,JSON_FORCE_OBJECT);
    
    // }     
    // else error(); 
}   
else error();

?>