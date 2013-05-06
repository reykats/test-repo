<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class Recipeblocks_Component_Block_Leastviewedrecipes extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
	
	    $aRacipes = $this->getLeastViewedRecipes();

		$this->template()->assign(array(
				'aRacipes' => $aRacipes,
				'sHeader' => 'Least Viewed Recipes'
			)
		);
		return 'block';
	}

    public function getLeastViewedRecipes(){

        return Phpfox::getLib('database') ->select('u.*')
              ->from('phpfox_recipe u')
              ->order('total_view ASC')
			  ->limit(5)
			  ->execute('getSlaveRows');
    }
}

?>