$(document).ready(()=>{
    setInterval(()=>{
        $.ajax({
            type:'POST',
            url:'./controlador.php',
            timeout:1500
        })
        .done(response=>{
            
            // if(response == '{}')   $('body').html('No hay usuarios online');
                response = JSON.parse(response);
                console.log(response);
                let lista = $('#lista');
                lista.html('');
                let band = false; 
                for (const prop in response) {
                    band = true;
                }
                if(band){
                    for (const prop in response) {
                    let elemento = '<li>  id: '+response[prop]['id'] + ' username: ' +response[prop]['username']+ '   ' + '</li>';
                    lista.append(elemento);
                    }
                }
                else{
                    lista.html('No hay usuarios');
                }

        });

    },5000);






});