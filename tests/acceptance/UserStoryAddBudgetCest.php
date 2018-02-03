<?php
//use \WebGuy;

class UserStoryAddBudgetCest
{
		public function addCategory(\WebGuy $I) {
				LoginCest::login($I);	
				$I->wantTo('Add a new budget');
				$I->click('/html/body/div[1]/div/div[2]/ul/li[2]/a');
				$I->amOnPage('add_budget');
				$I->see('Add budget');

				// Looks for Amount and Category labels
				$I->see('#add_budget_form > div:nth-child(1) > div > input');
				$I->see('#category');

				// Fills in test input and test option
				$I->fillField('#add_budget_form > div:nth-child(1) > div > input', '100');
				$I->selectOption('#category', 'Clothing');

				// Update
				$I->click('#btn_add_budget_form');

				// Will see 'Budget added' if test has passed
				$I->see('Budget added');
		}

}
