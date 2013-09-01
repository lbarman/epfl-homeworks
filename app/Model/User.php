<?php
// app/Model/User.php
class User extends AppModel {
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );
	
	
	public $hasMany = array(
        'Course' => array(
            'className' => 'Course',
            'foreignKey' => 'userId'
        ),
        'CourseSchedule' => array(
            'className' => 'CourseSchedule',
            'foreignKey' => 'userId'
        ),
        'AgendaEntry' => array(
            'className' => 'AgendaEntry',
            'foreignKey' => 'userId'
        )
    );
	
	
	public function beforeSave($options = array()) 
	{
		if (isset($this->data[$this->alias]['password'])) 
		{
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}
}
?>