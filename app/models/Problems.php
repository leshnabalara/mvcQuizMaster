<?php
	namespace Models;
	use Utils\Util;

	class Problems{

		public static function ProblemList(){


			$db= Util::getDB();//using static function

			$questions= $db->prepare("SELECT number,title,points,no_of_users FROM questions"); //make skeleton of query to prevent sql injection

			$data= $questions->execute();

			$rows = $questions->fetchAll();

			return $rows;
		}

	}	
?>