<!--{*


Created on: 2016-04-25 14:41:52 556
*}-->
<!-- admin details -->
<div class="top-action">
	<ul class="links">
		<!--<li class=""><a href="histories-action.php?id={$histories.history_id}&amp;code={$histories.code}" class="">Action</a></li>-->
		<li class="record-add"><a href="histories-add.php" class="add">Add Development History</a></li>
		<li class="record-list"><a href="histories-list.php" class="list">List Development History</a></li>
	</ul>
</div>
<div class="clear"></div>
<!-- admin details for administrators -->
<div class="details">
	
{if $histories.history_title}
<div class="holder">
	<div class="title">Title</div>
	<div class="content">{$histories.history_title}</div>
</div>
{/if}


{if $histories.history_text}
<div class="holder">
	<div class="title">Text</div>
	<div class="content">{$histories.history_text}</div>
</div>
{/if}

</div>
<div class="clear"></div>
<div class="information">
	<ul class="links admin-editor btm-action">
		<li class="list public">
			<a href="history.php?id={$histories.history_id}&amp;code={$histories.code}" class="view">As Public</a>
		</li>
		<li class="list edit">
			<a href="histories-edit.php?id={$histories.history_id}&amp;code={$histories.code}" class="list">Edit</a>
		</li>
		<li class="list delete">
			<a href="histories-delete.php?id={$histories.history_id}&amp;code={$histories.code}" onclick="return window.confirm('Are you sure to delete this?');" class="list">Delete</a>
		</li>
	</ul>
</div>
<div class="clear"></div>
<!-- End of administrators details of histories (Development History) -->