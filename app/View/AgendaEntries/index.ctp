<!-- File: /app/View/AgendaEntry/index.ctp -->
<?php 
echo $this->Html->css('dailyAgenda');
?>
<?php 

$params = array(
			'lastMonday' => $lastMonday,
			'agendaEntries' => $agendaEntries,
			'courseSchedules' => $courseSchedules,
			'courses' => $courses,
			'editable' => false
			);

echo $this->Calendar->printWeek($params); 


?>