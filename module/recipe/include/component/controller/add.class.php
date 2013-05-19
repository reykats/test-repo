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
 * @version 		$Id: add.class.php 2009-09-10 Nicolas $
 */
class Recipe_Component_Controller_Add extends Phpfox_Component
{
	public function process()
	{
		Phpfox::isUser(true);				
		Phpfox::getUserParam('recipe.can_add_recipe', true);
		$sUserName = Phpfox::getUserBy('user_name');
		
		$aValidation = array(
			'title' => array(
				'def' => 'required',
				'title' => Phpfox::getPhrase('recipe.provide_a_title')
			),
			'description' => array(
				'def' => 'required',
				'title' => Phpfox::getPhrase('recipe.provide_a_description')
			),
			/* 'servings' => array(
				'def' => 'int',
				'title' => 'Servings should be numeric.'
			), */
			'prep_time' => array(
				'def' => 'int',
				'title' => 'Prep Time should be numeric.'
			),
			'cook_time' => array(
				'def' => 'int',
				'title' => 'Cook Time should be numeric.'
			),
			'ready_in' => array(
				'def' => 'int',
				'title' => 'Ready In should be numeric.'
			)
		);
		$oValid = Phpfox::getLib('validator')->set(array(
				'sFormName' => 'js_form',	
				'aParams' => $aValidation
			)
		);
		
		$sFormSubmit = $this->url()->makeUrl('recipe.add');
		$bErrors = 'false';
		$bIsAdd = 'true';
		if($iRecipeId = $this->request()->getInt('id'))
		{
			$bIsAdd = 'false';
			
			$sFormSubmit = $this->url()->makeUrl('current');
			$aRecipe = Phpfox::getService('recipe')->getRecipeForEdit($iRecipeId);
			if (!isset($aRecipe['recipe_id']))
			{
				$this->url()->send('recipe', null, Phpfox::getPhrase('recipe.the_recipe_does_not_exist'));
			}
			if ($aVals = $this->request()->getArray('val'))
			{
				if ($oValid->isValid($aVals))
				{
					if(Phpfox::getService('recipe.process')->update($aVals['recipe_id'],$aVals))
					{
						$this->url()->send($sUserName, array('recipe', $aVals['title_url']), Phpfox::getPhrase('recipe.your_recipe_has_been_updated'));
					}
				}
				else
				{
					$this->template()->assign(array(
						'bErrors' => true
					));
				}
			}
			$this->template()->assign(array('aRecipe' => $aRecipe));
			$this->template()->setTitle(Phpfox::getPhrase('recipe.edit_a_recipe'))
				->setBreadcrumb(Phpfox::getPhrase('recipe.recipe_title'), $this->url()->makeUrl('recipe'))
				->setBreadcrumb(Phpfox::getPhrase('recipe.edit_a_recipe'), null, true);
			$this->template()->assign(array(
					'aForms' => $aRecipe					
				)
			);	
		}
		else
		{
			$this->template()->setTitle(Phpfox::getPhrase('recipe.add_a_recipe'))
				->setBreadcrumb(Phpfox::getPhrase('recipe.recipe_title'), $this->url()->makeUrl('recipe'))
				->setBreadcrumb(Phpfox::getPhrase('recipe.add_a_recipe'), null, true);	
		}
		
		if (($aVals = $this->request()->getArray('val')) && empty($iRecipeId))
		{
			if ($oValid->isValid($aVals))
			{
				if(Phpfox::getService('recipe.process')->add($aVals))
				{
					$this->url()->send($sUserName, array('recipe', $aVals['title_url']), Phpfox::getPhrase('recipe.your_recipe_has_been_added'));									
				}
			}
			else
			{
				$this->template()->assign(array(
					'bErrors' => true
				));
			}
		
		}
		
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
				
		$this->template()->setPhrase(array(
					'recipe.are_you_sure'
				)
			)
			->setEditor(array('wysiwyg' => true))
			->setHeader(array(
					//'recipe.js' => 'module_recipe',
					'add.js' => 'module_recipe',
					'<script type="text/javascript">$Core.recipe.init({isAdd: '.$bIsAdd.', bErrors: '.$bErrors.'});</script>'
				)
			)
			->setHeader('cache', array(
					'pager.css' => 'style_css',
					//'recipe.js' => 'module_recipe',
					'recipe.css' => 'module_recipe',
				)
			)
			->assign(array(
					'sCreateJs' => $oValid->createJS(),
					'sGetJsForm' => $oValid->getJsForm(),
					'sFormAction' => $sFormSubmit,
					'bIsAdd' => $bIsAdd,
					'sCategories' => Phpfox::getService('recipe.category')->getAddCatetories(),
					'sSuffix' => '_120',
					'sParentLink' => 'recipe',
				)
			);
	}
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('recipe.component_controller_add_clean')) ? eval($sPlugin) : false);
	}
}

?>