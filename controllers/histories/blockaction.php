<?php


# Created on: 2016-04-25 14:41:52 556

/**
 * Perform a block action in entities. Input is via POST only
 */

$action = $variable->post('action', 'string', '');
$ids = $variable->post('histories', 'array', array());
#print_r($_POST); print_r($ids); die();

# Safety preceutions, make all the IDs a list of numbers only.
$ao = new array_operation();
$ids = $ao->operate('numeric', $ids);
$ids = array_filter($ids);
if(!count($ids))
{
	$ids = array(0);
}

$histories = new histories();

switch($action)
{
	case 'delete':
	case 'disable':
	case 'enable':
	case 'prune':
		$histories->blockaction($action, $ids);
		break;
	case 'nothing':
	default:
		break;
}

/**
 * Go back to the page that referred here.
 */
headers::back('histories-list.php');
