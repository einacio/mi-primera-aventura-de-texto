<?php
include_once 'core.php';

if(isset($_POST['js'])){
	exit($respuesta);
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Mi primera aventura de texto</title>
	<style type="text/css">
		section{width:600px;margin:4px auto 0}
		#salida{width:100%;max-width:100%;min-width:100%;display:block;font-family:sans-serif}
		#entrada{width:200px}
		dl{margin:0;font-size:small}
		dt{font-weight:bold}
		dt em{font-weight:normal;font-style:italic}
		dd{margin-left:40px}
	</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var $entrada=$('#entrada'),$salida=$('#salida'),$accion=$('#accion');

			$accion.click(function(e){
				e.preventDefault();

				var entrada=$.trim($entrada.val());
				$entrada.val('');
				if (entrada){
					$.post('.',
							{js:1,entrada:entrada},
							function(r){$salida.text($salida.text()+"\n\n"+r);$salida.scrollTop($salida[0].scrollHeight);},
							'text'
					);
				}

			});
			$entrada.keypress(function(e){
				if (e.which===13){
					e.preventDefault();
					$accion.click();
				}
			});
		});
	</script>
</head>
<body>
	<section id="juego">
		<form action="." method="post">
			<div>
				<textarea readonly="readonly" id="salida" name="salida" cols="40" rows="10"><?php echo $respuesta;?></textarea>
				<input type="text" id="entrada" name="entrada" autofocus="autofocus" autocomplete="off" />
				<button type="submit" id="accion">Ingresar</button>
			</div>
		</form>
	</section>
	<section id="ayuda">
		<p>
			El objetivo del juego es encontrar la forma de salir por la puerta. Para esto pueden utilizarse las siguientes acciones:
		</p>
		<dl>
			<dt>ESTE</dt>
			<dd>mueve al personaje una habitación a la derecha en el mapa, si hay camino disponible.</dd>
			<dt>OESTE</dt>
			<dd>mueve al personaje una habitación a la izquierda en el mapa, si hay camino disponible.</dd>
			<dt>MIRAR</dt>
			<dd>da la descripción actual de la habitación donde está el jugador.</dd>
			<dt>AGARRAR <em>objeto</em></dt>
			<dd>guarda en el inventario un objeto de la habitación.</dd>
			<dt>INVENTARIO</dt>
			<dd>da una lista de los objetos que el personaje lleva consigo.</dd>
			<dt>EXAMINAR <em>objeto</em></dt>
			<dd>da la descripción de un objeto en la habitación actual o en el inventario del personaje.</dd>
			<dt>USAR <em>objeto</em></dt>
			<dd>realiza una acción disponible en la habitación actual usando un objeto del inventario.</dd>
			<dt>SALIR</dt>
			<dd>cierra el programa.</dd>
			<dt>INFO</dt>
			<dd>muestra datos de versión y del desarrollador.</dd>
		</dl>
	</section>
</body>
</html>
