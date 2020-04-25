<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="../additionals/fonts/style.css">		
	<link rel="stylesheet" href="../css/styles.css"> 			
    <link rel="stylesheet" href="../css/login.css">
	
	<script src="../additionals/jquery/jquery.js"></script>		

	<script src="../js/main.js"></script>	
    <script src="../js/login.js"></script>				

    
</head>
<body>
    <?php include('./header.php')  ?>

    <form action="" id="sesion">
					<h2>Identificate</h2>
					<p id="message"></p>
                    <label for="name">Nombre de usuario</label> 
					<input type="text" name="name" placeholder="Nombre" >  
					<label for="pass">Contraseña</label> 
					<input type="password" name="pass" placeholder="Contraseña" > <br> <br>
                    <button type="submit">Enviar</button>
    </form>
    <a href="./register.php" id="register"> No tienes una cuenta? Pulsa aqui </a>
                
    <?php include('./footer.php')  ?>
</body>
</html>