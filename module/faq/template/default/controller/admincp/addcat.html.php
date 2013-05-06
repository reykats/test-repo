<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

?>
<form method="post" action="{url link='admincp.faq.addcat'}">
	<div class="table">

		<div class="table_left">
		    Name:
            <br />
            <small style="font-size:10px;color:blue">Add here the var name of phrase</small>
		</div>

		<div class="table_right">
            <input type="text" name="val[cat_name]" value="{$aLinkForEdit.cat_name}" id="cat_name" size="55" maxlength="255" />
		</div>

		<div class="clear" style="height:20px"></div>
   		<div class="table_left">
		    Addon Name:
            <br />
            <small style="font-size:10px;color:blue">Add here the name of addon (Example <i>photo</i>) NOTE: You can't change this name. This should be extact the name of addon.</small>
		</div>

		<div class="table_right">
            <input type="text" name="val[cat_addon_name]" value="{$aLinkForEdit.cat_addon_name}" id="cat_addon_name" size="55" maxlength="255" />
		</div>

		<div class="clear" style="height:40px"></div>

		<div class="table_left">
		    Ordering:
            <br />
            <small style="font-size:10px;color:blue">Add here the order for this category</small>
		</div>

		<div class="table_right">
            <input type="text" name="val[ordering]" value="{$aLinkForEdit.ordering}" id="ordering" size="10" maxlength="10" />
		</div>

		<div class="clear" style="height:20px"></div>

		<div class="table_left">
			Is Active:
            <br />
            <small style="font-size:10px;color:blue">Enable/Disable this category</small>
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
        <input type="hidden" value="{$aLinkForEdit.faq_cat_id}" name="val[faq_cat_id]" />
        {else}
        <input type="submit" value="Add New" class="button" name="val[addnew]" />
        {/if}
	</div>
</form>