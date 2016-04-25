<?php


# Created on: 2016-04-25 14:41:52 556

/**
 * Lists entities in histories
 */

# When a user will cancel add/edit forms, we will try to come back here
url::remember();

# Begin the paginator along with: histories
# Parameter: GET[], and per page
$pagination = new pagination('pg', __PER_PAGE__);

$histories = new histories();

# Be sure NOT to load too many entities. Save the database
# Please modify this code, particularly for:
#	Page Limits
#	Selection Conditions
$search_histories = $variable->remember_string('search_histories');
$smarty->assign('search_histories', $search_histories);

$condition = new condition();

$condition->add('FULL', array(
	"e.subdomain_id={$subdomain_id}", # Bind the records with this subdomain only
	"e.is_active='Y'", # Do not remove this
	"e.is_approved='Y'", # Optionally use this flag | Filter for front end users

	$search_histories ? "(
		   e.history_title LIKE '%{$search_histories}%'
		OR e.history_text LIKE '%{$search_histories}%'
	)" : '',
));

# Compulsory conditions
$condition->add('AND', array(
	#'e.search_field' => 'Y', # Partial %contents%
));

# List out the entries
$entries = $histories->list_entries(
	$condition,
	$from_index = $pagination->beginning_entry(),
	$pagination->per_page()
);

# Pagination helper
$pagination->set_total($histories->total_entries());
$smarty->assignByRef('pagination', $pagination);

# Assign to Smarty: Lists
$smarty->assignByRef('historiess', $entries);
