<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width = device-width">
	<title>Proyecto Web</title>
	
	<link rel="stylesheet" href="../additionals/fonts/style.css">		
	<link rel="stylesheet" href="../css/styles.css"> 			
	<link rel="stylesheet" href="../css/register.css">

	<script src="../additionals/jquery/jquery.js"></script>			
	
	<script src="../js/main.js"></script>
	<script src="../js/register.js"></script>						
	
</head>
<body>

	<!-- ==0 -->

<?php  include("./header.php") ?>
	
	<section id="cuerpo">

		<div id="error" ></div>		<!-- Validacion -->

				<form action="">
						<label for="name" >Username</label>
						<input type="text" id="nombre" name="name">	<br>

						<label for="password" >Contraseña</label>
						<input type="password" id="password" name="password"> <br>

						<label for="email" >Email</label>
						<input type="text" id="email" name="email"> <br>

						<label for="edad" >Edad</label>
						<input type="text" id="edad" name="edad"> <br>

						
						
						<label for="sexo">Sexo</label>
						<select name="sexo">
							<option value="Hombre">Hombre</option>
							<option value="Mujer">Mujer</option>
						</select>				<br>
 
						<label for="nacimiento">Nacimiento (yy/mm/dd)</label>
						<input type="text" name="nacimiento" id="nacimiento"> <br>	

						<input type="submit" id="submit" value="Enviar datos">

				</form>
	</section>

	<?php  include_once("./footer.php") ?>


	
</body>
</html>