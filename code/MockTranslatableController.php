<?php

/**
 * Mock controller used for functional testing.
 *
 * @author      Janne Klouman <janne@klouman.com>
 * @package     TranslatableControllers
 */
class MockTranslatableController extends Controller implements TranslatableController
{

    const TEST_INDEX_RETURN = 'index';
    const TEST_ONE_RETURN   = 1;
    
    /**
     * @var array
     */
    private static $allowed_actions = [
        'one',
        'number'
    ];

    /**
     * @return  array   An array of valid controller url segments.
     */
    public function getValidUrlSegments()
    {
        return [
            'mock-controller',
            _t(__CLASS__ . '.CONTROLLER_URL', '日本語でも動いています')
        ];
    }

    /**
     * @return  array   A two dimensional array of valid url handlers.
     */
    public function getValidUrlHandlers()
    {
        return  [
            // Without variables
           'one' => 'one',
           'ett' => 'one',
           _t(__CLASS__ . '.CONTROLLER_ACTION_ONE', '一') => 'one',
            
            // With variables
           'number//$Number' => 'number',
           'nummer//$Number' => 'number',
            _t(__CLASS__ . '.CONTROLLER_ACTION_NUMBER', '数') . '//$Number' => 'number',
       ];
    }

    /**
     * @return  string
     */
    public function index()
    {
        return self::TEST_INDEX_RETURN;
    }

    /**
     * Returns a number passed in the url.
     * 
     * @param   SS_HTTPRequest $request
     * @return  mixed
     */
    public function number(SS_HTTPRequest $request)
    {
        return $request->param('Number');
    }

    /**
     * Returns the number one.
     * 
     * @param   SS_HTTPRequest $request
     * @return  int
     */
    public function one(SS_HTTPRequest $request)
    {
        return self::TEST_ONE_RETURN;
    }
    
}
