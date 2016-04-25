<?php


# Created on: 2016-04-25 14:41:52 556

/**
 * Delete an entity in [ histories ]
 * Our policy is to reset the is_active flag to N (no) to mean a deletion.
 * A record is NOT deleted physically.
 */

# If you do not allow the delete feature, just enable the below line.
# stopper::url('histories-list.php');

$histories = new histories();
$history_id = $variable->get('id', 'integer', 0);
$code = $variable->get('code', 'string', '');

# Assumes, ID always, in the GET parameter
if($history_id && $code)
{
	if($histories->delete('inactivate', $history_id, $code))
	{
		$messenger = new messenger('warning', 'The record has been deleted.');

		# stopper::url('histories-delete-successful.php');
		# headers::back('histories-list.php');
		stopper::url('histories-list.php');
	}
	else
	{
		$messenger = new messenger('error', 'The record has NOT been deleted.');

		stopper::url('histories-delete-error.php?context=permissions');
	}
}
else
{
	stopper::url('histories-direct-access-error.php?context=delete');
}
