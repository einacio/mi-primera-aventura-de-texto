<?php
if (strtolower($_SERVER["SCRIPT_NAME"])==='core.php'){
	header('Location: index.php');
	exit();
}

session_set_cookie_params(86400); //expiracion de la sesion 24hs
session_start();
/**
 *
 *tiene que mantener el estado en session, aceptar comandos y devolver un array con la respuesta
 *
 */

$s=&$_SESSION; //por mera vagancia, hago un alias de $_SESSION


if (!isset($s['hab'])){ //sesion en blanco. inicializo y doy mensaje inicial
	$s['hab']=1;
	$s['inventario']=array();
	$s['puerta_abierta']=false;
	$s['hab1_objs']=array('puerta','tapiz','escudo','espada');
	$s['hab2_objs']=array('caja','cuadro','llave','martillo','mesa'); //'estatuilla no esta disponible hasta que corresponda


	$s['estados']=array();
	$s['estados']['tapiz_hab']='';
	$s['estados']['puerta_hab']='una pesada puerta metálica';
	$s['estados']['cuadro_hab']=' que representa una esmeralda';
	$s['estados']['cuadro_est']='';
	$s['estados']['tapiz']='Un gran tapiz con un diseño que te causa un poco de jaqueca.';
}

include './acciones.php';

if (!isset($_POST['entrada'])){
	$respuesta=mirar();
	return;
}

$funciones1 = array('este','oeste','mirar','inventario','salir','info');
$funciones2 = array('agarrar','examinar','usar');
$entrada=explode(' ',strtolower(trim($_POST['entrada'])));
if (!empty($entrada[0])){
	if (in_array($entrada[0],$funciones1)){
		$respuesta=$entrada[0]();
	}elseif(in_array($entrada[0],$funciones2)){
		if (isset($entrada[1]) && !empty($entrada[1])){
			$respuesta=$entrada[0]($entrada[1]);
		}else{
			$respuesta=strtoupper($entrada[0]).' requiere un objeto.';
		}
	}else{
		$entrada[1]=isset($entrada[1])?$entrada[1]:'';
		$respuesta='No entiendo a que te refieres con '.strtoupper($entrada[0]).' '.strtoupper($entrada[1]);
	}
}else{
	$respuesta=$_POST['salida'];
}