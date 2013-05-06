<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		phpfoxguru.com
 * @author  		Nicolas
 * @package  		Module_Recipe
 * @version 		$Id: image.class.php 2009-09-10 Nicolas $
 */
class Recipe_Component_Block_Image extends Phpfox_Component
{
	public function process()
	{
		$this->template()->assign(array(
				'sSuffix' => '_' . Phpfox::getParam('recipe.recipe_max_image_pic_size')
			)
		);		
		return 'block';
	}
	
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('recipe.component_block_image_clean')) ? eval($sPlugin) : false);
	}
}

?>