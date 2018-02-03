<?php
use \WebGuy;

class UserStoryWishListCest
{

		// View all wishes
		public function viewWishes($I) {
				LoginCest::login($I);	
				$I->wantTo('View all wishes on list');
				
				// Navigate to wish list page
				$I->click('body > div.navbar.navbar-inverse.navbar-fixed-top > div > div.collapse.navbar-collapse > ul > li:nth-child(6) > a');	
				$I->amOnPage('wish_list');
				$I->see('#wish_list_form');

		}

		// Show amount saved
		public function showAmountSaved($I) {
				LoginCest::login($I);	
				$I->wantTo('Show amount saved on screen');
				
				// Navigate to wish list page
				$I->click('body > div.navbar.navbar-inverse.navbar-fixed-top > div > div.collapse.navbar-collapse > ul > li:nth-child(6) > a');	
				$I->amOnPage('wish_list');
				$I->see('#wish_list_form > 5');
		}
		
}
