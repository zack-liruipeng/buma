<?php

include_once dirname(__FILE__) . '/../config.php';
include_once dirname(__FILE__) . '/classes/expense.php';

// Get the data from the form
$expense_id = isset($p['expense_id']) ? $p['expense_id'] : (isset($g['expense_id']) ? $g['expense_id'] : '');
$budget_id = isset($p['budget_id']) ? $p['budget_id'] : (isset($g['budget_id']) ? $g['budget_id'] : '');
$amount = isset($p['amount']) ? $p['amount'] : (isset($g['amount']) ? $g['amount'] : '');
$description = isset($p['description']) ? $p['description'] : (isset($g['description']) ? $g['description'] : '');
$action = isset($p['action']) ? $p['action'] : (isset($g['action']) ? $g['action'] : 'insert');


// Intantiate class
$expense = new Expense;

if ($action == 'insert') {
	$expense->setBudgetId($budget_id);
	$expense->setAmount($amount);
	$expense->setDescription($description);
	if ($result = $expense->addExpense()) echo "Expense added.";
	else echo "An internal error occurred. " . $result;
} 
else if  ($action == 'edit') {
	$expense->setBudgetId($budget_id);
	$expense->setAmount($amount);
	$expense->setDescription($description);
	$expense->setExpenseID($expense_id);
	if ($result = $expense->editExpense()) echo "Expense edited.";
	else echo "An internal error occurred. " . $result;		
		} 
else if  ($action == 'delete') {
	$expense->setExpenseID($expense_id);
	if ($result = $expense->deleteExpense()) echo "Expense deleted.";
	else echo "An internal error occurred. " . $result;	
}
?>