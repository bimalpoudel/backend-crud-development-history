<!--{*


Created on: 2016-04-25 14:41:52 556
*}-->
<div class="search-form">
	<form autocomplete="off" method="post" action="histories-search-public.php" name="histories-livesearch"
	      id="histories-livesearch-form">
		<div class="search-bar">
			<input type="text" name="search_histories" value="{$search_histories}" id="search_histories"
			       class="search-field"/> <input type="submit" name="search-button" value="Search" class="submit"/>
		</div>
		<div id="livesearch-results"></div>
	</form>
</div>
{if $historiess|count}
<table class="data" id="data-table">
	<!--{* <caption>List of Development History</caption> *}-->
	<thead>
	<tr class="thead">
		<th>S.N.</th>
		<th>Details</th>
		<!--{* Column Headers *}-->        <th><a href="?sort=history_title">Title</a></th>
	</tr>
	</thead>
	<tbody>
	<!-- histories-details-public.php history.php -->{section name='l' loop=$historiess}
	<tr class="{cycle values='A,B'}">
		<td class="r">{$smarty.section.l.index_next+$pagination->beginning_entry()}.</td>
		<td><a href="history.php?id={$historiess[l].history_id}&amp;code={$historiess[l].code}">Details</a></td>
		<!--{* Column Data *}-->        <td>{$historiess[l].history_title}</td>
	</tr>
	{sectionelse}
	<tr class="error">
		<td>-</td>
		<td>-</td>
		<!--{* Empty Cells *}-->        <td>-</td>
	</tr>
	{/section}
	</tbody>
</table>
<!-- paginator -->
{if $pagination->has_pages()}
<div class="paginator">
	<span class="introduction">Jump to page: </span>
	<!--{* wrap with <ul>...</ul> tags when using ulli=true parameter. *}-->    <!--{* <ul> *}-->    {paginate separator=' ' ulli=false source=$pagination}    <!--{* <ul> *}-->
</div>
{/if}
{else}
<div class="nodata">No records.</div>
{/if}
<!-- End of histories List (Public) -->