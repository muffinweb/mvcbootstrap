<?php

/**
 * --------------------------------------------
 * 	MVCBOOTSTRAP - UGUR CENGIZ
 * --------------------------------------------
 * @package Mvcbootstrap
 * @author Ugur Cengiz <ugurcengiztr35@gmail.com>
 * @version 1.0.0
 */


/** Composer Autoloader */
//require '../vendor/autoload.php';

/** Manuel Packages & Frameworks */
require '../packages/Medoo.php';
require '../packages/Csrf.php';

/** Error show enabled */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


 /** Load Classes, Controllers and Model */
spl_autoload_register(function($class){
	if(file_exists("../models/" . $class . ".php")){
		require "../models/" . $class . ".php";
	} else if(file_exists("../interfaces/" . $class . ".php")){
		require "../interfaces/" . $class . ".php";
	}else if(file_exists("../controllers/" . $class . ".php")){
		require "../controllers/" . $class . ".php";
	} else if(file_exists("../classes/" . $class . ".php")){
		require "../classes/" . $class . ".php";
	}
});

/** Load Preboot functions and configurations */
require '../config/Core.php';

/** Start Mvcbootsrapper*/
startBootstrap();
