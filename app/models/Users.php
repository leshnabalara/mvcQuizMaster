<?php
	namespace Models;
	use Utils\Util;

	class Users{

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

		public static function UserList(){


			$db= Util::getDB();//using static function

			$users= $db->prepare("SELECT enrollment,username,score FROM users WHERE is_admin=0 ORDER BY score DESC"); //make skeleton of query to prevent sql injection

			$data= $users->execute();

			$rows = $users->fetchAll();

			$rank=0;
			$score=-1;
			$count=0;

			foreach ($rows as &$user) {

				if ($user["score"]==$score) {
					$user["rank"]=$rank;
					$count++;

				}

				else{

					$rank=$rank+1+$count;
					$score=$user["score"];
					$user["rank"]=$rank;
				}

			}

			return $rows;
		}

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