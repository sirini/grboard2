<?php
class Common {
	
	private $grboard;
	
	public function __construct($_grboard='') {
		$this->grboard = $_grboard;
	}

	public function getPlaneText($str) {
		return preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~|\!\?\*$#<>()\[\]\{\}]/i", '', $str);
	}

	public function getSubStr($str, $len=200) {
		if(!$len || !$str) return $str;
		$mb_cutSize = 0;
		$j = $len;
		for($i=0; ($j > 0) && ($i <= mb_strlen($str, 'UTF-8')); $i++){
			if( ord( mb_substr($str, $i, 1, 'UTF-8') ) > 127) { $j -= 1; $mb_cutSize += 1; }
			else { $j -= 0.5; $mb_cutSize += 1; }
		}
		if($j < 0 ) $mb_cutSize -= 1;
		$result = substr($str, 0, $mb_cutSize);
		preg_match('/^([\x00-\x7e]|.{3})*/', $result, $string);
		return $string[0];
	}

	public function error($msg, $moveBackPath='', $delay=10000) {
		$this->page($msg, $moveBackPath, 'error', $delay);
	}
	
	public function info($msg, $moveBackPath='', $delay=10000) {
		$this->page($msg, $moveBackPath, 'message', $delay);
	}
	
	public function page($msg, $moveBackPath='', $type='error', $delay=10000) {
		if( !strlen($moveBackPath) && array_key_exists('HTTP_REFERER', $_SERVER) ) $moveBackPath = $_SERVER['HTTP_REFERER'];
		if( !strlen($moveBackPath) ) $moveBackPath = 'http://' . $_SERVER['HTTP_HOST'];
		$grboard = $this->grboard;
		if(strstr($msg, '@page/')) {
			$path = str_replace('@page/', 'page/', $msg) . '.txt';
			$msg = file_get_contents($path);
		}
		$filepath = $type . '.php';
		if(file_exists($filepath)) include $filepath;
		else include '../' . $filepath;
		exit();
	}
	
	public function message($msg, $path, $delay=1500) {
		$msg = '<link rel="stylesheet" type="text/css" href="/'.$this->grboard.'/lib/gritter/css/jquery.gritter.css" />' .
			'<script src="/'.$this->grboard.'/lib/gritter/js/jquery.gritter.min.js"></script>' .
			'<script> $.gritter.add({ title: "Notice", text: "'.$msg.'", time: '.$delay.'}); ' .
			'setTimeout(function(){ location.href=\''.$path.'\'; }, '.$delay.'); </script>';
		die($msg);
	}

	public function getSessionKey() {
		if(isset($_SESSION['GRBOARD2KEY'])) return (int)$_SESSION['GRBOARD2KEY'];
		else return 0;
	}

	public function setSessionKey($no=0) {
		$_SESSION['GRBOARD2KEY'] = (int)$no;
	}
	
	public function postGoogleRecaptcha($resp, $gr2cfg) {
	    $fields = array('secret'=>$gr2cfg['googleRecaptchaSecretKey'],
	        'response'=>$resp,
	        'remoteip'=>$_SERVER['REMOTE_ADDR']);
	    $data = http_build_query($fields);	    
	    $url = parse_url($gr2cfg['googleRecaptchaRequestUrl']);
	    $host = 'ssl://' . $url['host'];
	    $path = $url['path'];
	    $port = 443;
	    $result = '';
	    
	    $fp = fsockopen($host, $port);
	    if($fp) {
	        $o = 'POST ' . $path . ' HTTP/1.1' . "\r\n";
	        $o .= 'Host: ' . $url['host'] . "\r\n";
	        $o .= 'Content-Type: application/x-www-form-urlencoded' . "\r\n";
	        $o .= 'Content-Length: ' . strlen($data) . "\r\n";
	        $o .= 'Connection: Close' . "\r\n\r\n";
	        fwrite($fp, $o);	        
	        fwrite($fp, $data);
	        
	        while(!feof($fp)) $result .= fgets($fp, 128);
	        fclose($fp);
	        
	        $res = explode("\r\n\r\n", $result);
	        $json = json_decode($res[1]);
	        
	        if(intval($json->{'success'}) !== 1) return false;
	        else return true;
	    }
	    return false;
	}
} 
?>