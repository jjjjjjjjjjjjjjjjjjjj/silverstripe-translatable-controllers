# SilverStripe Translatable Controllers

This module provides a simple interface that allows you to set up multiple routes to your controllers and their actions. The most common use case would probably be translating these routes.

## Requirements

```JSON
"require": {
    "php": "^5.4",
    "silverstripe/framework": "^3.1"
}
```

## Installation
`composer install jjjjjjjjjjjjjjjjjjjj/silverstripe-translatable-controllers`

## Basic usage example
The following example provides a simple controller (`ExampleController`) with one function (`example_function`), available from:
* `example.com/ExampleController/example_function` 
* `example.com/example_example/function_function` 
* `example.com/exempelcontroller/exempelfunktion` (when the locale is Swedish)
* `example.com/コントローラーの例/関数の例` (when the locale is Japanese)

Make your controller implement the [`TranslatableController`](https://github.com/janneklouman/silverstripe-translatable-controllers/blob/master/code/TranslatableController.php) interface:

```PHP
# ExampleController.php
class ExampleController extends Controller implements TranslatableController
{

    private static $allowed_actions = [
        'example_function'
    ];

    public function getValidUrlSegments()
    {
        return [
            'example_example',
            _t('ExampleController.CONTROLLER_URL_SEGMENT')
        ];
    }

    public function getValidUrlHandlers()
    {
        return [
            'function_function' => 'example_function',
            _t('ExampleController.CONTROLLER_ACTION_EXAMPLE') => 'example_function'
        ]
    }

    /**
     * Returns the number 42
     */
    public function example_function
    {
        return 42;
    }

}
```

Define your routes in the translation file for the target language(s):

```YAML
# sv_SE.yml
sv:
  ExampleController:
    CONTROLLER_URL_SEGMENT: 'exempelcontroller'
    CONTROLLER_ACTION_EXAMPLE: 'exempelfunktion'
```

```YAML
# ja_JP.yml
ja:
  ExampleController:
    CONTROLLER_URL_SEGMENT: 'コントローラーの例'
    CONTROLLER_ACTION_EXAMPLE: '関数の例'
```

