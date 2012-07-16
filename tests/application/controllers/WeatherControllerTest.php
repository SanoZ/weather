<?php

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{
 
	        public function setUp()
	        {
	            $this->bootstrap = array($this, 'appBootstrap');
	            parent::setUp();
	        }

	        public function appBootstrap()
	        {
	            $this->frontController
	                 ->registerPlugin(new Bugapp_Plugin_Initialize('development'));
	        }
 
	        public function testWeatherFormShouldGoToWeatherPage()
	        {
	            $this->request->setMethod('POST')
	                  ->setPost(array(
	                      'textlocation' => 'Sydney, Australia' 
	                  ));
	            $this->dispatch('/weather'); 

	            $this->resetRequest()
	                 ->resetResponse();
	            $this->assertQueryContentContains('h2', 'Sydney - Australia');
	        }
	
			public function testGeoDetectionWeatherForm()
	        {
	           //TODO
	        }
	
			public function testWrongCityWeatherForm()
	        {
	            $this->request->setMethod('POST')
	                  ->setPost(array(
	                      'textlocation' => 'Paris, Australia' 
	                  ));
	            $this->dispatch('/weather'); 

	            $this->resetRequest()
	                 ->resetResponse();
	            $this->assertQueryContentContains('h2', "Sorry, city wasn't found");
	        }
	    }