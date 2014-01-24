<?php

class WeatherController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $formData = $request->getPost();
        $postcode = $formData['postcode'];
        
        if($postcode) {
            $this->view->postcode = $postcode;
        }
    }
}