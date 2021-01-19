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


#ES: Despues de ver init.php podemos pasar aqui, es mas que todo para que no te pierdas
#EN: After seeing init.php we can go here, it is most of all so you don't get lost


#ES: Ahora vamos a cambiar de class Example_Module a class NombreDeTuModulo_Module (Esto tambien tienes que cambiarlo en init.php al final)
#EN: Now we are going to change from class Example_Module to class NameOfYourModule_Module (This you also have to change in init.php at the end)
class Example_Module extends Module {
	#ES: Agregamos las variables que podran estar en toda la class
	#EN: We add the variables that could be in the whole class
	private $_language, $_Example_language;

	public function __construct($language, $pages, $INFO_MODULE){
		$this->_language = $language;
		#ES: Aqui podemos agregar el lenguaje, por esta razon cree el $GLOBALS['ExampleLanguaje'];
		#EN: Here we can add the language, for this reason create the $GLOBALS['ExampleLanguaje'];
		$this->_Example_language = $GLOBALS['ExampleLanguaje'];

		#ES: Aqui nuestro module agarra la informacion que agregamos en init.php en $INFO_MODULE
		#EN: Here our module grabs the information that we add in init.php in $INFO_MODULE
		$name = $INFO_MODULE['name'];
		$author = $INFO_MODULE['author'];
		$module_version = $INFO_MODULE['module_ver'];
		$nameless_version = $INFO_MODULE['nml_ver'];
		parent::__construct($this, $name, $author, $module_version, $nameless_version);


		// Pages || Paginas
		#ES: Yeh! estoy seguro que la mas de la mitad de los que compraron este tutorial/modulo, llegaron fue para crear paginas
		#EN: Yeh! I'm sure more than half of those who bought this tutorial / module came to create pages

		#ES: La forma de agregar una pagina es la siguiente $pages->add('NombreDelModulo', 'URL', 'Archivo donde se va a encontrar la pagina'), si no me explico bien puedes entrar a al primer ejemlo que esta acontinuacion
		#EN: The way to add a page is the following $pages->add ('ModuleName', 'URL', 'File where the page will be found'), if I don't explain myself well, you can enter the first example that is next
		$pages->add('Example', '/panel/Example', 'pages/back_end/index.php');

		
		$pages->add('Example', '/Example', 'pages/front_end/index.php', 'Example', true);
		#ES: porque agrege en lo ultimo ['Example', true] lo agrege para que esa pagina tenga soporte a los widgets
		#EN: because it adds in the last ['Example', true] it adds it so that this page has support for widgets

	}

	public function onInstall(){
		#ES: Aqui puedes agregar cualquier codigo que quieres que se ejecute cuando tu modulo sea instalado
		#EN: Here you can add any code that you want to run when your module is installed
	}

	public function onUninstall(){
		#ES: Aqui puedes agregar cualquier codigo que quieres que se ejecute cuando tu modulo sea desintalado
		#EN: Here you can add any code that you want to run when your module is uninstalled
	}

	public function onEnable(){
		#ES: Aqui puedes agregar cualquier codigo que quieres que se ejecute cuando tu modulo sea habilitado
		#EN: Here you can add any code that you want to run when your module is enabled




		#ES: Aqui agregare el permiso de ver la pagina de administracion al administrador
		#EN: Here I will add the permission to see the administration page to the administrator
		$queries = new Queries();
		
		try {
			// Update main admin group permissions
			$group = $queries->getWhere('groups', array('id', '=', 2));
			$group = $group[0];
			
			$group_permissions = json_decode($group->permissions, TRUE);
			$group_permissions['admincp.example'] = 1;
			$group_permissions['users.example'] = 1;
			
			$group_permissions = json_encode($group_permissions);
			$queries->update('groups', 2, array('permissions' => $group_permissions));
		} catch(Exception $e){
			// Error
		}

	}

	public function onDisable(){
		#ES: Aqui puedes agregar cualquier codigo que quieres que se ejecute cuando tu modulo sea deshabilitado
		#EN: Here you can add any code that you want to run when your module is disabled
	}

	public function onPageLoad($user, $pages, $cache, $smarty, $navs, $widgets, $template){
		#ES: Ahora sigue?
			#ES: Pues vamos a crear permisos :D
		#EN: Now continue?
			#EN: Well, let's create permissions: D
		
		#ES: Ahora vamos a agregar un permiso especial para poder ingresar a la pagina /Panel/Example/ sin ese permiso nadie podra ingresar alli ni los administradores
		#EN: Now we are going to add a special permission to be able to enter the page /Panel/Example/ without that permission, no one will be able to enter there nor the administrators
		PermissionHandler::registerPermissions('Example', array(
			'admincp.example' => $this->_Example_language->get('general', 'ExampleGroupDescription'),
			'users.example' => $this->_Example_language->get('general', 'ExampleGroupDescription2')
		));


		// #SITE MAP :D!

		//ES: Esta funcion no ah sido agregada a ExampleModule :(
		//EN: This function has not been added to Example Module :(
		// #$pages->registerSitemapMethod(ROOT_PATH . 'none', 'Example_Sitemap::generateSitemap');

		
		 #ES: Vamos con el cache de NamelessMC
			 #ES: Que es el cache de NamelessMC, pues simplemente es algo que te guardara el texto/informacion que deseas, y luego la puedes usar nuevamente, pero mejor vamos a ejemplo
		
		#EN: Let's go with the NamelessMC cache
			#EN: What is the NamelessMC cache, because it is simply something that will save the text/information you want, and then you can use it again, but let's take an example

		//Example
		// 		$cache->setCache('MY_CACHE');
		// 		#ES: usamos $cache->setCache(); para crear un nuevo archivo en /cache/ donde se guardara nuestra informacion, en mi caso mi cache se llamara MY_CACHE
		// 		#EN:we use $cache->setCache (); to create a new file in /cache/ where our information will be saved, in my case my cache will be called MY_CACHE

		#ES: Ahora que tenemos donde se va a guardar nuestra informacion, vamos a agregar algo al cache no?, para eso te vamos a ensenar con un ejemplo
		#EN: Now that we have where our information will be stored, we are going to add something to the cache, right? For that we are going to show you with an example

		//Example
		// 		$cache->store('Mydata', 'ExampleModule :D');
		// 		$cache->store('Mydata2', 'ExampleModule :D', 5000);
		// 		#ES: usamos $cache->store() para agregar informacion a nuestro cache, de forma esta forma podriamos agregar informacion que luego podemos usar, Recurda  $cache->store('Nombre Del dato', 'Informacion' Tiempo de expiracion) tambien puedes usar en ves de texto una array de php de esta forma
		// 		#EN: We use $cache->store() to add information to our cache, in this way we could add information that we can later use, Remember $cache-> store('Data Name', 'Information' Expiration time) you can also use instead of text a php array like this
		// 		$ExampleArray123 = array('Example' => 'Example', 'Example1' => 'Ekisde','Example2' => 'Hi','Exmaple3' => 'Hola');
		// 		$cache->store('ExampleArray', $ExampleArray123);

		#ES: Ahora que tenemos una informacion en Cache como la usamos?, pues vamos aver como:
		#EN: Now that we have information in Cache, how do we use it? Well, let's see how:
		// 	//Example 
		// 		$cache->retrieve('Mydata'); #EN: Return: ExampleModule :D
		// 									#ES: Regresaria: ExampleModule :D
		// 		$cache->retrieve('ExampleArray'); #EN: Return: Array ( [Example] => Example [Example1] => Ekisde [Example2] => Hi [Exmaple3] => Hola ) 
		// 										  #ES: Regresaria: Array ( [Example] => Example [Example1] => Ekisde [Example2] => Hi [Exmaple3] => Hola )

		// #ES: Ahora nos preguntamos seguramente como sabemos si tenemos la informacion en cache
		// #EN: Now we surely wonder how we know if we have the information in cache
		// 	//Example
		// 		#ES: podemos usar simplemten un if y la variable de el cache para comprobar, puede hacerlo de la siguiente manera
		// 		#EN: We can simply use an if and the cache variable to check, you can do it as follows
		// 			if ($cache->isCached('Mydata')) {
		// 				#ES: Si existe Mydata
		// 				#EN: If Mydata exists
		// 				# You code...
		// 			} else {
		// 				#ES: Si no existe Mydata
		// 				#EN: If Mydata does not exist
		// 				# You code...
		// 			}

		
		
		// #Smarty 🤔
		// #ES:Antes de seguir vamos a aprender a usar variables smarty, que es eso? es lo que permite a las plantillas usar los datos creado, editados y puestos aqui como por ejemplo {$TITLE}, {$SITE_NAME}, {$SITE_HOME}, eso es smarty en las plantilas
		// #EN: Before continuing we are going to learn how to use smarty variables, what is that? it is what allows templates to use the data created, edited and put here such as {$TITLE}, {$SITE_NAME}, {$SITE_HOME}, that's smarty in templates
		// 		//Example
		// 				#ES: es muy facil usarlo puedes usarlo sola mente creando una asignacion smarty de la siguiente manera:
		// 				#EN: It is very easy to use it, you can use it alone by creating a smarty assignment as follows:

		// 				$smarty->assign(array(
		// 					'HI' => 'hola'
		// 				));
						
		// 				#ES: Como vez es facil solo tienes que agregar $smarty->assign() y en la plantilla seria {$HI} como resultado daria: 'hola' [yo uso array para agregar varios elementos pero me acostumbre a usarlo asi para todo]
		// 				#EN: As it is easy, you just have to add $smarty->assign() and in the template it would be {$HI} as a result it would give: 'hello' [I use array to add several elements but I get used to using it like this for everything]

		// 				#ES: se puede usar variable php? y arrays dentro de esas asignaciones smarty?
		// 					#ES: Por supuesto que si!
		// 				#EN: can you use php variable? and arrays within those smarty assignments?
		// 					#EN: Of course yes!
		// 					//Example In Example :v
		// 						$ExampleArray123 = array('Example' => 'Example', 'Example1' => 'Ekisde','Example2' => 'Hi','Exmaple3' => 'Hola');
		// 						$smarty->assign(array(
		// 							'ExampleArray' => $ExampleArray123, #or
		// 							'ExampleArray2' => array('Example' => 'Example', 'Example1' => 'Ekisde','Example2' => 'Hi','Exmaple3' => 'Hola')
		// 						));
		// 						#ES: En la plantilla tendrias que usar {foreach from=$ExampleArray item=item} {$item} {/foreach} para mostrar todos los resultados o si quieres mostrar uno en especifico usarias {$ExampleArray.Example1} rempaza Example1 por el item de array que que quieras
		// 						#EN: In the template you would have to use  {foreach from=$ExampleArray item=item} {$item} {/foreach} To show all results or if you want to show a specific one you would use {$ExampleArray.Example1} replace Example1 with the array item you want

		// #ES: Creo que ya estaria listo para continuar.
		// #EN: I think I would be ready to continue.

		// // Widgets :D!
		// //ES: Realmente no he creado un widget extraordinario pero si puego ayudate a saber como se crea, recurda que esta es una guia
		// //EN: I have not really created an extraordinary widget but if I can help you to know how to create it, remember that this is a guide

		// #ES: Agregaremos la ubucacion de nuestro widget
		// #EN: We will add the location of our widget
			require_once(ROOT_PATH . '/modules/Example/widgets/widgets.php');

		// #ES: En $module_pages debemos agregar el nombre que le pusismos a nuestro widget
		// #EN: In $module_pages we must add the name that you put to our widget
			$module_pages = $widgets->getPages('ExampleWidget');
		
			$Example_language = $this->_Example_language;
		// #ES: Agregamos nuestro widget
		// #EN: We add our widget
			$ExampleWidget = new ExampleWidget($module_pages, $smarty, $Example_language);
			$widgets->add($ExampleWidget);
		

		
		// #ES: Queremos que algo solo se muestre en el FRONT_END {PAGINA DONDE PUEDEN VER LOS USAURIOS} podemos usar if(defined('FRONT_END')){ #You Code... } en caso de que queramos que se muestre solamente en el panel podemos usar if(defined('BACK_END')){ #You Code... }
		// #EN: We want something to only show in the FRONT_END {PAGE WHERE THE USAURS CAN SEE} we can use if (defined('FRONT_END')) {#You Code ...} in case we want it to be shown only in the panel we can use if (defined('BACK_END')) {#You Code ...}
		if(defined('FRONT_END')){
			#ES: Se puede saber si el usuario que esta viendo la pagina esta logueado?
				#ES: Efectivamente si se puede de la siguiente forma: if($user->isLoggedIn()){ #You code ... }, $user->isLoggedIn() devolvera 0 si el usuario no esta logueado y 1 si lo esta
			#ES: Can you know if the user who is viewing the page is logged in?
				#ES: Indeed, if you can, as follows: if ($user->isLoggedIn()) {#You code ...}, $user->isLoggedIn() will return 0 if the user is not logged in and 1 if he is
			
			if ($user->isLoggedIn() == 1) {
				$smarty->assign('LOGIN_STATUS', 'Is logged');
			} else {
				$smarty->assign('LOGIN_STATUS', 'No is logged');
			}
		
			##Navbar!
			#ES:Agregemos enlaces a los navbar :D!
				#ES: esto lo haremos gracias al cache!
			#EN: Let's add links to the navbars: D!
				#EN: we will do this thanks to the cache!
			#ES: Comenzemos pues!
			#EN: So let's start!


			#ES:  Te recomiendo mirar el ejemplo y usarlo como lo hizimos.
			#EN:  I recommend you look at the example and use it as we did.

					//Example:
					
					#ES: Esto nos dara la posicion de el link en mi caso quiero que sea el numero 4
					#EN: This will give us the position of the link in my case I want it to be number 4

					$forum_order = 4;

					#ES: Ahora vamos a agregarle un icono a nuestro enlace, Recomiendo usar iconos de font-awesome ya que todas las plantillas tienen ese framework de iconos (Eso creo :P)
					#EN: Now we are going to add an icon to our link, I recommend using font-awesome icons since all templates have that icon framework (I think so :P)

					$cache->setCache('navbar_icons');
					if(!$cache->isCached('Example_icon'))
						$icon = '<i class="fa fa-users"></i> ';
					else
						$icon = $cache->retrieve('Example_icon');

					#ES: Ahora aqui viene la parte de agregarlo al navbar
						#ES: Te lo hare un forma de array para que sea mas facil de entender
					#EN: Now here comes the part of adding it to the navbar
						#EN: I will make it an array form to make it easier to understand

					#Only ES: Lo siguiente estara escrito en ingles puedes usar el traductor de google para entender, lo siento por ustedes 😞 pero tenia que decidir si era English or Spanish
					$navs[0]->add(
						'Example', #El $page que esta en tu pagina agregada anteriormete (ESTO ES IMPORTANTE PARA QUE SE LE AGREGE LA FUNCION ACTIVE CUANDO EL USUARIO ENTRA A TU PAGINA)
						$this->_Example_language->get('general', 'Example'), //El titulo que va a tener, en este caso usaremos un lenguaje
						URL::build('/Example'), //usamos URL::BUILD() para crear el enlace a nuestro sitio (De esta forma tendra soporte a No-friendly-url y a Friendly-URL)
						'top', null, //Esto es donde se mostrara el enlace, nosotros usaremos top para que se muestre en el navbar y no en el footer
						$forum_order, //Esta es el orden de nuestro enlace (Es la posicion en nuestro caso sera el 4 enlace)
						$icon //El icono que se mostrara en el navbar de nuestro enlace (Lo definimos mas arriba si lo quieres cambiar)
					);
		} else if(defined('BACK_END')){
			##Panel Navbar 😊

			#ES: Se me habia olvidado decir que puedes agregar permisos a los links, osea que cierto grupos grupos con ese permiso pueden ver el enlace de la pagina
			#EN: I had forgotten to say that you can add permissions to the links, so certain groups groups with that permission can see the link of the page

			#ES: En mi caso quiero agregar el permiso que cree anteriormente :p
			#EN: In my case I want to add the permission that I create above :p

			//Note : 
				#ES: Puedes seguir la guia de arriba con esta ya que es casi lo mismo solo que esta usa el sistema de permisos
				#EN: You can follow the guide above with this one since it is almost the same only that this one uses the permission system

			if($user->hasPermission('admincp.example')){
				$cache->setCache('panel_sidebar');
				if(!$cache->isCached('example1_order')){
					$order = 2000;
					$cache->store('example1_order', 200);
				} else {
					$order = $cache->retrieve('example1_order');
				}

				if(!$cache->isCached('example1_icon')){
					$icon = '<i class="nav-icon fas fa-comments"></i>';
					$cache->store('example1_icon', $icon);
				} else
					$icon = $cache->retrieve('example1_icon');

				$navs[2]->add('example_divider', mb_strtoupper('Example', 'UTF-8'), 'divider', 'top', null, $order, '');
				#ES: lo que definimos es arriba es el que divide la categoria
				#EN: what we define is above is the one that divides the category

				
				$navs[2]->add('example_items', $this->_Example_language->get('general', 'Example'), URL::build('/panel/Example'), 'top', null, $order + 0.1, $icon);
			}
		}
	}
}