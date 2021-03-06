<?php
    
    namespace Controllers;  //collection of classes 
    use Models\Users;

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
                $user=Users::GetInfo();

                echo $this->twig->render("profile.html",array(
                    "title" => "Profile",
                    "user"=> $user,
                    "loggedin" => isset($_SESSION["enrollment"])));
            }

            else
            {

                echo $this->twig->render("guest.html",array(
                    "title" => "Guest",
                    "loggedin" => isset($_SESSION["enrollment"])));
            }

        }

    }

?>
