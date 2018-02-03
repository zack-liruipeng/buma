<?php
use \WebGuy;

class UserStoryRememberPasswordCest
{

		/* A test to check that when the remember me checkbox is selected, 
		 * the username and password should be remembered
		 */
		public function rememberMePass ($I) {
			$I->amOnPage('login');
			$I->checkOption('#login_form > label > input');
			LoginCest::login($I);	
			$I->click('body > div.navbar.navbar-inverse.navbar-fixed-top > div > div.collapse.navbar-collapse > ul > li:nth-child(10) > a');
			$I->see('sarah_2819@hotmail.com');
			
				// Fill in info
				// Logout
				// See results
		}

		/* A test to check that when the remember me checkbox is not selected, 
		 * the username and password should NOT be remembered
		 */
		public function rememberMeFail ($I) {
			
			$I->amOnPage('login');
			LoginCest::login($I);
			$I->click('body > div.navbar.navbar-inverse.navbar-fixed-top > div > div.collapse.navbar-collapse > ul > li:nth-child(10) > a');
			$I->dontSee('sarah_2819@hotmail.com');
			
			// Fill in info
				// Logout
				// See results
		}
}
