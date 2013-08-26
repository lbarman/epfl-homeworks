<?php
class CourseSchedulesController extends AppController 
{
    public $helpers = array('Html', 'Form');
	public $uses = array('User', 'Course', 'CourseSchedule');
	
	public function index() 
	{
		$courseSchedules = $this->CourseSchedule->find('all');
		$users = $this->User->find('list', array("fields" => array('User.id', 'User.username')));
		$courses = $this->Course->find('list', array("fields" => array('Course.id', 'Course.label')));
        $this->set('courses', $courses);
        $this->set('users', $users);
        $this->set('courseSchedules', $courseSchedules);
    }
		
}
?>