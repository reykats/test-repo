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
 * @version 		$Id: recipe.class.php 2009-09-10 Nicolas $
 */
class Recipe_Service_Recipe extends Phpfox_Service 
{
	private $_aExt = array(
		'jpg' => 'photo/jpg',
		'gif' => 'photo/gif',
		'png' => 'photo/png'
	);
	
	private $_aCallback = false;
	
	public function __construct()
	{	
		$this->_sTable = Phpfox::getT('recipe');	
	}	
	
	public function getRecipe($sRecipe, $bUseId = false)
	{		
		$aRecipe = $this->database()->select('c.*,rt.*, u.user_name, rate_id AS has_rated, ' . Phpfox::getUserField())
			->from($this->_sTable, 'c')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = c.user_id')
			->join(Phpfox::getT('recipe_text'), 'rt', 'rt.recipe_id = c.recipe_id')
			->leftJoin(Phpfox::getT('recipe_rating'), 'cr', 'cr.item_id = c.recipe_id AND cr.user_id = ' . Phpfox::getUserId())
			->where(($bUseId ? 'c.recipe_id = ' . (int) $sRecipe : 'c.title_url = \'' . $this->database()->escape($sRecipe) . '\''))
			->execute('getSlaveRow');
		
			
		if (!isset($aRecipe['recipe_id']))
		{
			return false;
		}
		$aCategories = array();
		$aRecipe['breadcrumb'] = Phpfox::getService('recipe.category')->getBreadcrumb($aRecipe['recipe_id']);
		$aRecipe['bookmark'] = $this->makeUrl($aRecipe['user_name'], $aRecipe['title_url']);		
		if (Phpfox::isModule('tag'))
		{
			$aTags = Phpfox::getService('tag')->getTagsById('recipe', $aRecipe['recipe_id']);	
			if (isset($aTags[$aRecipe['recipe_id']]))
			{
				$aRecipe['tag_list'] = $aTags[$aRecipe['recipe_id']];
			}
		}
		$aRecipe['link'] = Phpfox::getService('recipe')->makeUrl($aRecipe['user_name'], $aRecipe['title_url']);
		return $aRecipe;
	}
	
	public function getRecipeForEdit($iRecipe)
	{
		$aRecipe = $this->database()->select('c.*,rt.*, u.user_name')
			->from($this->_sTable, 'c')
			->join(Phpfox::getT('recipe_text'), 'rt', 'rt.recipe_id = c.recipe_id')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = c.user_id')			
			->where('c.recipe_id = ' . (int) $iRecipe)
			->execute('getSlaveRow');
		if (isset($aRecipe['recipe_id']))
		{
			if ((Phpfox::getUserParam('recipe.can_edit_own_recipe') && $aRecipe['user_id'] == Phpfox::getUserId()) || Phpfox::getUserParam('recipe.can_edit_other_recipe'))
			{
				$aRecipe['categories'] = Phpfox::getService('recipe.category')->getCategoryIds($aRecipe['recipe_id'],Phpfox::getT('recipe_category_data'));	
				$aRecipe['recipe_url'] = $this->makeUrl($aRecipe['user_name'], $aRecipe['title_url']);
				if (Phpfox::isModule('tag'))
				{
					$aTags = Phpfox::getService('tag')->getTagsById('recipe', $aRecipe['recipe_id']);	
					if (isset($aTags[$aRecipe['recipe_id']]))
					{
						$aRecipe['tag_list'] = '';					
						foreach ($aTags[$aRecipe['recipe_id']] as $aTag)
						{
							$aRecipe['tag_list'] .= ' ' . $aTag['tag_text'] . ',';	
						}
						$aRecipe['tag_list'] = trim(trim($aRecipe['tag_list'], ','));
					}		
				}
				return $aRecipe;
			}
		}
		return Phpfox_Error::set(Phpfox::getPhrase('recipe.the_recipe_does_not_exist'));
	}
	
	public function makeUrl($sUser, $sUrl, $aCallback = null)
	{
		return Phpfox::getLib('url')->makeUrl($sUser, array('recipe', $sUrl));
	}
	
	public function getFileExt($bDisplay = false)
	{
		if ($bDisplay === true)
		{
			$sExts = '';
			$iCnt = 0;
			foreach (array_keys($this->_aExt) as $sExt)
			{
				$iCnt++;
				if ($iCnt == count($this->_aExt))
				{
					$sExts .= ' or ';
				}
				elseif ($iCnt != 1)
				{
					$sExts .= ', ';
				}
				$sExts .= strtoupper($sExt);
			}
			
			return $sExts;
		}		
		return array_keys($this->_aExt);
	}
	
	public function init()
	{
		Phpfox::getLib('setting')->setParam(array('recipe.dir_image'=>Phpfox::getParam('core.dir_pic'). 'recipe' . PHPFOX_DS));	
		Phpfox::getLib('setting')->setParam(array('recipe.url_image'=>Phpfox::getParam('core.url_pic'). 'recipe/'));
	}
	
	public function getNew()
	{
		$aRecipes = $this->database()->select('c.*, ' . Phpfox::getUserField())
			->from($this->_sTable, 'c')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = c.user_id')
			->where('c.view_id = 0')
			->order('c.time_stamp DESC')			
			->limit(6)
			->execute('getSlaveRows');
		if(count($aRecipes)>0){
			foreach ($aRecipes as $iKey => $aRecipe)
			{	
				$aRecipes[$iKey]['link'] = Phpfox::getLib('url')->makeUrl('recipe.view', $aRecipe['title_url']);				
			}
		}
		return $aRecipes;
	}
	
	public function getTodayRecipe()
	{
		$aRecipe = $this->database()->select('c.*')
			->from($this->_sTable, 'c')
			->where('c.view_id = 0 AND c.is_pickup=1')
			->limit(1)
			->execute('getSlaveRow');
		if(isset($aRecipe['recipe_id'])){
			$aRecipe['link'] = Phpfox::getLib('url')->makeUrl('recipe.view', $aRecipe['title_url']);
			return $aRecipe;
		}else{		
			return false;
		}
	}
	public function setTodayRecipe()
	{
		$this->database()->query("UPDATE " . Phpfox::getT('recipe') . " SET is_pickup = 0");
		
		$aRecipe = $this->database()->select('c.*')
			->from($this->_sTable, 'c')
			->where('c.view_id = 0')
			->order('RAND()')
			->limit(1)
			->execute('getSlaveRow');
		if(isset($aRecipe['recipe_id'])){
			$this->database()->update($this->_sTable, array('is_pickup' => 1), 'recipe_id = ' . (int) $aRecipe['recipe_id']);
		}
	}
	
	public function __call($sMethod, $aArguments)
	{
		if ($sPlugin = Phpfox_Plugin::get('recipe.service_recipe__call'))
		{
			eval($sPlugin);
			return;
		}
		Phpfox_Error::trigger('Call to undefined method ' . __CLASS__ . '::' . $sMethod . '()', E_USER_ERROR);
	}	
}

?>