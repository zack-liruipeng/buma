<?php
use \WebGuy;

class UserStoryAddExpenseCest
{

				
				public function invaildAmount($I){
								LoginCest::login($I);	
								$I->click('body > div.navbar.navbar-inverse.navbar-fixed-top > div > div.navbar-collapse.in > ul > li:nth-child(4) > a');
								$I->amOnPage('add_expense');
								$I->see('Add expense');

								//Enter the information

								//For this test, we need to enter an empty amount to fail the registeration
								$I->fillField('#add_expense_form > div:nth-child(1) > div > input','it is my expeence for');
								$I->fillField('#add_expense_form > div:nth-child(2) > div > input', '');


								//The user can not create the expense with an a empty amount and stay in the add expense page and see an error message
								$I->see('add_expense');
								$I->see('Fill the AMOUNT field correctly.');

				}


				public function invaildDescribtion($I){
								LoginCest::login($I);	
								$I->click('body > div.navbar.navbar-inverse.navbar-fixed-top > div > div.navbar-collapse.in > ul > li:nth-child(4) > a');
								$I->amOnPage('add_expense');
								$I->see('Add expense');

								//Enter the information

								//For this test, we need to enter an empty amount to fail the registeration
								$I->fillField('#add_expense_form > div:nth-child(1) > div > input','');
								$I->fillField('#add_expense_form > div:nth-child(2) > div > input', '100');


								//The user can not create the expense with an a empty amount and stay in the add expense page and see an error message
								$I->click('#btn_add_expense_form');
								$I->see('Fill the Description field correctly.');

				}


				public function tryToTest(WebGuy $I) {
								LoginCest::login($I);	
								$I->wantTo('Add new expense');
								$I->click('body > div.navbar.navbar-inverse.navbar-fixed-top > div > div.navbar-collapse.in > ul > li:nth-child(4) > a');
								$I->amOnPage('add_expense');
								$I->see('Add expense');

								//Look for Amount and Category labels
								$I ->see('#add_expense_form > div:nth-child(1) > div > input');
								$I->see('#add_expense_form > div:nth-child(2) > div > input');
								$I->see('#input_budget_id');

								// Fills in test input and test option
								$I->fillField('#add_expense_form > div:nth-child(1) > div > input','it is my expeence for');
								$I->fillField('#add_expense_form > div:nth-child(2) > div > input', '100');
								$I->selectOption('#input_budget_id', 'Clothing');

								// Update
								$I->click('#btn_add_expense_form');

								// Will see 'Expense added' if test has passed
								$I->see('Expense added.');
				}

}
