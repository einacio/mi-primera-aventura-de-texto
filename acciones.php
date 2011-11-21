<?php

if (strtolower($_SERVER["SCRIPT_NAME"])==='acciones.php'){
	header('Location: index.php');
	exit();
}

function este(){
	global $s;
	$m='';
	switch ($s['hab']){
		case 1:
			$s['hab']=2;
			$m=mirar();
			break;
		case 2:
			$m='Hay una pared en tu camino, no puedes avanzar en esa dirección.';
			break;
	}

	return $m;
}

function oeste(){
	global $s;
	$m='';
	switch ($s['hab']){
		case 1:
			if ($s['puerta_abierta']){
				$m='Felicidades, has logrado entrar a la casa.'."\n".salir();
			}else{
				$m='La puerta esta cerrada, no puedes avanzar en esa dirección.';
			}
			break;
		case 2:
			$s['hab']=1;
			$m=mirar();
			break;
	}
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
un escudo de armas. Hacia el oeste hay {$s['estados']['puerta_hab']} y hacia el este un
arco conecta con otra habitación. En el techo esta la trampilla por la que entró el
personaje, ahora cerrada.
EOD;
			break;
		case 2:
			$m=<<<EOD
Es una pequeña sala alfombrada que parece no haber sido usada en mucho tiempo,
evidenciado por la gruesa capa de polvo que cubre todo en la habitación.
Al igual que la anterior, esta iluminada sin fuente aparente.
En una pared hay colgado un cuadro{$s['estados']['cuadro_hab']}.
En la pared opuesta a la entrada hay una mesa cuberta de polvo y
debajo se ve una caja de herramientas.
EOD;
			break;
	}
	return $m;
}

function agarrar($obj){
	global $s;
	$m='';
	$objetos_agarrables=array('estatuilla','martillo','espada','llave');

	$arrHab='hab'.$s['hab'].'_objs';

	if (in_array($obj,$s[$arrHab])){
		if (in_array($obj,$objetos_agarrables)){
			$s['inventario'][]=$obj;
			unset($s[$arrHab][array_keys($s[$arrHab],$obj)]);
			if ($obj==='estatuilla'){
				$s['estados']['cuadro_est']='El espacio está vacío.';
			}
		}else{
			$m= strtoupper($obj).' no se puede AGARRAR.';
		}
	}else{
		$m= strtoupper($obj).' no se encuentra en esta habitación.';
	}

	return $m;
}

function inventario(){
	global $s;
	$m='En tus bolsillos solo hay un montón de nada.';
	if (count($s['inventario'])){
		$m=implode(',',$s['inventario']);
		$m='En tus bolsillos llevas: '.strtoupper($m).'.';
	}
	return $m;
}

function examinar($obj){
	global $s;
	$m='';
	if (in_array($obj,array_merge($s['hab'.$s['hab'].'_objs'],$s['inventario']))){
		switch ($obj){
			case 'caja':
				$m='Es una CAJA de herramientas común. Dentro hay algunas herramientas en muy mal estado.';
				if (!in_array('martillo',$s['inventario'])){
					$m.=' Entre el montón destaca un MARTILLO que parece usable.';
				}
				break;
			case 'cuadro':
				$m='Es una hermosa pintura'.$s['estados']['cuadro_hab'].$s['estados']['cuadro_est'];
				break;
			case 'escudo':
				if (in_array('espada',$s['inventario'])){
					$m='Es un escudo con una espada detrás.';
				}else{
					$m='Es un escudo con un par de ESPADAs detrás.';
				}
				break;
			case 'esmeralda':
				$m='Es una brillante esmeralda del tamaño de tu puño, lo cual es muy extraño.';
				break;
			case 'espada':
				$m='Recta, brillante y muy filosa, aparentemente hecha para cortar cosas. Casi podes sentirla rogándote que la uses.';
				break;
			case 'estatuilla':
				$m='Es una pequeña estatuilla de mármol de alguna diosa griega o algo así.';
				break;
			case 'llave':
				$m='Es una llave del tamaño de tu antebrazo. Quiza abra alguna puerta en los alrededores.';
				break;
			case 'martillo':
				$m='Es un martillo de esos que se usan para romper cosas. Lastima que sirve para contruir nada útil.';
				break;
			case 'mesa':
				$m='Una mesa de ébano cubierta de polvo.';
				if (!in_array('llave',$s['inventario'])){
					$m.=' Parece haber una LLAVE escondida debajo del polvo.';
				}
				break;
			case 'puerta':
				$m='Una pesada puerta metálica que bloquea la salida.';
				break;
			case 'tapiz':
				$m=$s['estado']['tapiz'];
				break;
		}
	}else{
		$m=strtoupper($obj).' no está a la vista.';
	}
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
		$m='Ha ocurrido un error, por favor intenta SALIR nuevamente.';
	}

	return $m;
}

function info(){
	$m='Versión 0.1. Desarrollado por webmaster@cabritocabron.com.ar. Código bajo licencia WTFPL (http://sam.zoy.org/wtfpl/COPYING)';
	return $m;
}