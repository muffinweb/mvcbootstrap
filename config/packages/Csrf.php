<?php 

namespace Http\Security;

class CSRF 
{
	public static function generate(){
		$token =  base64_encode(openssl_random_pseudo_bytes(32));
		$_SESSION['token'] = $token;
		return $token;
	}

	public static function token(){
		if(isset($_SESSION['token']))
			return $_SESSION['token'];
	}

	public static function validate($token){
		if(isset($_SESSION['token']) && $_SESSION['token'] === $token)
		{
			unset($_SESSION['token']);
			return true;
		}
	}
}

?>