<?php

/**
 * Allows controllers to define multiple url segments and url handlers to handle
 * for example translations or a scenario where you want both the singular name
 * and plural name of your controller to map to it.
 *
 * @author      Janne Klouman <janne@klouman.com>
 * @package     TranslatableControllers
 */
interface TranslatableController {

    /**
     * Define multiple URL segments that will hit the controller.
     *
     * Example of valid return:
     * <code>
     * [
     *      'question-controller',
     *      '質問',
     *      _t('ExampleController.URL_SEGMENT_SINGULAR', 'question'),
     *      _t('ExampleController.URL_SEGMENT_PLURAL', 'questions'),
     *  ]
     * </code>
     *
     * @return  array   An array of valid controller url segments.
     */
    public function getValidUrlSegments();

    /**
     * Define multiple URL handlers as an array in which key is route and value
     * is controller action.
     *
     * Example of valid return:
     * <code>
     * [
     *      'view' => 'view',
     *      '見る' => 'view',
     *      '消す//$UUID/$Recurse' => 'delete',
     *      _t('ExampleController.DELETE_ACTION', 'delete') . '//$UUID/$Recurse' => 'delete',
     *  ]
     * </code>
     *
     * @return  array   A two dimensional array of valid url handlers.
     */
    public function getValidUrlHandlers();
    
}