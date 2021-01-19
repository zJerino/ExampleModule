<?php
/*
 *	Made by Samerton
 *  https://github.com/NamelessMC/Nameless/tree/v2/
 *  NamelessMC version 2.0.0-pr7
 *
 *  License: MIT
 *
 *  ExampleModule By zJerino
 */
$Example_language = $GLOBALS['ExampleLanguaje'];

#ES: Primero antes de que se carge la pagina se verifica si el usuario esta registrado y posee los permisos para ver la pagina del panel
if($user->isLoggedIn()){
	if(!$user->canViewACP()){
		#ES: Redirijimos al usuario con la funcion Redirect::to y url::build
		#EN: 
		Redirect::to(URL::build('/'));
		die();
	}
	if(!$user->isAdmLoggedIn()){
		#ES: Redirijimos al usuario con la funcion Redirect::to y url::build a el logueo de administracion si no esta logueado
		#EN: 
		Redirect::to(URL::build('/panel/auth'));
		die();
	} else {
		if(!$user->hasPermission('admincp.example')){
			require_once(ROOT_PATH . '/403.php');
			die();
		}
	}
} else {
	// Not logged in
	Redirect::to(URL::build('/login'));
	die();
}

//ES: definimos en que pagina estamos, esto nos ayuda a que se agrege el active en el link del navbar
//EN: We define which page we are on, this helps us to add the active in the navbar link
define('PAGE', 'panel');
define('PARENT_PAGE', 'example_items');
define('PANEL_PAGE', 'example_items');
#ES:Ahora traemos nuestro lenguaje personalizado
#EN: Now we bring our custom language
$GLOBALS['ExampleLanguaje'] = $ExampleLenguaje;
#ES: Ahora definimos el titulo de la pagina
#EN: Now we define the title of the page
$page_title = $ExampleLenguaje->get('general', 'ExampleT');
#ES: Ahora tremos FrontEnd
#EN: Now we have FrontEnd
require_once(ROOT_PATH . '/core/templates/backend_init.php');
#ES: Aqui les dejo un ejemplo de codigo que pueden agregar, en mi caso una variable smarty con un texto
#EN: Here I leave an example of code that you can add, in my case a smarty variable with a text
$smarty->assign('EXAMPLE_CONTENTXD', 'Hi, This page is created in ExampleModule');


#ES: Sistema de acciones
#EN: Stock system
switch ($_GET['action']) {
	#ES: Si la url tiene "?action=NamelessMC" te redirige a la pagina oficial de namelessmc
	#EN: If the url has '?action=NamelessMC' it will redirect you to the official namelessmc page
	case 'NamelessMC':
			Redirect::to('https://NamelessMC.com');
			die();
		break;
	case 'Cuberico':
			Redirect::to('https://dev.mysticplay.net');
			die();
		break;
	default:
		# None
		break;
}


## You code


// Load modules + template
Module::loadPage($user, $pages, $cache, $smarty, array($navigation, $cc_nav, $mod_nav), $widgets, $template); $page_load = microtime(true) - $start; define('PAGE_LOAD_TIME', str_replace('{x}', round($page_load, 3), $language->get('general', 'page_loaded_in'))); $template->onPageLoad();


#ES: TRAEMOS MAS COSITAS
#EN: WE BRING MORE THINGS
require(ROOT_PATH . '/core/templates/panel_navbar.php');


#ES: Aqui definimos el archivo de la carpeta de la plantilla debe mostrar
#EN: Here we define the template folder file must show
$template->displayTemplate('Example/index.tpl', $smarty);
