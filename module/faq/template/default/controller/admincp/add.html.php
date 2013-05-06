<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

?>
<form method="post" action="{url link='admincp.faq.add'}">
	<div class="table">
		<div class="table_left">
			Category:
            <br />
            <small style="font-size:10px;color:blue">Select Category for this FAQ</small>
		</div>
		<div class="table_right">
		    <select name="val[faq_cat_id]" id="faq_cat_id">
				<option value="">Select:</option>
                {foreach from=$aFAQs key=iKey item=aLink}
				<option value="{$aLink.faq_cat_id}"{if $aLinkForEdit.faq_cat_id == $aLink.faq_cat_id} selected{/if}>{phrase var=$aLink.cat_name}</option>
                {/foreach}
			</select>
		</div>

		<div class="clear" style="height:20px"></div>

		<div class="table_left">
		    Question:
            <br />
            <small style="font-size:10px;color:blue">Add question here if you don't want translate this</small>
		</div>

		<div class="table_right">
            <textarea name="val[question]" id="question" rows="8" cols="50">{$aLinkForEdit.question}</textarea>
		</div>

		<div class="clear" style="height:20px"></div>

		<div class="table_left">
		    Answer:
            <br />
            <small style="font-size:10px;color:blue">Add answer here if you don't want translate this</small>
		</div>

		<div class="table_right">
            <textarea name="val[answer]" id="answer" rows="8" cols="50">{$aLinkForEdit.answer}</textarea>
		</div>

		<div class="clear" style="height:20px"></div>

		<div class="table_left">
		    Question Phrase:
            <br />
            <small style="font-size:10px;color:blue">Add var name of phrase here if you want translate this (Example: faq.my_var_name)</small>
		</div>

		<div class="table_right">
            <input type="text" name="val[question_phrase]" value="{$aLinkForEdit.question_phrase}" id="question_phrase" size="55" maxlength="255" />
		</div>

		<div class="clear" style="height:20px"></div>

		<div class="table_left">
		    Answer Phrase:
            <br />
            <small style="font-size:10px;color:blue">Add var name of phrase here if you want translate this (Example: faq.my_var_name)</small>
		</div>

		<div class="table_right">
            <input type="text" name="val[answer_phrase]" value="{$aLinkForEdit.answer_phrase}" id="answer_phrase" size="55" maxlength="255" />
		</div>

		<div class="clear" style="height:20px"></div>

		<div class="table_left">
		    Ordering:
            <br />
            <small style="font-size:10px;color:blue">Add here the order for this faq</small>
		</div>

		<div class="table_right">
            <input type="text" name="val[ordering]" value="{$aLinkForEdit.ordering}" id="ordering" size="10" maxlength="10" />
		</div>

		<div class="clear" style="height:20px"></div>

		<div class="table_left">
		    Friendly URL:
		    Ordering:
            <br />
            <small style="font-size:10px;color:blue">Add here friendly url, this will be used on URL (for better seo) NB: This should be unique for each category question</small>
		</div>

		<div class="table_right">
            <input type="text" name="val[friendly_url]" value="{$aLinkForEdit.friendly_url}" id="friendly_url" size="55" maxlength="255" />
		</div>

		<div class="clear" style="height:20px"></div>

		<div class="table_left">
			Is Active:
            <br />
            <small style="font-size:10px;color:blue">Enable/Disable this faq</small>
		</div>
		<div class="table_right">
		    <select name="val[is_active]" id="is_active">
				<option value="">Select:</option>
				<option value="1"{if $aLinkForEdit.is_active == '1'} selected{/if}>Enable</option>
				<option value="0"{if $aLinkForEdit.is_active == '0'} selected{/if}>Disable</option>
			</select>
		</div>

		<div class="clear"></div>
	</div>

	<div class="table_clear">
        {if $isEdit == 1}
        <input type="submit" value="Update" class="button" name="val[update]" />
        <input type="hidden" value="{$aLinkForEdit.faq_id}" name="val[faq_id]" />
        {else}
        <input type="submit" value="Add New" class="button" name="val[addnew]" />
        {/if}
	</div>
</form>

