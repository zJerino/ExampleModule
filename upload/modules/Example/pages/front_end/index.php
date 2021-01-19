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

//ES: definimos en que pagina estamos, esto nos ayuda a que se agrege el active en el link del navbar
//EN: We define which page we are on, this helps us to add the active in the navbar link
define('PAGE', 'Example');
#ES:Ahora traemos nuestro lenguaje personalizado
#EN: Now we bring our custom language
$GLOBALS['ExampleLanguaje'] = $ExampleLenguaje;
#ES: Ahora definimos el titulo de la pagina
#EN: Now we define the title of the page
$page_title = $ExampleLenguaje->get('general', 'ExampleT');
#ES: Ahora tremos FrontEnd
#EN: Now we have FrontEnd
require_once(ROOT_PATH . '/core/templates/frontend_init.php');
#ES: Aqui les dejo un ejemplo de codigo que pueden agregar, en mi caso una variable smarty con un texto
#EN: Here I leave an example of code that you can add, in my case a smarty variable with a text
$smarty->assign('EXAMPLE_CONTENTXD', 'Hi, This page is created in ExampleModule');


## You code


// Load modules + template
Module::loadPage($user, $pages, $cache, $smarty, array($navigation, $cc_nav, $mod_nav), $widgets, $template); $page_load = microtime(true) - $start; define('PAGE_LOAD_TIME', str_replace('{x}', round($page_load, 3), $language->get('general', 'page_loaded_in'))); $template->onPageLoad();
#ES: Agregamos la variable smarty para los widget (Recomiendo dejarlo como 'WIDGET' ya que casi todas las plantillas usan esta variable para los widget por defecto)
#EN: We add the smarty variable for the widgets (I recommend leaving it as 'WIDGET' since almost all templates use this variable for the widget by default)
$smarty->assign('WIDGETS', $widgets->getWidgets());


#ES: TRAEMOS MAS COSITAS
#EN: WE BRING MORE THINGS
require(ROOT_PATH . '/core/templates/navbar.php');
require(ROOT_PATH . '/core/templates/footer.php');



#ES: Aqui definimos el archivo de la carpeta de la plantilla debe mostrar
#EN: Here we define the template folder file must show
$template->displayTemplate('example/index.tpl', $smarty);
