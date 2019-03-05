<?php

	namespace Utils;

	class Util{

		public static function getDB()
		{
			include __DIR__."/../configs/credentials.php";
			return new \PDO("mysql:dbname=".  // PDO php data object
			$db_connect['db_name'].";host=".
			$db_connect['server'],
			$db_connect['username'],
			$db_connect['password']);
		}
	}
?>