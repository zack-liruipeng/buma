<?php

include_once dirname(__FILE__) . '/../config.php';

/**
 * @class login
 * Create a class for get and manage form data
 *
 * @var email
 * @var password
 * @var connection
 * @var user_data
 */	
class Login {
    public $email;
    public $password;

    public function setEmail($email_form) {
		$this->email = $email_form;
    }

    public function setPassword($password_form) {
		$this->password = $password_form;
    }
	
	public function logUserIn() {
		// Connect to the database
		$connection = new createConnection();
		$connection->connectToDatabase();
		
		// Insert the budget
		$sql = 'SELECT user_id, name
				FROM ' . $connection->database . '.user
				WHERE email = "' . htmlentities($this->email) . '" AND
					  password = "' . htmlentities($this->password) . '"
				LIMIT 1';
		$user_data = $connection->runSqlWithReturn($sql);
		
		// If user exist
		foreach ($user_data as $k)
			if ($k['user_id']) {
				// Store the user into a session
				$_SESSION['user_id'] = $k['user_id'];
				$_SESSION['user_name'] = $k['name'];
				$_SESSION['email'] = $this->email;
				$_SESSION['password'] = $this->password;
				return true;
			}
		
		// Close database connection
		$connection->closeConnection();
		
		return false;
	}
	
	public function userLogged() {
		if (!isset($_SESSION['user_id'])) {
			$this->logOutUser();
			return false;
		} else {
			$this->setEmail($_SESSION['email']);
			$this->setPassword($_SESSION['password']);
			/*if (!$this->userLogged()) $this->logOutUser();*/
		}
		return true;
	}
	
	public function userLoggedNoReturn() {
		if (isset($_SESSION['user_id'])) return true;
		return false;
	}
	
	public function logOutUser() {
		unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['email'], $_SESSION['password']);
		header("Location: login");
		return true;
	}
}

?>
