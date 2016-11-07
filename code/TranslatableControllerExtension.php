<?php

/**
 * Updates the controller's url handlers before it is initialized.
 * 
 * @author      Janne Klouman <janne@klouman.com>
 * @package     TranslatableControllers
 */
class TranslatableControllerExtension extends Extension {

    public function onBeforeInit()
    {
        $this->updateUrlHandlers();
    }

    /**
     * Update the controller's url handlers to include the ones
     * defined in its class.
     * 
     * @return bool
     */
    private function updateUrlHandlers() 
    {
        $oldUrlHandlers = $this->owner->config()->url_handlers;
        $newUrlHandlers = $this->owner->getValidUrlHandlers();

        Config::inst()->update(
            $this->owner->class,
            'url_handlers',
            $newUrlHandlers + $oldUrlHandlers // Note: important to prepend.
        );
        
        return !!$newUrlHandlers;
    }

}