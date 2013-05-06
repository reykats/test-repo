<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		phpfoxguru.com
 * @author  		Nicolas
 * @package  		Module_Recipe
 * @version 		$Id: rate.html.php 2009-09-10 Nicolas $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<div class="p_4">
<form method="post" action="#">
		<div><input type="hidden" name="rating[type]" value="{$aRatingCallback.type}" /></div>
		<div><input type="hidden" name="rating[item_id]" value="{$aRatingCallback.item_id}" /></div>
		<div style="height:18px;">
			<div>		
			{foreach from=$aRatingCallback.stars key=sKey item=sPhrase}		
				<input type="radio" class="js_rating_star" id="js_rating_star_{$sKey}" name="rating[star]" value="{$sKey}|{$sPhrase}" title="{$sKey}{if $sPhrase != $sKey} ({$sPhrase}){/if}"{if $aRatingCallback.default_rating >= $sKey} checked="checked"{/if} />
			{/foreach}	
				<div class="clear"></div>
			</div>
		</div>
		{if isset($aRatingCallback.total_rating)}
		<div class="extra_info" style="text-align:left;font-weight:bold;padding:2px 0px 0px 2px;">
				<span class="js_rating_total">{$aRatingCallback.total_rating}</span>
				<span class="js_rating_value"></span>
		</div>		
		{/if}
</form>
</div>
<div class="clear"></div>