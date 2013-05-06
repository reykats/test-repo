<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class Recipeblocks_Component_Block_Myrecipes extends Phpfox_Component
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

           $aRacipes ? $msg = '' : $msg = "You haven't added a recipe yet.<br><br>Why not <a href='/network/recipe/add/'>add one</a>? It's fun and easy!";

		
		$this->template()->assign(array(
				'aRacipes' => $aRacipes,
				'sHeader' => 'My Recipes',
				'msg' => $msg,
			)
		);
		return 'block';
	}

    public function getMyRecipes($id){

        return Phpfox::getLib('database') ->select('u.*')
              ->from('phpfox_recipe u')
		->where('u.user_id = ' . $id)
              ->order('rand()')
			  ->limit(5)
			  ->execute('getSlaveRows');
    }
}

?>