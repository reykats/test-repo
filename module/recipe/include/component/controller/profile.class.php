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
 * @version 		$Id: profile.class.php 2009-09-10 Nicolas $
 */
class Recipe_Component_Controller_Profile extends Phpfox_Component
{
	public function process()
	{	
		if ($this->request()->get('req3'))
		{
			return Phpfox::getLib('module')->setController('recipe.view');
		}
		$aUser = $this->getParam('aUser');
		return Phpfox::getLib('module')->setController('recipe.index');
	}
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('recipe.component_controller_profile_clean')) ? eval($sPlugin) : false);
	}
}

?>