<?php

/** Pre-written functions of configuration setup*/

include_once '../classes/Functions.php';

/**
 |---------------------------------------------------
 | MYSQL ACTIVATOR 
 |---------------------------------------------------
 */
 define('MYSQL_ENABLED', false);


/**
 |--------------------------------------------------
 | SQL DATABASE CONFIGURATION
 |--------------------------------------------------
 */
 
if(MYSQL_ENABLED):
	define('SQLTYPE', 'mysql');
	define('SQLHOST', 'localhost');
	define('SQLUSER', 'root');
	define('SQLPASS', '');
	define('SQLDATABASE', 'databasename_here');
	define('SQLCHARSET', 'utf8mb4');
	define('SQLCOLLATION', 'utf8mb4_general_ci');
endif;

/**
 |--------------------------------------------------
 | TIMEZONE
 |--------------------------------------------------
 */
 date_default_timezone_set('Europe/Istanbul');
?>