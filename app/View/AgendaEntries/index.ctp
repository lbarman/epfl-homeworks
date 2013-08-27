<!-- File: /app/View/AgendaEntry/index.ctp -->
<?php
echo $this->Html->css('dailyAgenda');

function twoDigits($number)
{
	if($number >= -9 && $number <= 9)
		return '0'.$number;
	return $number;	
}

function viewDay($agendaEntries)
{
	echo '<div class="dailyColumn"><div class="dailyTableContainer">';
	
	$hour = 8;
	$min = 0;
	
	while($hour < 21)
	{
		$timeString = twoDigits($hour).':'.twoDigits($min);		
		$hourInPixel = (15)*4;
		
		$startOffset = ($hour - 8)*$hourInPixel + $min;
		$height = $hourInPixel/2;
		
		echo '<div class="splitter" style="top:'.$startOffset.'px; height:'.$height.'px"><div>'.$timeString.'</div></div>';
							  
		$min += 30;
		if($min == 60)
		{
			$min = 0;
			$hour++;
		}
	}
	
	foreach ($agendaEntries as $agendaEntry):
		//echo 'comparing '.$t1.' with '.$agendaEntry['AgendaEntry']['startTime'].' = '.strtotime($agendaEntry['AgendaEntry']['startTime']);
		$t1 = ($agendaEntry['AgendaEntry']['startTime']);
		$t2 = ($agendaEntry['AgendaEntry']['endTime']);
		list($hour1, $min1) = explode(':', $t1);
		list($hour2, $min2) = explode(':', $t2);
		
		//30min = 30px
		//1h = 60px
		
		$hourInPixel = (15)*4;
		
		$startOffset = ($hour1 - 8)*$hourInPixel + $min1;
		$endOffset = ($hour2 - 8)*$hourInPixel + $min2; 
		$height = $endOffset-$startOffset;
		
		echo '<div class="dailyAgendaEntry" style="top:'.$startOffset.'px; height:'.$height.'px">'.$agendaEntry['AgendaEntry']['label'].'</div>';
		
	endforeach;	
	echo '</div></div>';
}

function printTable($agendaEntries, $courses, $users)
{
	?>
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
</table>
    <?php	
}

?>

<h1>Agenda Entries</h1>

    <?php //printTable($agendaEntries, $courses, $users); ?>
    <div class="dailyColumn"><div class="dailyTableContainer">
    <?php $this->Calendar->getTimeGrid(); ?>
    </div></div>
    <?php //viewDay($agendaEntries); ?>
    
    <?php unset($post); ?>