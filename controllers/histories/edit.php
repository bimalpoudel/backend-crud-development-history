<?php


# Created on: 2016-04-25 14:41:52 556

/**
 * Edit an entity in [ histories ]
 */

$histories = new histories();

# Handle Editing, when data is supplied
if($variable->post('edit-action', 'string', '') && ($history_id = $variable->post('history_id', 'integer', 0)))
{
	# Refer to old records in case we need it
	$old = $histories->details($history_id);
	if(!$old)
	{
		$messenger = new messenger('success', 'The record does not exist.');
		stopper::url('histories-edit-error.php?context=nodata');
	}

	# Editing....
	$code = $variable->post('protection_code', 'string', '');
	$data = $variable->post('histories', 'array', array());

	# Mark when this data was modified last time.
	$data['modified_on'] = 'CURRENT_TIMESTAMP()';
	$data['modified_counter'] = 'modified_counter+1';

	# If there are some FILEs to upload, please do now.
	# And assign the name of the file returned, to the same field.
	/**
	 * $uploader = new uploader(__BASE__.'/templates/images/histories', true);
	 * $file_field_name = 'file_field';
	 * $file_field = $uploader->store($file_field_name, '');
	 * if($file_field)
	 * {
	 * $data[$file_field_name] = $file_field;
	 * if(is_file(__BASE__.'/templates/images/histories/'.$old[$file_field_name]))
	 * {
	 * # Old uploaded file should be probably lost. So, delete it first.
	 * # $data[$file_field_name] = uploader::upload_delete($history_id, $old[$file_field_name]);
	 * # Produce the cropnail for uploaded images, if any. Adjust the dimensions as well.
	 * $original_image = __BASE__.'/templates/images/histories/'.$data[$file_field_name];
	 * $cropnail_image = __BASE__.'/templates/images/histories/thumbs/'.$data[$file_field_name];
	 * $cropnail = new cropnail($configurations['DEFAULT_IMAGE_WIDTH'], $configurations['DEFAULT_IMAGE_HEIGHT']);
	 * $cropnail->resize($original_image, $cropnail_image, 0);
	 * }
	 * }*/

	if($success = $histories->edit(
		$data, # Posted data
		array(
			'history_id' => $history_id,
		),
		$code, # Security code related to this entry
		$history_id
	)
	)
	{
		# Something about the image uploaders as a patch, if applies
		# $cu = new customized_uploader('uploader', __BASE__.'/templates/images/histories', 'images/histories', $record_id=$history_id);

		/*# Optionally remove old uploaded file, if any
		if($data[$file_field_name])
		{
			$file_field = __BASE__.'/templates/images/histories/'.$old[$file_field_name];
			if(is_file($file_field))
			{
				unlink($file_field);
			}
			$file_field = __BASE__.'/templates/images/histories/thumbs/'.$old[$file_field_name];
			if(is_file($file_field))
			{
				unlink($file_field);
			}
		}*/

		$messenger = new messenger('success', 'The record has been modified.');

		stopper::url(url::last_page('histories-list.php?context=permissions'));
		#stopper::url('histories-edit-successful.php');
		#stopper::url('histories-list.php');
	}
	else
	{
		stopper::url('histories-edit-error.php');
	}
}
else
{
	/**
	 * Otherwise, load the details of the entity before editing it.
	 */
	if($history_id = $variable->get('id', 'integer', 0))
	{
		$details = $histories->details($history_id);
		if(!$details)
		{
			# Data about this entity was not available
			stopper::url('histories-edit-error.php?context=data');
		}

		if($details['code'] != $variable->get('code', 'string', ''))
		{
			$messenger = new messenger('error', 'You are attempting to edit wrong data.');
			stopper::url('histories-edit-error.php?context=attemptedwrongdata');
		}

		# Purpose of this code block is to make sure that the variable
		# gets all indices with blank data, to feed to EDIT form.
		$details = $histories->validate('edit', $details);

		/**
		 * Build Smarty Variable with FULL details
		 */
		$smarty->assign('histories', $details);
	}
	else
	{
		# Really Bad...
		stopper::url('histories-direct-access-error.php');
	}
}
