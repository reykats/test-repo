<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class Recipeblocks_Component_Block_Newrecipes extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
	
	    $aRacipes = $this->getNewRecipes();

		$this->template()->assign(array(
				'aRacipes' => $aRacipes,
				'sHeader' => 'New Recipes'
			)
		);
		return 'block';
	}

    public function getNewRecipes(){

        return Phpfox::getLib('database') ->select('u.*')
              ->from('phpfox_recipe u')
              ->order('time_stamp DESC')
			  ->limit(5)
			  ->execute('getSlaveRows');
    }
}

?>