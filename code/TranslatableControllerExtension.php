<?php

/**
 * Updates the controller's url handlers before it is initialized.
 * 
 * @author      Janne Klouman <janne@klouman.com>
 * @package     TranslatableController
 */
class TranslatableControllerExtension extends Extension {

    public function onBeforeInit()
    {
        $oldUrlHandlers = $this->owner->config()->url_handlers;
        $newUrlHandlers = $this->owner->getValidUrlHandlers();

        Config::inst()->update(
            $this->owner->class,
            'url_handlers',
            $newUrlHandlers + $oldUrlHandlers // Note: important to prepend.
        );
        
    }

}