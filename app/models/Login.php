<?php
	namespace Models;
	use Utils\Util;

	class Login{

		public static function ValidateUser($enrollment,$password){


			$db= Util::getDB();//using static function

			$password_hash=hash('sha256',$password);

			$user= $db->prepare("SELECT * FROM users WHERE enrollment=:enrollment and password=:password"); //make skeleton of query to prevent sql injection

			$data= $user->execute(array(
				"enrollment" => $enrollment,
				"password" => $password_hash
			));

			$row = $user->fetch(\PDO::FETCH_ASSOC);

			if($row) return true;
			else return false;
		}

		public static function Admin($enrollment)
		{
			$db= Util::getDB();//using static function
			$is_admin=1;

			$user= $db->prepare("SELECT * FROM users WHERE enrollment=:enrollment and is_admin=:is_admin"); //make skeleton of query to prevent sql injection

			$data= $user->execute(array(
				"enrollment" => $enrollment,
				"is_admin" => $is_admin
			));

			$row = $user->fetch(\PDO::FETCH_ASSOC);

			if($row) return 1;
			else return 0;

		}
	}	
?>