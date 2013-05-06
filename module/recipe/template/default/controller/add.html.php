<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		phpfoxguru.com
 * @author  		Nicolas
 * @package  		Module_Recipe
 * @version 		$Id: add.html.php 2009-09-10 Nicolas $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
{$sCreateJs}
<div class="main_break"></div>
<form method="post" action="{$sFormAction}" id="js_form" name="js_form" onsubmit="{$sGetJsForm}" enctype="multipart/form-data">
	{if isset($aRecipe.recipe_id)}
	  <input type="hidden" name="val[recipe_id]"  value="{$aRecipe.recipe_id}" />
	  <input type="hidden" name="val[need_upload_image]" id="js_need_upload_image"  value="0" />
	{/if}
	<div class="table">
			<div class="table_left">
				{required}{phrase var='recipe.title'}:
			</div>
			<div class="table_right">
				{if isset($aRecipe.title) && $aRecipe.user_id == Phpfox::getUserId()}
				<input type="text" name="val[title]" value="{$aRecipe.title}" id="title" maxlength="150" size="40" />
				{else}
				<input type="text" name="val[title]" value="{value type='input' id='title'}" id="title" maxlength="150" size="40" />
				{/if}
			</div>
	</div>
	<div class="table">
			<div class="table_left">
			{required}<label for="category">{phrase var='recipe.category'}:</label>
			</div>
			<div class="table_right">
				{$sCategories}
			</div>
			{if isset($aRecipe.categories)}
			{literal}<script type="text/javascript">
			var aCategories = explode(',', '{/literal}{$aRecipe.categories}{literal}'); 
			for (i in aCategories) { 
				$('#js_mp_holder_' + aCategories[i]).show(); 
				$('#js_mp_category_item_' + aCategories[i]).attr('selected', true); 
			}
			</script>
			{/literal}
			{/if}
	</div>
	<div class="table">
			<div class="table_left">
				{required}{phrase var='recipe.description'}:
			</div>
			<div class="table_right">
				{editor id='description' type='basic' rows='10'}
			</div>
	</div>
		{if Phpfox::getParam('recipe.recipe_can_upload_picture')}
		<div class="table">
			<div class="table_left">
				{required}{phrase var='recipe.image'}:
			</div>

			<div class="table_right" id="js_recipe_current_image" {if !isset($aRecipe.image_path) || $aRecipe.image_path == ''} style="display: none;"{/if}>
				 {if isset($aRecipe) && isset($aRecipe.title) && isset($aRecipe.image_path)}
				 <div class="p_4">
					{img thickbox=true title=$aRecipe.title path='recipe.url_image' file=$aRecipe.image_path suffix=$sSuffix max_width='recipe.recipe_max_image_pic_size' max_height='recipe.recipe_max_image_pic_size'}
					<br />
					<a href="#" onclick="$Core.recipe.deleteImage({$aRecipe.recipe_id});return false;">{phrase var='recipe.click_here_to_delete_this_image_and_upload_a_new_one_in_its_place'}</a>
				</div>
				{/if}
			</div>

			<div class="table_right" id="js_submit_upload_image" {if isset($aRecipe.image_path) && $aRecipe.image_path != ''} style="display: none;"{/if}>
				<input type="file" id='image' name="image" />
				<div class="extra_info">
					{phrase var='recipe.you_can_upload_a_jpg_gif_or_png_file'}
				</div>
			</div>
		</div>
		{/if}
		<div class="table_clear">
			<input type="submit" value="{if isset($aRecipe.recipe_id)}{phrase var='recipe.update'}{else}{phrase var='recipe.add'}{/if}" class="button" onclick="return $Core.recipe.submitForm()"/>
		</div>
</form>