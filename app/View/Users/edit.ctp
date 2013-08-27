<!-- File: /app/View/Courses/add.ctp -->
<h1>Edit course</h1>
<?php echo $this->Html->link(
    'Back to the list',
    array('controller' => 'users', 'action' => 'index')
); ?>
<?php
echo $this->Form->create('User');
echo $this->Form->input('username');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Edit Course');
?>
<hr />
