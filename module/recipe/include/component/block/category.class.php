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
 * @version 		$Id: category.class.php 2009-09-10 Nicolas $
 */
class Recipe_Component_Block_Category extends Phpfox_Component
{
	public function process()
	{	
		if (defined('PHPFOX_IS_USER_PROFILE'))
		{
			return false;
		}
		$sCategory = $this->getParam('sCategory');		
		$aCategories = Phpfox::getService('recipe.category')->getForBrowse($sCategory);		
		if (!is_array($aCategories))
		{
			return false;
		}		
		if (!count($aCategories))
		{
			return false;
		}		
		$this->template()->assign(array(
				'sHeader' => Phpfox::getPhrase('recipe.categories'),
				'aCategories' => $aCategories,
				'sCategory' => $sCategory
			)
		);		
		return 'block';		
	}
	
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('recipe.component_block_category_clean')) ? eval($sPlugin) : false);
	}
}

?>