<?php
use \WebGuy;

class UserStoryForgotPasswordCest
{

    public function _before()
    {
    }

    public function _after()
    {
    }

		public function invalidEmail($I) {
							LoginCest::login($I);
							$I->wantTo('Fail to find the password with an invalid Email address');
							//Should be default to centi.cs.dal.ca/group11/buma
							$I->amOnPage('login');
							
							//Click the Forget Password on the log in page
							$I->click('#login_form > a:nth-child(5) > button');
							$I->amOnPage('forgot');
							//After the user click the button, there should be place for them to enter the username(email)
							$I->fillField('email','1234');
							//Click the button to confirm the username
							$I->click('#forgot_form_buttom');

							//As the username(email) is an incorrect one, the user should got an error messgae
							//and stay in the forget password paget
							$I->see('Forget Password');
							$I->see('Invalid username!');

							
							}

		public function validEmail($I) {
							
							LoginCest::login($I);
							$I->wantTo('Find the password using a valid Email(username)');
							//Should be default to centi.cs.dal.ca/group11/bume
							$I->amOnPage('login');
				
						//Click the Forget Password on the log in page
							$I->click('#login_form > a:nth-child(5) > button');
							$I->amOnPage('forgot');
							//After the user click the button, there should be a place for them to enter the username(email)
							$I->fillField('email','test');
							//Click the buttone to cofirm the username
							$I->click('#forgot_form_buttom');
	
							//As the username(email) is a correct ont, the user should get their password back
							$I->see('test');

		}

}
