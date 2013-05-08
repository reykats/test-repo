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
 * @version 		$Id: browse.class.php 2009-09-10 Nicolas $
 */
class Recipe_Service_Browse extends Phpfox_Service 
{
	private $_aConditions = array();
	
	private $_iCnt = 0;
	
	private $_iPage = 0;
	
	private $_iPageSize = 25;
	
	private $_sOrder = 'm.is_featured DESC, m.time_stamp DESC';
	
	private $_aRows = array();
	
	private $_sCategory = null;	
	
	private $_aCallback = false;
	
	private $_sTag = null;
	
	private $_sTagText = null;

	public function __construct()
	{	
		$this->_sTable = Phpfox::getT('recipe');
	}
	
	public function condition($aConditions)
	{
		$this->_aConditions = $aConditions;
		
		return $this;
	}
	
	public function page($iPage)
	{
		$this->_iPage = $iPage;
		
		return $this;
	}
	
	public function size($iPageSize)
	{
		$this->_iPageSize = $iPageSize;
		
		return $this;
	}
	
	public function category($sCategory)
	{
		$this->_sCategory = $sCategory;
		
		return $this;
	}
	
	public function callback($aCallback)
	{
		$this->_aCallback = $aCallback;
		
		return $this;
	}
	
	public function order($sOrder)
	{		
		if ($sOrder != 'm.time_stamp DESC')
		{		
			$this->_sOrder = $sOrder;
		}
		
		return $this;
	}
	
	public function tag($sTag)
	{
		$this->_getTagText($sTag);
		$this->_sTag = $sTag;
		
		return $this;
	}
	
	public function _getTagText($tag) {
		//added script by Rey for Tag Search Value
		$aTagText = Phpfox::getLib('database')->select('tag_text')
			->from(Phpfox::getT('tag'))
			->where('tag_url = \'' .  trim($tag) . '\'')
			->execute('getRow');
		$this->_sTagText = $aTagText['tag_text'];
	}
	
	public function tagText() {
		return $this->_sTagText;
	}
	
	public function execute()
	{
		if ($this->_sCategory !== null)
		{
			$sCategories = Phpfox::getService('recipe.category')->getAllCategories($this->_sCategory,Phpfox::getT('recipe_category'));
		
			$this->database()->innerJoin(Phpfox::getT('recipe_category_data'), 'mcd', 'mcd.recipe_id = m.recipe_id');
			
			$this->_aConditions[] = ' AND mcd.category_id IN(' . $sCategories . ')';
		}		
		
		if ($this->_sTag != null)
		{
			$this->database()->innerJoin(Phpfox::getT('tag'), 'tag', 'tag.item_id = m.recipe_id AND tag.category_id = \'recipe\' AND tag.tag_url = \'' . $this->database()->escape($this->_sTag) . '\'')->group('m.recipe_id');
		}		
		
		$this->_iCnt = $this->database()->select((($this->_sCategory !== null || $this->_sTag !== null) ? 'COUNT(DISTINCT m.recipe_id)' : 'COUNT(*)'))
			->from($this->_sTable, 'm')
			->join(Phpfox::getT('recipe_text'), 'rt', 'rt.recipe_id=m.recipe_id')
			->where($this->_aConditions)
			->execute('getSlaveField');
			
		if ($this->_iCnt)
		{
			if ($this->_sCategory !== null)
			{			
				$this->database()->innerJoin(Phpfox::getT('recipe_category_data'), 'mcd', 'mcd.recipe_id = m.recipe_id')->group('m.recipe_id');
			}			
			
			if ($this->_sTag != null)
			{
				$this->database()->innerJoin(Phpfox::getT('tag'), 'tag', 'tag.item_id = m.recipe_id AND tag.category_id = \'recipe\' AND tag.tag_url = \'' . $this->database()->escape($this->_sTag) . '\'')->group('m.recipe_id');
			}
			
			$this->_aRows = $this->database()->select('m.*, ' . Phpfox::getUserField())
				->from($this->_sTable, 'm')
				->join(Phpfox::getT('user'), 'u', 'u.user_id = m.user_id')
				->join(Phpfox::getT('recipe_text'), 'rt', 'rt.recipe_id=m.recipe_id')
				->where($this->_aConditions)
				->order($this->_sOrder)
				->limit($this->_iPage, $this->_iPageSize, $this->_iCnt)
				->execute('getSlaveRows');
			foreach ($this->_aRows as $iKey => $aRow)
			{	
				$this->_aRows[$iKey]['link'] = Phpfox::getLib('url')->makeUrl('recipe.view', $aRow['title_url']);
				$this->_aRows[$iKey]['breadcrumb'] = Phpfox::getService('recipe.category')->getBreadcrumb($aRow['recipe_id']);
				
				$this->_aRows[$iKey]['aRatingCallback'] =  array(
					'type' => 'recipe',
					'total_rating' => Phpfox::getPhrase('recipe.total_rating_ratings', array('total_rating' => $aRow['total_rating'])),
					'default_rating' => $aRow['total_score'],
					'item_id' => $aRow['recipe_id'],
					'stars' => array(
						'2' => Phpfox::getPhrase('recipe.poor'),
						'4' => Phpfox::getPhrase('recipe.nothing_special'),
						'6' => Phpfox::getPhrase('recipe.worth'),
						'8' => Phpfox::getPhrase('recipe.pretty_cool'),
						'10' => Phpfox::getPhrase('recipe.awesome')
				));
			}
		}		
	}	
		
	public function get()
	{
		return $this->_aRows;
	}

	public function getCount()
	{
		return $this->_iCnt;
	}	
	
	public function __call($sMethod, $aArguments)
	{
		if ($sPlugin = Phpfox_Plugin::get('recipe.service_browse__call'))
		{
			eval($sPlugin);
			return;
		}
		Phpfox_Error::trigger('Call to undefined method ' . __CLASS__ . '::' . $sMethod . '()', E_USER_ERROR);
	}	
}
?>