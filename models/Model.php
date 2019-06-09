<?php

use Medoo\Medoo;

class Model
{
	/** Medoo DatabaseFramework Instantiation */
	public $medoo;
	public function __construct()
	{
		if(! MYSQL_ENABLED )
		{
			return false;
		}

		$this->medoo = new Medoo([
			'database_type' => SQLTYPE,
			'server' => SQLHOST,
			'username' => SQLUSER,
			'password' => SQLPASS,
			'database_name' => SQLDATABASE,
			'charset' => SQLCHARSET,
			'collation' => SQLCOLLATION
		]);
	}

	/**
	 * Database Initializer From MedooFramework
	 * This function may be useful for classes which has __construct overwrite
	 * Because overwrite deletes Models __construct so medoo initialization not working
	 *
	 * @todo You should add use Medoo\Medoo; code top of class
	 * @todo public $medoo variable 
	 */
	public function initializeDatabase()
	{
		$this->medoo = new Medoo([
			'database_type' => SQLTYPE,
			'server' => SQLHOST,
			'username' => SQLUSER,
			'password' => SQLPASS,
			'database_name' => SQLDATABASE,
			'charset' => SQLCHARSET,
			'collation' => SQLCOLLATION
		]);
	}

	/**
	 * Config Lister from SQL formatted array
	 *
	 * @param $config|array, $optionName|string, $optionValue|string
	 * @return array
	 */
	public function getConfig($config, $optionName, $optionValue)
	{
		$opts = [];
		foreach($config as $datas){
			$opts[$datas[$optionName]] = $datas[$optionValue];
		}

		return $opts;
	}


	/** 
	 * Get Boolean if HTTP-Request Type equals first argument.
	 *
	 * @return string
	 */
	public function requestIs($reqType)
	{
		if($_SERVER['REQUEST_METHOD'] == strtoupper($reqType))
		{
			return true;
		}
		return false;
	}

	/** 
	 * Get name, surname of auth
	 * @todo nothing
	*/
	public function getNameSurname()
	{
		$nameSurname = $this->medoo->select("users", [
			"name",
			"surname"
		], [
			'username' => $_SESSION['auth']['username']
		]);
		return (object) $nameSurname[0];
	}

	public function getUsernameById($id = null)
	{
		if($id != null) {
			return $this->medoo->select("users", "username", [
				"id" => $id
			])[0];
		}
	}

	public function payload()
	{

		$payload = [];

		return $payload;
	}
}

?>
