<?php
//Insertar amigos o preguntar de la DB

    if(isset($_POST['decision']) and isset($_POST['user'])){
        $decision = $_POST['decision'];
        $user = $_POST['user'];
        include("../php_server/db_connect.php");

    
    if($decision == 'select'){                                                                  //Pedir todos los amigos
      
        $query = "SELECT * FROM friends WHERE id_user1 in(SELECT id FROM usuarios WHERE username = '$user') 
        OR id_user2 in(SELECT id FROM usuarios WHERE username = '$user') ";
        $response = $conexion->query($query);
        $datos = [];
        if($response->num_rows>0){
            while($row = $response->fetch_assoc()){
                $id = $row['id_user1'];                                                     //id1 de la relación
                $id2 = $row['id_user2'];                                                    //id2 de la relación   

                $query = "SELECT username FROM usuarios WHERE id = '$id'";                  //primer user
                $response2 = $conexion->query($query);
                $row2 = $response2->fetch_assoc();
                $userx = $row2['username'];
                
                $query = "SELECT username FROM usuarios WHERE id = '$id2'";                 //segundo user
                $response2 = $conexion->query($query);
                $row2 = $response2->fetch_assoc();
                $usery= $row2['username'];

                if($userx == $user)  $datos[] = ['id'=>$id2,'friend'=>$usery];              //devolver id y name
                else $datos[] = ['id'=>$id,'friend'=>$userx]; 
               
            }
        }
        echo json_encode($datos,JSON_FORCE_OBJECT);
    }
    
    else if($decision == 'insert'){                         //agregar a amigo luego de confirmar la notificacion
            
        if(isset($_POST['user2'])){
            $user2 = $_POST['user2'];
            $query = "SELECT id FROM usuarios WHERE username = '$user'";                //id del primero
            $response = $conexion->query($query);
            $row = $response->fetch_assoc();
            $id = $row['id'];
        

            $query = "SELECT id FROM usuarios WHERE username = '$user2'";               //id del segundo
            $response = $conexion->query($query);
            $row = $response->fetch_assoc();
            $id2 = $row['id'];

            $query = "SELECT * FROM friends WHERE (id_user1 = '$id' OR id_user2 = '$id')            
            AND ( id_user1 = '$id2' OR id_user2 = '$id2')";                         //Comprobar si existe relación de amistad
            //Existe relacion alguna
            
            $response = $conexion->query($query);
            if($conexion->error) echo $conexion->error;   
           
          
             if( $response->num_rows == 0 ){
                $query = "INSERT INTO friends VALUES('$id','$id2')";                            //Agregar a amigos
                $response = $conexion->query($query);
            }
        }

    }
    
    else if($decision == 'delete'){                         //borrar a amigo luego de negar la notificacion
    
        if(isset($_POST['user2'])){
       
        $user2 = $_POST['user2'];    
        $query = "SELECT id FROM usuarios WHERE username = '$user2'";               //id del usuario2 
        $response = $conexion->query($query);
        $row = $response->fetch_assoc();
        $id2 = $row['id'];
       
        $query = "SELECT id FROM usuarios WHERE username = '$user'";               //id del usuario 1
        $response = $conexion->query($query);
        $row = $response->fetch_assoc();    
        $id = $row['id']; 

        $query = "DELETE FROM friends WHERE (id_user1 = '$id' AND id_user2= '$id2') OR              
         (id_user1 = '$id2' AND id_user2= '$id') ";                                         //borrar amigos
        $response = $conexion->query($query);

        }
    }

//!user = emisor, user2 = receptor

}







?>