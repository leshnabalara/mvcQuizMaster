<?php

	namespace Controllers;	//collection of classes 
	use Models\Question;

	session_start();

	class QuestionController {

		protected $twig;

		public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ; //load twig enviornment
            $this->twig = new \Twig_Environment($loader) ;
        }

	    function get($id) {

	    	if(isset($_SESSION["enrollment"]) && $_SESSION["is_admin"]>0)
            {
            	$question=Question::GetQuestion($id);

            	echo $this->twig->render("editquestion.html",array(
	                "title" => "Question ".$id,
	                "question"=> $question));
            }

            else
            {
                
	        	$question=Question::GetQuestion($id);

            	echo $this->twig->render("question.html",array(
	                "title" => "Question ".$id,
	                "question" => $question,
	            	"loggedin" => isset($_SESSION["enrollment"])));
            }


	    }

	    function post($id) {

	    	if(isset($_SESSION["enrollment"])){
	    		$answer= $_POST["answer"];

		        $result=Question::CheckQuestion($id,$answer);

	            $array=[ "answer" => $result];
	            echo json_encode($array);
	        }


	        else{
	           
	        	$array=[ "answer" => "login"];
	        	echo json_encode($array);
	        }

	    }


}