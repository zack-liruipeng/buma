<?php
include_once dirname(__FILE__) . '/../config.php';
include_once dirname(__FILE__) . '/classes/forgot.php';

// Get the data from the form
$email = isset($p['email']) ? $p['email'] : (isset($g['email']) ? $g['email'] : '');

// Intantiate class

$forgot = new forgot();

// Set email and password
$forgot->setEmail($email);

// Test if the user is logged
if($result = $forgot->checkemail())
	{
		$forgot->sentemail();
		echo "Retrieve your password in your email"; 
	
	//This statement does not working!!!!!!!!
		/*if($send = $forgot->sentemail())
		{
		echo "   check mail".
		}*/
	}
	else 
	{
	echo "Email does not match. Please enter a correct email address";
	}
?>