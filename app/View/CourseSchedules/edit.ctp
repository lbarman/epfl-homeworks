<!-- File: /app/View/CourseSchedules/edit.ctp -->
<h1>Edit course schedule</h1>
<?php echo $this->Html->link(
    'Back to the list',
    array('controller' => 'CourseSchedule', 'action' => 'index')
); ?>
<?php
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->create('CourseSchedule');
echo $this->Form->input('Course', array(
    'name' => 'data[CourseSchedule][courseId]'));
echo $this->Form->input('DayOfWeek', array(
    'name' => 'data[CourseSchedule][dayOfWeek]'));
echo $this->Form->input('startTime', array('default' => '08:00'));
echo $this->Form->input('endTime', array('default' => '10:00'));
echo $this->Form->input('color');
echo $this->Form->end('Edit Course Schedule');
?>
<hr />
