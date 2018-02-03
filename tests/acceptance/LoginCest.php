<?php
use \WebGuy;

class LoginCest
{
    // Other tests that require login will call on this test first
    public function login(WebGuy $I) {
   		$I->amOnPage('login');
 			$I->see('BUMA');
			$I->fillField('#login_form > input.username.form-control', 'app.buma@gmail.com'); 
			$I->fillField('#login_form > input.password.form-control', 'Bumabuma1'); 
			$I->click('#btn_login_form');
    }
}
?>
