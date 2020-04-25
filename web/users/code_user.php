<?php



$path = pathinfo($_SERVER['REQUEST_URI']);
$username =  $path['filename'];
// echo $username;
//Escribir codigo de cada user 


    include('./head_users.php');
    include('../php/header.php');
    //incluir posts y opciones
    $dir = $_SERVER['REQUEST_URI'] ;
    //$dir = substr($dir,strlen($dir)-10);
    $dir = pathinfo($dir);
    $add_friend = '<button id="add_friend"> Agregar a amigos </button>';
    $delete_post = '<button class= "delete_post"> Borrar post </button>';
    $edit_post = '<button class= "edit_post"> Editar post </button>';
    $text_edit = '<textarea placeholder="Escriba una publicación" style="width:100%;height:100px;" id="text_post"></textarea>';

    echo "
        <section id='cuerpo'>       
        <section id='post'>
        <h2> <i style='color:orange'> Publicaciones </i> </h2>
        ";

    echo "  <script>
    setTimeout(()=>{
        let usuario = $('#usuario');
        if( usuario.html().trim() == 'Log in')    usuario.attr('href','../php/login.php'); //?No logged
        else{
        
        //?    console.log('$dir[filename]');
           if('$dir[filename]' != $('#usuario').html()){            //?Perfil desde extranjero
                 
            //console.log('Agregar a amigos');
               
           let friend_or_no = false;
            
           $.ajax({
                url:'../php_server/friends.php',                                //?Consultar si ya es amigo 
                type:'POST',
                data:{user: $('#usuario').html(), decision:'select' }           //?Lista de amigos
            })
            .done(response=>{
                response = JSON.parse(response);
                console.log(response);
                let bandx = false;
				for (const prop in response) bandx = true;

				    	if (bandx) {
							for (const prop in response) {
								if(response[prop]['friend'] == '$dir[filename]')  friend_or_no = true;  //?Comparar su name en la lista
					    	}			
                        }

                                   
        if(!friend_or_no){                  //?No es amigo
            
            $('#post').prepend('$add_friend');                             
                    $('#add_friend').click(()=>{
                        $.ajax({
                            url:'../php_server/notifications.php',
                            method:'POST',
                            data:{decision:'insert',user2:'$dir[filename]',user:$('#usuario').html()}       //?Boton de agregar a amigo
                        })
                        .done(response=>{
                            //  console.log(response);
                        });
                    });
                }
                else    $('#post').prepend('<span id=user_already_friend style=color:rgba(50,205,50,.6);>Amigo agregado</span>');
                //?Texto de amigo agregado
            });

                

            }
            else{                                                       //?perfil actual

                console.log('Perfil actual');
               //? console.log($('.articulo'));
                let articulos = $('.articulo');
                for(let i =0; i<articulos.length; ++i){
                     let article = $('.articulo').eq(i);
                     article.append('$delete_post');                    //?borrar post propio
                     article.append('$edit_post');                      //?editar post propio

                }
            }

            $('.delete_post').click((e)=>{                          //?delete post

                let article = e.target.parentElement;
                let id_post = article.id;
                $.ajax({
                    url:'../php_server/posts',                      
                    method:'POST',
                    data:{decision:'delete',id_post: id_post}           //?Borrar posts
                })  
                .done((response)=>{
                    window.location.href = 'http://localhost/project/web/php/web.php';
                });
            });

            $('.edit_post').click((e)=>{                    //?edit post
                 let button = $(e.target);
                 let article = e.target.parentElement;
                 let id_post = article.id;
                if(button.css('background') == 'rgb(255, 165, 0) none repeat scroll 0% 0% / auto padding-box border-box'){  //Color naranja
                
                $(e.target).css('background','green');                             //?Guardar cambios(boton)
                $(e.target).html('Guardar cambios');              
                let search_p =  article.childNodes;
                
                for(let i =0; i<search_p.length; ++i){
                    if(search_p[i].className == 'text_parent'){                   //?Textarea (no optimizado)
                        let p = search_p[i].childNodes[1];
                        let text = p.innerHTML;
                        p.remove();
                        let textarea = document.createElement('textarea');              
                        textarea.append(text); 
                        search_p[i].append(textarea);
                    } 
                }
            }

              else{                                                             //?Guardar cambios
                let div = $(article).children().eq(3).children().eq(0);         //?Textarea (optimizado a comparacion de arriba xd)
                    //?console.log(div.val());
                    $.ajax({
                        url:'../php_server/posts',
                        method:'POST',
                        data:{decision:'edit',id_post: id_post,text:div.val()}
                    })
                    .done((response)=>{
                        window.location.href = 'http://localhost/project/web/php/web.php';
                       //?console.log(response);
                    }); 
                  }
            });  

        }    

    },400);




    
    $.ajax({
        url:'../php_server/posts.php',
        type:'POST',
        data: {decision:'select',user:'$username',to:'user'}                            //?mostrar posts del usuario
    })  
    .done(response=>{
        setTimeout(()=>{
            response = JSON.parse(response);
            //console.log(response);
           
            let post = $('#post');
            let band = false; 
            for (const prop in response)    band = true;
            if(band){
                for (const prop in response) {
                    //?console.log(response[prop]);
                    
                    post.append(response[prop]);

                }
            }
        },250);
    });





    </script> ";

    echo '</section> </section>';
    include('./footer_users.php');

?>