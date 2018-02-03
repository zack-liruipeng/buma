<?php

// Get the user categories
$connection = new createConnection();
$connection->connectToDatabase();

$sql = 'SELECT b.budget_id,
			   c.name,
			   b.amount
		FROM ' . $connection->database . '.category c, ' . $connection->database . '.budget b 
		WHERE b.user_id = ' . htmlentities($user_id) . '
			   AND b.category_id = c.category_id
		ORDER BY c.name ASC';
		
$budgets = $connection->runSqlWithReturn($sql);

$sql = 'SELECT w.name,
               w.price,
               w.wish_list_id
        FROM ' . $connection->database . '.wish_list w 
        WHERE w.user_id = ' . htmlentities($user_id) . '
        ORDER BY w.name ASC';
        
    $wishes = $connection->runSqlWithReturn($sql);


if (count($budgets)) {
	foreach ($budgets as $k => $budget){
		$TotalAmount = $TotalAmount + $budget['amount'];
	}
	
	$sql = 'SELECT sum(e.amount) as TotalAmount
		FROM ' . $connection->database . '.expense e, ' . $connection->database . '.budget b
		WHERE b.user_id = ' . htmlentities($user_id) . '
			   AND b.budget_id = e.budget_id';
	
	$TotalSpentAmount = $connection->runSqlWithReturn($sql);
	foreach ($TotalSpentAmount as $t){
		$TotalSpent = $t["TotalAmount"];
		if($t["TotalAmount"] > $TotalAmount){
			echo '<div><h4>Total Limit: $'. number_format($TotalAmount, 2, '.', ',') . '</h4>
				  <h4 class="red-color">Total Spent: $'. number_format($t["TotalAmount"], 2, '.', ',') . '</h4>';
		} else	echo '<div><h4>Total Limit: $'. number_format($TotalAmount, 2, '.', ',') . '</h4>
			  <h4>Total Spent: $'. number_format($t["TotalAmount"], 2, '.', ',') . '</h4>'; 
	
	if (count($wishes)){
		$saved = $TotalAmount - $TotalSpent;
		foreach ($wishes as $w) {
			if($w["price"] <= $saved) {
				echo '<div class="form-horizontal"><a href="/group11/buma/wish_list" style="text-decoration: none;"><button class="btn btn-success btn-block" style="color: yellow; float: center; margin-left: auto; margin-right: auto; text-decoration: none;"><span style="color: yellow;" class="glyphicon glyphicon-star"></span>&nbsp;&nbsp;Complete your wishes!</button></a></div>';
				break;
			}
		}
	}	
	echo'<table class="table budgets_home">
			<thead>
				<tr>
					<th><h5><b></b></h5></th>
					<th><h5><b>Spent</b></h5></th>
					<th><h5><b>Limit</b></h5></th>
					<th id="nowrap"></th>
				</tr>
			</thead>
			<tbody>';
	}
	
	$count = 1;
	foreach ($budgets as $k => $budget){
		$sql = 'SELECT e.description,
			   e.amount,
			   e.expense_id,
			   DATE_FORMAT(e.date, "%d/%m") as date
		FROM ' . $connection->database . '.expense e 
		WHERE e.budget_id = ' . htmlentities($budget['budget_id']) . '
			ORDER BY e.date ASC';
		
		$expenses = $connection->runSqlWithReturn($sql);

		$sql = 'SELECT sum(e.amount) as sumAmount
		FROM ' . $connection->database . '.expense e 
		WHERE e.budget_id = ' . htmlentities($budget['budget_id']) . '';	

		
		$amounts = $connection->runSqlWithReturn($sql);
		$count++;
		foreach ($amounts as $amount)
		echo '<tr class="' . ($count % 2 ? 'warning' : 'success') . '">
				<td>
					<h5><b>' . utf8_encode(ucfirst($budget['name'])) . '</b></h5>
				</td>
				<td>'; 
		if($amount['sumAmount'] > $budget['amount']){
			echo '<h5 class="red-color"><b>'."$".'' . ($amount['sumAmount'] == "" ? '0' : $amount['sumAmount']) . '</b></h5>';
		} else 	echo '<h5><b>'."$".'' . ($amount['sumAmount'] == "" ? '0' : $amount['sumAmount']) . '</b></h5>';
		echo'</td>
				<td>
					<h5><b>'."$".'' . $budget['amount'] . '</b></h5>
				</td>				
				<td id="nowrap">
					<a href="add_budget/' . $budget['budget_id'] . '">
						<button class="btn btn-default">
							<span class="glyphicon glyphicon-pencil"></span>
						</button>
					</a>
					<span class="btn-space"></span>
					<span class="budget_id">' . $budget['budget_id'] . '</span>
					<button class="btn btn-default btn_delete">
						<span class="glyphicon glyphicon-trash"></span>
					</button>
				</td>
			  </tr>';
			  foreach ($expenses as $e => $expense){
				  echo '<tr class="' . ($count % 2 ? 'warning' : 'success') . '">
					<td>
						<h5>&nbsp;&nbsp;&nbsp;&nbsp;' . $expense['description'] . ''." - ".'' . $expense['date'] . '</h5>
					</td>
					<td>
						<h5>'."$".'' . $expense['amount'] . '</h5>
					</td>
					<td>
					</td>				
					<td id="nowrap">
						<a href="add_expense/' . $expense['expense_id'] . '">
							<button class="btn btn-default">
								<span class="glyphicon glyphicon-pencil"></span>
							</button>
						</a>
						<span class="btn-space"></span>
						<span class="expense_id">' . $expense['expense_id'] . '</span>
						<button class="delete_expense btn btn-default btn_delete">
							<span class="glyphicon glyphicon-trash"></span>
						</button>
					</td>
				  </tr>			  ';
				}			
	}
	
	echo '</table>
		</tbody>';
} else {
	echo '<h4 class="txt_home_center">' . utf8_encode(ucfirst($_SESSION['user_name'])) . ', welcome to <b>BUMA</b>!<br/><br/>You don\'t have any created budget yet =( </h4>';
}
$connection->closeConnection();

?>
