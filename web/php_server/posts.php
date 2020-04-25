<?php
//Pedir todos los posts de la db
if(isset($_POST['decision'])){
    
   $decision = $_POST['decision'];
 
  include("../php_server/db_connect.php");
   
   if($decision == 'insert'){                       //insertar post
    if(isset($_POST['text']) && isset($_POST['user']) && isset($_POST['title']) ){
        $text = $_POST['text'];
        $user = $_POST['user'];
        $title = $_POST['title'];
        $time = time();        
        if(strlen($text) > 0 && strlen($title) > 0){
           
            $query = "SELECT id FROM usuarios WHERE username = '$user'";
            $response = $conexion->query($query);
            if($response->num_rows >0 ){
                $row = $response->fetch_assoc();    
                $id = $row['id'];
                $query = "INSERT INTO posts(id_usuario,fecha,titulo,text,time) VALUES('$id',CURDATE(),'$title','$text','$time')";
                $response =  $conexion->query($query);
                if($conexion->error) echo $conexion->error;
                $conexion->close();
                }
            }
        }
    }
    else if($decision == 'select' ){            //seleccionar posts de amigos o unico
        if(isset($_POST['user']) && isset($_POST['to']) ){
            $user = $_POST['user'];
            $to = $_POST['to'];
            $query = "SELECT * FROM usuarios WHERE username = '$user' ";
            $response = $conexion->query($query);
            if($response->num_rows >0 ) $row = $response->fetch_assoc();
            $id = $row['id'];
            
            if($to == 'user')     $query = "SELECT   * FROM posts WHERE id_usuario = '$id' ORDER BY time DESC";       //Seleccionar posts de un usuario
            else if($to == 'all') $query = "SELECT * FROM posts  ORDER BY time DESC";                       //Posts de todos los usuarios
            //'friends' pendiente
                $response = $conexion->query($query);
                $datos = [];
                
                if($response->num_rows >0 ){
                    while($row = $response->fetch_assoc()){
                    $id = $row['id_usuario'];
                    $user_receptor = $conexion->query("SELECT username FROM usuarios WHERE id = '$id' ");   //Nombre del autor
                    $user_receptor = $user_receptor->fetch_assoc();
                    $user_receptor = $user_receptor['username'];  
                    $fecha = $row['fecha'];
                    $id = $row['id'];
                    $titulo = $row['titulo'];
                    $text = $row['text'];
                    $time = $row['time'];
                        $str=  "
                             <article class='articulo' id='post_$id'>
            
                                <span> $titulo </span>
                                
                                <time datetime=$fecha>Publicado el $fecha por <i style= 'color:black';>$user_receptor</i> </time>
                                <div class='caja_comentarios'>
                                    <a href='#comentarios'>73 comentarios</a>
                                </div>
            
                                <div class='text_parent'>
                                <p class='text'>$text</p>
                                </div>
                                        

                            </article>
                            ";
                            $datos[] = trim($str);
                    }
            }
            echo json_encode($datos,JSON_FORCE_OBJECT); 
        }
    }
    else if($decision == 'delete' ){
            if(isset($_POST['id_post'])){
                $pos = strpos($_POST['id_post'], '_');
                $pos++;
                $id_post = substr($_POST['id_post'],$pos);
                echo $id_post;
                $query = "DELETE FROM posts WHERE id = '$id_post'";
                $response = $conexion->query($query);
            }
    }
    else if($decision == 'edit'){
            if(isset($_POST['id_post']) and isset($_POST['text']) ){
                $pos = strpos($_POST['id_post'], '_');
                $pos++;
                $id_post = substr($_POST['id_post'],$pos);
                $text = $_POST['text'];
                echo $id_post.' '.$text;
                $query = "UPDATE posts SET text = '$text' WHERE id='$id_post'";
                $response = $conexion->query($query);
            }
    }
}



?>