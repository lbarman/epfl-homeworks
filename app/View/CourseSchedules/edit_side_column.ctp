<!-- File: /app/View/CourseSchedules/edit_side_column.ctp -->
<?php

echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->create('CourseSchedule');
echo $this->Form->input('Course', array(
    'name' => 'data[CourseSchedule][courseId]', 'default'=>3));
echo $this->Form->input('DayOfWeek', array(
    'name' => 'data[CourseSchedule][dayOfWeek]'));
echo $this->Form->input('startTime', array('default' => '08:00'));
echo $this->Form->input('endTime', array('default' => '10:00'));
echo $this->Form->input('colorClass');
echo $this->Form->end('Edit Course Schedule');
?>
