<?php
namespace Page;

class RegistrationPage
{
    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    public static $URL = '/?displayMobile=false';
    public static $RegistrationURL = '/register?displayMobile=false';

    public static $title = '//h1';
    public static $countryDropDownList = '//*[@class="oswald half"]';
// Billing Address
    public static $firstNameField = '//*[@name="fname"]';
    public static $lastNameField = '//*[@name="lname"]';
    public static $companyField = '//*[@name="company"]';
    public static $address1Field = '//*[@name="adr1"]';
    public static $address2Field = '//*[@name="adr2"]';
    public static $cityField = '//*[@name="city"]';
    public static $stateDropDownList = '//*[@name="state"]';
    public static $zipCodeField = '//*[@name="zip"]';
    public static $phoneNumberField = '//*[@name="phone"]';
    public static $cellNumberField = '//*[@name="cell"]';

// Account Information
    public static $emailField = '[name="register"]>div:nth-of-type(2)>div:nth-of-type(2)>input';
    public static $passField = '//*[@name="pass_confirmation"]';
    public static $reTypePassField = '//*[@name="pass"]';
    public static $sendToEmailCheckbox = '//*[@class="formlabel checklabel"]/label/span[1]';

// Age Verification
    public static $BdayField = './/*[@autocomplete="bday"]';
    public static $termsAndConditionsCheckbox = '//*[@for="terms"]/span[1]';
    public static $reCapthaField = '//*[@id="g-recaptcha-response"]';


    public static $registrationAccountButton = '//*[@class="formlabel tac"]/button';


    public function goToRegistrationPage()
    {
        $I = $this->tester;
        $I->amOnPage(self::$RegistrationURL);
        $I->see('Create An Account', self::$title);
    }

    public static $welcomeRegistrationMessage = '//*[@class="pagecore home"]/div[5]';

    public function signUp(
        $firstName,
        $lastName,
        $address1,
        $city,
        $state,
        $zipCode,
        $phone,
        $email,
        $pass,
        $bDay,
        $captcha
    ) {
        $I = $this->tester;
        $I->fillField(self::$BdayField, $bDay); //'05/19/1990'
        $I->see('I am at least 21 years old');
        $I->waitAndClick(self::$emailField);
        $I->fillField(self::$emailField, $email);
        $I->fillField(self::$passField, $pass);
        $I->fillField(self::$reTypePassField, $pass);
        $I->fillField(self::$firstNameField, $firstName);
        $I->fillField(self::$lastNameField, $lastName);
        $I->fillField(self::$address1Field, $address1);
        $I->fillField(self::$cityField, $city);
        $I->selectOption(self::$stateDropDownList, $state); // 'PA'
        $I->fillField(self::$zipCodeField, $zipCode);
        $I->fillField(self::$phoneNumberField, $phone);
        $I->dontSee('retype the same password');
        $I->canSeeCheckboxIsChecked('#signup');
        $I->cantSeeCheckboxIsChecked('#terms');
        $I->waitAndClick(self::$termsAndConditionsCheckbox);
        $I->fillField(self::$reCapthaField, $captcha);
        $I->waitAndClick(self::$registrationAccountButton);
        $I->waitForElementVisible(self::$welcomeRegistrationMessage);
        $I->see('Welcome and thank you for joining our family of Famous Smokers.', self::$welcomeRegistrationMessage);
    }


    public static $accountHeaderButton = './/*[@class="pagebar"]/div[1]/div[2]/a';
    public static $logoutButton = '//a[text()="Logout"]';
    public static $logo = '//*[@class="logo"]';

    public function logout()
    {
        $I = $this->tester;
        $I->waitAndClick(self::$logo);
        $I->waitForElementVisible(self::$accountHeaderButton);
        $I->waitAndClick(self::$accountHeaderButton);
        $I->waitForElementVisible(self::$logoutButton);
        $I->waitAndClick(self::$logoutButton);
    }

    public static $emailSignInField = '//*[@class="headlogin"]/input[2]';
    public static $passSignInField = '//*[@class="headlogin"]/input[3]';
    public static $signInButton = '//*[@class="headlogin"]/button';

    public function signIn($email, $pass)
    {
        $I = $this->tester;
        $I->amOnPage(self::$URL);
        $I->waitAndClick(self::$accountHeaderButton);
        $I->waitForElementVisible(self::$emailSignInField);
        $I->fillField(self::$emailSignInField, $email);
        $I->fillField(self::$passSignInField, $pass);
        $I->waitAndClick(self::$signInButton);
        $I->waitAndClick(self::$accountHeaderButton);
        $I->waitForElementVisible(self::$logoutButton);
        $I->waitAndClick(self::$accountHeaderButton);
    }

}
