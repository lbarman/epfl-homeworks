<!-- File: /app/View/AgendaEntries/editSideColumn.ctp -->
<?php
$label = $agendaEntry['AgendaEntry']['label'];
$lines = explode("\r\n", $label);
$lines_processed = array();

$dataSource = array();
for($i=0; $i<count($lines); $i++)
{
	$id = "editorLine_".$i;
	//$checkbox = '<input type="checkbox" id="'.$id.'" name="'.$id.'" value="Car">';
	$trimmed = trim($lines[$i]);
	$firstChar = substr($trimmed, 0, 1);
	$checked = ($firstChar == '+');
	if($firstChar == '+' || $firstChar == '-')
		$trimmed = trim(substr($trimmed, 1));
	
	$dataSource[] = array('id' => $id, 'text' => $lines[$i], 'checked'=>$checked, 'trimmedText'=>$trimmed);
}
echo '<script language="javascript" type="text/javascript">'."\r\n";
echo '<!--'."\r\n";
echo 'var dataSource = '.json_encode($dataSource)."\r\n";
echo '-->'."\r\n";
echo '</script>'."\r\n";
?>
<div id="editor">
loading fields...
</div>
<script type="text/javascript" language="javascript">
<!--

function checkedChanged(id, checked)
{
	for(var i=0; i<dataSource.length; i++)
	{
		if(dataSource[i]['id'] == id){
			dataSource[i]['checked'] = checked;
		}
	}
	updateLabelWithDataSource();
}

function updateLabelWithDataSource()
{
	var text = '';
	for(var i=0; i<dataSource.length; i++)
	{
		if(dataSource[i]['checked']){
			text += '+ ';
		}else{
			text += '- ';	
		}
		text += dataSource[i]['trimmedText'];
		text += "\r\n";
	}
	$("#AgendaEntryLabel").val(text.trim());	
}

var editorHtml = '';
$.each(dataSource, function(key, line) 
{
	editorHtml += '<div class="editorLine">';
	var checkedImage = line['checked'] ? '_1' : '_0';
	editorHtml += '<img src="app/webroot/img/checkbox32'+checkedImage+'.png" width="32" height="32" alt="Delete option" />';
	//editorHtml += '<input type="checkbox" class="cb_editorLine" id="cb_' + line['id'] + '" name="cb_' + line['id'] + '" '+checked+'>';
	editorHtml += '<input type="textbox" class="tb_editorLine" id="tb_' + line['id'] + '" name="tb_' + line['id'] + '" value="'+line['trimmedText']+'">';
    editorHtml += '<img src="app/webroot/img/delete.png" width="16" height="16" alt="Delete option" />';
	editorHtml += '</div>';
});
$("#editor").html(editorHtml);

$(".cb_editorLine").change(function() {
	checkedChanged(this.id.replace('cb_', ''), this.checked);
});
-->
</script>
<?

echo $this->Form->create('AgendaEntry');
echo $this->Form->input('label');
echo $this->Form->input('Course', array(
    'name' => 'data[AgendaEntry][courseId]'));
echo $this->Form->input('entryType');
echo $this->Form->input('date', array('dateFormat' => 'DMY', 'type' => 'hidden'));
echo $this->Form->input('startTime', array('type' => 'hidden'));
echo $this->Form->input('endTime', array('type' => 'hidden'));
echo $this->Form->end('Save tasks');
echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $this->request->data['AgendaEntry']['id']),
                array('confirm' => 'Are you sure?'));
?>