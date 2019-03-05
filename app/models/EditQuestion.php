<?php
	namespace Models;
	use Utils\Util;

	class EditQuestion{

		

		public static function EditQuestion($id,$title,$question,$answer,$points){


			$db= Util::getDB();//using static function

			$entry= $db->prepare("UPDATE questions SET 
									title=:title,
									question=:question,
									answer=:answer,
									points=:points
									WHERE number=:number
								"); //make skeleton of query to prevent sql injection

			$result= $entry->execute(array(
					 "number" => $id, 
					 "title" => $title,
					 "question" => $question,
					 "answer" => $answer,
					 "points" => $points,
					 ));

			return $result;
		}


	}	
?>