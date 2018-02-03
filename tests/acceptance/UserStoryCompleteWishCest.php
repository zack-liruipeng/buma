<?php
use \WebGuy;

class UserStoryCompleteWishCest
{

		// Complete an item on wish list if user has saved enough money
		public function completeWishSuccess($I) {
				LoginCest::login($I);	
				$I->wantTo('Complete item on wish list');
				$I->click('body > div.navbar.navbar-inverse.navbar-fixed-top > div > div.navbar-collapse.in > ul > li:nth-child(6) > a');
				$I->amOnPage('wish_list');
				
				// Complete code
				$I->click('#wish_list_form > button:nth-child(5)');

				// Will see the below text if test has passed
				$I->see('Your wish has been granted! Congrats!');
		}
		
		// Provides an error when user has not saved enough money
		public function completeWishFail($I) {
				LoginCest::login($I);	
				$I->wantTo('Complete item on wish list');
				$I->click('body > div.navbar.navbar-inverse.navbar-fixed-top > div > div.navbar-collapse.in > ul > li:nth-child(6) > a');
				$I->amOnPage('wish_list');
                            
				// Complete code
				$I->click('#wish_list_form > button:nth-child(5)');

				// Will see the below text if test has passed
				$I->see('Sorry, you have not saved enough money yet.');
		}
		
		//Show wish has been removed on screen.
		// TODO WISH LIST IS NOT WORKING CORRECTLY - WILL FIX FIELDS ONCE THIS IS FIXED
		public function completeWishRemoved($I) {
				LoginCest::login($I);	
				$I->wantTo('Remove Wish from page after completion');
				$I->click('body > div.navbar.navbar-inverse.navbar-fixed-top > div > div.navbar-collapse.in > ul > li:nth-child(6) > a');				
				$I->amOnpage('wish_list');
                $I->see('Item');
				$I->see('Value');
				//create item for wishlist
				$I->fillField('Item', 'Playstation');
				$I->fillField('Value', '400');
				
                $I->click('Add');
				//Confirm item has been added
				$I->see('Playstation');
				$I->click(''); //Click X button to remove item
				$I->click('Ok');//Confirm removal 
				$I->dontsee('Playstation');//Confirm item has been removed
 		}
		
		//incomplete 
		public function completeAmountChanged($I) {
				LoginCest::login($I);	
				$I->wantTo('Check if the saved value is updated');
				$I->click('body > div.navbar.navbar-inverse.navbar-fixed-top > div > div.navbar-collapse.in > ul > li:nth-child(6) > a');
				$I->amOnpage('wish_list');
   				
				$I->see('Saved: '); 
				//Amount is added to savings ....
				//Should changed saved value
				//Check Saved value for appropriate changes. 
		}
}	
