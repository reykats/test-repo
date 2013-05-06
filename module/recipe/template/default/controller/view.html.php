<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		phpfoxguru.com
 * @author  		Nicolas
 * @package  		Module_Recipe
 * @version 		$Id: view.html.php 2009-09-10 Nicolas $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<div class="main_break"></div>
<div id="js_recipe_outer_body">

<div class="p_4" style="color:#808080;">
	{phrase var='recipe.category'}: {$aRecipe.breadcrumb}		
</div>
<div class="p_4" style="color:#808080;padding-top:0px; padding-bottom:0px;">
	{phrase var='recipe.by'}: {$aRecipe|user} {phrase var='recipe.on'} {$aRecipe.time_stamp|date:'core.global_update_time'}	
</div>
<div class="p_4" style="color:#808080;padding-top:5px; padding-bottom:5px;">
	{phrase var='recipe.total_comments'}: {$aRecipe.total_comment}
</div>
<div class="p_4" style="color:#808080;padding-top:0px; padding-bottom:5px;">
	{phrase var='recipe.total_views'}: {$aRecipe.total_view} 
</div>	
{module name='rate.display'}

<p style="margin-top:5px;" id="js_recipe_text_{$aRecipe.recipe_id}">
		{$aRecipe.description_parsed}
</p>
<div class="t_right">
			<ul class="item_menu moderation_block_{$aRecipe.recipe_id}">
			{if Phpfox::getUserParam('recipe.can_edit_other_recipe') || ( ($aRecipe.user_id == Phpfox::getUserId()) && Phpfox::getUserParam('recipe.can_edit_own_recipe') )}
				<li><a href="{url link='recipe' delete=$aRecipe.recipe_id}">{phrase var='recipe.delete'}</a></li>
				{/if}
			{if Phpfox::getUserParam('recipe.can_edit_other_recipe') || ( ($aRecipe.user_id == Phpfox::getUserId()) && Phpfox::getUserParam('recipe.can_edit_own_recipe') )}				
				<li><a href="{url link='recipe.add' id=$aRecipe.recipe_id}">{phrase var='recipe.edit'}</a></li>
			{/if}
			</ul>
			<div class="clear"></div>
</div>

<div class="recipe_share_box">
		{if Phpfox::isModule('favorite')}
			<a href="#?call=favorite.add&amp;height=100&amp;width=400&amp;type=recipe&amp;id={$aRecipe.recipe_id}" class="inlinePopup" title="{phrase var='recipe.add_to_your_favorites'}">{img theme='misc/icn_save.png' class='v_middle'} {phrase var='recipe.favorite'}</a>
		{/if}
		{if Phpfox::isModule('share')}
			{module name='share.link' type='recipe' display='image' url=$aRecipe.bookmark title=$aRecipe.title}	
		{/if}
			{if Phpfox::isModule('report')}
				{if $aRecipe.user_id != Phpfox::getUserId()}<a href="#?call=report.add&amp;height=100&amp;width=400&amp;type=recipe&amp;id={$aRecipe.recipe_id}" class="inlinePopup" title="{phrase var='recipe.report_a_recipe'}">{img theme='misc/icn_report.png' class='v_middle'} {phrase var='recipe.report'}</a>{/if}
			{/if}		
</div>
</div>			
{module name='feed.comment'}
