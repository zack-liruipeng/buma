<?php
use \WebGuy;

class UserStoryCreateWishCest
{

    public function _before()
    {
    }

    public function _after()
    {
    }

		// Add new wish successfully
		public function addWishSuccess($I) {
		
		}
		
		public function additem($I) {
				LoginCest::login($I);	
				$I->wantTo('Error check - new wish added');
				$I->amOnPage('wish_list');

				// Looks for Item and Cost categories
				
				
				$I->click('#my_wish');
				$I->see('Item');
				$I->see('amount');

				// Fills in test input and test option
				$I->fillField('wishItem', 'Laptop');
				$I->fillField('itemCost', '1000');

				// Update
				$I->click('#new_wish > div:nth-child(4) > div > a');

				// Will see below text if test has passed
				$I->see('Item added to wish list!');
		}
	
		// New wish - error in value
		public function valueError($I) {
				LoginCest::login($I);	
				$I->wantTo('Error check - new wish added');
				$I->amOnPage('wish_list');

				// Looks for Item and Cost categories
				$I->see('Item');
				$I->see('amount');

				// Fills in test input and test option
				$I->fillField('wishItem', 'Laptop');
				$I->fillField('itemCost', '@#%^1000');

				// Update
				$I->click('#new_wish > div:nth-child(4) > div > a');

				// Will see below text if test has passed
				$I->see('Item cost is not valid - please enter your price as an integer (ex: 100)');
		}
		
		//Item addition error (item already in wish list)
		public function duplicateError($I) {
				LoginCest::login($I);	
				$I->wantTo('Error check - duplicate wishes');
				$I->amOnPage('wish_list');
				
				//Look for Iteam, and Value
				$I->see('Item');
				$I->see('amount');
				
				//Fill in fields with rest items
				$I->fillField('Item', 'test item');
				$I->fillField('itemCost', '100');
				
				//Update
				$I->click('#new_wish > div:nth-child(4) > div > a');
				
				//Confirm item was added.
				$I->see('Wish added');
				
				//Fill in fields with duplicate item
				$I->fillField('Item', 'test item');
				$I->fillField('itemCost', '100');
				
				//Update
				$I->click('Add');
				
				//Make sure error message appeared.
				$I->see('Duplicate item, wish rejected.');
		}
		// TESTS TO COMPLETE
		// Success message if item added to wishlist
		public function CheckMessage($I) {
				LoginCest::login($I);
				$I->wantTo('check if wish added message appears on page');
				$I->amOnPage('wish_list');
				
				$I->see('Item');
				$I->see('amount');
				
				$I->fillField('Item', 'test');
    				$I->fillField('itemCost', '50');
				
				$I->click('#new_wish > div:nth-child(4) > div > a');
			        //Should see success message.
				$I->see('Wish added');
		}
		// Show item added in database
		
  
}		  
