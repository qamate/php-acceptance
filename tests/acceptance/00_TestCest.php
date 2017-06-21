<?php
use \Step\Acceptance;


class TestCest
{
    /**
     * @group registration
     */

    function Registration(\Page\RegistrationPage $registrationPage)
    {
        $faker = Faker\Factory::create('en_US');
        $registrationPage->goToRegistrationPage();
        $registrationPage->signUp(
            $faker->firstName,
            $faker->lastName,
            $faker->streetAddress,
            $faker->city,
            $faker->state,
            $faker->postcode,
            $faker->tollFreePhoneNumber,
            'test.' . $faker->email,
            '!1qwerty',
            $faker->date('m/d/Y', '-21 years'),
            'test'
        );
    }


    /**
     * @group resetpass
     */
    function ResetForgottenPassword(\Page\ResetPasswordPage $resetPasswordPage, \Step\Acceptance\EmailSteps $emailSteps)
    {
        $resetPasswordPage->goToResetPasswordPage();
        $resetPasswordPage->enterTestEmail('famoussmokeshoptester@yahoo.com', 'reset');
        $emailSteps->loginEmailYahoo();
        $resetPasswordPage->enterNewPassword('!1qwerty');
    }

    /**
     * @group checkout
     */

    function checkout(\Page\ItemsPage $itemsPage, \Page\CheckoutPage $checkoutPage)
    {
//        $itemsPage->addRandomItem();
//        $itemsPage->addCigarillosItem();
        $itemsPage->addButaneItem();
//        $itemsPage->addLargeHumidorsItem();
        $checkoutPage->signInExistUser('famoussmokeshoptester86534333683@yahoo.com', '!1qwerty');
        $checkoutPage->checkout('4444-33333 22222-111111', '09\99', '232');
    }
}

