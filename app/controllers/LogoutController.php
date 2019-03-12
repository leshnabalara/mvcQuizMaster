<?php
    
    namespace Controllers;  //collection of classes 

    session_start();

    class LogoutController{

        protected $twig;

        public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ; //load twig enviornment
            $this->twig = new \Twig_Environment($loader) ;
        }

        public function get() {

            session_unset();
            session_destroy();

            echo $this->twig->render("login.html",array(
                "title" => "Login",
                "isNewUser" => false
            ));

        }

    }
?>