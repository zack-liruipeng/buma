<?php

include_once dirname(__FILE__) . '/../config.php';
include_once dirname(__FILE__) . '/classes/budget.php';

// Get the data from the form
$action = isset($p['action']) ? $p['action'] : (isset($g['action']) ? $g['action'] : 'insert');
$budget_id = isset($p['budget_id']) ? $p['budget_id'] : (isset($g['budget_id']) ? $g['budget_id'] : '');
//$user_id = isset($p['user_id']) ? $p['user_id'] : (isset($g['user_id']) ? $g['user_id'] : '');
$category_id = isset($p['category_id']) ? $p['category_id'] : (isset($g['category_id']) ? $g['category_id'] : '');
$amount = isset($p['amount']) ? $p['amount'] : (isset($g['amount']) ? $g['amount'] : '');
$new_category = isset($p['new_category']) ? $p['new_category'] : (isset($g['new_category']) ? $g['new_category'] : '');

// Intantiate class
$budget = new Budget;

if ($action == 'insert') {
	if ($add_category = ($category_id == 'other' && strlen($new_category)))
	$category_id = $budget->addCategory($new_category);
	
	$budget->setCategoryId($category_id);
	$budget->setAmount($amount);
	
	if ($result = $budget->addBudget()) echo "Budget added.";
	else echo "An internal error occurred. " . $result;
} else if  ($action == 'edit') {
	if ($add_category = ($category_id == 'other' && strlen($new_category)))
	$category_id = $budget->addCategory($new_category);
	
	$budget->setBudgetId($budget_id);
	$budget->setCategoryId($category_id);
	$budget->setAmount($amount);
	
	if ($result = $budget->editBudget()) echo "Budget edited.";
	else echo "An internal error occurred. " . $result;
} else if  ($action == 'delete') {
	$budget->setBudgetId($budget_id);
	
	if ($result = $budget->deleteBudget()) echo "Budget deleted.";
	else echo "An internal error occurred. " . $result;
}

?>