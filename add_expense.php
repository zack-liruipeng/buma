<?php

include_once dirname(__FILE__) . '/config.php';
include_once dirname(__FILE__) . '/classes/expense.php';

$id = isset($p['id']) ? $p['id'] : (isset($g['id']) ? $g['id'] : '0');
$expense = new Expense;
$expense->setExpenseId($id);
$description = $expense->getDescription();
$budget_id = $expense->getBudgetId();
$amount = $expense->getAmount();

?><h1 class="page-title"><?php echo ($id ? 'Edit' : 'Add') ?> expense</h1>
<form class="form-horizontal" role="form" action="add_expense_post.php" id="add_expense_form">
    <div class="form-group">
    	<input type="hidden" name="expense_id" value="<?php echo $id; ?>">
        <label for="inputDescription" class="col-sm-2 control-label">Description:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="description" placeholder="Example: Black Shirt, St Paddy's Party, Friday's Pizza" value="<?php echo ($description ? $description : ''); ?>" />
        </div>
    </div>
    <div class="form-group">
   	    <label for="inputAmount" class="col-sm-2 control-label">Amount:</label>
   	    <div class="col-sm-10">
            <input type="text" class="form-control" name="amount" placeholder="Amount" value="<?php echo (strlen($amount) && ($amount > 0) ? $amount : ''); ?>" />
    	</div>
    </div>	
    <div class="form-group">
   	    <label for="input_budget_id" class="col-sm-2 control-label">Budget:</label>
        <div class="col-sm-10">
            <select class="form-control" id="input_budget_id" name="budget_id"><?php
            
                // Get the user budget's
                $connection = new createConnection();
                $connection->connectToDatabase();
                
                $sql = 'SELECT DISTINCT b.budget_id,
                                        c.name category_name,
                                        b.amount
                        FROM ' . $connection->database . '.budget b,
                             ' . $connection->database . '.category c
                        WHERE c.category_id = b.category_id AND
                              (b.user_id = ' . htmlentities($user_id) . ')
                        ORDER BY b.budget_id DESC';
                $budgets = $connection->runSqlWithReturn($sql);

                foreach ($budgets as $k => $budget)
                    echo '<option ' . (strlen($budget_id) && $budget_id == $budget['budget_id'] ? 'selected="selected"' : '') . ' value="' . $budget['budget_id'] . '">' . utf8_encode(ucfirst($budget['category_name'])) . ' - $' . utf8_encode(ucfirst($budget['amount'])) . '</option>';
                
                $connection->closeConnection();
            
            ?></select>
        </div>
    </div>

  
    <div class="form-group">
   		 <div class="col-sm-offset-2 col-sm-10">    	
            <button id="btn_add_expense_form" class="btn btn-lg btn-success btn-block" type="button">Add</button>
   		 </div>
    </div>

    <div class="alert my_alert"></div>
</form>
