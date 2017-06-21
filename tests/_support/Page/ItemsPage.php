<?php
namespace Page;

use Exception;


class ItemsPage
{
    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    public static $cigarSearchURL = '/cigar-search?displayMobile=false';

    public static $title = '//h1';
    public static $countryDropDownList = '//*[@class="oswald half"]';
// Items Block
    public static $firstItem = '//*[@ class="dealscroller"]//a[1]';
    public static $quickViewButton = '//*[@class="dealscroller"]/a[1]/div[1]/div[1]';
    public static $itemWindow = '//*[@class="subtitle oswald"]';
    public static $addToCartButton = '//*[@class="half left cgray"]//a[text()="add to cart"]';
    public static $notificationAddedToCart = '//span[contains(text(),"Item added to cart:")]';
    public static $proceedToCartButton = '//span[contains(text(),"proceed to cart")]';

// proceed to checkout
    public static $cartTitle = '//*[@class="cart_title"]';
    public static $proceedToCheckoutButton = '//*[@class="checkoutbuttons"]/a[1]/span[1]';

    public function goToCigarSearchPage()
    {
        $I = $this->tester;
        $I->amOnPage(self::$cigarSearchURL);
        $I->canSee('Cigar Search', self::$title);
    }


// Login Checkout Page
    public static $loginFormLocator = '//*[@id="loginform"]/div[1]/p';

    public function addRandomItem()
    {
        $I = $this->tester;

        $x = rand(2, 170);
        $I->amOnPage('/cigar-search?displayMobile=false&results_per_page=60&page_number=' . $x); //page $x
        $I->canSee('Cigar Search', self::$title);

        $k = rand(1, 60);
        $I->moveMouseOver(['xpath' => '//*[@class="dealscroller"]/a[' . $k . ']']); //item $k
        $I->waitForElement(['xpath' => '//*[@class="dealscroller"]/a[1]/div[1]/div[1]']);
        $I->waitAndClick(['xpath' => '//*[@class="dealscroller"]/a[' . $k . ']/div[1]/div[1]']);
        try {
            $I->waitForElement(self::$addToCartButton);
            $I->waitAndClick(self::$addToCartButton);
        } catch (Exception $e) {
            $I->amOnPage('/cigar-search?displayMobile=false&results_per_page=1&page_number=1');
            $I->moveMouseOver(['xpath' => '//*[@class="dealscroller"]/a[1]']);
            $I->waitForElement(['xpath' => '//*[@class="dealscroller"]/a[1]/div[1]/div[1]']);
            $I->waitAndClick(['xpath' => '//*[@class="dealscroller"]/a[1]/div[1]/div[1]']);
            $I->waitForElement(self::$addToCartButton);
            $I->waitAndClick(self::$addToCartButton);
        }
        $I->waitForElement(self::$proceedToCheckoutButton);
        $I->waitAndClick(self::$proceedToCheckoutButton);
    }

    public function addCigarillosItem()
    {
        $I = $this->tester;
        $I->amOnPage('/cigars/cigarillos-cigars?displayMobile=false&sort=best_desc&shape=Cigarillo&results_per_page=60&page_number=' . rand(1, 5));

        $k = rand(1, 60);
        $I->moveMouseOver(['xpath' => '//*[@class="dealscroller"]/a[' . $k . ']']); //item $k
        $I->waitForElement(['xpath' => '//*[@class="dealscroller"]/a[1]/div[1]/div[1]']);
        $I->waitAndClick(['xpath' => '//*[@class="dealscroller"]/a[' . $k . ']/div[1]/div[1]']);

        try {
            $I->waitForElement(self::$addToCartButton);
            $I->waitAndClick(self::$addToCartButton);
        } catch (Exception $e) {
            $I->amOnPage('/cigars/cigarillos-cigars?displayMobile=false&sort=best_desc&shape=Cigarillo&results_per_page=1&page_number=1');
            $I->moveMouseOver(['xpath' => '//*[@class="dealscroller"]/a[1]']);
            $I->waitForElement(['xpath' => '//*[@class="dealscroller"]/a[1]/div[1]/div[1]']);
            $I->waitAndClick(['xpath' => '//*[@class="dealscroller"]/a[1]/div[1]/div[1]']);
            $I->waitForElement(self::$addToCartButton);
            $I->waitAndClick(self::$addToCartButton);
        }
        try {
            $I->waitForElement(self::$proceedToCheckoutButton);
            $I->waitAndClick(self::$proceedToCheckoutButton);
        } catch (Exception $e) {
            $I->waitAndClick('//*[@class="tac"]/div[2]/a[1]');
            $I->waitForElement(self::$proceedToCheckoutButton);
            $I->waitAndClick(self::$proceedToCheckoutButton);
        }

    }

    public function addButaneItem()
    {
        $I = $this->tester;
        $I->amOnPage('/search?kw=butane&displayMobile=false');

        $k = 1;
        $I->moveMouseOver(['xpath' => '//*[@class="dealscroller"]/a[' . $k . ']']); //item $k
        $I->waitForElement(['xpath' => '//*[@class="dealscroller"]/a[1]/div[1]/div[1]']);
        $I->waitAndClick(['xpath' => '//*[@class="dealscroller"]/a[' . $k . ']/div[1]/div[1]']);

        try {
            $I->waitForElement(self::$addToCartButton);
            $I->waitAndClick(self::$addToCartButton);
        } catch (Exception $e) {
            $I->amOnPage('/search?kw=butane&displayMobile=false');
            $I->moveMouseOver(['xpath' => '//*[@class="dealscroller"]/a[1]']);
            $I->waitForElement(['xpath' => '//*[@class="dealscroller"]/a[1]/div[1]/div[1]']);
            $I->waitAndClick(['xpath' => '//*[@class="dealscroller"]/a[1]/div[1]/div[1]']);
            $I->waitForElement(self::$addToCartButton);
            $I->waitAndClick(self::$addToCartButton);
        }
        $I->waitForElement(self::$proceedToCheckoutButton);
        $I->waitAndClick(self::$proceedToCheckoutButton);
    }

    public function addLargeHumidorsItem()
    {
        $I = $this->tester;
        $I->amOnPage('/search?kw=large%20humidors&displayMobile=false');

        $k = 1;
        $I->moveMouseOver(['xpath' => '//*[@class="dealscroller"]/a[' . $k . ']']); //item $k
        $I->waitForElement(['xpath' => '//*[@class="dealscroller"]/a[1]/div[1]/div[1]']);
        $I->waitAndClick(['xpath' => '//*[@class="dealscroller"]/a[' . $k . ']/div[1]/div[1]']);

        try {
            $I->waitForElement(self::$addToCartButton);
            $I->waitAndClick(self::$addToCartButton);
        } catch (Exception $e) {
            $I->amOnPage('/search?kw=large%20humidors&displayMobile=false');
            $I->moveMouseOver(['xpath' => '//*[@class="dealscroller"]/a[1]']);
            $I->waitForElement(['xpath' => '//*[@class="dealscroller"]/a[1]/div[1]/div[1]']);
            $I->waitAndClick(['xpath' => '//*[@class="dealscroller"]/a[1]/div[1]/div[1]']);
            $I->waitForElement(self::$addToCartButton);
            $I->waitAndClick(self::$addToCartButton);
        }
        $I->waitForElement(self::$proceedToCheckoutButton);
        $I->waitAndClick(self::$proceedToCheckoutButton);
    }
}
