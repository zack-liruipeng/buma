<?php
include_once dirname(__FILE__) . '/../config.php';
include_once dirname(__FILE__) . '/classes/connection.php';
 

/**
 * @class forgot
 * Set up variable that need to be register into datatbase.
 *
 * @var email
 * @var user_data
 * @var sql
 * @var connection
 */	
class forgot {
	public $email;

	
	 public function setEmail($email_form) {
		$this->email = $email_form;
    }	

	
	public function checkemail() {
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
		foreach ($user_data as $k)
			if ($k['email']) {
			    //echo "Please go to your email account to receive instruction.";
				$connection->closeConnection();
				
				return True;

				}
			else {
				$connection->closeConnection();
				return false;
			}
	}
	
	public function sentemail() {
			$connection = new createConnection();
			$connection->connectToDatabase();  
			$sql = 'SELECT email, password, name
					FROM ' . $connection->database . '.user
					WHERE email = "' . htmlentities($this->email) . '"
					LIMIT 1';
			$user_data = $connection->runSqlWithReturn($sql);
			
			foreach ($user_data as $k){
				$email = $k['email'];
				$password =$k['password'];
				$name = $k['name'];
			}	

			//mail body
			$mailbody = "Dear $name" .","."<br> Your password is: $password <br><br>Automatic message.Please do not reply this email";    

			//mail header
			$headers = 'MIME-Version: 1.0' . "\r\n".
				'Content-type: text/html; charset=iso-8859-1' . "\r\n".
			    'From: BUMA' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();
			// send mail    
			mail($email, "[BUMA] Retrieve Password", $mailbody, $headers);				
			return true;
	}
	
		
}   
?>
