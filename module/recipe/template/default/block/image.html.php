<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		phpfoxguru.com
 * @author  		Nicolas
 * @package  		Module_Recipe
 * @version 		$Id: image.html.php 2009-09-10 Nicolas $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
{if !empty($aRecipe.image_path)}
<div class="t_center" style="margin-bottom:10px;">
	{img  thickbox=true path='recipe.url_image' file=$aRecipe.image_path suffix=$sSuffix max_width='180' max_height='180'  thickbox=true title=$aRecipe.title}
</div>
{/if}