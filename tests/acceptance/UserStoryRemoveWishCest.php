<?php
use \WebGuy;

class UserStoryRemoveWishCest
{

    public function _before()
    {
    }

    public function _after()
    {
    }

		// Delete wish
		public function removeWish($I) {
				LoginCest::login($I);	
				$I->wantTo('Remove wish');
				$I->click('/html/body/div[1]/div/div[2]/ul/li[4]/a');
				$I->amOnPage('wish_list');

				// Update
				$I->click('#wish_list_form > button:nth-child(3) > span');
				$I->click('#wish_list_form > div.alert.alert-success.fade.in.complete-wish > p > button.btn.btn-success');

				// Will see 'Wish removed' if test has passed'
				$I->see('Wish removed');
		}

		// TODO
		// Show wish removed in database
}
