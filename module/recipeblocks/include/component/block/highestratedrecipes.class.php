<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class Recipeblocks_Component_Block_Highestratedrecipes extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
	
	    $aRacipes = $this->getHighestRatedRecipes();

		$this->template()->assign(array(
				'aRacipes' => $aRacipes,
				'sHeader' => 'Highest Rated Recipes'
			)
		);
		return 'block';
	}

    public function getHighestRatedRecipes(){

        return Phpfox::getLib('database') ->select('u.*')
              ->from('phpfox_recipe u')
              ->order('total_score DESC')
			  ->limit(5)
			  ->execute('getSlaveRows');
    }
}

?>