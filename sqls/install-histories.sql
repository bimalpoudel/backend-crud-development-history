# 1. histories.php
# Non-Admin page, for visitng the site.
# This page DOES NOT REUIQRE a login. It is sed for front-end purpose only.
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, needs_login, allow_edit, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'Y', 'Y', 'Y', 'Y', 'Y',
	'histories.php', 'Development History', 'histories/list-public.php',
	'List of Development History', '<p>Below is a list of <!-- PLURAL? --> Development History.</p>',
	'frontend.php'
);

# 2. histories-blockaction.php
# This is a controller only page to operate certain actions on a set of some records.
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, is_error, needs_login, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'N', 'Y', 'Y', 'Y', 'Y',
	'histories-blockaction.php', 'Block action performed', '',
	'Block action!', '<p>This is a controller only page to perform certain actions on selected records.</p>',
	'null.php'
);

# 3. histories-direct-access-error.php
# When some parameter verification failed, show this page as an error.
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, needs_login, is_error, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'N', 'N', 'Y', 'Y', 'Y',
	'histories-direct-access-error.php', 'Error (contents protected)', '',
	'Direct access error!', '<p>Missing sufficient parameters to load the page contents. Unfortunately, direct access to this record is NOT allowed.</p>',
	'frontend.php'
);

# 4. histories-search.php
# Searching results page.
# This page may or may not require login. Default is: login required.
# It is used for both front end and back end purposes. Default is backend.
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, needs_login, allow_edit, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'N', 'Y', 'Y', 'Y', 'Y',
	'histories-search.php', 'Searching for Development History', 'histories/list.php',
	'Searching Development History', '<p>Searching is not implemented correctly. Please consider it.</p>',
	'admin.php'
);

# 5. histories-search-public.php
# Searching results page.
# This page may or may not require login. Default is: login required.
# It is used for both front end and back end purposes. Default is backend.
# Needs login as of 2012-08-24
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, is_admin, needs_login, allow_edit, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'N', 'Y', 'Y', 'Y', 'Y', 'Y',
	'histories-search-public.php', 'Search results for Development History', 'histories/list-public.php',
	'Searching Development History', '<p>We found the below results under your search criteria.</p>',
	'frontend.php'
);

# 6. histories-details-public.php
# This page does not require a login and is for front end purpose.
# Needs login as of 2012-08-24
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, needs_login, allow_edit, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'N', 'Y', 'Y', 'Y', 'Y',
	'histories-details-public.php', 'Details of [ histories : query_development_history  ] data', 'histories/details-public.php',
	'Details of Development History', '<p><!-- PUBLIC -->Details of [ Development History ]</p>',
	'frontend.php'
);

# 7. history.php
# Alias of histories-details-public.php
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, needs_login, allow_edit, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'N', 'Y', 'Y', 'Y', 'Y',
	'history.php', 'Details of [ histories : query_development_history  ] data', 'histories/details-public.php',
	'Details of Development History', '<p><!-- PUBLIC -->Details of [ Development History ]</p>',
	'frontend.php'
);

# 8. histories-list.php
# Backend purpose listing of entities.
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	is_admin, needs_login, allow_edit, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'Y', 'Y', 'Y', 'Y', 'Y',
	'histories-list.php', 'Listing [ histories : query_development_history  ] data', 'histories/list.php',
	'Listing Development History', '<p>List of <!-- PLURAL: [ histories : query_development_history ]--> Development History.</p>',
	'admin.php'
);

# 9. histories-sort.php
# Adjusting sink_weight flag to sort the records.
# Linked by histories-list.php page only.
# This is a controller-only file that redirects to listing page again.
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, needs_login, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'N', 'Y', 'Y', 'Y',
	'histories-sort.php', 'Sorting histories', '',
	'Sorting histories', '<p>This is a controller only page.</p><p>We have just sorted the records in <strong>Development History</strong> based on their sinking weight.</p>',
	'null.php '
);

# 10. controllers/histories-add.php
# Add records in [ histories ] table.
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	is_admin, allow_edit, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'Y', 'Y', 'Y', 'Y',
	'histories-add.php', 'Adding a record in [ Development History ]', 'histories/add.php',
	'Adding Development History', '<p>Please fill up the form below and click on [ Add ] button to save it.</p>',
	'admin.php'
);

# 11. histories-add-successful.php
# When successful, it gives a link back to view the list of records
# Needs login as of 2012-08-24
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, needs_login, is_admin, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'N', 'Y', 'Y', 'Y', 'Y',
	'histories-add-successful.php', 'Addition Successful', '',
	'Congrats!', '<p>This record is added successfully. <a href="histories-list.php">Go back now</a> or <a href="histories-add.php">add another record</a>.</p>',
	'admin.php'
);

# 12. histories-add-error.php
# Needs login as of 2012-08-24
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, needs_login, is_error, is_admin, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'N', 'Y', 'Y', 'Y', 'Y', 'Y',
	'histories-add-error.php', 'Addition Failed', '',
	'Sorry!', '<p>Could not save this record. Have you entered the data correctly? Any duplicates? Also check, if you passed <strong>protection code</strong> correctly. <a href="histories-add.php">Retry</a>.</p>',
	'admin.php'
);

# 13. histories-details.php
# Needs login as of 2012-08-24
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	is_admin, needs_login, allow_edit, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'Y', 'Y', 'Y', 'Y', 'Y',
	'histories-details.php', 'Details of a record', 'histories/details.php',
	'Development History', '<p>A detailed record about Development History.</p>',
	'admin.php'
);

# 14. controllers/histories-edit.php
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, needs_login, is_admin, allow_edit, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'N', 'Y', 'Y', 'Y', 'Y', 'Y',
	'histories-edit.php', 'Edit Development History', 'histories/edit.php',
	'Editing Development History', '<p>Please modify the below data and save it. Your results will be visible immediately.</p>',
	'admin.php'
);

# 15. histories-edit-successful.php
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, needs_login, is_admin, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'N', 'Y', 'Y', 'Y', 'Y',
	'histories-edit-successful.php', 'Edit Successful', '',
	'Edit successful!', '<p>This record is modified successfully. <a href="histories-list.php">Go back now</a>.</p>',
	'admin.php'
);

# 16. histories-edit-error.php
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, needs_login, is_error, is_admin, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'N', 'Y', 'Y', 'Y', 'Y', 'Y',
	'histories-edit-error.php', 'Error', '',
	'Edit failed!', '<p>Error found while modifying the record. Please check for <strong>sufficient parameters</strong> and <strong>modification code</strong>.</p><p>This error also appears <strong>when you did not really edit any data</strong> but clicked on save/edit button. Or, the <strong>UPDATE</strong> query is wrong.</p>',
	'admin.php'
);

# 17. controllers/histories-flag.php
# This is probably a controller only page.
# It should immediately redirect to the listing page.
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, needs_login, is_admin, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'N', 'Y', 'Y', 'Y', 'Y',
	'histories-flag.php', 'Flagging [ histories : query_development_history ] data', '',
	'Flagging [ histories : query_development_history ] data', '<p>This is a controller only page to revert the current flag of the record.</p>',
	'null.php'
);

# 18. controllers/histories-delete.php
# This is probably a controller only page.
# It should immediately redirect to the success or fail page.
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, needs_login, is_admin, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'N', 'Y', 'Y', 'Y', 'Y',
	'histories-delete.php', 'Delete [ histories : query_development_history ] data', '',
	'Deleting [ histories : query_development_history ] data', '<p>This is a controller only page. Attempting to delete a record.</p>',
	'null.php'
);

# 19. controllers/histories-delete-successful.php
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, needs_login, is_admin, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'N', 'Y', 'Y', 'Y', 'Y',
	'histories-delete-successful.php', 'Deletion successful', '',
	'Record deleted successfully!', '<p>The record has been removed from the list successfully. You may think of <strong>pruning</strong> the database:table([ histories : query_development_history ]) as well. <a href="histories-list.php">Go back now.</a></p>',
	'admin.php'
);

# 20. controllers/histories-delete-error.php
INSERT IGNORE INTO query_pages (
	subdomain_id, added_on,
	in_sitemap, is_error, needs_login, is_admin, is_active, is_approved,
	page_name, page_title, include_file,
	content_title, content_text,
	template_file
) VALUES (
	__SUBDOMAIN_ID__, CURRENT_TIMESTAMP(),
	'N', 'Y', 'Y', 'Y', 'Y', 'Y',
	'histories-delete-error.php', 'Deletion Failed', '',
	'Deletion failed!', '<p>The record is not deleted! Do you have enough <strong>permissions</strong> or <strong>valid code</strong> to delete this record?</p>',
	'admin.php'
);

# 21. Identifiers for dropdowns usages
INSERT IGNORE INTO query_identifiers (
	subdomain_id, identifier_context, identifier_code, identifier_name,
	identifier_sql, identifier_comments,
	is_active, added_on
) VALUES (
	__SUBDOMAIN_ID__, 'identifiers:histories', 'identifiers:histories', 'identifiers:histories', 'SELECT
	history_id k,
	history_name v
FROM query_development_history
WHERE
	is_active=\'Y\'
	AND is_approved=\'Y\'
	#subdomain_id=30
;', 'SELECT
	history_id k,
	history_name v
FROM query_development_history
WHERE
	is_active=\'Y\'
	AND is_approved=\'Y\'
	#AND subdomain_id=30
;', 'Y', CURRENT_TIMESTAMP()
);
