<?php
class Course extends AppModel 
{
	public $validate = array(
        'label' => array(
            'rule' => 'notEmpty'
        )
    );
	
	public $hasMany = array(
        'CourseSchedule' => array(
            'className' => 'CourseSchedule',
            'foreignKey' => 'courseId'
        )
    );
	
	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'userId'
        )
    );
}
?>