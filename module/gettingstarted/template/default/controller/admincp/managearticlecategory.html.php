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

<form method="post" enctype="multipart/form-data" action="{url link='admincp.gettingstarted.managearticlecategory'}" style="margin-top:30px;">
<div class="table_header">
    {phrase var='gettingstarted.add_knowledge_base_category'}
</div>
    <div class="table">
    <div class="table_left">
        {required}Title :
    </div>
    <div class="table_right">
        <input type="text" name="val[title]" size="50" value="{$updateTitle}"/>
    </div>
    <div class="clear"></div>
</div>

<div class="table_clear">
    <input type="submit" id="submit_addarticlecategory"name="submit_addarticlecategory" value="{phrase var='core.submit'}" class="button" />
</div>
</form>

{if count($aCategories)}
<form method="post" action="{url link='admincp.gettingstarted.managearticlecategory'}" style="margin-top:30px;">
        <div class="table_header">
            {phrase var='gettingstarted.knowledge_base_categories'}
        </div>
	<table>
	<tr>
		<th style="width:10px;"><input type="checkbox" name="val[id]" value="" id="js_check_box_all" class="main_checkbox" /></th>
        <th>{phrase var='gettingstarted.title'}</th>
        <th>{phrase var='gettingStarted.edit'}</th>
	</tr>
	{foreach from=$aCategories key=iKey item=aCategory}
	<tr id="js_row{$aCategory.article_category_id}" class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
		<td><input type="checkbox" name="id[]" class="checkbox" value="{$aCategory.article_category_id}" id="js_id_row{$aCategory.article_category_id}" /></td>
        <td>{$aCategory.article_category_name}</td>
       	<td style="width: 45px;"><a href="{url link='admincp/gettingStarted/managearticlecategory'}edit-id_{$aCategory.article_category_id}">Edit</a></td>
	</tr>
	{/foreach}
	</table>
	<div class="table_bottom">
		<input type="submit" name="delete" value="{phrase var='blog.delete_selected'}" class="sJsConfirm delete button sJsCheckBoxButton disabled" disabled="true" />
	</div>
	{else}
	<div class="p_4">
            {phrase var='gettingstarted.no_knowledge_base_categories_have_been_created'}
	</div>
	{/if}
</form>

{pager}