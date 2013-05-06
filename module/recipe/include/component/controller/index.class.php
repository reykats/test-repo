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
 * @version 		$Id: index.class.php 2009-09-10 Nicolas $
 */
class Recipe_Component_Controller_Index extends Phpfox_Component
{
	public function process()
	{		
		Phpfox::getUserParam('recipe.can_access_recipe', true);
		if (($iDeleteId = $this->request()->getInt('delete')))
		{
			if (Phpfox::getService('recipe.process')->delete($iDeleteId))
			{
				$this->url()->send('recipe', null, Phpfox::getPhrase('recipe.recipe_successfully_deleted'));
			}
		}
		$oServiceRecipeBrowse = Phpfox::getService('recipe.browse');
		$iPage = $this->request()->get('page');
		$sView = $this->request()->get('view');
		$sCategory = null;		
		$iRequestCount = 0;	
		$this->setParam('sTagType', 'recipe');
		
		$aPages = array(10,20, 40);
		$aDisplays = array();
		foreach ($aPages as $iPageCnt)
		{
			$aDisplays[$iPageCnt] = Phpfox::getPhrase('core.per_page', array('total' => $iPageCnt));
		}
		$aFilters = array(
			'display' => array(
				'type' => 'select',
				'options' => $aDisplays,
				'default' => '10'
			),
			'sort' => array(
				'type' => 'select',
				'options' => array(
					'time_stamp' => Phpfox::getPhrase('recipe.date_added'),
					'total_score' => Phpfox::getPhrase('recipe.popular'),
					'total_comment' => Phpfox::getPhrase('recipe.most_discussed'),
					'total_view' => Phpfox::getPhrase('recipe.most_viewed')
				),
				'default' => 'time_stamp',
				'alias' => 'm'
			),
			'sort_by' => array(
				'type' => 'select',
				'options' => array(
					'DESC' => Phpfox::getPhrase('core.descending'),
					'ASC' => Phpfox::getPhrase('core.ascending')
				),
				'default' => 'DESC'
			),
			'keyword' => array(
				'type' => 'input:text',
				'size' => 20,
				'search' => 'AND (m.title LIKE \'%[VALUE]%\' OR rt.description LIKE \'%[VALUE]%\' OR rt.short_description LIKE \'%[VALUE]%\')'
				//'search' => 'AND m.title LIKE \'%[VALUE]%\''
			)		
		);
		
		$oFilter = Phpfox::getLib('search')
			->set(array(
				'type' => 'recipe',
				'filters' => $aFilters,
				'search' => 'keyword',
			)
		);
		
		switch ($sView)
		{
			case 'featured':
				$oFilter->setCondition('AND m.is_featured = 1');
				break;
			case 'most-viewed':
				$oFilter->setSort('total_view');
				break;
			case 'popular':
				$oFilter->setSort('total_score');
				break;
			case 'most-discussed':
				$oFilter->setSort('total_comment');
				break;
			case 'pending':
				if (Phpfox::getUserParam('recipe.can_approve_recipes'))
				{
					$oFilter->setCondition('AND m.view_id = 1');
				}				
				break;
			default:
				break;
		}
		
		$aRequests = $this->request()->getRequests();		

		$sCategoryUrl = '';	
		foreach ($aRequests as $sKey => $sValue)
		{			
			
			if (!preg_match("/req[0-9]/", $sKey))
			{
				continue;
			}
			
			$iRequestCount++;			
			
			if ($iRequestCount < 3)
			{
				continue;
			}
			$this->url()->setParam($sKey, $sValue);
			
			$sCategory = $sValue;
			$sCategoryUrl .= '.' . $sValue;
		}
		
		
		$sTagSearchValue = null;
		
		if ($this->request()->get('req2') == 'tag' && $this->request()->get('req3'))
		{
			$sCategory = null;
			$sCategoryUrl = '';
			$sTagSearchValue = $this->request()->get('req3');
		}
		
		
		$this->setParam('sCategory', $sCategory);
		
		if (defined('PHPFOX_IS_USER_PROFILE'))
		{
			$aUser = $this->getParam('aUser');
			
			$oFilter->setCondition('AND m.view_id = 0 AND m.user_id = ' . (int) $aUser['user_id']);
		}
		else 
		{
			if($sView!=='pending')
				$oFilter->setCondition('AND m.view_id = 0');
		}

		$oServiceRecipeBrowse->condition($oFilter->getConditions())
			->order($oFilter->getSort())
			->category($sCategory)
			->tag($sTagSearchValue)
			->page($iPage)
			->size($oFilter->getDisplay())
			->execute();		
			
		Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $oFilter->getDisplay(), 'count' => $oFilter->getSearchTotal($oServiceRecipeBrowse->getCount())));	
		
		$aFilterMenuCache = array();
		$aFilterMenu = array(
			Phpfox::getPhrase('recipe.recent') => '',
			Phpfox::getPhrase('recipe.featured') => 'featured',
			Phpfox::getPhrase('recipe.most_viewed') => 'most-viewed',
			Phpfox::getPhrase('recipe.popular') => 'popular',
			Phpfox::getPhrase('recipe.most_discussed') => 'most-discussed'
		);
		
		if (Phpfox::getUserParam('recipe.can_approve_recipes'))
		{
			$aFilterMenu[Phpfox::getPhrase('recipe.pending')] = 'pending';
		}
		
		$iFilterCount = 0;
		foreach ($aFilterMenu as $sMenuName => $sMenuLink)
		{
			$iFilterCount++;
			$aFilterMenuCache[] = array(
				'name' => $sMenuName,
				'link' => $this->url()->makeUrl('recipe' . (empty($sCategoryUrl) ? '' : '.category' . $sCategoryUrl), array('view' => $sMenuLink)),
				'active' => ($sView == $sMenuLink ? true : false),
				'last' => (count($aFilterMenu) === $iFilterCount ? true : false)
			);	
		}
		$this->template()->setTitle((defined('PHPFOX_IS_USER_PROFILE') ? Phpfox::getPhrase('recipe.full_name_s_recipe', array('full_name' => $aUser['full_name'])) : Phpfox::getPhrase('recipe.recipes')))
			->setBreadcrumb((defined('PHPFOX_IS_USER_PROFILE') ? Phpfox::getPhrase('recipe.full_name_s_recipe', array('full_name' => $aUser['full_name'])) : Phpfox::getPhrase('recipe.recipes')), (defined('PHPFOX_IS_USER_PROFILE') ? $this->url()->makeUrl($aUser['user_name'], array('recipe')) : $this->url()->makeUrl('recipe')))
			->setMeta('keywords', Phpfox::getParam('recipe.recipe_meta_keywords'))
			->setMeta('description', Phpfox::getParam('recipe.recipe_meta_description'))
			->setHeader('cache', array(
					'pager.css' => 'style_css',
					'recipe.js' => 'module_recipe',
					'recipe.css' => 'module_recipe',
					'rate.js' => 'module_rate',
				)
			)
			->assign(array(
					'aRecipes' => $oServiceRecipeBrowse->get(),
					'sParentLink' => 'recipe',
					'sCategoryUrl' => $sCategoryUrl,
					'sValue' => $sValue,
					'sSuffix' => '_120'
				)
			);
			if (!defined('PHPFOX_IS_USER_PROFILE'))
			{
				$this->template()->assign(array(
					'aFilterMenus' => $aFilterMenuCache
				)
				);
			
			}
			if (Phpfox::isModule('rate'))
			{
				$this->template()->setHeader(array(
						'jquery/plugin/star/jquery.rating.js' => 'static_script',
						'jquery.rating.css' => 'style_css',						
								
						'<script type="text/javascript">$Behavior.rateRecipe = function() { $Core.rate.init({module: \'recipe\',display: true}); }</script>',
					)
				);			
			}
		if ($sCategory !== null)
		{
			$aCategories = Phpfox::getService('recipe.category')->getParentBreadcrumb($sCategory);
			
			$aParentCategories = Phpfox::getService('recipe.category')->getParentCategories($sCategory);
			
			$aParts = explode(',',$aParentCategories);
			
			$iParentCategoryId = $aParts[count($aParts)-1];
			
						
			$iCnt = 0;
			foreach ($aCategories as $aCategory)
			{
				$iCnt++;
				
				$this->template()->setTitle($aCategory[0]);

				$this->template()->setBreadcrumb($aCategory[0], $aCategory[1], ($iCnt === count($aCategories) ? true : false));
			}			
		}		
		
		foreach ($oServiceRecipeBrowse->get() as $Recipe)
		{
			$this->template()->setMeta('keywords', $this->template()->getKeywords($Recipe['title']));
		}
		
		if (!empty($sTagSearchValue))
		{
			$this->template()->setBreadcrumb(Phpfox::getPhrase('recipe.tags'), $this->url()->makeUrl('recipe'));
			$this->template()->setBreadcrumb($sTagSearchValue, null, true);
		}
	}
	
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('recipe.component_controller_recipe_index_clean')) ? eval($sPlugin) : false);
	}
}

?>