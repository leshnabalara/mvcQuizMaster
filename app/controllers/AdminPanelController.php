<?php
    
	namespace Controllers;	//collection of classes 
	use Models\AdminPanel;

    session_start();

	class AdminPanelController{

		protected $twig;

		public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ; //load twig enviornment
            $this->twig = new \Twig_Environment($loader) ;
        }

        public function get(){

            if(isset($_SESSION["enrollment"]) && $_SESSION["is_admin"]>0)
            {
            	echo $this->twig->render("adminpanel.html",array(
                "title" => "AdminPanel"));
            }

            else
            {
                header("Location: /");
            }


        }


        public function post(){	//post executed when post request submitted (handeled by toro)
        	$title= $_POST["title"];
        	$question= $_POST["question"];
            $answer=$_POST["answer"];
            $points=$_POST["points"];
            // $no_of_users=0;

        	$result=AdminPanel::AddQuestion($title,$question,$answer,$points);
            
            if($result)
            {
                echo $this->twig->render("adminpanel.html",array(
                "title" => "AdminPanel",
                "message" => "Question Added Successfully !!"));
            }

            else
            {
                echo $this->twig->render("adminpanel.html",array(
                "title" => "AdminPanel",
                "message" => "There was a error while uploading the Question !!"));
            }
        }
    }

?>
