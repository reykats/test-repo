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
 * @version 		$Id: view.class.php 2009-09-10 Nicolas $
 */
class Recipe_Component_Controller_View extends Phpfox_Component
{
	public function process()
	{
		Phpfox::getUserParam('recipe.can_access_recipe', true);
		$sRecipe = $this->request()->get('req3');
		if (!($aRecipe = Phpfox::getService('recipe')->getRecipe($sRecipe)))
		{
			return Phpfox_Error::display(Phpfox::getPhrase('recipe.the_recipe_does_not_exist'));
		}
		
		if ($aRecipe['view_id']==1)
		{
			return Phpfox_Error::display(Phpfox::getPhrase('recipe.is_pending_an_admins_approval'));
		}
		
		if ($aRecipe['user_id'] == Phpfox::getUserId())
		{
			Phpfox::getService('notification.process')->delete('comment_recipe', $aRecipe['recipe_id'], Phpfox::getUserId());
		}
		
		Phpfox::getLib('database')->query("UPDATE " . Phpfox::getT('recipe') . " SET total_view = total_view + 1 WHERE recipe_id = " . (int) $aRecipe['recipe_id'] . "");
		$aRecipe['total_view'] = $aRecipe['total_view'] + 1;
		
		
		
		
		$this->setParam('aRecipe', $aRecipe);
		
	
		$this->setParam('aRatingCallback', array(
				'type' => 'recipe',
				'total_rating' => Phpfox::getPhrase('recipe.total_rating_ratings', array('total_rating' => $aRecipe['total_rating'])),
				'default_rating' => $aRecipe['total_score'],
				'item_id' => $aRecipe['recipe_id'],
				'stars' => array(
					'2' => Phpfox::getPhrase('recipe.poor'),
					'4' => Phpfox::getPhrase('recipe.nothing_special'),
					'6' => Phpfox::getPhrase('recipe.worth'),
					'8' => Phpfox::getPhrase('recipe.pretty_cool'),
					'10' => Phpfox::getPhrase('recipe.awesome')
				)
			)
		);
		
		$aPages = array(6, 12, 15, 18, 21);
		$aDisplays = array();
		foreach ($aPages as $iPageCnt)
		{
			$aDisplays[$iPageCnt] = Phpfox::getPhrase('core.per_page', array('total' => $iPageCnt));
		}
		$aFilters = array(
			'display' => array(
				'type' => 'select',
				'options' => $aDisplays,
				'default' => '6'
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
				'search' => 'AND m.title LIKE \'%[VALUE]%\''
			)		
		);
		
		$oFilter = Phpfox::getLib('search')
			->set(array(
				'type' => 'browse',
				'filters' => $aFilters,
				'search' => 'keyword',
			)
		);
		
		$this->setParam('aFeed', array(				
				'comment_type_id' => 'recipe',
				'privacy' => 0,
				'comment_privacy' => 0,
				'item_id' => $aRecipe['recipe_id'],
				'user_id' => $aRecipe['user_id'],
				'total_comment' => $aRecipe['total_comment'],
				//'time_stamp' => $aRecipe['time_stamp'],
				'feed_link' => Phpfox::getService('recipe')->makeUrl($aRecipe['user_name'], $aRecipe['title_url']),
				'feed_title' => $aRecipe['title'],
				'total_like' => 0,
			)
		);		
		
		$this->template()->setTitle($aRecipe['title'])
			->setTitle(Phpfox::getPhrase('recipe.recipes'))
			->setBreadcrumb(Phpfox::getPhrase('recipe.recipes'), $this->url()->makeUrl('recipe'))
			->setBreadcrumb($aRecipe['title'], null, true)
			->setMeta('description', $aRecipe['title'] . '.' . (!empty($aRecipe['text']) ? $aRecipe['text'] : ''))
			->setMeta('keywords', $this->template()->getKeywords($aRecipe['title']))
			->setPhrase(array(
					'rate.thanks_for_rating'			
				)
			)
			->setHeader('cache', array(
					'jquery/plugin/star/jquery.rating.js' => 'static_script',
					'jquery.rating.css' => 'style_css',
					'rate.js' => 'module_rate',					
					'jquery/plugin/jquery.highlightFade.js' => 'static_script',	
					'jquery/plugin/jquery.scrollTo.js' => 'static_script',
					'quick_edit.js' => 'static_script',
					'comment.css' => 'style_css',
					'pager.css' => 'style_css',
					'switch_legend.js' => 'static_script',
					'switch_menu.js' => 'static_script',
					//'recipe.js' => 'module_recipe',
					'recipe.css' => 'module_recipe',
					'feed.js' => 'module_feed'		
				)
			)
			->setEditor(array(
					'load' => 'simple'
				)
			)
			->assign(array(
					'aRecipe' => $aRecipe,
					'sParentLink' => 'recipe',
					'sSuffix' => '_' . Phpfox::getParam('recipe.recipe_max_image_pic_size')
				)
			);
			
		if (Phpfox::isModule('rate'))
		{
				$this->template()->setHeader(array(
						'<script type="text/javascript">$Behavior.rateRecipe = function() { $Core.rate.init({module: \'recipe\', display: ' . ($aRecipe['has_rated'] ? 'false' : ($aRecipe['user_id'] == Phpfox::getUserId() ? 'false' : 'true')) . ', error_message: \'' . ($aRecipe['has_rated'] ? Phpfox::getPhrase('recipe.you_have_already_voted', array('phpfox_squote' => true)) : Phpfox::getPhrase('recipe.you_cannot_rate_your_own_content', array('phpfox_squote' => true))) . '\'}); }</script>',
						
					)
				);			
		}	
		if (isset($aRecipe['breadcrumb']) && is_array($aRecipe['breadcrumb']))
		{
				foreach ($aRecipe['breadcrumb'] as $aParentCategory)
				{
					if (isset($aParentCategory[0]))
					{
						$this->template()->setMeta('description', $aParentCategory[0]);
						$this->template()->setMeta('keywords', $this->template()->getKeywords($aParentCategory[0]));
					}
				}
		}
	}
	
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('recipe.component_controller_view_clean')) ? eval($sPlugin) : false);
	}
}

?>