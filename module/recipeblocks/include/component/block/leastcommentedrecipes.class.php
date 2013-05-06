<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class Recipeblocks_Component_Block_Leastcommentedrecipes extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
	
	    $aRacipes = $this->getLeastCommentedRecipes();

		$this->template()->assign(array(
				'aRacipes' => $aRacipes,
				'sHeader' => 'Least Commented Recipes'
			)
		);
		return 'block';
	}

    public function getLeastCommentedRecipes(){

        return Phpfox::getLib('database') ->select('u.*')
              ->from('phpfox_recipe u')
              ->order('total_comment ASC')
			  ->limit(5)
			  ->execute('getSlaveRows');
    }
}

?>