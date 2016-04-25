<?php


# Created on: 2016-04-25 14:41:52 556

/**
 * histories Class
 */
class histories
	extends entity
{
	/**
	 * Optional Constructor: Load on demand only.
	 */
	public function __construct()
	{
		# Parent's default constructor is necessary.
		parent::__construct();

		/**
		 * Set Private, Protected or Public Members
		 */
		$this->protection_code = '1e2c116a811fd3732807fd01ec199867'; # Some random text, valid for the entire life
		$this->table_name = 'query_development_history'; # Name of this table/entity name
		$this->pk_column = 'history_id'; # Primary Key's Column Name

		/**
		 * Minimum validation fields as used in add/edit forms
		 */
		$this->fields = array(
			# Remove the columns that you do not want to use in the ADD form
			'add' => array(
				'history_title' => null,
				'history_text' => null,
			),

			# Remove the columns that you do not want to use in the EDIT form
			'edit' => array(
				'history_title' => null,
				'history_text' => null,
			),
		);
	}

	/**
	 * List entries from [ histories ]
	 * Column `code` signifies a protection code while deleting/editing a record
	 *
	 * @param condition $condition SQL Conditions
	 * @param int       $from_index
	 * @param int       $per_page
	 *
	 * @return array Multi-Dimensional array of entries in the list
	 */
	public function list_entries(condition $condition, $from_index = 0, $per_page = 50)
	{
		$crud = new crud();

		/**
		 * Conditions are Compiled here so that we can manupulate them individually.
		 * And make them fit for [ histories ] only.
		 */
		$conditions_compiled_AND = $crud->compile_conditions(
			$condition->get_condition('AND'),
			false, 'AND', 2
		);
		$conditions_compiled_OR = $crud->compile_conditions(
			$condition->get_condition('OR'),
			false, 'OR', 2
		);

		$from_index = (int)$from_index;
		$per_page = (int)$per_page;

		$listing_sql = "
SELECT SQL_CALC_FOUND_ROWS
	e.`{$this->pk_column}`, -- Do not remove this

	-- Modify these columns to your own required list (e.*)
	e.`history_title`,

	-- Flags, load them as per your need
	e.`is_approved`,

	MD5(CONCAT(e.`{$this->pk_column}`, '{$this->protection_code}')) `code` -- Protection Code
FROM `{$this->table_name}` `e`
WHERE
	(
		{$conditions_compiled_AND}
	)
	AND (
		{$conditions_compiled_OR}
	)
ORDER BY
	-- We assume that the sorting fields are available
	e.`sink_weight` ASC,
	e.`{$this->pk_column}` DESC
LIMIT {$from_index}, {$per_page}
;";
		$entries = $this->arrays($listing_sql);

		# Pagination helper: Set the number of entries
		$counter_sql = "SELECT FOUND_ROWS() total;"; # Uses SQL_CALC_FOUND_ROWS from above query. So, run it immediately.
		$totals = $this->row($counter_sql);
		$this->total_entries_for_pagination = isset($totals['total']) ? $totals['total'] : 0;

		return $entries;
	}

	/**
	 * Details of an entity in [ histories ] for management activities only.
	 *
	 * @param int $history_id integer Primary Key's value of an entity
	 *
	 * @return array $details Associative Array of Detailed records of an entity
	 */
	public function details($history_id = 0)
	{
		global $subdomain_id;

		$history_id = (int)$history_id;
		$details_sql = "
SELECT
	e.`{$this->pk_column}`, # Do not remove this

	e.*, # Modify these columns,

	# Admin must have it to EDIT the records
	MD5(CONCAT(e.`{$this->pk_column}`, '{$this->protection_code}')) `code` # Protection Code
FROM `{$this->table_name}` `e`
WHERE
	e.`{$this->pk_column}` = {$history_id}
	AND e.is_active='Y'
	# AND e.subdomain_id={$subdomain_id}
;";

		return $this->row($details_sql);
	}

	/**
	 * Details of an entity in [ histories ] for public display.
	 *
	 * @param int    $history_id Primary Key's value of an entity
	 * @param string $protection_code
	 *
	 * @return array Associative Array of Detailed records of an entity
	 */
	public function get_details($history_id = 0, $protection_code = '')
	{
		$history_id = (int)$history_id;
		$protection_code = $this->sanitize($protection_code);
		$details_sql = "
SELECT
	e.`{$this->pk_column}`, # Do not remove this

	e.*, # Modify these columns

	MD5(CONCAT(e.`{$this->pk_column}`, '{$this->protection_code}')) `code` # Protection Code
FROM `{$this->table_name}` `e`
WHERE
	e.`{$this->pk_column}` = {$history_id}
	AND e.is_active='Y'

	# Optionally validate
	AND MD5(CONCAT(e.`{$this->pk_column}`, '{$this->protection_code}')) = '{$protection_code}'
;";

		return $this->row($details_sql);
	}

	/**
	 * Flag a particular field; dummy use; unless you use it.
	 * Every method should sanitize the user input.
	 * It will co-exist with the live features.
	 *
	 * @param int    $history_id
	 * @param string $protection_code
	 * @param string $field_name
	 *
	 * @return bool
	 */
	public function flag_field($history_id = 0, $protection_code = '', $field_name = '')
	{
		# Allow only selected fields to be flagged Y/N
		if(!in_array($field_name, array('is_approved', 'is_featured', 'is_reported', 'is_private')))
		{
			# Such flag does not exist.
			return false;
		}

		$history_id = (int)$history_id;
		$protection_code = $this->sanitize($protection_code);
		global $subdomain_id;

		$flag_sql = "
UPDATE `{$this->table_name}` SET
	# Set your flag name here
	`{$field_name}`=IF(`{$field_name}`='Y', 'N', 'Y'),
	modified_on=CURRENT_TIMESTAMP()
WHERE
	`{$this->pk_column}` = {$history_id}
	AND subdomain_id={$subdomain_id}

	# Optionally, do not touch the deleted flags
	AND is_active='Y'

	# Optionally validate
	AND MD5(CONCAT(`{$this->pk_column}`, '{$this->protection_code}')) = '{$protection_code}'
;";

		return $this->query($flag_sql);
	}

	/**
	 * Welcome and ask for authentication?
	 * Please extend this method according to your business logic.
	 * eg. Send email to the first signed up member, trigger something else when a data is added.
	 * Called right after a new [ histories ] is added: insert-hook.
	 *
	 * @param int $history_id
	 *
	 * @return bool
	 */
	public function welcome_first($history_id = 0)
	{
		$history_id = (int)$history_id;

		return true;
	}
}
