
let ruta = "../additionals/images_web";

$('document').ready(() => {
        'use strict';

        // <!-- ==0 -->

        $('#left').click(() => {		//Boton izquierdo
                if ((i - 1) >= 0) i--;
                else i = arr.length - 1;
                actualizar();
        });
        $('#right').click(() => {		//Boton derecho
                if ((i + 1) < arr.length) i++;
                else i = 0;
                actualizar();
        });

        setTimeout(()=>{                                                
                let val = $('#usuario').html().trim();
                if (val != 'Log in') {
                                //Insertar post
                        $('#art_example').toggle('slow');               //Ocultar ejemplo
                        $('#post').prepend(' <i> <h2>Realice un post</h2> </i> <div> <input type="text" id="title_post" placeholder="Digite su titulo"> </div> <div><textarea placeholder="Escriba una publicación" style="width:100%;height:100px;" id="text_post"></textarea> </div><form action="" id="upload_post"><button type="submit" id="public">Publicar</button></form> ');                        
                        let up_post = $('#upload_post');   
                        let name = localStorage.getItem('user');
                                up_post.click((e) => {
                                let txt = $('#text_post').val();
                                let title_post = $('#title_post').val();
                                e.preventDefault();
                                console.log(txt,title_post);
                                if (txt.length > 0 && title_post.length > 0) {
                                        $.ajax({
                                                url: '../php_server/posts.php',
                                                type: 'POST',
                                                data: { decision:'insert',text: txt, title: title_post,user: name }
                                        })
                                                .done((response) => {
                                                        window.location.href = 'http://localhost/project/web/php/web.php';
                                                         console.log(response);
                                        });
                                 } else alert('Elija campos con mas longitud por favor');
                                
                                 });

                        //Mostrar posts de amigos;
                        $.ajax({
                                url: '../php_server/posts.php',
                                type: 'POST',
                                data: { decision:'select',user: name,to:'all' }         //De quienes quieres pedir posts
                        })
                        .done((response) => {
                                response = JSON.parse(response);
                                //?console.log(response);
                                let post = $('#post');
                                let band = false; 
                                for (const prop in response)    band = true;
                                if(band){
                                    for (const prop in response) {
                                        post.append(response[prop]);
                                    }
                                }            
                        });   

                }
        }, 500);
        

});


/*SLIDER*/
const arr = [ruta + "/aurora.jpg", ruta + "/atardecer.jpg", ruta + "/bosque.jpg", ruta + "/lava.jpg", ruta + "/tornado.jpg"];		//Imagenes
let i = 0;

const actualizar = () => $('#imagen_slider').attr("src", arr[i]);	//Actualizar con los botones (left,right)
const selector = index => {											//Selector, evento Onload
        $('#imagen_slider').attr("src", arr[index]);
        i = index;
}