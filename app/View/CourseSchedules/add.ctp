<!-- File: /app/View/Courses/add.ctp -->
<h1>Add new course</h1>
<?php echo $this->Html->link(
    'Back to the list',
    array('controller' => 'CourseSchedule', 'action' => 'index')
); ?>
<?php
echo $this->Form->create('CourseSchedule');
echo $this->Form->input('courseId');
echo $this->Form->input('dayOfWeek');
echo $this->Form->input('startTime');
echo $this->Form->input('endTime');
echo $this->Form->input('color');
echo $this->Form->end('Save Post');
?>
<hr />
