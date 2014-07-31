<?php

/**
 * Class Bitly
 * 
 * @link themes.microdesign-web.com
 * @author Martin Tonev
 * @package bit ly  
 */
class Bitly{

	/**
	 * Bit ly api URL of version 3
	 */
	const BITLY_OAUTH_API = 'https://api-ssl.bit.ly/v3/';
	
	public static $instance;

	/**
	 * You Auth token
	 */
	const BITLY_OAUTH_ACCESS_TOKEN = '5286bf79ba929be674c39940f90e5f3153674d8d';

	public static function init()
	{
		if ( is_null( self::$instance ) )
		{
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @param        $longUrl
	 * @param string $domain
	 * @param string $x_login
	 * @param string $x_apiKey
	 * @return array api call response
	 */
	public function bitly_shorten($longUrl, $domain = '', $x_login = '', $x_apiKey = '')
	{			
		try
		{
			$result = array();
			$url = self::BITLY_OAUTH_API . "shorten?access_token=" .self::BITLY_OAUTH_ACCESS_TOKEN. "&longUrl=" . urlencode($longUrl);

			if ($domain != '')
			{
				$url .= "&domain=" . $domain;
			}

			if ($x_login != '' && $x_apiKey != '')
			{
				$url .= "&x_login=" . $x_login . "&x_apiKey=" . $x_apiKey;
			}

			$response = json_decode($this->get_curl($url), TRUE);

			if ($response['status_code'] == 200)
			{
				return $response['data'];
			}
			else
			{
				return $response['status_code'].$response['status_txt'];
			}
			
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die('-- error');	
		}
	}

	/**
	 * Call to API with cURL
	 * 
	 * @param $uri
	 *
	 * @return mixed|string
	 */
	public function get_curl($uri)
	{
		$output = "";
		try
		{
			$ch = curl_init($uri);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 4);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			$output = curl_exec($ch);
		} 
		catch (Exception $e)
		{
			echo $e->getMessage();
			die('-- error');
		}

		return $output;
	}

}
