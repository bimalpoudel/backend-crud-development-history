<?php


# Created on: 2016-04-25 14:41:52 556

/**
 * Sorts histories by changing the sinking weight.
 * Extended features can sort the data within the set of record (categories) only.
 */

$history_id = $variable->get('id', 'integer', 0);
$code = $variable->get('code', 'string', ''); # For future references

$histories = new histories();
$data = $histories->details($history_id, $code);
if(!$data)
{
	$messenger = new messenger('error', 'No such data to sort.');
	headers::back('histories-list.php');
}

# Find out the direction to sort. Go upwards or downloads in the list.
$direction = strtolower($variable->get('direction', 'string', 'down'));
$direction = (in_array($direction, array('up', 'down'))) ? $direction : 'down';

# Match active records (and optionally other conditions)
$sorter = new sorter("AND `is_active`='Y'");
$sorter->sort_table('query_development_history', 'history_id', $history_id, $direction, 'sink_weight');

$messenger = new messenger('warning', 'The record has been sorted.');

# This is a controller only page and does not have anything to display.
headers::back('histories-list.php');
#stopper::url(url::last_page('histories-list.php'));
