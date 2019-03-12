<?php
    
    namespace Models;
    use Utils\Util;


    class Questions{

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

        public static function ProblemList(){


            $db= Util::getDB();//using static function

            $questions= $db->prepare("SELECT number,title,points,no_of_users FROM questions"); //make skeleton of query to prevent sql injection

            $data= $questions->execute();

            $rows = $questions->fetchAll();

            return $rows;
        }


        public static function GetQuestion($id){

            $db= Util::getDB();//using static function

            $questions= $db->prepare("SELECT * FROM questions WHERE number=:number"); //make skeleton of query to prevent sql injection

            $data= $questions->execute(array(
                "number" => $id
            ));

            $row = $questions->fetch(\PDO::FETCH_ASSOC);

            return $row;
        }

    }   
?>