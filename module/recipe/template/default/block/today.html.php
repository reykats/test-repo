<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		phpfoxguru.com
 * @author  		Nicolas
 * @package  		Module_Recipe
 * @version 		$Id: today.html.php 2009-09-10 Nicolas $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<div>	
	{img thickbox=true path='recipe.url_image' file=$aTodayRecipe.image_path suffix='_120' max_width='120' max_height='120' class='js_mp_fix_width' title=$aTodayRecipe.title}
	<div class="p_4" style="font-size:10pt;"><a href="{$aTodayRecipe.link}">{$aTodayRecipe.title|clean}</a></div>
</div>