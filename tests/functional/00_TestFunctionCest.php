<?php

/**
 * @group test
 */
class TestFunctionCest
{

    function functionalLogin(\Step\Functional\FunctionalSteps $I) {
        $I->enterDataLogin('test_mowdirect@yahoo.co.uk','123456');
        $I->seeCurrentUrlEquals('/customer/account/');
    }




}

