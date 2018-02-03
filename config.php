<?php

include_once dirname(__FILE__) . '/classes/connection.php';

// Get the get and post
$p = $_POST;
$g = $_GET;

// Current page
$file = isset($p['file']) ? $p['file'] : (isset($g['file']) ? $g['file'] : 'login');

// Start the session
session_start();

include_once dirname(__FILE__) . '/classes/login.php';

// Intantiate class
$login = new Login;

// Test if the user is logged
if (!in_array($file, array('login', 'register', 'forgot')) && $logged = $login->userLogged()) {
	//echo 1;
	$user_id = $_SESSION['user_id'];
	$user_name = $_SESSION['user_name'];
} else if ($file == "login" && ($login->userLoggedNoReturn())) {
	//echo 2;
	//header("Location: home");
}

?>
