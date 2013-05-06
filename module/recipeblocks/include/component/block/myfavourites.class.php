<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class Recipeblocks_Component_Block_Myfavourites extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{

	    $aUser = $this->getParam('aUser');
		
	    $id = $aUser['user_id'];

	   if (!$id) $id = Phpfox::getUserBy('user_id');
	
           #if no recipes then it doesn't show rest of them?
	    $aRacipes = $this->getMyRecipes($id);

           $aRacipes ? $msg = '' : $msg = "You haven't added any favorites yet!";

		
		$this->template()->assign(array(
				'aRacipes' => $aRacipes,
				'sHeader' => 'My Favorite Recipes',
				'msg' => $msg,
			)
		);
		return 'block';
	}

    public function getMyRecipes($id){

        return       Phpfox::getLib('database')->select('phpfox_recipe.*')
			->from('phpfox_recipe')
			->join(Phpfox::getT('favorite'), 'u', 'phpfox_recipe.recipe_id = u.item_id')
			->where('u.type_id = "recipe" AND u.user_id = '  . $id)
			->order('rand()')
			->limit(5)
			->execute('getSlaveRows');
    }
}

?>