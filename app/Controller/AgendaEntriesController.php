<?php
class AgendaEntriesController extends AppController 
{
    public $helpers = array('Html', 'Form');
	public $uses = array('User', 'Course', 'CourseSchedule', 'AgendaEntry');
	
	public function index($monday = -1) 
	{
		if($monday == -1 || !is_numeric($monday))
			$lastMonday = strtotime('last monday', strtotime('tomorrow'));
		else
			$lastMonday = $monday;
		
		$oneDay = 3600*24;
		$oneWeek = $oneDay*7;
		$nextMonday = $lastMonday + $oneWeek;
		$previousMonday = $lastMonday - $oneWeek;
		
		$courseSchedules = $this->CourseSchedule->find('all');
		$users = $this->User->find('list', array("fields" => array('User.id', 'User.username')));
		$courses = $this->Course->find('list', array("fields" => array('Course.id', 'Course.label')));
		$agendaEntries = $this->AgendaEntry->find('all', array(
												'conditions' => array('AgendaEntry.date >= ' => date('Y/m/d', $lastMonday), 'AgendaEntry.date <= ' => date('Y/m/d', $nextMonday)),
												'order' => array('AgendaEntry.date ASC')
											));
		
		$this->set('lastMonday', $lastMonday);
		$this->set('nextMonday', $nextMonday);
		$this->set('previousMonday', $previousMonday);
        $this->set('courses', $courses);
        $this->set('users', $users);
        $this->set('courseSchedules', $courseSchedules);
        $this->set('agendaEntries', $agendaEntries);
    }
	
	public function add($courseId=1, $dateEarly=0, $dateLater=0)
	{
		$this->set('courses', $this->AgendaEntry->Course->find('list', array(
        															'fields' => array('Course.id', 'Course.label'))));
		$this->set('entryTypes', $this->AgendaEntry->EntryType->find('list', array(
        															'fields' => array('EntryType.id', 'EntryType.name'))));
																	
		if($dateEarly != 0 && $dateLater != 0)
		{
			$dateParts1 = getdate($dateEarly);
			$dateParts2 = getdate($dateLater);
			
			$date = $dateParts1['mon'].'/'.$dateParts1['mday'].'/'.$dateParts1['year'];
			$time1 = $dateParts1['hours'].':'.$dateParts1['minutes'].':'.$dateParts1['seconds'];
			$time2 = $dateParts2['hours'].':'.$dateParts2['minutes'].':'.$dateParts2['seconds'];
			
			if(!$this->request->is('post'))
			{
				$this->request->data['AgendaEntry']['startTime'] = $time1;
				$this->request->data['AgendaEntry']['endTime'] = $time2;
				$this->request->data['AgendaEntry']['courseId'] = $courseId;
				$this->request->data['AgendaEntry']['date'] = $date;
				$this->request->data['AgendaEntry']['entryType'] = 'default';
			}
		}
		
		if($this->request->is('post'))
		{
			$this->request->data['AgendaEntry']['userId'] = $this->Auth->user('id');
            $this->AgendaEntry->create();
            if ($this->AgendaEntry->save($this->request->data))
			{
                //$this->Session->setFlash(__('Your agenda entry has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your agenda entry.'));
        }
	}
	
	public function addSideColumn($courseId=1, $dateEarly=0, $dateLater=0)
	{																	
		$this->layout = false;
		$this->add($courseId, $dateEarly, $dateLater);
	}
	
	public function edit($id)
	{
		$this->set('courses', $this->AgendaEntry->Course->find('list', array(
        															'fields' => array('Course.id', 'Course.label'))));
		$this->set('entryTypes', $this->AgendaEntry->EntryType->find('list', array(
        															'fields' => array('EntryType.id', 'EntryType.name'))));
																	
		if (!$id) 
		{
			throw new NotFoundException(__('Invalid post'));
		}
	
		$agendaEntry = $this->AgendaEntry->findById($id);
		$this->set("agendaEntry", $agendaEntry);
		if (!$agendaEntry) 
		{
			throw new NotFoundException(__('Invalid post'));
		}
	
		if ($this->request->is('post') || $this->request->is('put')) 
		{
			$this->AgendaEntry->id = $id;
			if ($this->AgendaEntry->save($this->request->data)) {
				//$this->Session->setFlash(__('Your agenda entry has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your timeslot.'));
		}
	
		if (!$this->request->data) 
		{
			$this->request->data = $agendaEntry;
		}	
	}
	
	public function editSideColumn($id)
	{
		$this->layout = false;
		$this->edit($id);
	}
	
	public function delete($id)
	{
		if (!$this->request->is('post'))
		{
			throw new MethodNotAllowedException();
		}
	
		if ($this->AgendaEntry->delete($id))
		{
			$this->Session->setFlash(__('The Agenda Entry with id: %s has been deleted.', h($id)));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>