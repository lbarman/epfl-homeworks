<!-- File: /app/View/Courses/index.ctp -->

<h1>Courses Entries</h1>
<?php echo $this->Html->link(
    'Add Post',
    array('controller' => 'courses', 'action' => 'add')
); ?>
<table>
    <tr>
        <th>Id</th>
        <th>User Id</th>
        <th>Label</th>
        <th>Actions</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($courses as $course): ?>
    <tr>
        <td><?php echo $course['Course']['id']; ?></td>
        <td><?php echo $users[$course['Course']['user_id']]; ?></td>
        <td><?php echo $course['Course']['label']; ?></td>
        <td>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $course['Course']['id'])); ?>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $course['Course']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>