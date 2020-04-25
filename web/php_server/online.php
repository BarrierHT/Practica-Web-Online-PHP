<?php
//Pedir todos los usuarios online de la db
function error(){
    echo 'Error...';
    die();
}


if(isset($_POST['name']) && isset($_POST['decision'])){
    $name = $_POST['name'];
    $decision = $_POST['decision'];

    include("../php_server/db_connect.php");


if($decision == 'create' ){                         //log in
        $query =   "SELECT username,id FROM usuarios WHERE username = '$name'";
        $response = $conexion->query($query);
        $row = $response->fetch_assoc(); 
        $id = $row['id'];
        $time = time();
        $query =   "SELECT id FROM usuarios_online WHERE id = '$id'";
        $response = $conexion->query($query);
        if($response->num_rows==0){                  //Ya esta online
            $query = "INSERT INTO usuarios_online VALUES('$id','$name','$time')";
            $response = $conexion->query($query);
        }
  
}
else if($decision=='update'){                       //Update online
        $time = time();
        $query =   "UPDATE usuarios_online SET time='$time' WHERE username = '$name'";
        $response = $conexion->query($query);
}
else{                                               //Log out
    $query = "DELETE FROM usuarios_online WHERE username = '$name'";
    $response = $conexion->query($query);
    if($conexion->error) die();
}
$conexion->close();


}





?>