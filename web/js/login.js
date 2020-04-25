$(document).ready(()=>{

     //Inicio de Sesion
$('#sesion').submit((e) => {
	e.preventDefault();
	let name = $('input[name="name"]').val(),
	password = $('input[name="pass"]').val();
    console.log(name,password);
    if( name.length === 0 || password.length === 0 ) {
        $('#message').html('Llene todos los campos por favor');
        $('#message').removeClass('success');
        $('#message').addClass('error');
    }          
    else{
		$.ajax({
			url:'../php_server/control_usuarios.php',
			type:'POST',
			data:{name:name,password:password},
			timeout:3000
		})
		.done(response=>{
			 if(response == 'no_user'){
                $('#message').html('No concuerdan los datos en nuestro registro');
                $('#message').removeClass('success');
                $('#message').addClass('error');
             }     
			 else{
                response = JSON.parse(response);
                let val = $('#usuario').html().trim();
                if(val !='Log in'){
                    alert('Tú Ya estas logueado!');
                    throw 'Error log';
                }
                $('#usuario').html(response.name);	
                localStorage.setItem('user',response.name);
                localStorage.setItem('password',response.password);
                $('#message').removeClass('error');
                $('#message').html('Usuario logueado!');
              
					$.ajax({
						url:'../php_server/online.php',
						type:'POST',
						data:{name:name,decision:'create'},
						timeout:3000
                    })
                    .done(()=>{
                        window.location.href = 'http://localhost/project/web/php/web.php';
                    });
				
			 }
		});
    }
    
    
});


});