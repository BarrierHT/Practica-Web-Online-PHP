<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width = device-width">
	<title>Proyecto Web</title>
	
	<link rel="stylesheet" href="../additionals/fonts/style.css">		
	<link rel="stylesheet" href="../css/styles.css"> 			
	<link rel="stylesheet" href="../css/posts.css">			<!--//todo Habilitar  estilos  de posts-->
	
	<script src="../additionals/jquery/jquery.js"></script>		

	<script src="../js/main.js"></script>						
	<script src="../js/web.js"></script>
</head>

<body>
	<!-- ==0 -->

	<?php  include("./header.php") ?>
		<div id="slider">
			<img src="../additionals/images_web/aurora.jpg" alt="No se encontro la imagen" id="imagen_slider">
			<div id="left"></div>
			<div id="right"></div>
			<div class="selector" id="0" title="Aurora" onclick="selector(this.id);"></div>
			<div class="selector" id="1" title="Atardecer" onclick="selector(this.id);"></div>
			<div class="selector" id="2" title="Bosque" onclick="selector(this.id);"></div>
			<div class="selector" id="3" title="Lava" onclick="selector(this.id);"></div>
			<div class="selector" id="4" title="Tornado" onclick="selector(this.id);"></div>
		</div>

	<section id="cuerpo">
			
			<section id="post">
					
				<!-- //!Usar sistema api  web.js de 'pedir_posts.php' ; -->

					 <article class="articulo" id="art_example">

						<span> Contenido interesante </span>
						
						<time datetime="04/01/2020">Publicado el 04/01/2020</time>
						<div class="caja_comentarios">
							<a href="#comentarios">73 comentarios</a>
						</div>

						<div>
						<p>
							Puedes tener publicaciones así, solo registrate y disfruta :)
						</p>
						</div>
								<a href="#" class="leer">Leer Más</a>
					</article>
				<!--	
					<article class="articulo">

						<span> Lorem ipsum </span>
						
						<time datetime="05/01/2020">Publicado el 05/01/2020</time>
						<div class="caja_comentarios">
							<a href="#comentarios">37 comentarios</a>
						</div>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, numquam. Provident repellendus repudiandae neque quia incidunt. Libero unde quas facere culpa modi impedit adipisci molestias odio et rerum blanditiis ex atque officiis, enim, at commodi, nobis, labore. Accusantium, vero, molestias.
						</p>
								<a href="#" class="leer">Leer Más</a>
					</article>
				
				<article class="articulo">

						<span> Lorem ipsum </span>
						
						<time datetime="05/01/2020">Publicado el 05/01/2020</time>
						<div class="caja_comentarios">
							<a href="#comentarios">21 comentarios</a>
						</div>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, possimus reiciendis consequatur voluptas deserunt dolores id. Tenetur porro rerum voluptate delectus sed explicabo labore ducimus aut excepturi, maxime inventore non, ad, minima harum corrupti officiis exercitationem possimus provident fuga. Sunt perferendis repellendus, saepe atque praesentium deserunt, earum ut dolor, quisquam assumenda aut voluptas fuga enim accusantium debitis ipsa tempora dicta vitae eum architecto inventore natus facere sint obcaecati nihil. Saepe sed fugiat soluta dolor ratione aliquid corporis, reiciendis iste impedit quam quisquam, tempora, culpa, magni vitae reprehenderit cumque eveniet. Illum id molestias optio odit vitae hic error quas porro possimus quos deserunt, placeat sequi illo facere consequatur, aspernatur repudiandae fugiat impedit, vel voluptates iure necessitatibus explicabo. Eaque iste adipisci, ratione. Nisi, voluptatibus, error?
						</p>
								<a href="#" class="leer">Leer Más</a>
					</article> -->
	
			</section>

			<aside id="sidebar">
				<span>¿Qué es esto?</span>
				<img src="../additionals/images_web/remolino.jpg" alt="No se encontro la imagen">
				<blockquote>
					Un remolino es un gran volumen de agua giratorio producido por mareas oceánicas. En la imaginación popular, y tan sólo rara vez en la realidad, pueden tener el peligroso efecto de destruir embarcaciones. Los remolinos marinos son cuerpos de agua que giran rápidamente sobre sí mismos.
				</blockquote>


			
			</aside>
		
		</section>

		<?php  include_once("./footer.php") ?>

	

	
</body>
</html>