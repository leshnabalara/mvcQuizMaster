<?php
    
	namespace Controllers;	//collection of classes 
	use Models\Problems;

    session_start();

	class ProblemController{

		protected $twig;

		public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ; //load twig enviornment
            $this->twig = new \Twig_Environment($loader) ;
        }


        public function get(){
            $rows=Problems::ProblemList();

            echo $this->twig->render("problems.html",array(
                "title" => "Problems",
                "problemlist"=> $rows,
                "is_admin" => $_SESSION["is_admin"],
                "loggedin" => isset($_SESSION["enrollment"])));

        }

    }

?>
