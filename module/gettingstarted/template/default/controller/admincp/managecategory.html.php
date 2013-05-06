<?php
/**
 *
 *
 * @copyright        [YouNet_COPYRIGHT]
 * @author           YouNet Company
 * @package          Module_GettingStarted
 * @version          2.01
 */

defined('PHPFOX') or exit('NO DICE!');

?>
{literal}
<style type="text/css">
#public_message, #core_js_messages
{
	margin-top:30px;
}
</style>
{/literal}
{if count($aCategories)}

<form method="post" action="{url link='admincp.gettingStarted.managecategory'}" style="margin-top:30px;">
        <div class="table_header">
       {phrase var='gettingstarted.manage_mail_categories'}
    </div>
	<table>
	<tr>
<!--		<th style="width:10px;"><input type="checkbox" name="val[id]" value="" id="js_check_box_all" class="main_checkbox" /></th>-->
                <th>{phrase var='gettingStarted.module'}</th>
		<th>Description</th>
                <th>{phrase var='gettingStarted.edit'}</th>
	</tr>
	{foreach from=$aCategories key=iKey item=aCategory}
	<tr id="js_row{$aCategory.scheduledmail_id}" class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
<!--		<td><input type="checkbox" name="id[]" class="checkbox" value="{$aCategory.scheduledmail_id}" id="js_id_row{$aCategory.scheduledmail_id}" /></td>-->
                <td style="width: 130px;">{$aCategory.scheduledmail_name}</td>
                <td>{$aCategory.description}</td>
                <td style="width: 45px;"><a href="{url link='admincp/gettingstarted/editmanagecategory'}id_{$aCategory.scheduledmail_id}">Edit</a></td>
	</tr>
	{/foreach}
	</table>

	{else}

	{/if}
</form>

{pager}