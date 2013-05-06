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
<form method="post" action="{url link='admincp.recipe.add'}">
{if $bIsEdit}
	<div><input type="hidden" name="id" value="{$aForms.category_id}" /></div>
{/if}
	<div class="table_header">
		{phrase var='recipe.category_details'}
	</div>
	<div class="table">
		<div class="table_left">
			{phrase var='recipe.category_name'}:
		</div>
		<div class="table_right">
			<input type="text" name="val[name]" size="30" maxlength="100" value="{value type='input' id='name'}" />
		</div>
		<div class="clear"></div>
	</div>	
	<div class="table">
		<div class="table_left">
			{phrase var='recipe.parent_category'}:
		</div>
		<div class="table_right">
			<select name="val[parent_id]" style="width:300px;">
				<option value="">{phrase var='recipe.select'}:</option>
				{$sOptions}
			</select>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table_clear">
		<input type="submit" value="{phrase var='recipe.submit'}" class="button" />
	</div>
</form>