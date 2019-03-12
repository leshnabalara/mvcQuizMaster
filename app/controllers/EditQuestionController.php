<?php
    
	namespace Controllers;	//collection of classes 
	use Models\Questions;

    session_start();

	class EditQuestionController{

		protected $twig;

		public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ; //load twig enviornment
            $this->twig = new \Twig_Environment($loader) ;
        }


            function post($id){

            if(isset($_SESSION["enrollment"]) && $_SESSION["is_admin"]>0){
                $title= $_POST["title"];
                $question= $_POST["question"];
                $answer=$_POST["answer"];
                $points=$_POST["points"];
                // $no_of_users=0;

                if(isset($title) && 
                   isset($question) &&
                   isset($answer) && 
                   isset($points)){
                    $result=Questions::EditQuestion($id,$title,$question,$answer,$points);
                }

                else{
                    $result=false;
                }

                if($result)
                {
                    echo $this->twig->render("editquestion.html",array(
                    "title" => "Edit Question",
                    "message" => "Question Updated Successfully !!"));
                }

                else
                {
                    echo $this->twig->render("editquestion.html",array(
                    "title" => "Edit Question",
                    "message" => "There was a error while updating the Question !!"));
                }
            }

            else{
                header("Location: /");
            }

        }
    }
?>