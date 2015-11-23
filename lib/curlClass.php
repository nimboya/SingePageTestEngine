<?php
/**
******************************************************
* @file curl.class.php
* @brief wArLeY_cURL: Use this class to get full webpage, send data, get data and all universe possibilities.
* @author Evert Ulises German Soto
* @version 1.0
* @date August 2012
*******************************************************/
// defined( 'SIPES' ) or die( 'Restricted access' );
//  define('GOOGLE_API_KEY', 'AIzaSyATMr7jRs8EyOlgxcqBsczLl6nPeHxyZZg');
//  define('GOOGLE_ENDPOINT', 'https://www.googleapis.com/urlshortener/v1');
if (!function_exists('curl_init')) 	die('Curl needs the CURL PHP extension.');
class curlclass{
	private $err_msg = "";
	private $opt_followlocation = false;
	var $httpCode = "";
	private $options = array(
		"url" => "",
		"type" => "POST",
		"redirect" => "0",
		"timeout" => "0",
		"httpheader" => array('Content-Type : text/html'),
		"referer" => "",
		"https" => "0",
		"return_transfer" => "0",
		"user_agent" => "",
		"header" => "0",
		"post" => "0",
		"post_fields" => "",
		"data" => "plain",
		"data_filename" => "example.html",
		"proxy" => "",
		"proxy_userpwd" => "",
		"proxy_type" => CURLPROXY_HTTP //CURLPROXY_SOCKS5
	);

	/** 
	* @brief Constructor, initialize class values.
	* @param array $options, load the required values for the user.
	*/
	public function __construct($options = array()){
		if(!empty($options) && is_array($options)  )
		{
			if((string)$options['url']==""){
				$this->err_msg = "Error: the argument url is required.";
				return false;
			}
	
			foreach($this->options as $c=>$v){
				if(isset($options[$c])) $this->options[$c] = $options[$c];
				if(trim($c)=="redirect" && (integer)$this->options[$c]>0) $this->opt_followlocation = true;
			}
		}
	}
	
	function set_options($options)
	{
		if(!is_array($options)){
			$this->err_msg = "Error: invalid option passed.";
			return false;
		}
		if((string)$options['url']==""){
			$this->err_msg = "Error: the argument url is required.";
			return false;
		}

		foreach($this->options as $c=>$v){
			if(isset($options[$c])) $this->options[$c] = $options[$c];
			if(trim($c)=="redirect" && (integer)$this->options[$c]>0) $this->opt_followlocation = true;
		}
	}

	/** 
	* @brief Execute, this execute the curl function.
	* @return object, this object can be string with full request, or the filename with full request for work with this.
	*/
	public function Execute(){
		$data = $this->options['data'];
		$data_filename = $this->options['data_filename'];

		// Check if cURL installed
		if(!function_exists('curl_init')){
			$this->err_msg = "Error: Sorry cURL is not installed!";
			return false;
		}
		
		 $ch = curl_init();
		 
		curl_setopt($ch, CURLOPT_URL, $this->options['url']);

		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->options['httpheader']);
		
		//((string)$this->options['httpheader']!=="") ? curl_setopt($ch, CURLOPT_HTTPHEADER, $this->options['httpheader']) : curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type : text/html'));
		((string)$this->options['header']	==="1" ) ? curl_setopt($ch, CURLOPT_HEADER, 1) : curl_setopt($ch, CURLOPT_HEADER, 0);
		((string)$this->options['referer']!=="") ? curl_setopt($ch, CURLOPT_REFERER, $this->options['referer']) : curl_setopt($ch, CURLOPT_REFERER, "http://www.google.com/?q=bitches+open+legs");
		((string)$this->options['user_agent']!=="") ? curl_setopt($ch, CURLOPT_USERAGENT, $this->options['user_agent']) : curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);		
		((string)$this->options['return_transfer']==="0") ? curl_setopt($ch, CURLOPT_RETURNTRANSFER, false) : curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//((integer)$this->options['timeout']>0) ? curl_setopt($ch, CURLOPT_TIMEOUT, $this->options['timeout']) : curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		//((string)$this->options['type']==="GET") ? curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET") : curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

		$fp = "";
		switch($data){
			case "web":
			case "file":
				$fp = fopen($data_filename, "w");
				curl_setopt($ch, CURLOPT_FILE, $fp);
				break;
		}

		if($this->opt_followlocation===true){
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_MAXREDIRS, $this->options['redirect']);
		}else{
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		}

		if((string)$this->options['proxy']!==""){
			curl_setopt($ch, CURLOPT_PROXYTYPE, $this->options['proxy_type']);
			curl_setopt($ch, CURLOPT_PROXY, $this->options['proxy']);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, $this->options['proxy_userpwd']);
			curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
		}
		
		if((string)$this->options['https']==="1" ){
			curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		}
		if((string)$this->options['post']==="1" && gettype($this->options['post_fields'])==="string"){
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->options['post_fields']);
		}else{
			curl_setopt($ch, CURLOPT_POST, false);
		}

		$tmp_output = curl_exec($ch);
		$tmp_error = curl_error($ch);
		$this->httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);
		
	
		if($this->httpCode === 404){
			$this->err_msg = "Error: 404, Page Not Found.";
			return false;
		}elseif($this->httpCode !== 200){
			$this->err_msg = "Error: ". $this->httpCode .", operation denied.";
			return false;
		}

		if($tmp_error){
			$this->err_msg = "Error: ". $tmp_error;
			return false;
		}

		if($data!="plain"){ fclose($fp); return $data_filename; }else{ return $tmp_output; }
	}

	/** 
	* @brief getError, get the latest error ocurred in the class.
	* @return string, this is the latest error description.
	*/
	public function getError(){
		return trim($this->err_msg)!="" ? "<span style='display:block;color:#FF0000;background:#FFEDED;font-weight:bold;border:2px solid #FF0000;padding:2px 4px 2px 4px;margin-bottom:5px'>".$this->err_msg."</span><br />" : "";
	}
	function get_httpCode(){
		return $this->httpCode;
	}
}
?>