<?php


# Created on: 2016-04-25 14:41:52 556

/**
 * Add an entity in [ histories ]
 */

$histories = new histories();

if($variable->post('add-action', 'string', ''))
{
	# Posted Data: Apply security
	$data = $variable->post('histories', 'array', array());

	# Immediately activate the record
	$data['is_active'] = 'Y';
	$data['is_approved'] = 'Y';

	# When this record is added for the first time?
	$data['added_on'] = 'CURRENT_TIMESTAMP()';

	# Bind the data edited, to the current subdomain only, if there is a subdomain_id column
	$data['subdomain_id'] = $subdomain_id;

	/*
	# If there are some FILEs to upload, please do now.
	# And assign the name of the file returned, to the same field.
	$uploader = new uploader(__BASE__.'/templates/images/histories', true);
	$file_field_name = 'file_field';
	$file_field = $uploader->store($file_field_name, '');
	if($file_field)
	{
		$data[$file_field_name] = $file_field;
		# Produce the cropnail for uploaded images, if any. Adjust the dimensions as well.
		$original_image = __BASE__.'/templates/images/histories/'.$data[$file_field_name];
		$cropnail_image = __BASE__.'/templates/images/histories/thumbs/'.$data[$file_field_name];
		$cropnail = new cropnail($configurations['DEFAULT_IMAGE_WIDTH'], $configurations['DEFAULT_IMAGE_HEIGHT']);
		$cropnail->resize($original_image, $cropnail_image, 0);
	}*/


	if($history_id = $histories->add($data, false))
	{
		# Destroy current successful data for the next form.
		unset($_SESSION['attempt_histories']);

		# Treat/Patch something on the currently added record.
		# Case: Send a welcome message (and ask to authenticate), if applies, eg. as in Membership.
		# $histories->welcome_first($history_id);

		$messenger = new messenger('success', 'The record has been added.');

		# Jump to the valid details page
		$data = $histories->details($history_id);
		stopper::url("histories-details.php?id={$data['history_id']}&code={$data['code']}");

		# stopper::url(url::last_page('histories-list.php'));
		# stopper::url('histories-add-successful.php');
		# stopper::url('histories-list.php');
		# stopper::url("histories-edit.php?id={$history_id}&code={$code}");
	}
	else
	{
		$messenger = new messenger('error', 'The record was NOT added. Does the table exist? Are the column names intact? Also, please check the <strong>database error</strong> log.');

		$_SESSION['attempt_histories'] = $data;
		stopper::url('histories-add.php');
		#stopper::url('histories-add-error.php');
	}
}
else
{
	# Must allow a chance to load the ADD form.
	# stopper::url('histories-direct-access-error.php');

	# Purpose of this code block is to make sure that the variable
	# gets all indices with blank data, to feed to ADD form.

	# A dynamic details about this record
	$details = array();

	if(isset($_SESSION['attempt_histories']))
	{
		$details = $_SESSION['attempt_histories'];
		unset($_SESSION['attempt_histories']);
	}

	# Validate it against the parameters in itself, plus those what we need.
	$details = $histories->validate('add', $details);
	$smarty->assign('histories', $details);
}

$smarty->assign('protection_code', $histories->code());
