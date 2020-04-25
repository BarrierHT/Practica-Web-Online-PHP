<?php

    if( isset($_POST['user']) and isset($_POST['decision'])){                       //Pedir usuarios y peticiones
        include('../php_server/db_connect.php');
        $user  = $_POST['user'];
        $decision = $_POST['decision'];



     if($decision == 'insert'){                                                             //agregar notificacion

        if(isset($_POST['user2'])){
            $user2 = $_POST['user2'];
            $query = "SELECT id FROM usuarios WHERE username = '$user'";                //id del primero
            $response = $conexion->query($query);
            $row = $response->fetch_assoc();
            $id = $row['id'];
            //echo json_encode($row,JSON_FORCE_OBJECT);
            $query = "SELECT id FROM usuarios WHERE username = '$user2'";               //id del segundo
            $response = $conexion->query($query);
            $row = $response->fetch_assoc();
            $id2 = $row['id'];

            $query = "SELECT * FROM notifications WHERE (id_user1 = '$id')          
            AND ( id_user2 = '$id2')";
            //Existe relacion alguna
            
            $response = $conexion->query($query);
            if($conexion->error) echo $conexion->error;   
           
          
             if( $response->num_rows == 0 ){
                $query = "INSERT INTO notifications VALUES('$id','$id2','friends')";
                $response = $conexion->query($query);
            }
        }

    }

    else if($decision == 'select'){                         //Mostrar todas las notificaciones de un user
       
        $query = "SELECT id FROM usuarios WHERE username = '$user'";               //id del usuario receptor
        $response = $conexion->query($query);
        $row = $response->fetch_assoc();    
        $id = $row['id'];                                                          //receptor                                        

        $query = "SELECT * FROM notifications WHERE id_user2 = '$id' ";            //Todas las notificaciones 
        $response = $conexion->query($query);
        //$row = $response->fetch_assoc();
        
        $datos = [];
        while($row = $response->fetch_assoc()){
            
            $emisor = $row['id_user1'];                                             //emisor
            
            $query = "SELECT username FROM usuarios WHERE id = '$emisor'";
            $response2 = $conexion->query($query);
            $row2 = $response2->fetch_assoc();
            
            $emisor = $row2['username'];
            $msj = "$emisor Quiere agregarte a sus amigos";   
            
            $str = "$msj  <button class='button_notification confirm_friend' value=$emisor> Confirmar solicitud de $emisor</button> 
            <button class='button_notification deny_friend' value=$emisor> Negar solicitud de $emisor </button> "; 
                                                                                           //Mensaje
            $datos[] = ['emisor'=>$emisor,'msj'=>$str]; 
        }
        echo json_encode($datos,JSON_FORCE_OBJECT);
    }
    
    else if($decision == 'delete'){                                                        //borrar una notificacion
       
        if(isset($_POST['user2'])){
        $user2 = $_POST['user2'];
        
        $query = "SELECT id FROM usuarios WHERE username = '$user2'";                       //id del usuario receptor
        $response = $conexion->query($query);
        $row = $response->fetch_assoc();    
        $id2 = $row['id']; 

        $query = "SELECT id FROM usuarios WHERE username = '$user'";                       //id del usuario emisor
        $response = $conexion->query($query);
        $row = $response->fetch_assoc();    
        $id = $row['id']; 


        $query = "DELETE FROM notifications WHERE id_user1 = '$id' AND id_user2 = '$id2'";
        $response = $conexion->query($query);
        }
    }

}

//todo   --- id_user1 = Manda notificacion, id_user2 = recibe  ---



?>