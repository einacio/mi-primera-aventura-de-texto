<?php
session_set_cookie_params(86400); //expiracion de la sesion 24hs
session_start();
/**
 *
 *tiene que mantener el estado en session, aceptar comandos y devolver un array con la respuesta
 *
 */

$s=&$_SESSION; //por mera vagancia, hago un alias de $_SESSION

include './acciones.php';

if (!isset($s['hab'])){ //sesion en blanco. inicializo y doy mensaje inicial
	$s['hab']=1;
	$s['inventario']=array();
	$s['hab1_objs']=array('puerta','tapiz','escudo','espada');
	$s['hab2_objs']=array('caja','cuadro','llave','martillo','mesa'); //'estatuilla no esta disponible hasta que corresponda


	$s['estados']=array();
	$s['estados']['tapiz_hab']='';
	$s['estados']['puerta_hab']='';
}

function_exists();
