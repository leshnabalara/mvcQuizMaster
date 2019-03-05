<?php
    
	namespace Controllers;	//collection of classes 
	use Models\Profile;

    session_start();

	class ProfileController{

		protected $twig;

		public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ; //load twig enviornment
            $this->twig = new \Twig_Environment($loader) ;
        }


        public function get(){
            if(isset($_SESSION["enrollment"]))
            {
                $user=Profile::GetInfo();

                echo $this->twig->render("profile.html",array(
                    "title" => "Profile",
                    "user"=> $user));
            }

            else
            {

                echo $this->twig->render("guest.html",array(
                    "title" => "Guest"));
            }

        }

    }

?>
