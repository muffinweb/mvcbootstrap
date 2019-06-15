<?php


class Controller extends Model
{

	public static function loadview($view, $payload = [], $extractEnabled = false){
		if(file_exists("../views/" . $view . ".php")){
			
			//Extract Payload to variables
			if($extractEnabled)
				extract($payload);
			
			require "../views/" . $view . ".php";
		}
	}

	/**
	 * View Loader From Viewbase
	 * 
	 * @param $view
	 * @param $payload | Array
	 * @param $extractEnabled | Boolean
	 */
	public function view($view, $payload = [], $extractEnabled = false){
		$view = strtr($view, '.', '/');
		if(file_exists("../views/" . $view . ".php")){
			
			//Extract Payload to variables
			if($extractEnabled)
				extract($payload);
			
			require "../views/" . $view . ".php";
		}
	}

	/** Validator for Request */
	public function validate($requiredFields, $request){
		return !array_diff_key(array_flip($requiredFields), $request);
	}


	/**
	 * Redirect homeuri
	 */
	public function toBaseUri()
	{
		header('Location: /');
		return false;
	}

	/**
	 * Redirect to target
	 * 
	 * Url variable is uri or another website address. 
	 * If isExternal is true, url you enter considered as another web address
	 *
	 * @param $url, $isExternal
	 */
	public function redirect($url = false, $isExternal = false)
	{
		if($url){
			if($isExternal){
				header("Location: http://www.$url");
			}else{
				header("Location: $url");
			}
		}else{
			die("REDIRECT URL BOŞ BIRAKILMAMALI!");
		}
	}

	/**
	 * Classcaller
	 * 
	 * Even though you are running a controller with a uri, 
	 * you can run another controller class and methods with arguments
	 * 
	 * @param $class, $method, $args
	 */
	public function callController($class = false, $method = false, Array $args = array())
	{
		if($class != false && $method != false){
			call_user_func_array([new $class, $method], $args);
		} else if($class != false && $method == false){
			call_user_func_array([new $class, 'index'], $args);
		}else {
			die('callController methodunda eksik argumanlar var!');
		}
	}

	/** 
	 * API CONTROLLER
	 *
	 */




}

?>
