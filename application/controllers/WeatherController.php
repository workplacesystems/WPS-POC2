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
        $formData = $request->getPost();
        $postcode = $formData['postcode'];
        print_r($postcode."x");
        if($postcode) {
            $this->view->postcode = $postcode;
        }
    }
}