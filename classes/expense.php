<?php

include_once dirname(__FILE__) . '/../config.php';

/**
 * @class expense
 * Create a class for get and manage form data
 *
 * @var expense_id
 * @var budget_id
 * @var amount
 * @var description
 * @var connection
 */	
class Expense {
    private $expense_id;
    private $amount;
    private $budget_id;
    private $description;
	
    public function setBudgetId($budget_id_form) {
		$this->budget_id = $budget_id_form;
    }
	
    public function setExpenseId($expense_id_form) {
		$this->expense_id = $expense_id_form;
    }
	
    public function setAmount($amount_form) {
		$this->amount = $amount_form;
    }

    public function setDescription($description_form) {
		$this->description = $description_form;
    }
    public function getDescription(){
		// Connect to the database
		$connection = new createConnection();
		$connection->connectToDatabase();
		
		/*	Get the category id using the budget id	*/
		$sql = 'SELECT DISTINCT description
				FROM ' . $connection->database . '.expense
				WHERE "' . strtolower(htmlentities($this->expense_id)) . '" = expense_id';
		$description_db = $connection->runSqlWithReturn($sql);

		// Close database connection
		$connection->closeConnection();
		
		$description = 0;
		foreach ($description_db as $k) $description = $k['description'];
		
        return $description;
    }
    public function getBudgetId(){
		// Connect to the database
		$connection = new createConnection();
		$connection->connectToDatabase();
		
		/*	Get the category id using the budget id	*/
		$sql = 'SELECT DISTINCT budget_id
				FROM ' . $connection->database . '.expense
				WHERE "' . strtolower(htmlentities($this->expense_id)) . '" = expense_id';
		$budget_id_db = $connection->runSqlWithReturn($sql);

		// Close database connection
		$connection->closeConnection();
		
		$budget_id = 0;
		foreach ($budget_id_db as $k) $budget_id = $k['budget_id'];
		
        return $budget_id;
    }
    public function getAmount(){
		// Connect to the database
		$connection = new createConnection();
		$connection->connectToDatabase();
		
		/*	Get the category id using the budget id	*/
		$sql = 'SELECT DISTINCT amount
				FROM ' . $connection->database . '.expense
				WHERE "' . strtolower(htmlentities($this->expense_id)) . '" = expense_id';
		$amount_db = $connection->runSqlWithReturn($sql);

		// Close database connection
		$connection->closeConnection();
		
		$amount = 0;
		foreach ($amount_db as $k) $amount = $k['amount'];
		
        return $amount;
    }
	public function editExpense(){
		// Connect to the database
		$connection = new createConnection();
		$connection->connectToDatabase();
		
		// Edit the budget
		$sql = 'UPDATE ' . $connection->database . '.expense SET
				budget_id = "' . htmlentities($this->budget_id) . '",
				amount = "' . htmlentities($this->amount) . '",
				description = "' . htmlentities($this->description) . '"
				WHERE expense_id = "' . htmlentities($this->expense_id) . '"';
		
		$return = $connection->runSql($sql);
		
		// Close database connection
		$connection->closeConnection();
		
		return $return;
	}
	public function deleteExpense(){
		$connection = new createConnection();
		$connection->connectToDatabase();
		
		// Edit the budget
		$sql = 'DELETE FROM ' . $connection->database . '.expense
				WHERE expense_id = "' . htmlentities($this->expense_id) . '"';
		
		$return = $connection->runSql($sql);
		// Close database connection
		$connection->closeConnection();
		
		return $sql;		
	}
	public function addExpense() {
		// Connect to the database
		$connection = new createConnection();
		$connection->connectToDatabase();
		
		// Insert the budget
		$sql = 'INSERT INTO ' . $connection->database . '.expense
				(budget_id,
				 amount,
				 description,
				 date)
				VALUES
				("' . htmlentities($this->budget_id) . '",
				 "' . htmlentities($this->amount) . '",
				 "' . htmlentities($this->description) . '",
				 NOW())';
		$return = $connection->runSql($sql);
		
		// Close database connection
		$connection->closeConnection();
		
		return $return;
	}
	
	/*public function deleteBudget() {
		// Connect to the database
		$connection = new createConnection();
		$connection->connectToDatabase();
		
		// Edit the budget
		$sql = 'DELETE FROM ' . $connection->database . '.budget
				WHERE budget_id = "' . htmlentities($this->budget_id) . '"';
		
		$return = $connection->runSql($sql);
		// Close database connection
		$connection->closeConnection();
		
		return $sql;
	}*/
}

?>
