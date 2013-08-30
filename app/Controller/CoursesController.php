<?php
class CoursesController extends AppController 
{
    public $helpers = array('Html', 'Form');
	public $uses = array('User', 'Course');
	
	public function index() 
	{
		$courses = $this->Course->find('all');
		$users = $this->User->find('list', array("fields" => array('User.id', 'User.username')));
        $this->set('courses', $courses);
        $this->set('users', $users);
    }
		
	public function add()
	{
        if ($this->request->is('post'))
		{
			$this->request->data['Course']['userId'] = $this->Auth->user('id');
            $this->Course->create();
            if ($this->Course->save($this->request->data))
			{
                $this->Session->setFlash(__('Your course has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your course.'));
        }
    }
	
	public function edit($id = null) 
	{
		if (!$id) 
		{
			throw new NotFoundException(__('Invalid post'));
		}
	
		$post = $this->Course->findById($id);
		if (!$post) 
		{
			throw new NotFoundException(__('Invalid post'));
		}
	
		if ($this->request->is('post') || $this->request->is('put')) 
		{
			$this->Course->id = $id;
			if ($this->Course->save($this->request->data)) {
				$this->Session->setFlash(__('Your course has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your course.'));
		}
	
		if (!$this->request->data) 
		{
			$this->request->data = $post;
		}
	}
	
	public function delete($id)
	{
		if ($this->request->is('get'))
		{
			throw new MethodNotAllowedException();
		}
	
		if ($this->Course->delete($id))
		{
			$this->Session->setFlash(__('The post with id: %s has been deleted.', h($id)));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>