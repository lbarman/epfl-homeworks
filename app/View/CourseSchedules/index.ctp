<!-- File: /app/View/CoursesSchedules/index.ctp -->

<?php
echo $this->Html->css('dailyAgenda');

function printTable($courseSchedules, $courses, $users)
{
?>
<table>
    <tr>
        <th>Id</th>
        <th>Course</th>
        <th>User</th>
        <th>DayOfWeek</th>
        <th>StartTime</th>
        <th>EndTime</th>
        <th>Color</th>
        <th>Actions</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($courseSchedules as $courseSchedule): ?>
    <tr>
        <td><?php echo $courseSchedule['CourseSchedule']['id']; ?></td>
        <td><?php echo $courses[$courseSchedule['CourseSchedule']['courseId']]; ?></td>
        <td><?php echo $users[$courseSchedule['CourseSchedule']['userId']]; ?></td>
        <td><?php echo $courseSchedule['CourseSchedule']['dayOfWeek']; ?></td>
        <td><?php echo $courseSchedule['CourseSchedule']['startTime']; ?></td>
        <td><?php echo $courseSchedule['CourseSchedule']['endTime']; ?></td>
        <td><?php echo $courseSchedule['CourseSchedule']['color']; ?></td>
        <td>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $courseSchedule['CourseSchedule']['id'])); ?>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $courseSchedule['CourseSchedule']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>    
<?php	
}

?>

<h1>Courses Schedules Entries</h1><?php echo $this->Html->link(
    'Add Timeslot',
    array('controller' => 'CourseSchedules', 'action' => 'add')
); ?>

    <?php //printTable($courseSchedules, $courses, $users); ?>
    <div class="dailyColumn">
    <div class="dailyTableContainer">
	
	<?php echo $this->Calendar->getTimeGrid(); ?>
		
	<?php echo $this->Calendar->getCoursesTimeSlots($courseSchedules, $courses, true); ?>
		
	</div>
    </div>