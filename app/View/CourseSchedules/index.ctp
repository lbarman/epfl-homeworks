<!-- File: /app/View/CoursesSchedules/index.ctp -->

<?php
echo $this->Html->css('dailyAgenda');
?>

<div id="rightColumn" class="rightColumn">
</div>
<div class="leftColumn">
<?php
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
<?php echo $this->Html->link(
    'Add Timeslot',
    array('controller' => 'CourseSchedules', 'action' => 'add'),
	 array('class' => 'addLink')
); ?>

    <?php //printTable($courseSchedules, $courses, $users); ?>
    <div class="dailyColumn">
    <div class="dailyTableContainer">

	<?php
	$params = array(
			'lastMonday' => $this->Calendar->lastMonday(),
			'courseSchedules' => $courseSchedules,
			'courses' => $courses,
			'editable' => true
			);
	
	 echo $this->Calendar->getTimeGrid($params);
	 echo $this->Calendar->getCoursesTimeSlots($params);
	  ?>
		
	</div>
    </div>
   </div><script type="text/javascript" language="javascript">
<!--
	
	$(".courseSchedule").each(function()
	{
		$(this).click(function(event)
		{
			$('#rightColumn').html("loading...");
			var id = $(this).attr("id").split('_')[1];
			var url = 'CourseSchedules/editSideColumn/'+id;
	  		$('#rightColumn').load(url);
		});
		$(this).css("cursor", "pointer");
	});
	$(".editLink").each(function()
	{
		$(this).css("display", "none");
	});
	$(".addLink").click(function(event){
		$("#rightColumn").load('CourseSchedules/addSideColumn');	
		return false;
	});
-->
</script>