<!-- File: /app/View/AgendaEntries/editSideColumn.ctp -->
<?php
$label = $agendaEntry['AgendaEntry']['label'];
$lines = explode("\r\n", $label);
$lines_processed = array();

for($i=0; $i<count($lines); $i++)
{
	$id = "lines_".$i;
	$checkbox = '<input type="checkbox" id="'.$id.'" name="'.$id.'" value="Car">';
	$lines_processed[] = $checkbox.$lines[$i].'<br />';
}

foreach($lines_processed as $line)
	echo $line;

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