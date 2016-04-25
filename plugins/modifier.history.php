<?php
/**
 * Finds out a Name from its ID for histories
 * This is an auto generated |histories modifier - please fix it according to your needs
 * @usage {id|history}
 * @usage {id|history|false}
 */
function smarty_modifier_history($history_id = 0, $show_link = true)
{
	$link = '';
	$page = constant('IS_ADMINISTRATOR') ? 'histories-details.php' : 'history.php';

	$history_id = (int)$history_id;
	if($history_id)
	{
		$histories = new histories();
		$history = $histories->details($history_id);
		if($history)
		{
			$link = ($show_link == true) ? "<a href='{$page}?id={$history['history_id']}&amp;code={$history['code']}'>{$history['history_name']}</a>" : $history['history_name'];
		}
		else
		{
			#$link = 'Invalid';
		}
	}

	return $link;
}