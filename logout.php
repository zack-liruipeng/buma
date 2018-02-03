<?php

include_once dirname(__FILE__) . '/classes/login.php';

// Intantiate class
$login = new Login;

// Logout the user
$login->logOutUser();

?>
