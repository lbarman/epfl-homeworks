// JavaScript Document
function checkedChanged(id)
{
	var checkState = false;
	for(var i=0; i<dataSource.length; i++)
	{
		if(dataSource[i]['id'] == id)
		{
			checkState = !dataSource[i]['checked'];
			dataSource[i]['checked'] = checkState;
		}
	}
	var checkedImage = checkState ? '_1' : '_0';
	$("#cb_"+id).attr('src', "/epfl-homeworks/app/webroot/img/checkbox32"+checkedImage+".png");
	
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

function generateEditorHtml()
{
	var editorHtml = '';
	$.each(dataSource, function(key, line) 
	{
		editorHtml += '<div class="editorLine">';
		var checkedImage = line['checked'] ? '_1' : '_0';
		editorHtml += '<img id="cb_' + line['id'] + '" class="cb_editorLine" src="/epfl-homeworks/app/webroot/img/checkbox32'+checkedImage+'.png" width="32" height="32" alt="Status" />';
		//editorHtml += '<input type="checkbox" class="cb_editorLine" id="cb_' + line['id'] + '" name="cb_' + line['id'] + '" '+checked+'>';
		editorHtml += '<input type="textbox" class="tb_editorLine" id="tb_' + line['id'] + '" name="tb_' + line['id'] + '" value="'+line['trimmedText']+'">';
		editorHtml += '<img id="del_' + line['id'] + '" class="del_editorLine" src="/epfl-homeworks/app/webroot/img/delete.png" width="16" height="16" alt="Delete option" />';
		editorHtml += '</div>';
	});
	
	editorHtml += '<div class="editorLine">';
	editorHtml += '<form onsubmit="return insertNewLine();"><input type="submit" value="Add task"></form>';	
	editorHtml += '</div>';
	
	$("#editor").html(editorHtml);
	addEvents();
}

generateEditorHtml();

function insertNewLine()
{
	var lastId = maxId();
	dataSource.push({'id' : 'editorLine_'+(lastId+1), 'text' : '-New task', 'checked':false, 'trimmedText':'New task'});
	
	
	updateLabelWithDataSource();
	generateEditorHtml();
	return false;
}

function deleteLineWithId(id)
{
	for(var i=0; i<dataSource.length; i++)
	{
		if(dataSource[i]['id'] == id)
		{
			dataSource.splice(i, 1);
			break;
		}
	}
	updateLabelWithDataSource();
	generateEditorHtml();
}

function maxId()
{
	var maxId = -1;
	for(var i=0; i<dataSource.length; i++)
	{
		var currId = dataSource[i]['id'].replace('editorLine_', '');
		if(currId > maxId)
			maxId = currId;
	}
	return maxId;
}

function addEvents()
{
	$(".del_editorLine").unbind('click');
	$(".cb_editorLine").unbind('click');
	$(".tb_editorLine").unbind('onkeyup');
	$(".del_editorLine").click(function() 
	{
		deleteLineWithId(this.id.replace('del_', ''));
	});
	$(".cb_editorLine").click(function() 
	{
		checkedChanged(this.id.replace('cb_', ''));
	});
	$(".tb_editorLine").keyup(function() 
	{
		for(var i=0; i<dataSource.length; i++)
		{
			if(dataSource[i]['id'] == this.id.replace('tb_', ''))
			{
				dataSource[i]['text'] = (dataSource[i]['checked'] ? '+ ' : '- ')+this.value;
				dataSource[i]['trimmedText'] = this.value;
				break;
			}
		}
		updateLabelWithDataSource();
	});
}