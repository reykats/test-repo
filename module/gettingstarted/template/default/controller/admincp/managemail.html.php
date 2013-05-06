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
<form method="post" accept-charset="utf-8"  action="{url link='admincp.gettingstarted.managemail'}" style="margin-top:30px;" >
	<div class="table_header">{phrase var ='gettingstarted.search_filters'}</div>
	<div class="table">
		<div class="table_left">
			{phrase var='gettingstarted.keyword'}
		</div>
		<div class="table_right">
    		{$aFilters.title}
		</div>
	<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
			Module:
		</div>
		<div class="table_right">
        	{$aFilters.type}
    	</div>
		<div class="clear"></div>
	</div>
	<div class="table_bottom">
    	<input type="hidden" value="search_" name="se"/>
    	<input type="submit" name="search[submit]" value="{phrase var='core.submit'}" class="button" />
    	<input type="submit" name="search[reset]" value="{phrase var='core.reset'}" class="button" />
	</div>
</form>

{if count($aCategories)}

<form method="post" action="{url link='admincp.gettingStarted.managemail'}">
        <div class="table_header">
            {phrase var='gettingStarted.manage_mails'}
        </div>
	<table>
	<tr>
		<th style="width:10px;"><input type="checkbox" name="val[id]" value="" id="js_check_box_all" class="main_checkbox" /></th>
        <th>{phrase var='gettingStarted.module'}</th>
		<th>{phrase var='gettingStarted.time'}</th>
        <th>{phrase var='gettingstarted.subtitle'}</th>
		<th>{phrase var='gettingStarted.message'}</th>
		<th>{phrase var='gettingStarted.active'}</th>
        <th>{phrase var='gettingStarted.edit'}</th>
	</tr>
	{foreach from=$aCategories key=iKey item=aCategory}
	<tr id="js_row{$aCategory.scheduledmail_id}" class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
		<td><input type="checkbox" name="id[]" class="checkbox" value="{$aCategory.scheduledmail_id}" id="js_id_row{$aCategory.scheduledmail_id}" /></td>               
                <td>{$aCategory.scheduledmail_name}</td>
                <td>{$aCategory.time}</td>
                <td>{$aCategory.name}</td>
                <td>{$aCategory.message_parsed|shorten:300:'expand':true}</td>
                <td style="width: 60px;text-align: center;">           
                    <div class="js_item_is_active" {if $aCategory.active==0}style="display: none"{else}style="display: block"{/if}>
			<a title="Deactivate" class="js_item_active_link" href="#?call=gettingstarted.updateScheduledActivity&amp;id={$aCategory.scheduledmail_id}&amp;active=0"><img alt="" src="{$corepath}theme/adminpanel/default/style/default/image/misc/bullet_green.png"></a>
                    </div>
                    <div class="js_item_is_not_active" {if $aCategory.active==1}style="display: none"{else}style="display: block"{/if}>
			<a title="Activate" class="js_item_active_link" href="#?call=gettingstarted.updateScheduledActivity&amp;id={$aCategory.scheduledmail_id}&amp;active=1"><img alt="" src="{$corepath}theme/adminpanel/default/style/default/image/misc/bullet_red.png"></a>
                    </div>                
                </td>
                <td style="width: 45px;"><a href="{url link='admincp/gettingStarted/editscheduledmail'}id_{$aCategory.scheduledmail_id}">Edit</a></td>
	</tr>
	{/foreach}
	</table>
	<div class="table_bottom">
		<input type="submit" name="delete" value="{phrase var='blog.delete_selected'}" class="sJsConfirm delete button sJsCheckBoxButton disabled" disabled="true" />
		    	
	</div>
	
</form>

{pager}
{else}
	{if $bIsSearch}
		<div class="error-message">{phrase var='gettingstarted.no_search_results_found'}</div>
	{else}
	<div class="p_4">
            {phrase var='gettingstarted.no_mails_have_been_created'} <a href="{url link='admincp.gettingstarted.addscheduledmail'}">Create one now.</a>
	</div>
	{/if}
{/if}