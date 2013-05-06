<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		phpfoxguru.com
 * @author  		Nicolas
 * @package  		Module_Recipe
 * @version 		$Id: filter.html.php 2009-09-10 Nicolas $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<div id="top_recipe_search">
<form method="post" action="{if empty($sCategoryUrl)}{url link=$sParentLink}{else}{url link=''$sParentLink'.category'$sCategoryUrl''}{/if}">
<div>
{filter key='keyword'}
<input type="submit" value="{phrase var='core.submit'}" id="search_button"  name="search[submit]" style="text-indent:-9999px;background:url('{module_path}recipe/static/image/searchbutton.png') no-repeat 0 0;"/>
</div>
</form>
</div>
<div class="extra_info" style="width:555px;margin:5px auto;">
{phrase var='recipe.search_tips'}
</div>
<div class="main_break"></div>