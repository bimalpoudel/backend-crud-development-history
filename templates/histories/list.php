<!-- Beginning of histories list -->
<!--{*


Created on: 2016-04-25 14:41:52 556
*}-->
<div class="search-form">
	<form autocomplete="off" method="post" action="histories-search.php" name="histories-livesearch" id="histories-livesearch-form">
		<div class="search-bar">
			<input type="text" name="search_histories" value="{$search_histories}" id="search_histories"
			       class="search-field"/> <input type="submit" name="search-button" value="Search" class="submit"/> <a
				href="histories-list.php">Cancel</a>
		</div>
		<div id="livesearch-results"></div>
	</form>
</div>
<div class="top-action">
	<ul class="links">
		<li class="record-list"><a href="histories-list.php?random={random}">Refresh</a></li>
		<li class="record-add"><a href="histories-add.php">Add Development History</a></li>
	</ul>
</div>
{if $historiess|count}
<div class="form-wrap">
	<form id="histories-list-form" name="histories-list-form" method="post" action="histories-blockaction.php">
		<table class="data" id="data-table">
			<!--{* <caption>List of Development History</caption> *}-->
			<thead>
			<tr class="thead">
				<th class="checkboxes"><input type="checkbox" id="histories-checkall" name="checkallentities"
				                              value="checkallentities" tabindex="0"/></th>
				<th title="Serial Number" class="th-sn">S.N.</th>
				<th title="Enable/Disable viewing this record">{#WHATTITLE#}</th>
				<th>Details</th>
				<!--{* Column Headers *}-->        <th><a href="?sort=history_title">Title</a></th>
				<th title="Other administrative options and actions on this record" class="th-menus">{#EDITTITLE#}</th>
			</tr>
			</thead>
			<tbody>
			{section name='l' loop=$historiess}
			<tr class="{cycle values='A,B'}">
				<td class="checkboxes"><input type="checkbox" name="histories[]"
				                              value="{$historiess[l].history_id}"/></td>
				<td class="r">{$smarty.section.l.index_next+$pagination->beginning_entry()}.</td>
				<td>
					<a class="ajax" href="histories-flag.php?ajax=true&amp;flag=is_approved&amp;id={$historiess[l].history_id}&amp;code={$historiess[l].code}">{$historiess[l].is_approved|yn}</a>
				</td>
				<td>
					<a href="histories-details.php?id={$historiess[l].history_id}&amp;code={$historiess[l].code}">Details</a>
				</td>
				<!--{* Column Data *}-->        <td>{$historiess[l].history_title}</td>
				<!--{* Management Icons, without being wrapped anymore *}-->
				<td class="actions nowrap">
					<ul>
						<li class="edit"><a
								href="histories-edit.php?id={$historiess[l].history_id}&amp;code={$historiess[l].code}"
								title="Edit">Edit</a></li>
						<!--{*
						<li class="move-up"><a href="histories-sort.php?id={$historiess[l].history_id}&amp;code={$historiess[l].code}&amp;direction=up" title="Move Up">Move Up</a></li>
						<li class="move-down"><a href="histories-sort.php?id={$historiess[l].history_id}&amp;code={$historiess[l].code}&amp;direction=down" title="Move Down">Move Down</a></li>
						<li class="detail"><a href="histories-details.php?id={$historiess[l].history_id}&amp;code={$historiess[l].code}" title="Details">Details</a></li>
						<li class="delete"><a href="histories-delete.php?id={$historiess[l].history_id}&amp;code={$historiess[l].code}" title="Delete" class="delete">Delete</a></li>
						*}-->
					</ul>
				</td>
			</tr>
			{sectionelse}
			<tr class="error">
				<td class="checkboxes">-</td>
				<td>-</td>
				<td>-</td>
				<!--{* Empty FOOTER Cells *}-->        <td>-</td>
				<td>-</td>
				<td>-</td>
			</tr>
			{/section}
			</tbody>
		</table>
		<div class="block-actions">
			<!--{*
				With selected records, <input type="hidden" name="action" value="nothing" />
				<select name="actions" id="actions">
					<option value="">-- Choose --</option>
					<option value="delete">Delete</option>
					<option value="disable">Disable</option>
					<option value="enable">Enable</option>
					<option value="prune">Prune</option>
					<option value="update">Update</option>
					<option value="nothing" selected="selected">Do Nothing</option>
				</select>
				<input type="submit" name="submit-button" id="submit-button" value="Perform!" />
			*}-->
		</div>
	</form>
</div>
<!-- paginator -->
{if $pagination->has_pages()}
<div class="paginator">
	<span class="introduction">Jump to page: </span> {paginate separator=' ' ulli=false source=$pagination}
</div>
{/if}
<!-- Javascript Handlers, Ajax, and Validators -->
<script src="js/ajax.js" language="javascript" type="text/javascript"></script>
{js src='validators/histories/list.js' validator=true}
{else}
<div class="nodata">No records.</div>
{/if}
<!-- End of histories List -->