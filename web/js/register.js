$('document').ready(()=>{
'use strict';

//CONTACTO Formulario con su validacion

$('#cuerpo form').submit((e)=>{
	e.preventDefault();

	let nombre = $('#nombre'), email = $('#email'), edad = $('#edad'), sexo = $('form select')
	,password = $('#password'),fecha = $('#nacimiento'); 
	var control = true;
	if(nombre.val().length < 3 || isNaN(nombre.val()) == false ){						//Nombre
		let parrafo = document.createElement('p');
		parrafo.innerHTML= "-Username no valido, minimo 3 caracteres";
		$('label[for="name"]').html("Username");
		$('label[for="name"]').append(parrafo);	
		$('label[for="name"]').addClass("error");
		control = false;
	}else{
	 $('label[for="name"]').html("Username");
	 $('label[for="name"]').removeClass("error");
	}
	if(password.val().length <5){
		let parrafo = document.createElement('p');
		parrafo.innerHTML= "-Contraseña no valida, minimo 5 caracteres";
		$('label[for="password"]').html("Contraseña");
		$('label[for="password"]').append(parrafo);	
		$('label[for="password"]').addClass("error");
		control = false;
	}
	else{
		$('label[for="password"]').html("Contraseña");
		$('label[for="password"]').removeClass("error");
	}

	if(edad.val() < 18 || isNaN(edad.val()) ){											//Edad
		let parrafo = document.createElement('p');
		parrafo.innerHTML= "-Edad no aceptada, mínimo  18 años";
		$('label[for="edad"]').html("Edad");
		$('label[for="edad"]').append(parrafo);
		$('label[for="edad"]').addClass("error");
		control = false;
	}else{
		$('label[for="edad"]').html("Edad");	
		$('label[for="edad"]').removeClass("error");
	} 
 	if(fecha.val().length!=10){															//Fecha de Nacimiento
 		let parrafo = document.createElement('p');
		parrafo.innerHTML= "-Fecha no aceptada, seleccione correctamente el campo";
		$('label[for="nacimiento"]').html("Nacimiento(yy/mm/dd)");
		$('label[for="nacimiento"]').append(parrafo);
		$('label[for="nacimiento"]').addClass("error");
		control = false;
 	}else{
 	 $('label[for="nacimiento"]').html("Nacimiento(yy/mm/dd)");
	 $('label[for="nacimiento"]').removeClass("error");
	}

 let sub = email.val().substr( (email.val().length-12) );								//ultimos 12 digitos

 	if( email.val().length<13 || (sub != "@outlook.com" && sub != "@hotmail.com") ||  email.val().match( /@/g ).length>1 ){ //Email
 		let parrafo = document.createElement('p');
		parrafo.innerHTML= "-Correo no aceptado, seleccione un correo valido ~ example@outlook.com ~ ";
		$('label[for="email"]').html("Email");
		$('label[for="email"]').append(parrafo);
		$('label[for="email"]').addClass("error");
		control = false;
	}else{
 		$('label[for="email"]').html("Email");
 		$('label[for="email"]').removeClass("error");
 	} 
	 if(control) crear_usuario({
		 name:nombre.val(),
		 password:password.val(),
		 email:email.val(),
		 edad:edad.val(),
		 sexo:sexo.val(),
		 nacimiento:fecha.val()
	 });

});



});

function crear_usuario(object) {
	$.ajax({
		url:'../php_server/registrar_usuarios.php',
		type:'POST',
		data: object,
		timeout:3000
	})
	.done(response=>{
		if(response == 'invalid_name'){
			let parrafo = document.createElement('p');
			parrafo.innerHTML= "Username ocupado, por favor elija otro";
			$('label[for="name"]').html("Username");
			$('label[for="name"]').append(parrafo);
			$('label[for="name"]').addClass("error");
		}
		else {
				$('label[for="name"]').html("Usuario registrado! Espere un momento");
				$('label[for="name"]').removeClass("error");
				localStorage.setItem('user',object.name);
				localStorage.setItem('password',object.password);
				
				$.ajax({
					url:'../users/create_user.php',
					type:'POST',
					data:{name:object.name}
				})
				.done(()=>{
					$.ajax({
						url:'../php_server/online.php',
						type:'POST',
						data:{name:object.name,decision:'create'},
						timeout:3000
                    })
                    .done(()=>{
		                      window.location.href = 'http://localhost/project/web/php/web.php';
                    });
				});

		}
	});	

}
