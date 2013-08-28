<!-- File: /app/View/AgendaEntry/index.ctp -->
<?php 
echo $this->Html->css('dailyAgenda');
?>
<?php echo $this->Calendar->printWeek($lastMonday, $courseSchedules, $courses, false); ?>