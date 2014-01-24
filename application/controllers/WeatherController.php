<?php

class WeatherController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $request = $this->getRequest();
        print_r($request);
        $formData = $request->getPost();
        print_r($formData);
        if ($request->isPost()) {
            $formData = $request->getPost();
            // process the save action on the main page form
            if ($formData['action'] === 'weather') {
                Zend_Registry::get('logger')->debug(print_r($formData, true)); 
            }
        }
    }


}

