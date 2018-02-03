<?php

include_once dirname(__FILE__) . '/../config.php';
include_once dirname(__FILE__) . '/classes/login.php';

// Get the data from the form
$email = isset($p['email']) ? $p['email'] : (isset($g['email']) ? $g['email'] : '');
$password = isset($p['password']) ? $p['password'] : (isset($g['password']) ? $g['password'] : '');

// Intantiate class
$login = new Login;

// Set email and password
$login->setEmail($email);
$login->setPassword($password);

// Test if the user is logged
if ($logged = $login->logUserIn()) {
	echo 'Logged in.';
} else echo 'Email or password incorrect.';

?>
