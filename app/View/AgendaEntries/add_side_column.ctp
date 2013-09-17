<!-- File: /app/View/AgendaEntries/add_side_column.ctp -->
<?php
$dataSource = array();
$dataSource[0] = array('id' => 'editorLine_0', 'text' => '- ', 'checked'=>false, 'trimmedText'=>'');

echo '<script language="javascript" type="text/javascript">'."\r\n";
echo '<!--'."\r\n";
echo 'var dataSource = '.json_encode($dataSource)."\r\n";
echo '-->'."\r\n";
echo '</script>'."\r\n";
?>
<div id="editor">
loading fields...
</div>
<?php
echo $this->Html->script('editor');

echo $this->Form->create('AgendaEntry');
echo $this->Form->input('label', array('type' => 'hidden'));
echo $this->Form->input('Course', array(
    'name' => 'data[AgendaEntry][courseId]', 'default'=>$courseId, 'type' => 'hidden'));
echo $this->Form->input('entryType', array('type' => 'hidden'));
echo $this->Form->input('date', array('dateFormat' => 'DMY'));
echo $this->Form->input('startTime', array('type' => 'hidden'));
echo $this->Form->input('endTime', array('type' => 'hidden'));
echo $this->Form->end('Add tasks');
?>
