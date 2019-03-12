<?php
    
	namespace Controllers;	//collection of classes 
	use Models\Users;

    session_start();

	class SignupController{

		protected $twig;

		public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ; //load twig enviornment
            $this->twig = new \Twig_Environment($loader) ;
        }

        public function get(){
        	echo $this->twig->render("login.html",array(
        		"title" => "Signup",
                "newuser" => true));

        }


        public function post(){	//post executed when post request submitted (handeled by toro)
        	$username= $_POST["username"];
        	$password= $_POST["password"];
            $enrollment=$_POST["enrollment"];
            // $score=0;

            if(isset($username) &&
               isset($password) &&
               isset($enrollment)){

            	Users::AddUser($username,$password,$enrollment);
                
                $_SESSION["enrollment"] = $enrollment;
                $_SESSION["is_admin"]=0;

                    header("Location: /");
            }

            else{

                get();

            }


        }
    }

?>
