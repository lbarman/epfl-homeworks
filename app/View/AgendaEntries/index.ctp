<!-- File: /app/View/AgendaEntry/index.ctp -->

<div id="rightColumn" class="rightColumn">
	&nbsp;
</div>
<div class="leftColumn">
    <div  id="left_disclosure" class="clickable">
        <img src="<?php echo $this->webroot; ?>img/left_disclosure.png" width="40" height="131" alt="Previous week" />
    </div>
    <div id="right_disclosure" class="clickable">
        <img src="<?php echo $this->webroot; ?>img/right_disclosure.png" width="40" height="131" alt="Next week" />
    </div>
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

	
	$(".courseSchedule").each(function()
	{
		$(this).click(function(event)
		{
			$('#rightColumn').html("loading...");
			var id = $(this).attr("id").split('_')[3];
			var time1 = $(this).attr("tag").split('_')[0];
			var time2 = $(this).attr("tag").split('_')[1];
			var url = '<?php echo Router::url('/'); ?>AgendaEntries/addSideColumn/'+id+'/'+time1+'/'+time2;
	  		$('#rightColumn').load(url);
		});
	});
	
	
	$(".agendaEntry").each(function()
	{
		$(this).click(function(event)
		{
			$('#rightColumn').html("loading...");
			var id = $(this).attr("id").split('_')[1];
			var url = '<?php echo Router::url('/'); ?>AgendaEntries/editSideColumn/'+id;
	  		$('#rightColumn').load(url);
		});
	});
	
	var screenWidth = $('body').innerWidth();
	var rightColumnWidth = $(".rightColumn").css("width").replace("px", "");
	var leftColumnWidth = screenWidth - rightColumnWidth;
	var rightDisclosureplacement = leftColumnWidth - 100;
	
	$("#left_disclosure").css("top", "400px");
	$("#left_disclosure").css("left", "25px");
	$("#left_disclosure").click(function(event)
		{
			$('.courseSchedule').fadeOut();
			$('.agendaEntry').fadeOut();
			window.location = '<?php echo Router::url('/').'AgendaEntries/index/'.$previousMonday; ?>';
		});
		
	$("#right_disclosure").css("top", "400px");
	$("#right_disclosure").css("left", rightDisclosureplacement+"px");
	$("#right_disclosure").click(function(event)
		{
			$('.courseSchedule').fadeOut();
			$('.agendaEntry').fadeOut();
			window.location = '<?php echo Router::url('/').'AgendaEntries/index/'.$nextMonday; ?>';
		});
-->
</script>