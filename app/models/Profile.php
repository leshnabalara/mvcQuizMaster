<?php
	namespace Models;
	use Utils\Util;

	session_start();

	class Profile{

		public static function GetInfo(){

			$db= Util::getDB();//using static function

			$users= $db->prepare("SELECT username,enrollment,score FROM users WHERE enrollment=:enrollment"); //make skeleton of query to prevent sql injection

			$data= $users->execute(array(
				"enrollment" => $_SESSION["enrollment"]
			));

			$row = $users->fetch(\PDO::FETCH_ASSOC);

			return $row;
		}
	}
?>