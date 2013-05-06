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
<form method="post" accept-charset="utf-8"  action="{url link='admincp.gettingstarted.managearticle'}" style="margin-top:30px;" >
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
			Category:
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

<form method="post" action="{url link='admincp.gettingStarted.managearticle'}">
	<div class="table_header">
		Knowledge Base Articles
	</div>
	<table>
	<tr>
		<th style="width:8px;"><input type="checkbox" name="val[id]" value="" id="js_check_box_all" class="main_checkbox" /></th>
                <th style="width:170px;">{phrase var='gettingstarted.title'}</th>
                <th style="width:380px;">{phrase var='gettingstarted.description'}</th>
                <th>Category</th>
                <th>{phrase var='gettingStarted.edit'}</th>
	</tr>
	{foreach from=$aCategories key=iKey item=aCategory}
	<tr id="js_row{$aCategory.article_id}" class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
		<td><input type="checkbox" name="id[]" class="checkbox" value="{$aCategory.article_id}" id="js_id_row{$aCategory.article_id}" /></td>
                <td>{$aCategory.title}</td>
                <td>{$aCategory.description_parsed|shorten:300:'Expand':true}</td>
                <td>{$aCategory.article_category_name}</td>
                <td style="width: 45px;"><a href="{url link='admincp/gettingStarted/editarticle'}id_{$aCategory.article_id}/page_{$iPage}">Edit</a></td>
	</tr>
	{/foreach}
	</table>
	<div class="table_bottom">
		<input type="submit" name="delete" value="{phrase var='blog.delete_selected'}" class="sJsConfirm delete button sJsCheckBoxButton disabled" disabled="true" />
	</div>
	{else}
		{if $bIsSearch}
			<div class="error-message">{phrase var='gettingstarted.no_search_results_found'}</div>
		{else}
		<div class="p_4">
           	{phrase var='gettingstarted.no_knowledge_base_articles_have_been_created'}<a href="{url link='admincp.gettingstarted.addarticle'}">Create one now.</a>
		</div>
		{/if}
	{/if}
</form>

{pager}