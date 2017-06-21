<?php
namespace Page;

use Exception;

class CheckoutPage
{
    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }


// Checkout Page
    public static $checkoutURL = '/checkout?displayMobile=false';
    public static $title = '//h1';
    public static $enterYourEmailField = './/*[@id="loginform"]/div[1]/input';
    public static $newUserCheckbox = '//*[@id="newreg"]';
    public static $existUserCheckbox = '//*[@id="exist"]';
        public static $existUserPassField = '//*[@class="notnew"]';
    public static $signInButton = './/*[@id="login-submit-button"]/button';


    public static $shoppingCartLocator = '//*[@class="cartbigcol"]/div[2]';
    public static $shoppingCart = '//*[@class="cart_title desktop tablet"]';

    public function signInExistUser($email,$pass){
        $I = $this->tester;
        $I->fillField(self::$enterYourEmailField,$email);
        $I->waitAndClick(self::$existUserCheckbox);
        $I->fillField(self::$existUserPassField,$pass);
        $I->waitAndClick(self::$signInButton);
    }


    public static $addCartButton = '//*[@id="add_cc_btn"]';
    public static $addPayPalButton = '#add_pp_btn';
    public static $subscribeCheckbox = '//*[@ for="sendcat"]';
//add card
    public static $addNewCardBlock = './/*[@id="addcardarea"]';

    public static $cardNumberField = '#cc-number';
    public static $mmyy = '//*[@id="cc-exp"]';
    public static $cvv = '//*[@id="cc-cvv"]';
    public static $submitButton = '//*[@id="submitcard"]';
    public static $placeOrderButton = '//*[@id="btn-place-order"]';

    public static $notificationError = './/*[@id="paymentmethodcontent"]/div/div';


    //PayPal Page
    public static $paypalLocator = '//*[@id="defaultCancelLink"]';
   //credit card checkout page
    public static $testCardAdded = '.col-xs-12.padleft2';
    public static $cardCheckbox = '//*[@class="radio-cust-display"]';
    public static $cardCvvField = './/*[@class="input-group cvvarea"]/input[1]';


    public function checkout($cardNumber,$data,$cv){
        $I = $this->tester;
        $I->amOnPage(self::$checkoutURL);
        $I->scrollTo(self::$subscribeCheckbox);
        $I->waitForElementVisible(self::$subscribeCheckbox);
        $I->waitAndClick(self::$subscribeCheckbox);
        try {
            $I->waitForElementVisible(self::$testCardAdded);
            $I->waitAndClick(self::$cardCheckbox);
            $I->fillField(self::$cardCvvField,$cv);
        } catch (Exception $e) {
            $I->waitAndClick(self::$addCartButton);
            $I->waitForElementVisible(self::$addNewCardBlock);
            $I->wait(2);
            $I->fillField(self::$cardNumberField,$cardNumber);
            $I->fillField(self::$mmyy,$data);
            $I->fillField(self::$cvv,$cv);
            $I->waitAndClick(self::$submitButton);
            $I->waitForElementVisible(self::$testCardAdded);
            $I->waitAndClick(self::$cardCheckbox);
        }
        $I->waitAndClick(self::$placeOrderButton);
        $I->wait(10);
        $I->see('YOUR ORDER HAS BEEN PLACED - ADDITIONAL ACTION REQUIRED',self::$title, 8);
        $I->wait(3);
    }



}
