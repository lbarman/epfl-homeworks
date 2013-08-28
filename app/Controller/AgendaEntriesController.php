<?php
class AgendaEntriesController extends AppController 
{
    public $helpers = array('Html', 'Form');
	public $uses = array('User', 'Course', 'CourseSchedule');
	
	public function index() 
	{
		$lastMonday = strtotime('last monday', strtotime('tomorrow'));
		$thisWeek = $lastMonday + 3600*24*7;
		$courseSchedules = $this->CourseSchedule->find('all');
		$users = $this->User->find('list', array("fields" => array('User.id', 'User.username')));
		$courses = $this->Course->find('list', array("fields" => array('Course.id', 'Course.label')));
		
		$this->set('lastMonday', $lastMonday);
        $this->set('courses', $courses);
        $this->set('users', $users);
        $this->set('courseSchedules', $courseSchedules);
    }
	
	public function add($courseId, $dateEarly, $dateLater)
	{
		$dateParts = getdate($dateEarly);
		echo '<pre>';
		print_r($dateParts);
		echo '</pre>';
		
		#warning reprendre ici
	}
}
?>