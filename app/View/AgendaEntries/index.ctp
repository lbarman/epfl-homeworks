<!-- File: /app/View/AgendaEntry/index.ctp -->
<?php 
echo $this->Html->css('dailyAgenda');
?>
<div id="rightColumn" class="rightColumn">
 This is a test
</div>
<div class="leftColumn">
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
</div>

<script type="text/javascript" language="javascript">
<!--

	$(".agendaEntry").each(function()
	{
		$(this).click(function(event)
		{
			$('#rightColumn').html("loading...");
			var id = $(this).attr("id").split('_')[1];
			var url = 'AgendaEntries/editSideColumn/'+id;
	  		$('#rightColumn').load(url);
		});
	});
-->
</script>