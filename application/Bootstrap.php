<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	
	protected $_config;
  
	function _initConfig(){
		
		// config
		$this->_config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
		Zend_Registry::set('config', $this->_config); 

		// debugging
		if($this->_config->debug) {
			error_reporting(E_ALL | E_STRICT);
			ini_set('display_errors', 'on');
		} 
	}

	
	protected function _initAutoload() {
        
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath' => APPLICATION_PATH  ,
        ));
         
        $auth = Zend_Auth::getInstance(); 
    }
       
    protected function _initDoctype() {
        
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->setEncoding('UTF-8');
        $view->doctype('XHTML1_STRICT'); 

        // $view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Zend_View_Helper');
       
    }

	
 
}

