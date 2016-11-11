<?php

/**
 * Functional tests for Translatable Controllers.
 *
 * @author      Janne Klouman <janne@klouman.com>
 * @package     TranslatableController
 */
class TranslatableControllersTest extends FunctionalTest {

    const TEST_NUMBER_PARAMETER = 42;

    /**
     * Test alternate controller url segments (both translated and static).
     */
    public function testControllerUrlSegments()
    {
        $alternateRouteBody = $this->get('mock-controller')->getBody();
        $this->assertEquals(
            MockTranslatableController::TEST_INDEX_RETURN,
            $alternateRouteBody,
            '/mock-controller/ route hits MockTranslatableController'
        );

        $translatedRoute = _t('MockTranslatableController.CONTROLLER_URL', '日本語でも動いています');
        $translatedRouteBody = $this->get($translatedRoute)->getBody();
        $this->assertEquals(
            MockTranslatableController::TEST_INDEX_RETURN,
            $translatedRouteBody,
            '/' . $translatedRoute .'/ route hits MockTranslatableController'
        );

    }

    /**
     * Test alternate controller action url handlers (both translated and static).
     */
    public function testUrlHandlers() 
    {
        $mockController = singleton('MockTranslatableController');
        $urlSegments    = $mockController->getValidUrlSegments();

        foreach($urlSegments as $urlSegment) {

            // Test English alternate route to "one" action.
            $englishOneAction       = $urlSegment . '/one';
            $englishOneActionBody   = $this->get($englishOneAction)->getBody();
            $this->AssertEquals(
                MockTranslatableController::TEST_ONE_RETURN,
                $englishOneActionBody,
                '/' . $englishOneAction .'/ hits controller action "one"'
            );

            // Test Swedish alternate route to "one" action.
            $swedishOneAction       = $urlSegment . '/ett';
            $swedishOneActionBody   = $this->get($swedishOneAction)->getBody();
            $this->AssertEquals(
                MockTranslatableController::TEST_ONE_RETURN,
                $swedishOneActionBody,
                '/' . $swedishOneAction .'/ hits controller action "one"'
            );

            // Test Translated alternate route to "one" action
            $translatedOneAction     = $urlSegment . '/' . _t('MockTranslatableController.CONTROLLER_ACTION_ONE', '一');
            $translatedOneActionBody = $this->get($translatedOneAction)->getBody();
            $this->AssertEquals(
                MockTranslatableController::TEST_ONE_RETURN,
                $translatedOneActionBody,
                '/' . $translatedOneAction .'/ hits controller action "one"'
            );

            // Test English alternate route to "number" action with parameter.
            $englishNumberAction     = $urlSegment . '/number/' . self::TEST_NUMBER_PARAMETER;
            $englishNumberActionBody = $this->get($englishNumberAction)->getBody();
            $this->AssertEquals(
                self::TEST_NUMBER_PARAMETER,
                $englishNumberActionBody,
                '/' . $englishNumberAction .'/ hits controller action "number" with parameter'
            );

            // Test Swedish alternate route to "number" action with parameter.
            $swedishNumberAction     = $urlSegment . '/nummer/' . self::TEST_NUMBER_PARAMETER;
            $swedishNumberActionBody = $this->get($swedishNumberAction)->getBody();
            $this->AssertEquals(
                self::TEST_NUMBER_PARAMETER,
                $swedishNumberActionBody,
                '/' . $swedishNumberAction .'/ hits controller action "number" with parameter'
            );

            // Test translated alternate route to "number" action with parameter.
            $translatedNumberAction     = $urlSegment . '/' ._t('MockTranslatableController.CONTROLLER_ACTION_NUMBER', '数')  . '/' . self::TEST_NUMBER_PARAMETER;
            $translatedNumberActionBody = $this->get($translatedNumberAction)->getBody();
            $this->AssertEquals(
                self::TEST_NUMBER_PARAMETER,
                $translatedNumberActionBody,
                '/' . $translatedNumberAction .'/ hits controller action "number" with parameter'
            );


        }
        
    }
    
}