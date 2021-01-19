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

#ES: Quiero hacerle todo un poco mas facil asi que todo estara comentado y muy facil de entender por lo menos para mi :P
    #ES: Primero vamos a iniciar cambiando la informacion de nuestro modulo, para ello cree una variable con toda la informacion
#EN: I want to make everything a little easier so that everything will be commented and very easy to understand at least for me: P
     #EN: First we are going to start changing the information of our module, for this create a variable with all the information
$INFO_MODULE = array(
    'name' => 'Example', 
    #ES: Este es el nombre de tu Modulo, recuerda que si lo cambias aqui debes cambiar tambien el nombre de esta carpeta
    #En: This is the name of your Module, remember that if you change it here you must also change the name of this folder
    'author' => '<a href="https://samerton.me" target="_blank" rel="nofollow noopener">Samerton</a> and <a href="https://Mysticplay.net" target="_blank" rel="nofollow noopener">zJerino</a>',
    #ES: Aqui puedes agregar tu nombre para que las personas sepan que tu fuiste quien creo el modulo
    #EN: Here you can add your name so people know that it was you who created the module
    'module_ver' => '1.0',
    #ES: Aqui debes colocar la vercion actual de tu recurso, cada vez que actualices el modulo cambialo para indicarle a los usuarios si tiene que actualizar o no
    #ES: Here you must place the current version of your resource, every time you update the module change it to indicate to users if it has to update or not
    'nml_ver' => '2.0.0-pr7',
    #ES: este dato es inportante (Bueno todos son importantes), pero este debes cambiarlo cuando tu recurso este listo para entrar el una siguiente vercion de NamelessMC, si no lo haces NamelessMC detectara que el modulo esta para una version anterior y mostrara un cuadro con la advertencia
    #EN: This data is important (well, it is all important), but it should be changed when your resource is ready to enter the next version of NamelessMC, if you don't, NamelessMC will detect that the module is for an older version and it will show a box with the warning

);
#ES: Modificado todo esto podemos seguir a otro paso
#EN: Modified all this we can continue to another step

#ES: Asi puedes exportar un lenguaje a una variable para ser usada:
#EN: So you can export a language to a variable to use:
$ExampleLenguaje = new Language(ROOT_PATH . '/modules/'.$INFO_MODULE['name'].'/language', LANGUAGE);

#ES: Ahora Haremos que nuestro idioma este en una variable global, esto lo veremos mas tarde
#EN: Now we will make our language into a global variable, we will see it later
$GLOBALS['ExampleLanguaje'] = $ExampleLenguaje;

#ES: Como podemos usarlo?
    #ES: Pues muy sencillo solo debemos poner $ExampleLenguaje->get('Archivo', 'Item'); a que me refiero con 'Archivo'? pues es el nombre del archivo en mi caso, el 'Archivo' es el nombre y seria Archivo.php, Te dejare un ejemplo
#ES: How can we use it?
    #ES: Well, very simple we just have to write $ExampleLenguaje->get('File', 'Item');  what do I mean by 'File'? Well, it is the name of the file in my case, the 'File' is the name and it would be File.php, I'll leave you an example

$ExampleString = 'this is an' . $ExampleLenguaje->get('general', 'Example');
    //echo $ExampleString; return = Hi

#ES: Si queremos crear un apartado especial en la pagina de Perfil podemos hacer lo siguiente: 
#EN: If we want to create a special section on the Profile page we can do the following:

if(!isset($profile_tabs)) $profile_tabs = array();
$profile_tabs['Example'] = array('title' => $ExampleLenguaje->get('general', 'Example'), 'smarty_template' => 'user/example.tpl', 'require' => ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $INFO_MODULE['name'] . DIRECTORY_SEPARATOR . 'profile_tab.php');
#ES: Recurda cambiar, revisar y estudiar no solo hacer copia y pega
#EN: Remember to change, review and study not just copy and paste



##ES: Ahora vamos ha importar el modulo en si
##EN: Now we are going to import the module itself
require_once(ROOT_PATH . '/modules/'.$INFO_MODULE['name'].'/module.php');

#ES: Ahora despues de aver modificado todo podemos importar nuestro modulo [Recuerda cambiar la parte (Example_Module) por la que le pusiste a la class que esta en module.php]
#EN: Now after modifying everything we can import our module [Remember to change the part (Example_Module) for the one you put in the class that is in module.php]
$module = new Example_Module($language, $pages, $INFO_MODULE);