<?php

/**
 * @group functional
 */
class FunctionalCest
{

    function functionalLogin(\Step\Functional\FunctionalSteps $I) {
        $I->enterDataLogin('test_mowdirect@yahoo.co.uk','123456');
        $I->seeCurrentUrlEquals('/customer/account/');
    }
    function functionalWrongLogin(\Step\Functional\FunctionalSteps $I) {
        $I->enterDataLogin('test_mowdirect@mail.com','123456');
        $I->seeCurrentUrlEquals('/customer/account/login');
    }

    function functionalSearch(\Step\Functional\FunctionalSteps $I) {
        $I->functionalSearch('invalid');
    }
    function functionalSearch2(\Step\Functional\FunctionalSteps $I) {
        $I->functionalSearch('test');
    }

    function checkInvalidUrl(\Step\Functional\FunctionalSteps $I)
    {
        $I->checkInvalidUrl();
    }

    /**
     * My Account
     * @param \Step\Functional\FunctionalSteps $I
     */

    function accountInfo(\Step\Functional\FunctionalSteps $I)
    {
        $I->accountInfo('test_mowdirect@yahoo.co.uk','123456');
        $I->editInfo('Test20');
    }
    function accountAddress(\Step\Functional\FunctionalSteps $I)
    {
        $I->accountAddress('test_mowdirect@yahoo.co.uk','123456');
        $I->addAddress('test1','test2');
    }
    
    
    
    


    
    



}

