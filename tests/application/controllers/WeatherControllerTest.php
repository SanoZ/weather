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
 
	        public function testIndexActionShouldContainLoginForm()
	        {
	            $this->dispatch('/user');
	            $this->assertAction('index');
	            $this->assertQueryCount('form#loginForm', 1);
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

	            $this->request->setMethod('GET')
	                 ->setPost(array());
	            $this->dispatch('/user/view');
	            $this->assertRoute('default');
	            $this->assertModule('default');
	            $this->assertController('user');
	            $this->assertAction('view');
	            $this->assertNotRedirect();
	            $this->assertQuery('dl');
	            $this->assertQueryContentContains('h2', 'User: foobar');
	        }
	    }