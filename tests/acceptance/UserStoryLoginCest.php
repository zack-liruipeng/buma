<?php
use \WebGuy;

class UserStoryLoginCest
{

				// Check if user can see login page
				public function welcome($I) {
								
								$I->wantTo('ensure that frontpage works');
								$I->amOnPage('login');
								$I->see('Welcome');
				}

				// Login with valid information
				public function validInformation($I) {
								
								$I->wantTo('Login with a correct username and password');

								// Should default to centi.cs.dal.ca/group11/buma
								$I->amOnPage('login');

								// We already have an account created with this username and password
								// So we expected this test to pass
								$I->fillField('email', 'test');
								$I->fillField('password', 'test');

								$I->click('#btn_login_form');
								$I->amOnPage('/home');

								// If we don't see Log in, then we are logged in and the test has passed 
								$I->sendAjaxGetRequest('/refresh');
								$I->dontSee('#btn_login_form');
				}

				// Login with wrong password
				public function incorrectPassword($I) {
								
								$I->wantTo('Fail to log in with wrong password');
								
								//Should default to centi.cs.dal.ca/group11/buma
								$I->amOnPage('login');
						
								//We already have an account created with this username
						                $I->fillField('emal','test');
								//Enter the wrong password to fail the login
								$I->fillField('password','1234');
								$I->click('#btn_login_form');

								//The log in should be failed
								//User should stay in the login page and see the error message
								$I->sendAjaxGetRequest('/refrest');
								$I->see('Log in');
								$I->see('Email or password incorrect');

				}

				// Login with wrong username
				public function incorrectUsername($I) {
								
								$I->wantTo('Fail to log in with the wrong username');
							
								//Should default to centi.cs.dal.ca/group11/buma
								$I->amOnPage('login');

								//Enter the wrong username
								$I->fillField('email','1234');
								//We have already have an account created with this password
								$I->fillField('password','test');
								$I->click('#btn_login_form');

								//The log in should be failed
								//User should stay in the login page and see the error messaget
								$I->sendAjaxGetRequest('/refresh');
								$I->see("Log in");
								$I->see('Email or password incorrect');

				}

				// Logout if user is logged in
			 	public function logoutSuccess($I) {
								$I->wantTo('Logout of BUMA successfully');

								LoginCest::login($I);	
								
								// If we don't see Log in, then we are logged in and the test has passed 
								$I->dontSee('Log in');
								$I->click('body > div.navbar.navbar-inverse.navbar-fixed-top > div > div.collapse.navbar-collapse > ul > li:nth-child(10) > a');
								$I->sendAjaxGetRequest('/refresh');
								$I->amOnPage('login');
								}
			}
