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

<form method="post" action="{url link='admincp.gettingStarted.managetodolist'}" style="margin-top:30px;">
        <div class="table_header">
            {phrase var='gettingstarted.todo_list'}
        </div>
	<table>
	<tr>
		<th style="width:10px;"><input type="checkbox" name="val[id]" value="" id="js_check_box_all" class="main_checkbox" /></th>

                <th>Title</th>
                <th>Description</th>
             
                <th>{phrase var='gettingStarted.edit'}</th>
	</tr>
	{foreach from=$aCategories key=iKey item=aCategory}
	<tr id="js_row{$aCategory.todolist_id}" class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
		<td><input type="checkbox" name="id[]" class="checkbox" value="{$aCategory.todolist_id}" id="js_id_row{$aCategory.todolist_id}" /></td>
                <td>{$aCategory.title}</td>
                <td>{$aCategory.description_parsed|shorten:300:'expand':true}</td>               
                <td style="width: 45px;"><a href="{url link='admincp/gettingStarted/edittodolist'}id_{$aCategory.todolist_id}">Edit</a></td>
	</tr>
	{/foreach}
	</table>
	<div class="table_bottom">
		<input type="submit" name="delete" value="{phrase var='blog.delete_selected'}" class="sJsConfirm delete button sJsCheckBoxButton disabled" disabled="true" />
	</div>
	{else}
	<div class="p_4">
           {phrase var='gettingstarted.no_todo_lists_have_been_created'} <a href="{url link='admincp.gettingstarted.addtodolist'}">Create one now.</a>
	</div>
	{/if}
</form>

{pager}