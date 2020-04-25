<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width = device-width">
	<title>Proyecto Web</title>
	
	<link rel="stylesheet" href="../additionals/fonts/style.css">		
	<link rel="stylesheet" href="../css/styles.css"> 			
	<link rel="stylesheet" href="../css/barrier.css"> 			

	<script src="../additionals/jquery/jquery.js"></script>			
	
	<script src="../js/main.js"></script>						
	<script src="../js/barrier.js"></script>

</head>
<body>
	<!-- ==0 -->

<?php  include_once("./header.php") ?>

	<section id="cuerpo">
		
			<div class="informacion" onclick="acordeon('#texto1');">
				<h2>Lorem ipsum.</h2>
				<div id="texto1" style="display: none;" >
				<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae nobis fugit consequatur, hic, inventore quaerat!</span>
			</div>
			 </div>
			

			<div class="informacion" onclick="acordeon('#texto2');">
			 <h2>Lorem ipsum dolor.</h2>
			 <div id="texto2" style="display: none;" >
				<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem minus laborum itaque aspernatur porro odio ut corporis, pariatur reprehenderit at, deleniti fugiat fuga atque, ducimus explicabo. Culpa officiis quisquam, obcaecati!</span>
			</div>
			 </div>
			

			<div class="informacion" onclick="acordeon('#texto3');">
				<h2>Lorem ipsum...</h2>	
				<div id="texto3" style="display: none;" >
				<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui distinctio asperiores, minus rerum possimus cupiditate ducimus atque at excepturi nihil.</span>
			</div>		
			 </div>
			

	</section>

	<?php  include_once("./footer.php") ?>


	
</body>
</html>