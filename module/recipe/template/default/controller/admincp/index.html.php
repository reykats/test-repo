<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		phpfoxguru.com
 * @author  		Nicolas
 * @package  		Module_Recipe
 * @version 		$Id: index.html.php 2009-09-10 Nicolas $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<div id="js_menu_drop_down" style="display:none;">
	<div class="link_menu dropContent" style="display:block;">
		<ul>
			<li><a href="#" onclick="return $Core.recipe.action(this, 'edit');">{phrase var='recipe.edit'}</a></li>
			<li><a href="#" onclick="return $Core.recipe.action(this, 'delete');">{phrase var='recipe.delete'}</a></li>
		</ul>
	</div>
</div>
<div class="table_header">
	{phrase var='recipe.categories'}
</div>
<form method="post" action="{url link='admincp.recipe'}">
	<div class="table">
		<div class="sortable">
			{$sCategories}			
		</div>
	</div>
	<div class="table_clear">
		<input type="submit" value="{phrase var='recipe.update_order'}" class="button" />
	</div>
</form>