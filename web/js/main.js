$('document').ready(() => {
	'use strict';
	// alert('[Aviso] el cambiador de temas se encuentra en reparacion intensa...');

	//CAMBIAR Tema

	let aurora = $('#tema_aurora');
	let blanco = $('#tema_blanco');
	let azul = $('#tema_azul');

	aurora.click(() => {									//Tema AURORA
		if (aurora.hasClass('actual') == false) {			//No esta en modo Aurora
			if (blanco.hasClass('actual')) blanco.removeClass('actual');
			else azul.removeClass('actual');
			aurora.addClass('actual');
			cambiarColor();
		}
	});

	blanco.click(() => {									//Tema Blanco
		if (blanco.hasClass('actual') == false) {			//No esta en modo Blanco
			if (aurora.hasClass('actual')) aurora.removeClass('actual');
			else azul.removeClass('actual');
			blanco.addClass('actual');
			cambiarColor();
		}
	});

	azul.click(() => {									//Tema AZUL
		if (azul.hasClass('actual') == false) {			//No esta en modo Azul
			if (blanco.hasClass('actual')) blanco.removeClass('actual');
			else aurora.removeClass('actual');
			azul.addClass('actual');
			cambiarColor();
		}
	});
	let ruta = "../additionals/images_web";

	function cambiarColor() {		//Color a cambiar
		if (blanco.hasClass('actual')) {							//TEMA BLANCO
			$('body').css("background", "url(" + ruta + "/nieve.jpg)").css("background-repeat", "no-repeat").css("background-size", "100% 100% ");
			$('section#main,.caja_comentarios').css("background", "#000");
			$('#cabecera h1,footer,article,footer h2,#sidebar form,#sidebar blockquote,nav,li#sublista ul').css("background", "#fff").css("color", "#000");
			$('#sidebar span').css("color", "lightgreen");
			$('nav ul li a,nav ul li span,li#sublista ul,li#sublista').css("color", "#000");
			$('.icon-search,.caja_comentarios a').css("color", "#fff");
			$('time').css("color", "orange");
			$('.leer').css("background", "orange");
		}
		else if (azul.hasClass('actual')) {							//TEMA AZUL
			$('body').css("background", "url(" + ruta + "/gotas.jpg)").css("background-repeat", "no-repeat").css("background-size", "100% 100% ");
			$('section#main').css("background", "lightgreen");
			$('.caja_comentarios').css("background", "#FEFE9B");
			$('#cabecera h1,footer,article,footer h2,#sidebar form,#sidebar blockquote,nav,li#sublista ul').css("background", "#10C7DD");
			$('#sidebar span,nav ul li a,nav ul li span,#cabecera h1,footer h2,li#sublista ul,li#sublista').css("color", "black");
			$('.icon-search,.caja_comentarios a,#sidebar form h2').css("color", "red");
			$('.leer').css("background", "pink");
			$('time').css("color", "#fff");
		}
		else {		//TEMA AURORA
			$('body').css("background", "url(" + ruta + "/rayos.jpg)").css("background-repeat", "no-repeat").css("background-size", "100% 100% ");
			$('section#main,article,#sidebar blockquote,#sidebar form').css("background", "#fff");
			$('footer, footer h2').css("background", "#000");
			$('#cabecera h1,nav,li#sublista ul').css("background-color", "rgba(0,0,0,.8)");
			$('.caja_comentarios').css("background", "lightgreen");
			$('#cabecera h1,nav ul li a,footer h2,nav ul li,li#sublista ul').css("color", "#fff");
			$('nav ul li span').css("color", "lightgreen");
			$('time').css("color", "#ccc");
			$('.icon-search,.caja_comentarios a,#sidebar span,.leer').css("color", "#000");
			$('.leer').css("background", "orange"); $('#sidebar form h2').css("color", "orange");
		}
	}
	cambiarColor();

	//SCROLL AUTOMATIZADO

	$('#scroll').click(() => {
		$('html').animate({
			scrollTop: 0
		}, 850);
	});


	//RELOJ

	let pop_up = $('#pop_up');

	$('#reloj').click(() => {							//click al Boton "Reloj"
		pop_up.css("display", "block");
		$('#horario').css("display", "block");
		let reloj = $('#pop_up div h2');
		let dia = $('#pop_up div h3');

		$(reloj).css("font-family", "Verdana,Arial").css("font-weight", "bold").css("font-size", "30px");
		$(dia).css("font-family", "Verdana,Arial").css("font-weight", "bold").css("font-size", "30px");

		setInterval(() => {
			let fecha = new Date();
			let horas = fecha.getHours(), minutos = fecha.getMinutes(), segundos = fecha.getSeconds(), dias = fecha.getDate(),
				mes = fecha.getMonth() + 1, anio = fecha.getFullYear();
			reloj.html("Horario -> " + horas + " : " + minutos + " : " + segundos);
			dia.html("Fecha -> " + dias + " / " + mes + " / " + anio);
		}, 500);

	});
	$('#pop_up button').click(() => {					//Cerrar
		pop_up.css("display", "none");
	});

	$('#logout').click(() => {
		localStorage.removeItem('user');
		localStorage.removeItem('password');
		$.ajax({
			url: '../php_server/online.php',
			type: 'POST',
			data: { name: name, decision: 'delete' },
			timeout: 3000
		});

	});

	$('#search_global').blur(() => {
		setTimeout(() => {
			$('#lista').html('');
			$('#search_global').removeAttr('title');
		}, 150);
	});



	$('#search_global').keyup((e) => {
		if (e.keyCode == 13) {				//enter
			let val = $('#search_global').val().trim();
			if (val.length > 0) {
				$.ajax({
					url: '../php_server/search_users.php',
					type: 'POST',
					data: { type: 'user', value: val },			//usuario en concreto, ir a pag
					timeout: 1500
				}).done(response => {

					response = JSON.parse(response);
					for (const prop in response) {
						response[prop] = response[prop].trim();
						if (response[prop] == val) {
							window.location.href = 'http://localhost/project/web/users/' + val;
						}
					}
					setTimeout(() => {
						$('#search_global').attr('title', 'No se encontro el usuario');
					}, 75);

				});
			}
		}
		else {
			let text = $('#search_global').val().trim();
			$.ajax({
				url: '../php_server/search_users.php',							//barra de busquedas
				type: 'POST',
				data: { value: text.trim(), type: 'users' },
				timeout: 1500
			})
				.done(response => {
					response = JSON.parse(response);
					// console.log(response);
					let lista = $('#lista');
					lista.html('');
					for (const prop in response) {
						// console.log(response[prop]);
						let elemento = '<li class="user"> ' + response[prop] + ' ' + '</li>';
						lista.append(elemento);
					}

					$('li.user').click((e) => {
						$('#search_global').val(e.target.innerHTML);
					});
				});
		}
	});



	control_usuario();									//llamar a la función al mando del back

});

function control_usuario() {
	//Login de usuarios
	if (localStorage.getItem('user') === null || localStorage.getItem('password') === null) {
		$('#usuario').attr('href', './login.php');
		$('#usuario').html('Log in');
		$('#logout').parent().css('display', 'none');
	}
	else {
		var name = localStorage.getItem('user');
		var password = localStorage.getItem('password');
		$.ajax({
			url: '../php_server/control_usuarios.php',					//existe usuario
			type: 'POST',
			data: { name: name, password: password },
			timeout: 3000
		})
			.done(response => {
				response = JSON.parse(response);
				// console.log(response);
				if (response == 'no_user') {
					$('#usuario').attr('href', '../php/login.php');
					$('#usuario').html('Log in');
					$('#logout').parent().css('display', 'none');
				}
				else {
					$.ajax({
						type: 'POST',
						url: '../active/controlador.php',				//Usuario en la tabla online
						timeout: 1500
					})
						.done(response_online => {
							response_online = JSON.parse(response_online);
							// console.log(response_online);
							let band = false;
							for (const prop in response_online) {
								let elemento = response_online[prop]['username'];
								// console.log(elemento,name);
								if (elemento == name) {
									$('#usuario').html(response.name);

									$('#usuario').attr('href', '../users/' + response.name + '.php');				//?Modificar en users	
									$('#logout').parent().css('display', 'inline-block');

									let notificaciones = '<li id="notificaciones">  Notificaciones  </li>';		//Notificaciones
									$('nav #menu').append(notificaciones);										//Menú de navegación
									
									let friend = '<li id="friends">  Amigos  </li>';							//Lista de amigos
									$('nav #menu').append(friend);										//Menú de navegación


					$('#notificaciones').click(() => {													//Notificaciones
										$('#pop_up').css("display", "block");
										$('#horario').css("display", "none");

										$.ajax({
											type: 'POST',
											url: '../php_server/notifications.php',							//Mostrar notificaciones
											data: { user: name, decision: "select" }
										})
											.done(response => {
												// console.log(response);										
												response = JSON.parse(response);								//JSON de notis
												
												let band2 = false;
												for (const prop in response) band2 = true;

												if (band2) {
													for (const prop in response) {
														let elemento = '<div class="solicitud"> '+ response[prop]['msj'] + ' </div>';   //solicitudes	
														$('#menu_notificaciones').append(elemento);		
													}			
												}
												$('#pop_up>button').click(() => {					//Cerrar pop_up
													$('#pop_up').css("display", "none");
													$('#menu_notificaciones').html('');									//menu de notis	
												});
												
												$('.button_notification').click((e)=>{									//Boton de notificaciones
													
													let user = e.target.value.trim();
													e.target.parentNode.remove();										//Eliminar notificacion
													$.ajax({
														type: 'POST',
														url: '../php_server/notifications.php',							//borrar notificaciones
														data: { user:user ,user2: name, decision: "delete" }
													})
													.done(response =>{
																// console.log(response);
													});

												});
												
												$('.confirm_friend').click((e)=>{							//Agregar amigos por solicitud(notificación)
													$.ajax({
															url:'../php_server/friends.php',
															type:'POST',
															data: {user:name, user2 : e.target.value.trim(), decision: 'insert'}
													});
												});

											});
									});


									$('#friends').click(()=>{						//lista de amigos
										
										$('#pop_up').css("display", "block");
										$('#horario').css("display", "none");


										$('#pop_up>button').click(() => {					//Cerrar pop_up
											$('#pop_up').css("display", "none");
											$('#menu_notificaciones').html('');									//menu de notis	
										});
										
										$.ajax({
											type: 'POST',
											url: '../php_server/friends.php',							
											data: { user: name, decision: "select" }						//Mostrar Lista de amigos
										})
										.done(response=>{
												// console.log(response);
												response = JSON.parse(response);

												let band3 = false;
												for (const prop in response) band3 = true;

												if (band3) {
													for (const prop in response) {
														let elemento = '<div class="solicitud"> '+ response[prop]['friend'] + '    <button class="delete_friend" value=' +  response[prop]['friend'] + '> Borrar amigo </button> </div>';  
														//? solicitudes de amigos, nombre y botón de eliminar	
														
														 $('#menu_notificaciones').append(elemento);		
													}			
												}

												$('.delete_friend').click((e)=>{				//borrar amigo de la lista
													
													$.ajax({
														type: 'POST',
														url: '../php_server/friends.php',							
														data: { user: name,user2: e.target.value.trim(), decision: "delete" }	//user = emisor, user2 = receptor					
													})
													.done(response=>{
														e.target.parentNode.remove();			//eliminar articulo de amigo
													});

												});

										});


										


									});







									setInterval(() => {
										$.ajax({
											url: '../php_server/online.php',
											type: 'POST',
											data: { name: name, decision: 'update' },				//actualizar usuario online
											timeout: 3000
										});
									}, 1000);
									band = true;
								}
							}
							if (band == false) {
								localStorage.removeItem('user');
								localStorage.removeItem('password');
							}

						});

				}
			});
	}

}