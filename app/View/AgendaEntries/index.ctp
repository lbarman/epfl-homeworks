<!-- File: /app/View/AgendaEntry/index.ctp -->
<?php
echo $this->Html->css('dailyAgenda');

function hasAgendaEntryForTime($time, $agendaEntries)
{
	$t1 = strtotime($time);
	foreach ($agendaEntries as $agendaEntry):
		//echo 'comparing '.$t1.' with '.$agendaEntry['AgendaEntry']['startTime'].' = '.strtotime($agendaEntry['AgendaEntry']['startTime']);
		$t2 = strtotime($agendaEntry['AgendaEntry']['startTime']);
		$t3 = strtotime($agendaEntry['AgendaEntry']['endTime']);
		if($t1 >= $t2 && $t1 <= $t3)
		{
			return $agendaEntry;	
		}
	endforeach;
	
	return NULL;
}

function twoDigits($number)
{
	if($number >= -9 && $number <= 9)
		return '0'.$number;
	return $number;	
}

function viewDay($agendaEntries)
{
	echo '<table class="dailyTable">';
	
	$hour = 8;
	$min = 0;
	
	while($hour < 21)
	{
		$timeString = twoDigits($hour).':'.twoDigits($min);
		$agendaEntry = hasAgendaEntryForTime($timeString, $agendaEntries);
		$agendaString = '';
		if($agendaEntry != NULL)
		{
			$agendaString = $agendaEntry['AgendaEntry']['label'];
		}
		echo '<tr class="splitter">
				<td class="time">'.$timeString.'</td>
				<td>'.$agendaString.'</td>
			  </tr>';
			  
		$min += 30;
		if($min == 60)
		{
			$min = 0;
			$hour++;
		}
	}
	echo '</table>';	
}

?>

<h1>Agenda Entries</h1>
<table>
    <tr>
        <th>#</th>
        <th>Label</th>
        <th>Course</th>
        <th>User</th>
        <th>Date</th>
        <th>From...</th>
        <th>...to</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($agendaEntries as $agendaEntry): ?>
    <tr>
        <td><?php echo $agendaEntry['AgendaEntry']['id']; ?></td>
        <td><?php echo $agendaEntry['AgendaEntry']['label']; ?></td>
        <td><?php echo $courses[$agendaEntry['AgendaEntry']['courseId']]; ?></td>
        <td><?php echo $users[$agendaEntry['AgendaEntry']['userId']]; ?></td>
        <td><?php echo $agendaEntry['AgendaEntry']['date']; ?></td>
        <td><?php echo $agendaEntry['AgendaEntry']['startTime']; ?></td>
        <td><?php echo $agendaEntry['AgendaEntry']['endTime']; ?></td>
    </tr>
    <?php endforeach; ?>
    
    <?php viewDay($agendaEntries); ?>
    
    <?php unset($post); ?>
</table>