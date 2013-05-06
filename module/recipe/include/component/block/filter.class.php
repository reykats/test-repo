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
 * @version 		$Id: filter.class.php 2009-09-10 Nicolas $
 */
class Recipe_Component_Block_Filter extends Phpfox_Component
{
	public function process()
	{
		if (defined('PHPFOX_IS_USER_PROFILE'))
		{
			return false;
		}
		return 'block';		
	}
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('recipe.component_block_filter_clean')) ? eval($sPlugin) : false);
	}
}

?>