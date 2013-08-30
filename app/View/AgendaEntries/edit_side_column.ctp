<!-- File: /app/View/AgendaEntries/editSideColumn.ctp -->
<?php
echo $this->Form->create('AgendaEntry');
echo $this->Form->input('label');
echo $this->Form->input('courseId');
echo $this->Form->input('entryType');
echo $this->Form->input('date', array('dateFormat' => 'DMY'));
echo $this->Form->input('startTime');
echo $this->Form->input('endTime');
echo $this->Form->end('Save Post');
?>