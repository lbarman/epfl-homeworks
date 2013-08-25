<?php
class Course extends AppModel 
{
	public $validate = array(
        'label' => array(
            'rule' => 'notEmpty'
        )
    );
}
?>