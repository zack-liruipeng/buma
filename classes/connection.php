<?php

/**
 * @class connection
 * Create a class for make connection
 *
 * @var host
 * @var username
 * @var password
 * @var database
 * @var myconn
 */	
class createConnection {
    var $host = "localhost";
    var $username = "group11";
    var $password = "group11";
    var $database = "group11";
    var $myconn;
	
	/*var $host = "db.cs.dal.ca";
    var $username = "wegner";
    var $password = "B00664377";
    var $database = "wegner";
    var $myconn;*/

	// Create a function for connect database
    function connectToDatabase() {
		// Try to connect
        $conn = mysql_connect($this->host,$this->username,$this->password);

		// Testing the connection
        if(!$conn) die ("Cannot connect to the database");
        else $this->myconn = $conn;

        return $conn;
    }
	
	// Run MySQL query without return of values from the database
	function runSql($sql) {
		// Run the SQL
		return mysql_query($sql, $this->myconn);
	}
	
	function runSqlWithReturn($sql) {
		// Run the SQL
		$query = mysql_query($sql, $this->myconn);
		
		// Get the result from the database
		while($row = mysql_fetch_assoc($query))
			$result[] = $row;
			
		return $result;
	}

    /*function selectDatabase() // selecting the database.
    {
        mysql_select_db($this->database);  //use php inbuild functions for select database

        if(mysql_error()) // if error occured display the error message
        {

            echo "Cannot find the database ".$this->database;

        }
         echo "Database selected..";       
    }*/

    function closeConnection() {
		// Close the connection
        mysql_close($this->myconn);
    }
}

?>
