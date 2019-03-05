<?php

	require_once __DIR__ . "/../vendor/autoload.php";

	Toro::serve(array(
		"/"					=> "Controllers\\ProblemController",
		"/problem/([0-9]+)" => "Controllers\\QuestionController",
		"/edit/([0-9]+)"    => "Controllers\\EditQuestionController",
		"/signup"			=> "Controllers\\SignupController",
		"/login"  			=> "Controllers\\LoginController",
		"/logout"  			=> "Controllers\\LogoutController",
		"/admin"  			=> "Controllers\\AdminPanelController",
		"/leaderboard"		=> "Controllers\\LeaderboardController",
		"/profile"          => "Controllers\\ProfileController"
	))
?>