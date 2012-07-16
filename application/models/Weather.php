<?php
/**
 * Weather class.
 * 
 * Google api
 * Url : http://www.google.com/ig/api?weather=city,country 
 * This class returns the weather details for a given city
 * 
 * 
 * @author sandrine 
 */
class Model_Weather
{
	
	private $url = "http://www.google.com/ig/api?weather=city,country";
	private $url_image = "http://www.google.com/ig";
	private $_city;
	private $_country;
	
	public $today = array();
	public $tomorrow = array();
	
	
	public function __construct($city="",$country=""){
		// $this->city = ucfirst(strtolower(Common_Misc::myUrlEncode($city)
	 	$this->_city = $city;
		// $this->country = ucfirst(strtolower(Common::myUrlEncode($country)););
	 	$this->_country = $country;
	}
	
	public function setCity($city){
		$this->_city = $city;
	}
	public function getCity(){
		return $this->_city;
	}
	public function setCountry($country){
		$this->_country = $country;
	}
	public function getCountry(){
		return $this->_country;
	}
	
	/*
	* Returns the weather of the day 
	* or throw an exception in case of error
	*/
	public function getToday(){
		try{
			if(!empty($this->_city) && !empty($this->_country)){
				//get  the xml for the weather
				$this->url = str_replace("city",$this->_city, $this->url);
				$this->url = str_replace("country",$this->_country, $this->url);
				$this->url = str_replace(" ","",$this->url);
				$xml = utf8_encode(file_get_contents($this->url));
				$xml = simplexml_load_string($xml);

				if($xml->weather->current_conditions->condition['data']){ 
					$this->today['currentWeather'] = $xml->weather->current_conditions->condition['data'];
					$this->today['currentTemperature'] = $xml->weather->current_conditions->temp_f['data'];
					$this->today['picture'] = $this->url_image.$xml->weather->current_conditions->icon['data'];
					return $this->today;
				} 
			}
			return false;
		}catch(Exception $e){
			//log error +
			throw new Exception ("Error - please try again.");
		}
	}
	
	// public function getTomorrow(){
	// 	try{
	// 		if(!empty($city) && !empty($country)){
	// 			//get  the xml for the weather
	// 			$this->url = str_replace("city",$city, $this->url);
	// 			$this->url = str_replace("country",$country, $this->url);
	// 			$xml = simplexml_load_file($this->googleapiweather);
	// 		
	// 			//tomorrow weather
	// 			$this->tomorrow['tomorrowDay'] = $xml->weather->forecast_conditions[0]->day_of_week['data'];
	// 			$this->tomorrow['tomorrowLow'] = $xml->weather->forecast_conditions[0]->low['data'];
	// 			$this->tomorrow['tomorrowHigh'] = $xml->weather->forecast_conditions[0]->high['data'];
	// 			$this->tomorrow['tomorrowIcon'] = $this->url_image.$xml->weather->forecast_conditions[0]->icon['data'];
	// 			$this->tomorrow['>tomorrowWeather'] = $xml->weather->forecast_conditions[0]->condition['data'];
	// 		
	// 		}
	// 	}catch(Exception $e){
	// 		//log error +
	// 		throw new Exception ("Error - please try again.");
	// 	}
	}
}
