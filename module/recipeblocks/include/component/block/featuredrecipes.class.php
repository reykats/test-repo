<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class Recipeblocks_Component_Block_Featuredrecipes extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
	
	    $aRacipes = $this->getFeaturedRecipes();

		$this->template()->assign(array(
				'aRacipes' => $aRacipes,
				'sHeader' => 'Featured Recipes'
			)
		);
		return 'block';
	}

    public function getFeaturedRecipes(){

        return Phpfox::getLib('database') ->select('u.*')
              ->from('phpfox_recipe u')
		->where('is_featured = 1')
              ->order('rand()')
			  ->limit(5)
			  ->execute('getSlaveRows');
    }
}

?>