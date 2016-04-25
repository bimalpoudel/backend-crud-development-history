/**
 * Live search, if enabled, requires /js/ajax.js
 */
function _livesearch_histories()
{
	var str = this.value;
	if(str.length <= 1)
	{
		document.getElementById('livesearch-results').innerHTML = '';
		document.getElementById('livesearch-results').style.border = '0px';
		return false;
	}
	var xmlhttp = getXMLHTTPRequest();
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			document.getElementById('livesearch-results').innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open('GET', 'histories-livesearch.php?q=' + str, true);
	xmlhttp.send();
	return false;
}
function handle_livesearch()
{
	document.forms['histories-livesearch'].elements['search[name]'].onkeyup = _livesearch_histories;
	document.forms['histories-livesearch'].elements['search[name]'].focus();
	return false;
}

/**
 * Select or deselect all visible entities
 * Installs the "check/uncheck all" handler
 */
function _select_deselect_all_visible_historiess()
{
	var checker = (this.checked == true);
	var lists = document.getElementsByName('histories[]');
	for(var i = 0; i < lists.length; ++i)
	{
		if(lists[i].type == 'checkbox')
		{
			lists[i].checked = checker;
		}
	}
	return true;
}
function handle_select_all()
{
	if(document.getElementById('histories-checkall'))
	{
		document.getElementById('histories-checkall').onclick = _select_deselect_all_visible_historiess;
	}
	return false;
}


/**
 * Questions and allows to delete an item.
 * Instantly installs the delete handler based on their css class selector
 */
function _confirm_deletion()
{
	var success = window.confirm('Are you sure to delete this [ histories ]?');
	return success;
}
function handle_confirm_deletion()
{
	var entries = document.getElementsByTagName('a');
	for(var i = 0; i < entries.length; ++i)
	{
		if(entries[i].className == 'delete')
		{
			entries[i].onclick = _confirm_deletion;
		}
	}
	return false;
}

/**
 * Confirms a block action before performing it
 */
function _blockactions_histories()
{
	document.forms['histories-list-form'].elements['action'].value = document.forms['histories-list-form'].elements['actions'].value;

	// remove the below line in production environment
	// alert('Performing block action might be dangerous!'); return false;
	return window.confirm('Are you sure to perform this block action?\r\nIt may be too dangerous.');
}
function handle_block_action()
{
	if(document.forms['histories-list-form'])
	{
		document.forms['histories-list-form'].onsubmit = _blockactions_histories;
	}
	return false;
}

/** Install the selected handlers */
//handle_livesearch();
handle_select_all();
handle_confirm_deletion();
handle_block_action();

handle_ajax_flagging();