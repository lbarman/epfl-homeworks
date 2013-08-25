<?php
class AgendaEntriesController extends AppController 
{
    public $helpers = array('Html', 'Form');
	public $uses = array('User', 'Course', 'AgendaEntry');
	
	public function index() 
	{
		$users = $this->User->find('list', array("fields" => array('User.id', 'User.username')));
		$agendaEntries = $this->AgendaEntry->find('all', array('order' => array('AgendaEntry.startTime ASC')));
		$courses = $this->Course->find('list', array("fields" => array('Course.id', 'Course.label')));
        $this->set('agendaEntries', $agendaEntries);
        $this->set('users', $users);
        $this->set('courses', $courses);
    }
}
?>