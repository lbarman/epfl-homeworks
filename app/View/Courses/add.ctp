<!-- File: /app/View/Courses/add.ctp -->
<h1>Add new course</h1>
<?php echo $this->Html->link(
    'Back to the list',
    array('controller' => 'courses', 'action' => 'index')
); ?>
<?php
echo $this->Form->create('Course');
echo $this->Form->input('label');
echo $this->Form->end('Save Post');
?>
<hr />
