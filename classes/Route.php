<?php 

class Route extends Controller
{
	public static $validRoutes = array();

	/**
	 * Route setter function 
	 * 
	 * @param  $route, $function, $paramsEnabled
	 */
	public static function set($route, $function, $paramsEnabled = false)
	{

		//$uri = @explode('/', $_GET['url']);
		$uri = self::parseUrl();
		$parameters = @array_slice($uri, 1); //silence error if array $uri hasn't any element

		/** Add route to valid routes list */
		self::$validRoutes[] = $route;

		/** Run callback function written if url matches request*/
		if(isset($_GET['url']) && $route == $uri[0]){
			
			/** If static URI's arguments are allowed, fetch parameters else leave them */
			if($paramsEnabled === true){
				$function($parameters);
			}else{
				if(count($parameters)){
					echo 'This static route doesn\'t accept any parameters. Add third parameter and set it true to change it';
				}else{
					$function();
				}
			}

			/** Avoid handling dynamic URI Requests on static matches cases */
			exit();
		}
	}

	/**
	 * List all registered routes
	 *
	 * @return Array
	 */
	public static function listRoutes()
	{
		header('Content-type: application/json');
		$validRoutes = array_merge(self::$validRoutes, ['uri' => $_GET['url']]);
		$json = json_encode($validRoutes);
		echo $json;
	}

	/**
	 * Exceptions that class will not execute any method, only arguments
	 * @return array
	 */
	public static $NonAction = [
		
	];

	/**
	 * Check URI-Controller Based Things
 	 *
	 */


	 public static function handleURI()
	 {

	 	@$request = explode('/', $_GET['url']);

	 	//Class
	 	if(isset($request[0])){

	 		/** NonAction Handler **/
	 		if(in_array($request[0], self::$NonAction)){

	 			$class = $request[0];
	 			unset($request[0]);
	 			$params = $request ? array_values($request) : [];
	 			call_user_func_array([new $class, 'index'], $params);
	 			return;
	 		}
	 		/** **/
	 		
	 		/** Sitemap.xml handler **/
	 		if($request[0] == 'sitemap.xml'){
	 			call_user_func_array([new Sitemap, 'index'],[]);
	 			return;
	 		}
	 		/** **/

	 		if($request[0] == ''){
	 			$request[0] = 'main';
	 		}



	 		if(file_exists('../controllers/' . ucfirst($request[0]) . '.php')){
	 			$class = ucfirst($request[0]);
	 			unset($request[0]);
	 		}else{
	 			parent::loadview('404');
	 			return false;
	 			$class = 'Main';
	 		}
	 	}

	 	//Method
	 	if(isset($request[1])){

	 		if($request[1] == '') {
	 			$method = 'index';
	 			unset($request[1]);
	 		} else {
 				if(method_exists(new $class, $request[1])){
 					$method = $request[1];
 					unset($request[1]);
 				} else{
					$method = 'index';
					parent::loadview('404');
					return false;
 				}
	 		}
	 	}
	 		else{
	 		$method = 'index';
	 	}

	 	$params = $request ? array_values($request) : [];


	 	/** Runs Output with Request URI */
	 	if(!in_array($request, self::$validRoutes)){
			 @call_user_func_array([new $class, $method], $params);
	 	}
	 }

	 /** URI Parser*/
	 public static function parseUrl()
	{
		if(isset($_GET['url'])){
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
}

?>