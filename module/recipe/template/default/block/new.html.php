<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		phpfoxguru.com
 * @author  		Nicolas
 * @package  		Module_Recipe
 * @version 		$Id: new.html.php 2009-09-10 Nicolas $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
{if !count($aRecipes)}
<div class="extra_info">
	{phrase var='recipe.no_recipe_have_been_added_yet'}
	<ul class="action">
		<li><a href="{url link='recipe.add'}">{phrase var='recipe.be_the_first_to_add'}</a></li>
	</ul>
</div>
{else}
{foreach from=$aRecipes name=arecipes item=aRecipe}
<div class="go_left t_center" style="width:30%;height:180px;">
	<a href="{$aRecipe.link}">{img path='recipe.url_image' file=$aRecipe.image_path suffix='_120' max_width='120' max_height='120' class='js_mp_fix_width' title=$aRecipe.title}</a>
	
	<div class="p_4">
		<a href="{$aRecipe.link}">{$aRecipe.title|clean}</a>
		<div class="extra_info">
			{phrase var='recipe.by'}: {$aRecipe|user}
		</div>
	</div>
</div>
{/foreach}
<div class="clear"></div>
{/if}