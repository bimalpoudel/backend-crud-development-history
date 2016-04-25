<!--{*


Created on: 2016-04-25 14:41:52 556
*}-->
<div class="top-action">
	<ul class="links">
		<li><a href="histories-list.php">List Development History</a></li>
	</ul>
</div>
<div class="form-wrap">
	<form autocomplete="off" id="histories-add-form" name="histories-add-form" method="post" action="histories-add.php"
	      enctype="multipart/form-data">
		<table class="data-editor">
			
<tr class="{cycle values='A,B'}">
	<td class="attribute">Title: <span class="required">*</span></td>
	<td>
		<input type="text" name="histories[history_title]" value="{$histories.history_title|utf8}" class="input"
		id="histories-history_title" placeholder="Title" />
		<span class="form-hints">Quick title</span>
	</td>
</tr>

<tr class="{cycle values='A,B'}">
	<td class="attribute">Text: <span class="required">*</span></td>
	<td class="value">
		<div><textarea rows="5" cols="75" name="histories[history_text]" class="plaintext" id="histories-history_text" placeholder="Text">{$histories.history_text|utf8}</textarea></div>
		<div><span class="form-hints">Development Message</span></div>
	</td>
</tr>

			<tr class="{cycle values='A,B'}">
				<td class="attribute">&nbsp;</td>
				<td>
					<input type="text" name="email" value="" class="vanish"/> <input type="text" name="is_spam" value=""
					                                                                 class="vanish"/>
					<!--{* 100% sure, only spammers fill these fields, Leave it blank/CSS hidden. *}-->
					<input type="hidden" name="protection_code" value="{$protection_code}"/> <input type="hidden"
					                                                                                name="add-action"
					                                                                                value="Add Development History"/>
					<input type="submit" name="submit-button" class="submit" value="Add"/> <a
						href="{url::last_page('histories-list.php')}" class="button-cancel">Cancel</a>
				</td>
			</tr>
		</table>
	</form>
</div>
<!-- End of administrators histories Add -->
<!-- Add validation -->
<script type="text/javascript" src="js/validator/gen_validatorv31.js"></script>
<script type="text/javascript" src="js/validators/histories/add.js"></script>
<!--{if 0|local}-->
<!-- populates sample data on the form -->
<script type="text/javascript" src="js/validators/histories/populate.js"></script>
<!--{/if}-->
<!-- Rich Editor: Remove if not necessary. Or, use different .js files -->
<script type="text/javascript" src="{cdn editor='tinymce'}"></script>
<script type="text/javascript" src="js/tinymce-textareas.js"></script>
<!-- End of histories Add -->