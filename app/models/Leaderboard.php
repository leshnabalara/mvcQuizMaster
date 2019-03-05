<?php
	namespace Models;
	use Utils\Util;

	class Leaderboard{

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

	}	
?>