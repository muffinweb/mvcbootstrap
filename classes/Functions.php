<?php

/**
 |---------------------------------------------------
 | Functions.php is likely a helpers source
 |---------------------------------------------------

/**
 * ForceSLL is forcer function that force client to https protocol
 *
 * @return void
 */
function force_ssl(){
	if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
	    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	    header('HTTP/1.1 301 Moved Permanently');
	    header('Location: ' . $redirect);
	    exit();
	}
}

/** 
 * Auth function lets you check if client has auth or not, then makes its action
 */
function auth(){
	if(@!$_SESSION['auth']){
		return false;
	}else{
		return true;
	}
}


/** StartUP function of MVCBootstrap */
function startBootstrap()
{
	session_start();
	require '../Routes.php';
}

/** Get a spesific partial from Viewbase **/
function partial($source, $payload = []){
	$path = '../views/';
	$source = strtr($source, '.', '/');
	$source .= '.php';

	include $path . $source;
}

/**
 * Convert Array to Object 
 *
 * @param $arr
 * @return object
 */
 function toObject($arr = false){
 	if( !$arr )
 		return false;
 	return (object) $arr;
 }


 /**
  * If any request requires fields that has to be declared,
  * this function very useful for these kind of cases.
  * 
  * @param $fields, $request
  * @return boolean
  */
 function requestRequires($fields, $request){
 	return !array_diff_key(array_flip($fields), $request);
 }

 /**
  * Specify content format
  *
  * @param $type
  */
 function contentIs($type = null){
 	if($type != null) {
 		header("Content-type: application/$type");
 	}
 }

 /**
  * <pre> lister
  *
  * @param $data
  */
 function prelist($data){
  echo '<pre>', print_r($data, true);
 }

 /**
  * SlugTool
  *
  * @param $str
  * @return var
  */
 function permalink($str, $options = array())
  {
      $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
      $defaults = array(
          'delimiter' => '-',
          'limit' => null,
          'lowercase' => true,
          'replacements' => array(),
          'transliterate' => true
      );
      $options = array_merge($defaults, $options);
      $char_map = array(
          // Latin
          'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
          'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
          'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
          'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
          'ß' => 'ss',
          'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
          'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
          'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
          'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
          'ÿ' => 'y',
          // Latin symbols
          '©' => '(c)',
          // Greek
          'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
          'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
          'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
          'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
          'Ϋ' => 'Y',
          'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
          'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
          'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
          'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
          'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
          // Turkish
          'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
          'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
          // Russian
          'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
          'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
          'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
          'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
          'Я' => 'Ya',
          'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
          'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
          'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
          'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
          'я' => 'ya',
          // Ukrainian
          'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
          'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
          // Czech
          'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
          'Ž' => 'Z',
          'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
          'ž' => 'z',
          // Polish
          'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
          'Ż' => 'Z',
          'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
          'ż' => 'z',
          // Latvian
          'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
          'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
          'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
          'š' => 's', 'ū' => 'u', 'ž' => 'z'
      );
      $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
      if ($options['transliterate']) {
          $str = str_replace(array_keys($char_map), $char_map, $str);
      }
      $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
      $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
      $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
      $str = trim($str, $options['delimiter']);
      return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
  }


  /** OS AND BROWSER DETECTOR */
  $user_agent = $_SERVER['HTTP_USER_AGENT'];

  function getOS() { 

      global $user_agent;

      $os_platform  = "Unknown OS Platform";

      $os_array     = array(
                            '/windows nt 10/i'      =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                      );

      foreach ($os_array as $regex => $value)
          if (preg_match($regex, $user_agent))
              $os_platform = $value;

      return $os_platform;
  }

  function getBrowser() {

      global $user_agent;

      $browser        = "Unknown Browser";

      $browser_array = array(
                              '/msie/i'      => 'Internet Explorer',
                              '/firefox/i'   => 'Firefox',
                              '/safari/i'    => 'Safari',
                              '/chrome/i'    => 'Chrome',
                              '/edge/i'      => 'Edge',
                              '/opera/i'     => 'Opera',
                              '/netscape/i'  => 'Netscape',
                              '/maxthon/i'   => 'Maxthon',
                              '/konqueror/i' => 'Konqueror',
                              '/mobile/i'    => 'Handheld Browser'
                       );

      foreach ($browser_array as $regex => $value)
          if (preg_match($regex, $user_agent))
              $browser = $value;

      return $browser;
  }
 
?>