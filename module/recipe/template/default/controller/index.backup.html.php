<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		phpfoxguru.com
 * @author  		Nicolas
 * @package  		Module_Recipe
 * @version 		$Id: index.html.php 2009-09-10 Nicolas $
 */
 
/**
modified by Cozumel
if this module upgraded replace index.html with this file (and keep a coppy of this file too)
lines 47/53 changed (proper links to recipes added in)
**/

defined('PHPFOX') or exit('NO DICE!'); 
?>
{if !count($aRecipes)}
	{if defined('PHPFOX_IS_USER_PROFILE')}
		{if $aUser.user_id == Phpfox::getUserId()}
		<div class="extra_info">{phrase var='recipe.you_have_not_added_any_recipe'}</div>
		<ul class="action">
			<li><a href="{url link=''$sParentLink'.add'}">{phrase var='recipe.recipe_add_a_recipe'}</a></li>
		</ul>
		{else}
		<div class="extra_info">{phrase var='recipe.user_link_has_not_added_any_recipe' user=$aUser}</div>
		<ul class="action">
			<li><a href="{url link=$sParentLink}">{phrase var='recipe.browse_other_recipe'}</a></li>
		</ul>
		{/if}
	{else}
		<div class="main_break"></div>
		<div class="extra_info">{phrase var='recipe.no_recipe_have_been_added_yet'}</div>
		<ul class="action">
			<li><a href="{url link=''$sParentLink'.add'}">{phrase var='recipe.be_the_first_to_add'}</a></li>
		</ul>
	{/if}
{else}
	<div id="js_recipe_outer_body">
	{foreach from=$aRecipes name=arecipes item=aRecipe}
		<div id="js_recipe_{$aRecipe.recipe_id}" class="js_recipe_inline {if is_int($phpfox.iteration.arecipes/2)}row1{else}row2{/if}{if $phpfox.iteration.arecipes == 1} row_first{/if}{if $aRecipe.is_featured} row_featured{/if}{if $aRecipe.view_id == '1'} row_moderate{/if}">
		<span class="row_featured_link"{if !$aRecipe.is_featured} style="display:none;"{/if}>
			{phrase var='recipe.featured'}
		</span>	
		<div style="width:130px; position:absolute; text-align:center; left:10px;">
			<a href="/network/recipe/view/{$aRecipe.title_url}" class="js_recipe_title_{$aRecipe.recipe_id}">{img  path='recipe.url_image' file=$aRecipe.image_path suffix=$sSuffix max_width='recipe.recipe_max_image_pic_size' max_height='recipe.recipe_max_image_pic_size' class='js_mp_fix_width' title=$aRecipe.title}</a>
			
			{module name='rate.display' aRatingCallback=$aRecipe.aRatingCallback}
			
		</div>
		<div style="margin-left:145px; height:160px;">
			<a href="/network/recipe/view/{$aRecipe.title_url}" style="font-size:11pt;">{$aRecipe.title|clean}</a>
			
			<div style="color:#808080;padding-top:5px; padding-bottom:5px;">
				{phrase var='recipe.by'} {$aRecipe|user} {phrase var='recipe.on'} {$aRecipe.time_stamp|date:'core.global_update_time'}	
			</div>
			<div style="color:#808080;padding-top:5px; padding-bottom:5px;">
				{phrase var='recipe.total_comments'}: {$aRecipe.total_comment}
			</div>
			<div style="color:#808080;padding-top:0px; padding-bottom:5px;">
				{phrase var='recipe.total_views'}: {$aRecipe.total_view} 
			</div>	
			<div class="extra_info" style="padding-top:0px;">
				{$aRecipe.breadcrumb}		
			</div>
			
			
		</div>
		<div class="t_right">
			<ul class="item_menu_bar" style="margin:0px;">
				{if Phpfox::getUserParam('recipe.can_feature_recipes')}
					<li class="js_recipe_is_not_featured"{if $aRecipe.is_featured} style="display:none;"{/if}><a href="#" onclick="$(this).parents('.js_recipe_inline:first').find('.row_featured_link:first').show(); $(this).parents('.js_recipe_inline:first').addClass('row_featured'); $(this).parents('.item_menu:first').find('.js_recipe_is_not_featured:first').hide(); $(this).parents('.item_menu:first').find('.js_recipe_is_featured:first').show(); $.ajaxCall('recipe.feature', 'id={$aRecipe.recipe_id}&amp;type=1'); return false;">{phrase var='recipe.feature'}</a></li>
					<li class="js_recipe_is_featured"{if !$aRecipe.is_featured} style="display:none;"{/if}><a href="#" onclick="$(this).parents('.js_recipe_inline:first').find('.row_featured_link:first').hide(); $(this).parents('.js_recipe_inline:first').removeClass('row_featured'); $(this).parents('.item_menu:first').find('.js_recipe_is_not_featured:first').show(); $(this).parents('.item_menu:first').find('.js_recipe_is_featured:first').hide(); $.ajaxCall('recipe.feature', 'id={$aRecipe.recipe_id}&amp;type=0'); return false;">{phrase var='recipe.unfeature'}</a></li>
				{/if}
				{if $aRecipe.view_id != 0 && Phpfox::getUserParam('recipe.can_approve_recipes')}
					<li><a href="#" onclick="$.ajaxCall('recipe.approve', 'id={$aRecipe.recipe_id}'); $('#js_recipe_{$aRecipe.recipe_id}').removeClass('row_moderate'); $(this).parent().remove();return false;">{phrase var='recipe.approve'}</a></li>
				{/if}
				{if (Phpfox::getUserParam('recipe.can_edit_own_recipe') && Phpfox::getUserId() == $aRecipe.user_id) || Phpfox::getUserParam('recipe.can_edit_other_recipe')}
					<li><a href="{url link='recipe.add' id=$aRecipe.recipe_id}">{phrase var='core.edit'}</a></li>
				{/if}				
				{if ($aRecipe.user_id == Phpfox::getUserId() && Phpfox::getUserParam('recipe.can_delete_own_recipe')) || Phpfox::getUserParam('recipe.can_delete_other_recipe')}
					<li><a href="#" onclick="if (confirm('{phrase var='recipe.are_you_sure' phpfox_squote=true}')) {literal}{{/literal} $.ajaxCall('recipe.delete', 'id={$aRecipe.recipe_id}'); {literal}}{/literal} return false;">{phrase var='recipe.delete'}</a></li>
				{/if}
				
				<li><!-- --></li>
			</ul>	
		</div>	
	</div>
	{/foreach}
	<div class="clear"></div>
	<div class="t_right">
	{pager}
	</div>
	</div>
{/if}