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
    }
    
    public function getweatherAction()
    {
        $request = $this->getRequest();
        print_r($request);
        $formData = $request->getPost();
        print_r($formData);
    }    


}

