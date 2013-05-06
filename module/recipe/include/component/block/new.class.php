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
 * @version 		$Id: new.class.php 2009-09-10 Nicolas $
 */
class Recipe_Component_Block_New extends Phpfox_Component
{
	public function process()
	{
		$this->template()->assign(array(
				'aRecipes' => Phpfox::getService('recipe')->getNew()
			)
		);
		return 'block';
	}
	
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('recipe.component_block_new_clean')) ? eval($sPlugin) : false);
	}
}

?>