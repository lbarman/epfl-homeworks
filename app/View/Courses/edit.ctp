<!-- File: /app/View/Courses/edit.ctp -->
<h1>Edit course</h1>
<?php echo $this->Html->link(
    'Back to the list',
    array('controller' => 'courses', 'action' => 'index')
); ?>
<?php
echo $this->Form->create('Course');
echo $this->Form->input('label');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Edit Post');
?>
<hr />
