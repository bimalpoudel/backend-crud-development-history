<?php


# Created on: 2016-04-25 14:41:52 556

/**
 * Reverts the flag of a single known field (pre-defined in the class file)
 *
 * @todo Check for HTTP Referrer validity
 * @todo Accept GET/POST requests
 * @todo Make this page AJAX friendly
 */

$histories = new histories();
$history_id = $variable->get('id', 'integer', 0);
$code = $variable->get('code', 'string', '');
$flag = $variable->get('flag', 'string', '');

/**
 * Process request as Ajax Call
 */
$ajax = $variable->get('ajax', 'string', 'false') == 'true';

# Assumes, ID always, in the GET parameter
if($history_id != 0 && $code != '' && $flag != '')
{
	$data = $histories->details($history_id, $code);
	if(!$data)
	{
		if($ajax)
		{
			stopper::message('N', false);
		}

		$messenger = new messenger('error', 'Invalid data.');
		stopper::url(url::last_page('histories-list.php?context=invaliddata'));
	}
	if(empty($data['code']) || $data['code'] != $code)
	{
		if($ajax)
		{
			stopper::message('N', false);
		}

		$messenger = new messenger('warning', 'Verification code is invalid.');
		stopper::url(url::last_page('histories-list.php?context=invalidcode'));
	}

	if($histories->flag_field($history_id, $code, $flag))
	{
		if($ajax)
		{
			stopper::message('Y', false);
		}

		$messenger = new messenger('notice', 'The record has been successfully flagged.');

		# The list from where the flag was applied will appear back with pagination.
		headers::back(url::last_page('histories-list.php?flagging=successful'));
	}
	else
	{
		if($ajax)
		{
			stopper::message('N', false);
		}

		$messenger = new messenger('error', 'The record has NOT been flagged yet. Such flag does not exist.');
		stopper::url(url::last_page('histories-list.php?context=flagging'));
	}
}
else
{
	if($ajax)
	{
		stopper::message('N', false);
	}

	stopper::url('histories-direct-access-error.php?context=flagging');
}
