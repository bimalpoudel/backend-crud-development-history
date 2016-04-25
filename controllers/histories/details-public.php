<?php


# Created on: 2016-04-25 14:41:52 556

/**
 * Details of an entry in [ histories ]
 */

$histories = new histories();
$history_id = $variable->get('id', 'integer', 0); # Entity ID
$code = $variable->get('code', 'string', ''); # Protection Code

if(!$history_id || !$code)
{
	# Page was loaded without the ID parameter
	stopper::url('histories-direct-access-error.php?context=identity');
}
else
{
	# Check for valid requests
	# if(!$histories->is_valid($history_id, $code)) stopper::message('Invalid request.', false);

	# Try to load the details
	if($histories_details = $histories->details($history_id, $code))
	{
		# We aim to reach here only.
		$smarty->assignByRef('histories', $histories_details);

		# To customize the content titles etc. for SEO purposes if necessary.
		# $page_details['content_title'] = "{$histories_details['history_name']}";
		# $page_details['page_title'] = "{$histories_details['history_name']}";
	}
	else
	{
		# Record not found
		stopper::url('histories-direct-access-error.php?context=data');
	}
}
