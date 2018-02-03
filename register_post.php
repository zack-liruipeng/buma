<?php

include_once dirname(__FILE__) . '/../config.php';
include_once dirname(__FILE__) . '/classes/reg.php';

// Get the data from the form
$email = isset($p['email']) ? $p['email'] : (isset($g['email']) ? $g['email'] : '');
$password = isset($p['password']) ? $p['password'] : (isset($g['password']) ? $g['password'] : '');
$username = isset($p['username']) ? $p['username'] : (isset($g['username']) ? $g['username'] : '');
//$userid = isset($p['user_id']) ? $p['user_id'] : (isset($g['user_id']) ? $g['user_id'] : '');

// Intantiate class
$register = new register;

// Set email,username,user_id and password
//if ($userid)
$register->setEmail($email);
// set password
$register->setPassword($password);
$register->setUsername($username);
//$register->setUserid($userid);
//register to the database
if ($result = $register->register() ){ 
	echo "Register successfully.";
	echo '<script language=javascript>   
    		function out(){ //
	       		document.location.href="login";  
   			 }	 
       		setTimeout("out()",2500);   
    	 </script>';
	echo "If the browser does not automatic jump. Please Click<a href='login'> here</a> to login";
}
?>
  
