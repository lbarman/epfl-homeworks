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
<?
echo $this->Html->script('editor');

echo $this->Form->create('AgendaEntry');
echo $this->Form->input('label', array('type' => 'hidden'));
echo $this->Form->input('Course', array(
    'name' => 'data[AgendaEntry][courseId]', 'type' => 'hidden'));
echo $this->Form->input('entryType', array('type' => 'hidden'));
echo $this->Form->input('date', array('dateFormat' => 'DMY', 'type' => 'hidden'));
echo $this->Form->input('startTime', array('type' => 'hidden'));
echo $this->Form->input('endTime', array('type' => 'hidden'));
echo $this->Form->end('Save tasks');
echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $this->request->data['AgendaEntry']['id']),
                array('confirm' => 'Are you sure?'));
echo ' - ';
echo $this->Html->link('Edit fullscreen', array('controller'=>'AgendaEntries', 'action'=>'edit', $agendaEntry['AgendaEntry']['id']));

?>