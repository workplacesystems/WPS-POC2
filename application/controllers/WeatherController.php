<?php

class WeatherController extends Zend_Controller_Action
{
    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $request = $this->getRequest();
        $formData = $request->getPost();
        $postcode = $formData['postcode'];
        
        $db = $this->connectDB();
        $result = $db->fetchAll("DESC schedule;");
        $this->view->db_test = $result;
        
        if($postcode) {
            
            $weather = $this->getWeather($postcode);

            $weatherRows = explode("\r\n", $weather);
            $weatherHeaders = explode(",", $weatherRows[6]);
            $weatherData = explode(",", $weatherRows[9]);
            
            $this->view->postcode = $postcode;
            $this->view->weatherHeaders = $weatherHeaders;
            $this->view->weatherData = $weatherData;
        }
    }
    
    private function getWeather($postcode) {
        $wsdl_uri = 'http://api.worldweatheronline.com/free/v1/weather.ashx?q=' . $postcode . '&format=csv&num_of_days=5&key=3ujjqezksxanb8mkg85e9j83';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $wsdl_uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return curl_exec($ch);
    }
    
    function connectDB() {
        $config = new Zend_Config(
        array(
            'database' => array(
                'adapter' => 'Mysqli',
                'params'  => array(
                    'host'     => 'ec2-50-17-185-106.compute-1.amazonaws.com',
                    'dbname'   => 'wpspoc2',
                    'username' => 'deploy',
                    'password' => '2F1RmVw02s',
                    )
                )
            )
        );

        return Zend_Db::factory($config->database);
    }
}