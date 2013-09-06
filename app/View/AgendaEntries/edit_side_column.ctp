<!-- File: /app/View/AgendaEntries/editSideColumn.ctp -->

<!DOCTYPE html>
<html ng-app>
<head>
<?php
echo $this->Html->script('angular');
echo $this->Html->script('jquery');
?>

</head>
<body>
<div ng-controller="TaskCtrl">
      <span>{{remaining()}} of {{todos.length}} remaining</span>
      <ul class="taskList">
        <li ng-repeat="task in taskList">
          <input type="checkbox" ng-model="task.checked" ng-change="alert('yes');updateLabel()">
          <span class="done-{{task.checked}}">{{task.trimmedText}} <button ng-click="deleteTask(task.id);">&nbsp;x&nbsp;</button></span>
        </li>
      </ul>
      <form ng-submit="addTask()">
        <input type="text" ng-model="taskText"  size="30"
               placeholder="add new task here">
        <input class="btn-primary" type="submit" value="add">
      </form>
    </div>
<script type="text/javascript" language="javascript">
<!--

function TaskCtrl($scope) 
{
	<?php
$label = $agendaEntry['AgendaEntry']['label'];
$lines = explode("\r\n", $label);
$lines_processed = array();

$dataSource = array();
for($i=0; $i<count($lines); $i++)
{
	$trimmed = trim($lines[$i]);
	$firstChar = substr($trimmed, 0, 1);
	$checked = ($firstChar == '+');
	if($firstChar == '+' || $firstChar == '-')
		$trimmed = trim(substr($trimmed, 1));
	
	$dataSource[] = array('text' => $lines[$i], 'checked'=>$checked, 'trimmedText'=>$trimmed, 'id'=>$i);
}
echo '$scope.taskList = '.json_encode($dataSource)."\r\n";
?>

  $scope.addTask = function() {
	  if($scope.taskText != "")
	  {
    	$scope.taskList.push({text:$scope.taskText, checked:false, trimmedText:$scope.taskText, id:$scope.lastId()+1});
    	$scope.todoText = '';
	  }
	$scope.updateLabel();
  };
 
  $scope.remaining = function() {
    var count = 0;
    angular.forEach($scope.taskList, function(task) {
      count += task.checked ? 0 : 1;
    });
    return count;
  };
  
  $scope.lastId = function() {
    var maxId = 0;
    angular.forEach($scope.taskList, function(task) {;
		if(maxId < task.id)
			maxId = task.id;
    });
    return maxId;
  };
 
  $scope.deleteTask = function(id) {
	var newTaskList = [];
    angular.forEach($scope.taskList, function(task)
	{
      if (task.id != id)
	  {
	  	newTaskList.push(task);
	  }
    });
	$scope.taskList = newTaskList;
	$scope.updateLabel();
	return false;
  };
  
  $scope.updateLabel = function()
  {
	var value = '';
	
	angular.forEach($scope.taskList, function(task)
	{
      value += (task.checked ? '+' : '-' )+" "+task.trimmedText+"\r\n";
    });
	
	$("#AgendaEntryLabel").val(value.trim());
  }
}

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
?></body>
</html>