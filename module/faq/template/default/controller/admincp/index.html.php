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
	Manage FAQs
</div>
<table cellpadding="0" cellspacing="0" style="font-size:11px">
<tr>
	<th style="width:30px;"></th>
	<th style="width:40px;">ID</th>
	<th style="width:100px;">Category</th>
	<th style="width:100px;">Friendly URL</th>
    <th style="width:130px;">Question</th>
	<th style="width:130px;">Answer</th>
	<th style="width:100px;">Question Phrase</th>
	<th style="width:100px;">Answer Phrase</th>
	<th style="width:30px;">Order</th>
	<th style="width:20px;">Active</th>
</tr>
{foreach from=$aFAQs key=iKey item=aLink}
<tr class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
	<td class="t_center"><a href="{url link='admincp.faq.add' edit={$aLink.faq_id}">Edit</a></td>
	<td>{$aLink.faq_id}</td>
	<td>{phrase var=$aLink.cat_name}</td>
    <td>{$aLink.friendly_url|shorten:15:'...'}</td>
	<td>{$aLink.question|shorten:15:'...'}</td>
	<td>{$aLink.answer|shorten:15:'...'}</td>
	<td>
    	{if $aLink.question_phrase}
    	{$aLink.question_phrase}
    	{else}
        <a href="/admincp/language/phrase/add/">Add Phrase</a>
    	{/if}
    </td>
	<td>
    	{if $aLink.answer_phrase}
    	{$aLink.answer_phrase}
    	{else}
        <a href="/admincp/language/phrase/add/">Add Phrase</a>
    	{/if}
    </td>

	<td>{$aLink.ordering}</td>
	<td>
    	{if $aLink.is_active == '1'}
    	<a href="{url link='admincp.faq' disable={$aLink.faq_id}">{img theme='misc/bullet_green.png' alt=''}</a>
    	{elseif $aLink.is_active == '0'}
        <a href="{url link='admincp.faq' enable={$aLink.faq_id}">{img theme='misc/bullet_red.png' alt=''}</a>
    	{/if}
	</td>
</tr>
{/foreach}
</table>
{/if}