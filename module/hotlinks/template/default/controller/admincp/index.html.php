<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: index.html.php 1544 2010-04-07 13:20:17Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<div class="table_header">
	Hotlinks
</div>
<table id="js_drag_drop" cellpadding="0" cellspacing="0">
	<tr>
		<th>Keyword</th>
		<th class="t_center" width="50%">URL</th>
		<th>Action</th>
	</tr>
	{foreach from=$sHotlinks key=iKey item=aItem}
	<tr class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
		<td>{$aItem.keyword}</td>
		<td>{$aItem.url}</td>
		<td><a href="/admincp/hotlinks/add/{$aItem.id}">Edit</a> | <a href="/admincp/hotlinks/delete/{$aItem.id}">Edit</a></td>
	</tr>
	{/foreach}
</table>