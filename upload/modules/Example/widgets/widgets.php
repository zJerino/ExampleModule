<?php
/*
 *	Made by Samerton
 *  https://github.com/NamelessMC/Nameless/
 *  NamelessMC version 2.0.0-pr7
 *
 *  License: MIT
 *
 *  ExampleWidget By zJerino
 */
class ExampleWidget extends WidgetBase {
    private $_smarty, $_Example_language;
	public function __construct($pages = array(), $smarty, $Example_language){
        parent::__construct($pages);
        $this->_smarty = $smarty;
        $this->_Example_language = $Example_language;
        // Get order
        $order = DB::getInstance()->query('SELECT `order` FROM nl2_widgets WHERE `name` = ?', array('ExampleWidget'))->first();

        // Set widget variables
        $this->_module = 'Example';
        $this->_name = 'ExampleWidget';
        $this->_location = 'right';
        $this->_description = 'ExampleWidget :D';
        $this->_order = $order->order;

        // Generate HTML code for widget
        //$this->_content = $this->_smarty->fetch('widgets/ExampleWidget.tpl');
    }
    public function initialise(){
		
        #ES: Aqui vamos agregar variables Smarty (Lo que nos permite usar {$} en las plantilas)
        #EN: .
        $this->_smarty->assign(array(
        	'EXAMPLE_TITLE' => $this->_Example_language->get('general', 'Example'),
	        'EXAMPLE_CONTENT' => $this->_Example_language->get('general', 'WidgetContent'),
		));
		
        #ES: Aqui podemos agregar todo el codigo que queramos agregar a nuestro widget
        #EN: .



		
        #ES: Aqui pondremos la ubicacion de donde la plantilla buscara el html del widget (En este caso seria ExampleWidget)
        #EN: .
		$this->_content = $this->_smarty->fetch('widgets/ExampleWidget.tpl');
		#Note: Mooz es compatible con este widget 🤣🤣
    }
}