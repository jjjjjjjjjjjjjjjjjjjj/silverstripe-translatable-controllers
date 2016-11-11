<?php

/**
 * Core functions for making controllers and actions translatable.
 *
 * @author      Janne Klouman <janne@klouman.com>
 * @package     TranslatableControllers
 */
class TranslatableControllers
{

    /**
     * Applies alternate routes to the controllers for all the classes
     * that implement the {@link TranslatableController} interface and
     * return an array with the alternate routes.
     *
     * @return  bool    Indicates if any routes have been applied.
     */
    public static function applyControllerRoutes()
    {
        $interface   = TranslatableController::class;
        $controllers = ClassInfo::implementorsOf($interface);
        $routes      = [];

        // For each controller that implements the TranslatableController interface...
        foreach ($controllers as $controller) {

            // ... collect routes (url segments) defined on the controller.
            $controllerRoutes = singleton($controller)->getValidUrlSegments();
            foreach ($controllerRoutes as $route) {
                $routes[$route . '//$Action/$ID/$OtherID'] = $controller;
            }
        }

        // Apply all routes that come from implementors of TranslatableController to the config.
        if (count($routes)) {
            Config::inst()->update(
                Director::class,
                'rules',
                $routes
            );
            
            return true;
        }

        return false;
    }

    /**
     * Applies the {@link TranslatableControllerExtension} extension to all
     * controllers that implement the {@link TranslatableController}
     * interface. The extension in its turn applies the url handlers
     * defined by the controller.
     *
     * @return  bool    Indicates if any url handlers have been applied.
     */
    public static function applyControllerUrlHandlers()
    {
        $interface   = TranslatableController::class;
        $controllers = ClassInfo::implementorsOf($interface);

        // For each controller that implements the TranslatableController interface...
        foreach ($controllers as $controller) {
            
            // ... add extension if the controller has defined valid url handlers.
            $urlHandlers = singleton($controller)->getValidUrlHandlers();
            if (is_array($urlHandlers) && count($urlHandlers)) {
                $controller::add_extension('TranslatableControllerExtension');
            }
        }

        return isset($controller);
    }
    
}
