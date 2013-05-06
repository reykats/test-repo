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
 * @version 		$Id: process.class.php 2009-09-10 Nicolas $
 */
class Recipe_Service_Category_Process extends Phpfox_Service 
{
	public function __construct()
	{	
		$this->_sTable = Phpfox::getT('recipe_category');
	}
	
	public function add($aVals)
	{
		if (empty($aVals['name']))
		{
			return Phpfox_Error::set(Phpfox::getPhrase('recipe.provide_category_name'));
		}
		
		$oParseInput = Phpfox::getLib('parse.input');
		
		$iId = $this->database()->insert($this->_sTable, array(
				'parent_id' => (!empty($aVals['parent_id']) ? (int) $aVals['parent_id'] : 0),
				'is_active' => 1,
				'name' => $oParseInput->clean($aVals['name'], 255),
				'name_url' => $oParseInput->cleanTitle($aVals['name']),
				'time_stamp' => PHPFOX_TIME
			)
		);
		
		$this->cache()->remove('recipe', 'substr');
		
		return $iId;
	}
	
	public function update($iId, $aVals)
	{
		$this->database()->update($this->_sTable, array('name' => Phpfox::getLib('parse.input')->clean($aVals['name'], 255), 'parent_id' => (int) $aVals['parent_id']), 'category_id = ' . (int) $iId);
		
		$this->cache()->remove('recipe', 'substr');
		
		return true;
	}
	
	public function delete($iId)
	{
		$this->database()->update($this->_sTable, array('parent_id' => 0), 'parent_id = ' . (int) $iId);
		
		$aRecipes = $this->database()->select('m.recipe_id, m.user_id, m.image_path')
			->from(Phpfox::getT('recipe_category_data'), 'mcd')
			->join(Phpfox::getT('recipe'), 'm', 'm.recipe_id = mcd.recipe_id')
			->where('mcd.category_id = ' . (int) $iId)
			->execute('getRows');		
			
		foreach ($aRecipes as $aRecipe)
		{
			Phpfox::getService('recipe.process')->delete($aRecipe['recipe_id'], $aRecipe);
		}
		
		$this->database()->delete($this->_sTable, 'category_id = ' . (int) $iId);
		
		$this->cache()->remove('recipe', 'substr');
		
		return true;
	}
	
	public function updateOrder($aVals)
	{
		foreach ($aVals as $iId => $iOrder)
		{
			$this->database()->update($this->_sTable, array('ordering' => $iOrder), 'category_id = ' . (int) $iId);
		}
		
		$this->cache()->remove('recipe', 'substr');
		
		return true;
	}
	
	public function __call($sMethod, $aArguments)
	{
		if ($sPlugin = Phpfox_Plugin::get('recipe.service_category_process__call'))
		{
			return eval($sPlugin);
		}
		Phpfox_Error::trigger('Call to undefined method ' . __CLASS__ . '::' . $sMethod . '()', E_USER_ERROR);
	}		
}
?>