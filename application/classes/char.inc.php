<?php
class Char extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Bangkok');
		
	}

	function clearStr($string){
		$string = str_replace('–', '-', $string);
		$string = str_replace(' ', '-', $string);
		return preg_replace('/-+/', '-', $string);
	}
	
	function cutStr($str, $maxChars='', $holder=''){  
		if (strlen($str) > $maxChars ){  
			$str = iconv_substr($str, 0, $maxChars,"UTF-8") . $holder;  
		}  
		return $str;  
	}
}
?>