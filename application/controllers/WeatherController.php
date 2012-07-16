<?php
/**
 * Weather Controller 
 *      @author		Sandrine Reboul <sandrine.reboul@gmail.com> 
 */

class WeatherController extends Zend_Controller_Action{


	public function indexAction(){

		try {
			$city = $country = $this->view->weather_today = "";
			$city_n_country = Zend_Controller_Action::_getParam('textlocation' );
			if($city_n_country && preg_match('/,/i',$city_n_country)){
				list($city, $country) = explode(",",$city_n_country); 
			}
			
			//TODO: the case where the user adds a wrong city
			
			
			if(!empty($city) && !empty($country) ){ 
				$weather_class = new Model_Weather($city,$country);
				$weather_today = $weather_class->getToday();
			}else{
				//TODO geodetection and then 
				$weather_class = new Model_Weather($city,$country);
				$weather_today = $weather_class->getToday();
				//logError('WeatherController', $e->getMessage());
			}
 			
			if($weather_today){
				$this->view->weather_today = $weather_today;
			}
			$this->view->city = $weather_class->getCity();
			$this->view->country = $weather_class->getCountry();
  			
			// $this->view->locationweather = Common_Misc::nameDecode($this->view->locationweather);
			$this->view->locationweather = $this->view->city. " - " . $this->view->country ;
			
		} catch (Exception $e) { 
			//logError('WeatherController', $e->getMessage());
		}
	}
	 
	
}
?>
