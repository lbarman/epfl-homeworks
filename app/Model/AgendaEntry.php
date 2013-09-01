<?php
class AgendaEntry extends AppModel 
{	
	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'userId'
        ),
        'Course' => array(
            'className' => 'Course',
            'foreignKey' => 'courseId'
        ),
        'EntryType' => array(
            'className' => 'EntryType',
            'foreignKey' => 'entryType'
        )
    );
}
?>