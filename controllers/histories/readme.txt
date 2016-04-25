Entity: 	histories
Produced on:	2016-04-25 14:41:52 556


Patterns of controllers (of high priorities) are:
	histories-add.php
	histories-delete.php
	histories-details.php
	histories-edit.php
	histories-list.php

	# Public pages
	histories-list-public.php
	histories-details-public.php

	histories.php


Or, with less priorities,
	histories/add.php
	histories/delete.php
	histories/details.php
	histories/edit.php
	histories/list.php

	# Public pages
	histories/list-public.php
	histories/details-public.php

	# Repeated again, here.
	histories.php


However, the second option has multiple advantages.
It helps you to group the files within one directory for each entity.
So, it seems better managed.


Any other files within this directory will be disregarded by default.
Rather, use: histories-[action].php file in the parent directory.


Developer's notes:
Every single file should have to registed in query_pages table.
If you register more files, you can use them.
Every file follows the priority patterns as defined earlier.