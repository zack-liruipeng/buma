<?php
include_once dirname(__FILE__) . '/../config.php';
include_once dirname(__FILE__) . '/classes/connection.php';

/**
 * @class reg
 * Set up variable that need to be register into datatbase.
 *
 * @var userid
 * @var username
 * @var password
 * @var email
 * @var regdate
 */	
class register {
	public $userid;
	public $username;
	public $password;
	public $email;
	public $regdate;
	
    public function setUserid($userid_form) {
		$this->user_id = $userid_form;
    }
	
	public function setUsername($username_form) {
		$this->username = $username_form;
    }
	
	public function setPassword($password_form) {
		$this->password = $password_form;
    }
	
	 public function setEmail($email_form) {
		$this->email = $email_form;
    }
	 public function setDate() {
		$this->date = date();
	}
/*$userid = $_POST['user_id'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];*/

		
	public function register() {
		//connect to database
		$connection = new createConnection();
		$connection->connectToDatabase();
	
		//check if the email exist
		$sql = 'SELECT email
				FROM ' . $connection->database . '.user
				WHERE email = "' . htmlentities($this->email) . '"
				LIMIT 1';
		$user_data = $connection->runSqlWithReturn($sql);
		// If user exist
		foreach ($user_data as $k){
			if ($k['email']) {
			    echo "Email already exist. Please use other email for your account!";
				$connection->closeConnection();
				}
		}
		//if(mysql_fetch_array($check_query)){}
		//$password = MD5($password);
		if($user_data == ""){
			echo $sql = 'INSERT INTO ' . $connection->database . '.user
					(name,
					 password,
					 email)
					 VALUES
					 ("' . htmlentities($this->username) . '",
					  "' . htmlentities($this->password) . '",
					  "' . htmlentities($this->email) . '")';
			
			$return = $connection->runSql($sql);
			// Close database connection
			$connection->closeConnection();
			return $return . $sql;
		}
	}	
}   
?>
