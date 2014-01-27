<?php

class SchedulesController extends Zend_Controller_Action
{
    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        
        
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $request = $this->getRequest();
        $formData = $request->getPost();
        $schedule = new Schedule($formData['description'], $formData['start_date'], $formData['description']);
        if ($schedule->description) {
           $schedule->save();
        }
        
        $schedules = Schedule::getAll();
        $this->view->schedules = $schedules;
    }
}

/* Wouln;t normally shove it all in here, but it's just a POC! */
class Schedule {

    public $description;
    public $start_date;
    public $end_date;

    function __construct($description, $start_date, $end_date) {
        $this->description = $description;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    function save() {
        $db = $this->connectDB();
        $db->insert(
                'schedule', 
                array(
                    'description' => $this->description, 
                    'start_date' => $this->start_date, 
                    'end_date' => $this->end_date
                )
            );
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
    
    static function getAll() {
        $db = $this->connectDB();
        $rows = $db->fetchAll("SELECT * FROM schedule");
        return $rows;
    }
}
