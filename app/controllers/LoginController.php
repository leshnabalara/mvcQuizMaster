<?php
    
	namespace Controllers;	//collection of classes 
	use Models\Users;

    session_start();

	class LoginController{

		protected $twig;

		public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ; //load twig enviornment
            $this->twig = new \Twig_Environment($loader) ;
        }

        public function get() {
        	echo $this->twig->render("login.html",array(
        		"title" => "Login",
                "newuser" => false
            ));

        }


        public function post(){	//post executed when post request submitted (handeled by toro)
        	$enrollment= $_POST["enrollment"];
        	$password= $_POST["password"];

            if(isset($enrollment) &&
               isset($password) &&
               Users::ValidateUser($enrollment,$password))
            {   $_SESSION["enrollment"] = $enrollment;
                $_SESSION["is_admin"] = Users::Admin($enrollment);
                header("Location: /");
            }

            else{
                echo $this->twig->render("login.html",array(
                "title" => "Login",
                "error" => "Invalid Username or Password"));

            }
        }
    }
?>