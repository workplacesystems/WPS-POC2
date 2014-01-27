<?php

class SchedulesController extends Zend_Controller_Action
{
    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $db = $this->connectDB();
        $request = $this->getRequest();
        $formData = $request->getPost();
        $schedule = new Schedule($formData['description'], $formData['start_date'], $formData['end_date']);
        if ($schedule->description) {
           $schedule->save($db);
        }
        
        $schedules = Schedule::getAll($db);
        $this->view->schedules = $schedules;
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

    function save($db) {
        $db->insert(
                'schedule', 
                array(
                    'description' => $this->description, 
                    'start_date' => $this->start_date, 
                    'end_date' => $this->end_date
                )
            );
    }
    
    static function getAll($db) {
        $rows = $db->fetchAll("SELECT * FROM schedule");
        return $rows;
    }
}
