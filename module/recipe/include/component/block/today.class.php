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
 * @version 		$Id: today.class.php 2009-09-10 Nicolas $
 */
class Recipe_Component_Block_Today extends Phpfox_Component
{
	public function process()
	{
		
		
		if(($aTodayRecipe = Phpfox::getService('recipe')->getTodayRecipe())&&!defined('PHPFOX_IS_USER_PROFILE'))
		{
			$this->template()->assign(array(
					'sHeader' => Phpfox::getPhrase('recipe.recipe_of_the_day'),
					'aTodayRecipe' => $aTodayRecipe
				)
			);		
			return 'block';
		}else{
			return false;
		}
	}
	
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('recipe.component_block_today_clean')) ? eval($sPlugin) : false);
	}
}

?>