<?php
	/**
	* Geolocation Module
	* 
	* @author Pedro Prez
	* @link http://community.elgg.org/pg/profile/pedroprez
	* @copyright (c) Keetup 2009-2010
	* @link http://www.keetup.com/
	* @license GNU General Public License (GPL) version 2
	*/
	define('GEO_URL', 'http://api.hostip.info/');
	
	class GeoLocation {
		
			private $ip_address;
			private $location_xml;
			private $coordinates;
			private $lat;
			private $long;
			private $city;
			private $country;
			private $country_code;
		
		//Construct	
			public function __construct(){
				$this->lat = 0;
				$this->lng = 0;
				$this->ip_address = $this->get_real_ip();
				//$this->ip_address = "200.42.136.212";
				$this->location_xml = $this->get_location_via_url();
			}
			
		//Get real IP
		   	private function get_real_ip(){
		   		if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' ){
		   			$client_ip =
					         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
					            $_SERVER['REMOTE_ADDR']
					            :
					            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
					               $_ENV['REMOTE_ADDR']
					               :
					               "unknown" );
				   
				      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
				   
				      reset($entries);
				      while (list(, $entry) = each($entries))
				      {
				         $entry = trim($entry);
				         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
				         {
				            // http://www.faqs.org/rfcs/rfc1918.html
				            $private_ip = array(
				                  '/^0\./',
				                  '/^127\.0\.0\.1/',
				                  '/^192\.168\..*/',
				                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
				                  '/^10\..*/');
				   
				            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
				   
				            if ($client_ip != $found_ip)
				            {
				               $client_ip = $found_ip;
				               break;
				            }
				         }
				      }
				   }
				   else
				   {
				      $client_ip =
				         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
				            $_SERVER['REMOTE_ADDR']
				            :
				            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
				               $_ENV['REMOTE_ADDR']
				               :
				               "unknown" );
				   }
				   
			   return $client_ip;
		   	}
		
		//Get a geo
			private function get_location_via_url(){
				
				$url = GEO_URL . "?ip={$this->ip_address}";
		   		  
			    $ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url);
			    curl_setopt($ch, CURLOPT_POST,"GET");
		      	
		      	ob_start();
		      
			    curl_exec($ch);
			    curl_close($ch);
			    $cache = ob_get_contents();
			    ob_end_clean();
			    
			    if(!empty($cache)){
			    	// Use of Simple XML extension of PHP 5
						$xml = simplexml_load_string($cache);
 
						if (!is_object($xml))
		    				throw new Exception('Error reading XML');
 
						$infohost = $xml->xpath('//gml:featureMember');
						$city = $xml->xpath('//gml:featureMember//gml:name');
 						
						$coordinates = $infohost[0]->xpath('//gml:coordinates');
						$this->coordinates = (string) $coordinates[0];
						$coordinates = split(',', (string) $coordinates[0]);

						$this->city = (string) $city[0];
						$this->country = (string) $infohost[0]->Hostip->countryName;
						$this->country_code = (string) $infohost[0]->Hostip->countryAbbrev;
						$this->long = (float)$coordinates[0];
						$this->lat = (float)$coordinates[1];
				}
		      	return $cache;
		   	}
		   	
		//Conseguimos el xml con información del lugar
			public function get_location_xml(){
				return $this->location_xml;
			}
	   	
	   	//Consigue el pais
		   	public function get_country(){
		   		return $this->country;
		   	}
		   	
		//Consigue el codigo pais
		   	public function get_country_code(){
		   		return $this->country_code;
		   	}
		   	
		//Consigue la ciudad
		   	public function get_city(){
		   		return $this->city;
		   	}
		   	
		//Consigue las coordinadas del lugar
			public function get_coordinates(){
				return $this->coordinates;
			}
			
		//Consigue la latitude 
			public function get_lat(){
				return $this->lat;
			}
			
		//Consigue la longitud 
			public function get_long(){
				return $this->long;
			}
	   	
	   	//Consigue la url de un icono
		   	public function get_icon_url(){
		   		return GEO_URL . "flag.php?ip={$this->ip_address}";
		   	}
	
	   	
	   	//Muestra la imagen de la bandera en una etiqueta html
		   	public function get_icon(){
		   		return "<img src=" . $this->get_icon_url() . "  />";
		   	}
	   	
		//Get the IP   	
		   	public function get_ip(){
		   		return $this->ip_address;
		   	}
	}
		
?>