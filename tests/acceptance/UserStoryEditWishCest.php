<?php
use \WebGuy;

class UserStoryEditWishCest
{

    public function _before()
    {
    }

    public function _after()
    {
    }

		// Edit wish - user is successful
		public function editWishSuccessful($I) {
				LoginCest::login($I);	
				$I->wantTo('Edit a wish to change item in wish or amount the item costs');
				$I->amOnPage('wish_list');
					
				// Update
				$I->click('#wish_list_form > button:nth-child(7) > span');
				
				$I->see('Item');
				$I->see('amount');
				
				// Changes wish item or item amount
				$I->fillField('wishItem', 'Laptop');
				$I->fillField('itemCost', '1000');

				// Will see 'Information updated' if test has passed
				$I->see('Information updated');
		}
		
		// Error message if item has already been added to wishlist
		public function editWishItemDouble($I) {
				LoginCest::login($I);	
				$I->wantTo('Edit a wish but try to add an item that already exists');
				$I->amOnPage('wish_list');

				// Add wish first time
				$I->click('#my_wish');
				// Changes wish item or item amount
				$I->fillField('itemName', 'Laptop');
				$I->fillField('inputAmount', '1000');
				$I->click('#new_wish > div:nth-child(4) > div > a');
				
				// Add new item
				$I->click('#my_wish');
				// Changes wish item or item amount
				$I->fillField('itemName', 'Stuff');
				$I->fillField('inputAmount', '100');
				$I->click('#new_wish > div:nth-child(4) > div > a');
				
				// Edit
				$I->click('#wish_list_form > button:nth-child(7) > span');
				// Changes wish item or item amount
				$I->fillField('wishItem', 'Laptop');
				$I->fillField('itemCost', '@#%^1000');

				// Will see 'Information updated' if test has passed
				$I->see('Error: cannot ask for same wish twice');
		}

		// Value error
		public function editWishValueError($I) {
				LoginCest::login($I);	
				$I->wantTo('Edit a wish but try to enter a non-numerical value');
				$I->amOnPage('wish_list');

				// Update
				$I->click('#wish_list_form > button:nth-child(7) > span');

				// Changes wish item or item amount
				$I->fillField('wishItem', 'Laptop');
				$I->fillField('itemCost', 'Laptop');

				// Will see 'Information updated' if test has passed
				$I->see('Error: amount field must be a number');
		}

}
