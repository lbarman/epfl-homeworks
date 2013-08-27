<!-- File: /app/View/CoursesSchedules/index.ctp -->

<?php
echo $this->Html->css('dailyAgenda');

function twoDigits($number)
{
	if($number >= -9 && $number <= 9)
		return '0'.$number;
	return $number;	
}

function viewDay($courseSchedules, $courses)
{
	echo '<div class="dailyColumn"><div class="dailyTableContainer">';
	
	$startHour = 7;
	
	$hour = $startHour;
	$min = 0;
	
	while($hour < 20)
	{
		$timeString = twoDigits($hour).':'.twoDigits($min);		
		$hourInPixel = (15)*4;
		
		$startOffset = ($hour - $startHour)*$hourInPixel + $min;
		$height = $hourInPixel/2;
		
		echo '<div class="splitter" style="top:'.$startOffset.'px; height:'.$height.'px;"><div>'.$timeString.'</div></div>';
							  
		$min += 30;
		if($min == 60)
		{
			$min = 0;
			$hour++;
		}
	}
	
	foreach ($courseSchedules as $courseSchedule):
		//echo 'comparing '.$t1.' with '.$agendaEntry['AgendaEntry']['startTime'].' = '.strtotime($agendaEntry['AgendaEntry']['startTime']);
		$t1 = ($courseSchedule['CourseSchedule']['startTime']);
		$t2 = ($courseSchedule['CourseSchedule']['endTime']);
		list($hour1, $min1) = explode(':', $t1);
		list($hour2, $min2) = explode(':', $t2);
		
		//30min = 30px
		//1h = 60px
		
		$hourInPixel = (15)*4;
		
		$startOffset = ($hour1 - $startHour)*$hourInPixel + $min1;
		$endOffset = ($hour2 - $startHour)*$hourInPixel + $min2; 
		$height = $endOffset-$startOffset;
		$width = 200;
		$yOffset = 100+($width+20) * ($courseSchedule['CourseSchedule']['dayOfWeek'] - 1);
		
		echo '<div class="courseSchedule" style="top:'.$startOffset.'px; height:'.$height.'px;left:'.$yOffset.'px;width:'.$width.'px;" onClick="window.location = \'CourseSchedules/edit/'.$courseSchedule['CourseSchedule']['id'].'\';">'.
					
					'<a class="deleteLink" href="#" onclick="if (confirm(\'Are you sure you want to delete this?\')) { window.location = \'CourseSchedules/delete/'.$courseSchedule['CourseSchedule']['id'].'\'; } event.returnValue = false; return false;"><img src="app/webroot/img/delete.png" width="16" height="16" alt="Delete" /></a>'.
					
					'<a class="editLink" href="CourseSchedules/edit/'.$courseSchedule['CourseSchedule']['id'].'"><img src="app/webroot/img/edit.gif" width="14" height="14" alt="Edit" /></a>'.
					
					$courses[$courseSchedule['CourseSchedule']['courseId']].
				'</div>';
		
	endforeach;	
	echo '</div></div>';
}
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
    <?php viewDay($courseSchedules, $courses); ?>
    
    <?php unset($courseSchedules); ?>