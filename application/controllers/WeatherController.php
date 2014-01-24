<?php

class WeatherController extends Zend_Controller_Action
{
    private $_WSDL_URI="http://192.168.188.128:8081/soap?wsdl";

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $request = $this->getRequest();
        $formData = $request->getPost();
        $postcode = $formData['postcode'];
        if($postcode) {
            
            $wsdl_uri = 'http://api.worldweatheronline.com/free/v1/weather.ashx?q=' . $postcode . '&format=csv&num_of_days=5&key=3ujjqezksxanb8mkg85e9j83';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $wsdl_uri);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);

            $this->view->postcode = $postcode;
            
            $weatherRows = explode("\r\n", $result);
            
            // array containing the column headers for the data
            $weatherHeaders = explode(",", $weatherRows[6]);
            
            $this->view->weatherHeaders = $weatherHeaders;
            //print_r($weatherRows);
            
        }
    }
    
}