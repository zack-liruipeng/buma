<?php

include_once dirname(__FILE__) . '/../config.php';

/**
 * @class wish_list
 * Create a class for get and manage form data
 *
 * @var wish_id
 * @var description
 * @var amount
 */	
class WishList {
    public $wish_id;
    public $description;
    public $amount;

    public function setWishId($wish_id_form) {
		$this->wish_id = $wish_id_form;
    }

    public function setDescription($description_form) {
		$this->description = $description_form;
    }
	
    public function setAmount($amount_form) {
		$this->amount = $amount_form;
    }
	
	public function getDescription() {
        // Connect to the database
		$connection = new createConnection();
		$connection->connectToDatabase();
		
		/*	Get the description using the budget id	*/
		$sql = 'SELECT DISTINCT name as description
				FROM ' . $connection->database . '.wish_list
				WHERE "' . strtolower(htmlentities($this->wish_id)) . '" = wish_list_id';
		$description_db = $connection->runSqlWithReturn($sql);

		// Close database connection
		$connection->closeConnection();
		
		$description = '';
		foreach ($description_db as $k) $description = $k['description'];
		
        return $description;
    }
	
	public function getAmount() {
        // Connect to the database
		$connection = new createConnection();
		$connection->connectToDatabase();
		
		/*	Get the amount using the budget id	*/
		$sql = 'SELECT DISTINCT price as amount
				FROM ' . $connection->database . '.wish_list
				WHERE "' . strtolower(htmlentities($this->wish_id)) . '" = wish_list_id';
		$amount_db = $connection->runSqlWithReturn($sql);

		// Close database connection
		$connection->closeConnection();
		
		$amount = 0;
		foreach ($amount_db as $k) $amount = $k['amount'];
		
        return $amount;
    }
	
	public function addWish() {
		// Connect to the database
		$connection = new createConnection();
		$connection->connectToDatabase();
		
		// Insert the wish
		$sql = 'INSERT INTO ' . $connection->database . '.wish_list
				(user_id,
				 name,
				 price)
				VALUES
				("' . htmlentities($_SESSION['user_id']) . '",
				 "' . htmlentities($this->description) . '",
				 "' . htmlentities($this->amount) . '")';
		$return = $connection->runSql($sql);
		
		// Close database connection
		$connection->closeConnection();
		
		return $return;
	}
	
	public function deleteWish() {
		// Connect to the database
		$connection = new createConnection();
		$connection->connectToDatabase();
		
		// Delete the wish
		$sql = 'DELETE FROM ' . $connection->database . '.wish_list
				WHERE wish_list_id = "' . htmlentities($this->wish_id) . '"';
		
		$return = $connection->runSql($sql);
		// Close database connection
		$connection->closeConnection();
		
		return $return;
	}
	
	public function completeWish() {
		// Connect to the database
		$connection = new createConnection();
		$connection->connectToDatabase();
		
		// Complete the wish
		$sql = 'UPDATE ' . $connection->database . '.wish_list SET
				status = "' . htmlentities('C') . '"
				WHERE wish_list_id = "' . htmlentities($this->wish_id) . '"';
		
		$return = $connection->runSql($sql);
		// Close database connection
		$connection->closeConnection();
		
		return $return;
	}
	
	public function editWish() {
		// Connect to the database
		$connection = new createConnection();
		$connection->connectToDatabase();
		
		// Edit the budget
		$sql = 'UPDATE ' . $connection->database . '.wish_list SET
				name = "' . htmlentities($this->description) . '",
				price = "' . htmlentities($this->amount) . '"
				WHERE wish_list_id = "' . htmlentities($this->wish_id) . '"';
		
		$return = $connection->runSql($sql);
		
		// Close database connection
		$connection->closeConnection();
		
		return $return;
	}
}

?>
