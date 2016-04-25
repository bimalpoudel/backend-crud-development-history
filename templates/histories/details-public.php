<!--{*


Created on: 2016-04-25 14:41:52 556
*}-->
<!-- public links -->
<div class="top-action">
	<ul class="links">
		<li class="record-list"><a href="histories.php" class="list">Back</a></li>
	</ul>
</div>
<!-- Public details for histories (Development History). {* Remove the fields or entire contents if not. *}-->
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
<!-- End of public details of histories (Development History) -->