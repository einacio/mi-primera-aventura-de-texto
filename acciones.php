<?php

if (strtolower($_SERVER["SCRIPT_NAME"])==='acciones.php'){
	header('Location: index.php');
	exit();
}

function este(){
	global $s;
	$m='';

	return $m;
}

function oeste(){
	global $s;
	$m='';

	return $m;
}

function mirar(){
	global $s;
	$m='';
	switch ($s['hab']){
		case 1:
			$m=<<<EOD
Parece ser el recibidor de una casa elegante. Esta agradablemente iluminada,
aunque no hay fuente de luz visible. En una de las paredes hay un tapiz{$s['estados']['tapiz_hab']} y en la otra
un escudo de armas. Hacia el oeste hay una pesada puerta metálica{$s['estados']['puerta_hab']} y hacia el este un
arco conecta con otra habitación. En el techo esta la trampilla por la que entró el
personaje, ahora cerrada.
EOD;
			break;
	}
	return $m;
}

function agarrar($obj){
	global $s;
	$m='';

	return $m;
}

function inventario(){
	global $s;
	$m='';

	return $m;
}

function examinar($obj){
	global $s;
	$m='';

	return $m;
}

function usar($obj){
	global $s;
	$m='';

	return $m;
}

function salir(){
	$m='';

	$_SESSION = array();
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}

	if(session_destroy()){
		$m='Gracias por jugar.';
	}else{
		$m='Ha ocurrido un error, por favor intenta salir nuevamente.';
	}

	return $m;
}

function info(){
	$m='Versión 0.1. Desarrollado por webmaster@cabritocabron.com.ar. Código bajo licencia WTFPL (http://sam.zoy.org/wtfpl/COPYING)';
	return $m;
}