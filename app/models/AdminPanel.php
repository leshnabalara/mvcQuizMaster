<?php
	
	namespace Models;
	use Utils\Util;


	class AdminPanel{

		public static function AddQuestion($title,$question,$answer,$points){


			$db= Util::getDB();//using static function
			$no_of_users=0;

			$entry= $db->prepare("INSERT INTO questions (title,question,answer,points,no_of_users) VALUES (:title,:question,:answer,:points,:no_of_users)"); //make skeleton of query to prevent sql injection

			$result= $entry->execute(array(
					 "title" => $title,
					 "question" => $question,
					 "answer" => $answer,
					 "points" => $points,
					 "no_of_users" => $no_of_users
					 ));

			return $result;
		}
	}	
?>