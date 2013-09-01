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
	
	public function add()
	{
		$this->set('courses', $this->CourseSchedule->Course->find('list', array(
        															'fields' => array('Course.id', 'Course.label'))));
		$this->set('dayOfWeeks', $this->CourseSchedule->DayOfWeek->find('list', array(
        															'fields' => array('DayOfWeek.id', 'DayOfWeek.name'))));
		$this->set('colorClasses', $this->CourseSchedule->ColorClass->find('list', array(
        															'fields' => array('ColorClass.id', 'ColorClass.name'))));
        if ($this->request->is('post'))
		{
			$this->request->data['CourseSchedule']['userId'] = $this->Auth->user('id');
            $this->CourseSchedule->create();
            if ($this->CourseSchedule->save($this->request->data))
			{
                $this->Session->setFlash(__('Your timeslot has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your timeslot.'));
        }
    }
	
	public function edit($id = null) 
	{
		$this->set('courses', $this->CourseSchedule->Course->find('list', array(
        															'fields' => array('Course.id', 'Course.label'))));
		$this->set('dayOfWeeks', $this->CourseSchedule->DayOfWeek->find('list', array(
        															'fields' => array('DayOfWeek.id', 'DayOfWeek.name'))));
		$this->set('colorClasses', $this->CourseSchedule->ColorClass->find('list', array(
        															'fields' => array('ColorClass.id', 'ColorClass.name'))));
		if (!$id) 
		{
			throw new NotFoundException(__('Invalid post'));
		}
	
		$courseSchedule = $this->CourseSchedule->findById($id);
		if (!$courseSchedule) 
		{
			throw new NotFoundException(__('Invalid post'));
		}
	
		if ($this->request->is('post') || $this->request->is('put')) 
		{
			$this->CourseSchedule->id = $id;
			if ($this->CourseSchedule->save($this->request->data)) {
				$this->Session->setFlash(__('Your timeslot has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your timeslot.'));
		}
	
		if (!$this->request->data) 
		{
			$this->request->data = $courseSchedule;
		}
	}
	
	public function delete($id)
	{
		if ($this->request->is('post'))
		{
			throw new MethodNotAllowedException();
		}
	
		if ($this->CourseSchedule->delete($id))
		{
			$this->Session->setFlash(__('The timeslot with id: %s has been deleted.', h($id)));
			return $this->redirect(array('action' => 'index'));
		}
	}		
}
?>