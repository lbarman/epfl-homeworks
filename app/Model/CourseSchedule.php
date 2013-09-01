<?php
class CourseSchedule extends AppModel 
{
    public $hasOne = array(
        'AgendaEntry' => array(
            'className' => 'AgendaEntry',
            'foreignKey' => 'courseId'
        )
    );
	
	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'userId'
        ),
        'Course' => array(
            'className' => 'Course',
            'foreignKey' => 'courseId'
        ),
        'DayOfWeek' => array(
            'className' => 'DayOfWeek',
            'foreignKey' => 'dayOfWeek'
        )
    );
}
?>