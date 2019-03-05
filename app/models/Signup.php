<?php
	
	namespace Models;
	use Utils\Util;


	class Signup{

		public static function AddUser($username,$password,$enrollment){


			$db= Util::getDB();//using static function
			$score=0;
			$is_admin=0;

			$password_hash=hash('sha256',$password);

			$user= $db->prepare("INSERT INTO users (username,password,enrollment,score,is_admin) VALUES (:username,:password,:enrollment,:score,:is_admin)"); //make skeleton of query to prevent sql injection

			$user->execute(array(
				"username" => $username,
				"password" => $password_hash,
				"enrollment" => $enrollment,
				"score" => $score,
				"is_admin" => $is_admin
			));
		}
	}	
?>