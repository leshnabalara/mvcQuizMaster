<?php
	namespace Models;
	use Utils\Util;

	session_start();

	class Question{

		public static function GetQuestion($id){

			$db= Util::getDB();//using static function

			$questions= $db->prepare("SELECT * FROM questions WHERE number=:number"); //make skeleton of query to prevent sql injection

			$data= $questions->execute(array(
				"number" => $id
			));

			$row = $questions->fetch(\PDO::FETCH_ASSOC);

			return $row;
		}

		public static function CheckQuestion($id,$answer){

			$db= Util::getDB();//using static function

			$result=$db->prepare("SELECT * FROM questions WHERE number=:number");
			$result->execute(array(
				"number" => $id
				));

			$users=$db->prepare("SELECT * FROM users WHERE enrollment=:enrollment");
			$users->execute(array(
				"enrollment" => $_SESSION["enrollment"]
				));

			$solved=$db->prepare("SELECT * FROM answer WHERE enrollment=:enrollment AND question_number=:number");
			$solved->execute(array(
				"enrollment" => $_SESSION["enrollment"],
				"number" => $id));

			$ques = $result->fetch(\PDO::FETCH_ASSOC);
			$user = $users->fetch(\PDO::FETCH_ASSOC);

			$current_score=$user["score"];
			$number_of_solver=$ques["no_of_users"];
			$rows=$solved->fetchAll();

			if($ques["answer"]==$answer && count($rows)==0)
			{	
				$current_score=$current_score+$ques["points"];
				$number_of_solver=$number_of_solver+1;

				$sql=$db->prepare("UPDATE users SET score=:score WHERE enrollment=:enrollment");
				$sql->execute(array(
					"enrollment" => $_SESSION["enrollment"],
					"score" => $current_score
					));

				$sql=$db->prepare("UPDATE questions SET no_of_users=:no_of_users WHERE number=:number");
				$sql->execute(array(
					"no_of_users" => $number_of_solver,
					"number" => $id
					));

				$sql=$db->prepare("INSERT INTO answer(enrollment,question_number) 
					VALUES(:enrollment,:number)");
				$sql->execute(array(
					"enrollment" => $_SESSION["enrollment"],
					"number" => $id
					));



				return true;
			}

			elseif($ques["answer"]===$answer)
			{
				return true;
			}

			else{
				return false;
			}

		}


	}	
?>