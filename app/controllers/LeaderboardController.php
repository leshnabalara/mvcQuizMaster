<?php
    
    namespace Controllers;  //collection of classes 
    use Models\Users;

    session_start();

    class LeaderboardController{

        protected $twig;

        public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ; //load twig enviornment
            $this->twig = new \Twig_Environment($loader) ;
        }


        public function get(){
            $rows=Users::UserList();
            // $is_admin=$_SESSION["is_admin"];

            echo $this->twig->render("leaderboard.html",array(
                "title" => "Leaderboard",
                "userlist"=> $rows,
                "is_admin" => $_SESSION["is_admin"],
                "loggedin" => isset($_SESSION["enrollment"])));

        }

    }

?>