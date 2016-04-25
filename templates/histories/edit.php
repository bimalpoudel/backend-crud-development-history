<!--{*


Created on: 2016-04-25 14:41:52 556
*}-->
<div class="top-action">
	<ul class="links">
		<li class="record-list"><a href="histories-list.php">List Development History</a></li>
	</ul>
</div>
<div class="form-wrap">
	<form autocomplete="off" id="histories-edit-form" name="histories-edit-form" method="post" action="histories-edit.php"
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

			<tr>
				<td class="attribute">&nbsp;</td>
				<td>
					<input type="text" name="email" value="" class="vanish"/> <input type="text" name="is_spam" value=""
					                                                                 class="vanish"/>
					<!--{* 100% sure, only spammers fill these fields, Leave blank. *}-->
					<input type="hidden" name="history_id" value="{$histories.history_id}"/>
					<!-- This is different than system's protection code. This is related to particular ID. -->
					<input type="hidden" name="protection_code" value="{$histories.code}"/> <input type="hidden"
					                                                                                name="edit-action"
					                                                                                value="Edit Development History"/>
					<input type="submit" name="submit-button" class="submit" value="Save Changes"/> <a
						href="{url::last_page('histories-list.php')}" class="button-cancel">Cancel</a>
				</td>
			</tr>
		</table>
	</form>
</div>
<!-- End of administrators Edit -->
<!-- Validation -->
<script type="text/javascript" src="js/validator/gen_validatorv31.js"></script>
<script type="text/javascript" src="js/validators/histories/edit.js"></script>
<!-- Rich Editor: Remove if not necessary. Or, use different .js files -->
<script type="text/javascript" src="{cdn editor='tinymce'}"></script>
<script type="text/javascript" src="js/tinymce-textareas.js"></script>
<!-- End of histories Edit -->
