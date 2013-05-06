<?php
/**
* [PHPFOX_HEADER]
*/
defined('PHPFOX') or exit('NO DICE!');
?>
{if !count($aFAQs)}
<div class="message">
	No FAQ found
</div>
{/if}

{if count($aFAQs)}
<div class="table_header">
	Manage FAQs Category
</div>
<table cellpadding="0" cellspacing="0" style="font-size:11px">
<tr>
	<th style="width:30px;"></th>
	<th style="width:40px;">ID</th>
	<th style="width:100px;">Name</th>
	<th style="width:100px;">Addon</th>
	<th style="width:30px;">Order</th>
	<th style="width:20px;">Active</th>
</tr>
{foreach from=$aFAQs key=iKey item=aLink}
<tr class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
	<td class="t_center"><a href="{url link='admincp.faq.addcat' edit={$aLink.faq_cat_id}">Edit</a></td>
	<td>{$aLink.faq_cat_id}</td>
	<td>{phrase var=$aLink.cat_name}</td>
	<td>{$aLink.cat_addon_name}</td>
	<td>{$aLink.ordering}</td>
	<td>
    	{if $aLink.is_active == '1'}
    	<a href="{url link='admincp.faq.category' disable={$aLink.faq_cat_id}">{img theme='misc/bullet_green.png' alt=''}</a>
    	{elseif $aLink.is_active == '0'}
        <a href="{url link='admincp.faq.category' enable={$aLink.faq_cat_id}">{img theme='misc/bullet_red.png' alt=''}</a>
    	{/if}
	</td>
</tr>
{/foreach}
</table>
{/if}