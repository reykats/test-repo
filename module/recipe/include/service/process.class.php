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
class Recipe_Service_Process extends Phpfox_Service 
{
	private $_aCategories = array();
		
	public function __construct()
	{
		$this->_sTable = PhpFox::getT('recipe');
	}
		
	public function add(&$aVals)
	{
		if (!isset($aVals['category']))
		{
			return Phpfox_Error::set(Phpfox::getPhrase('recipe.provide_a_category_this_item_will_belong_to'));
		}		
		foreach ($aVals['category'] as $iCategory)
		{		
			if (empty($iCategory))
			{
				continue;
			}			
			if (!is_numeric($iCategory))
			{
				continue;
			}			
			$this->_aCategories[] = $iCategory;
		}		
		if (!count($this->_aCategories))
		{
			return Phpfox_Error::set(Phpfox::getPhrase('recipe.provide_a_category_this_item_will_belong_to'));
		}

		if(Phpfox::getParam('recipe.recipe_can_upload_picture'))
		{
			if(isset($_FILES['image']['name']) and !empty($_FILES['image']['name'])){
				$sExts = implode('|', Phpfox::getService('recipe')->getFileExt());	
				if (!preg_match("/^(.*?)\.({$sExts})$/i", $_FILES['image']['name']))
				{
					return Phpfox_Error::set(Phpfox::getPhrase('recipe.not_a_valid_file_we_only_allow_sallow', array('sAllow' => implode(', ', Phpfox::getService('recipe')->getFileExt()))));
				}
			}
		}
		
		$sTitleUrl = Phpfox::getLib('parse.input')->prepareTitle('recipe', $aVals['title'], 'title_url', Phpfox::getUserId(), $this->_sTable);
		$aVals['title_url'] = $sTitleUrl;
		
		if (Phpfox::getUserParam('recipe.approve_recipes'))
		{			
			$bIsApproved = 1;
		}else{
			$bIsApproved = 0;
		}
		
		$iRecipeId = $this->database()->insert($this->_sTable, array(
				'view_id' => $bIsApproved,
				'user_id' => Phpfox::getUserId(),
				'title' => Phpfox::getLib('parse.input')->clean($aVals['title']),
				'title_url' => $sTitleUrl,
				'time_stamp' => PHPFOX_TIME,
			)
		);
		foreach ($this->_aCategories as $iCategoryId)
		{
			$this->database()->insert(Phpfox::getT('recipe_category_data'), array('recipe_id' => $iRecipeId, 'category_id' => $iCategoryId));			
		}
		
		$this->database()->insert(Phpfox::getT('recipe_text'), array(
				'recipe_id' => $iRecipeId,
				'description' => Phpfox::getLib('parse.input')->clean($aVals['description']),
				'description_parsed' => Phpfox::getLib('parse.input')->prepare($aVals['description']),
				'short_description' => Phpfox::getLib('parse.input')->prepare($aVals['short_description']),
				'keywords' => Phpfox::getLib('parse.input')->prepare($aVals['keywords']),
				'servings' => Phpfox::getLib('parse.input')->prepare($aVals['servings']),
				'prep_time' => Phpfox::getLib('parse.input')->prepare($aVals['prep_time']),
				'cook_time' => Phpfox::getLib('parse.input')->prepare($aVals['cook_time']),
				'ready_in' => (int) Phpfox::getLib('parse.input')->prepare($aVals['prep_time']) + Phpfox::getLib('parse.input')->prepare($aVals['cook_time'])
			)
		);
		//insert tags here
		$this->insertTags($iRecipeId, $aVals['keywords']);
		
		if(isset($_FILES['image']['name']) and !empty($_FILES['image']['name'])){
			if(Phpfox::getParam('recipe.recipe_can_upload_picture'))
			{
				$oFile = Phpfox::getLib('file');
				$oImage = Phpfox::getLib('image');
				$aImage = $oFile->load('image', array(
						'jpg',
						'gif',
						'png'
					)
				);
				if ($aImage !== false)
				{	
					$sFileName = $oFile->upload('image', Phpfox::getParam('recipe.dir_image'), $iRecipeId);
					$this->database()->update($this->_sTable, array('image_path' => $sFileName), 'recipe_id = ' . $iRecipeId);
					$iSize = Phpfox::getParam('recipe.recipe_max_image_pic_size');
					$oImage->createThumbnail(Phpfox::getParam('recipe.dir_image') . sprintf($sFileName, ''), Phpfox::getParam('recipe.dir_image') . sprintf($sFileName, '_' . $iSize), $iSize, $iSize);
					$iSize = 120;
					$oImage->createThumbnail(Phpfox::getParam('recipe.dir_image') . sprintf($sFileName, ''), Phpfox::getParam('recipe.dir_image') . sprintf($sFileName, '_' . $iSize), $iSize, $iSize);
				}
			}
		}
		if(!$bIsApproved){
			Phpfox::getService('feed.process')->add('recipe', $iRecipeId, Phpfox::getLib('parse.input')->clean($aVals['title']), Phpfox::getUserId());
		}
		
		return true;		
	}
	
	public function update($iRecipeId, &$aVals)
	{
		if (!isset($aVals['category']))
		{
			return Phpfox_Error::set(Phpfox::getPhrase('recipe.provide_a_category_this_item_will_belong_to'));
		}		
		foreach ($aVals['category'] as $iCategory)
		{		
			if (empty($iCategory))
			{
				continue;
			}
			
			if (!is_numeric($iCategory))
			{
				continue;
			}			
			
			$this->_aCategories[] = $iCategory;
		}		
		if (!count($this->_aCategories))
		{
			return Phpfox_Error::set(Phpfox::getPhrase('recipe.provide_a_category_this_item_will_belong_to'));
		}
		
		if(Phpfox::getParam('recipe.recipe_can_upload_picture'))
		{
			if(!isset($_FILES['image']['name']) || empty($_FILES['image']['name'])){
				
			}else{			
				$sExts = implode('|', Phpfox::getService('recipe')->getFileExt());	
				if (!preg_match("/^(.*?)\.({$sExts})$/i", $_FILES['image']['name']))
				{
					return Phpfox_Error::set(Phpfox::getPhrase('recipe.not_a_valid_file_we_only_allow_sallow', array('sAllow' => implode(', ', Phpfox::getService('recipe.recipe')->getFileExt()))));
				}
			}
		}		
		
		
		
		$aRecipe = $this->database()->select('c.*')
			->from($this->_sTable, 'c')
			->where('c.recipe_id = ' . (int) $iRecipeId)
			->execute('getRow');
		
		if (!isset($aRecipe['recipe_id']))
		{
			return Phpfox_Error::set(Phpfox::getPhrase('recipe.the_recipe_does_not_exist'));
		}
		
		if (($aRecipe['user_id'] == Phpfox::getUserId() && Phpfox::getUserParam('recipe.can_edit_own_recipe')) || Phpfox::getUserParam('recipe.can_edit_other_recipe'))
		{
			$aVals['title_url'] = $aRecipe['title_url'];		
			if(isset($_FILES['image']['name']) and !empty($_FILES['image']['name'])) {
				if(Phpfox::getParam('recipe.recipe_can_upload_picture'))
				{
					if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name']))
					{
						$oFile = Phpfox::getLib('file');
						$oImage = Phpfox::getLib('image');
						$aImage = $oFile->load('image', array(
								'jpg',
								'gif',
								'png'
							)
						);	
						if ($aImage !== false)
						{
							$sFileName = $oFile->upload('image', Phpfox::getParam('recipe.dir_image'), $iRecipeId);
							$iSize = Phpfox::getParam('recipe.recipe_max_image_pic_size');
							
							if (file_exists(Phpfox::getParam('recipe.dir_image') . sprintf($sFileName, '')) && 
								file_exists(Phpfox::getParam('recipe.dir_image') . sprintf($sFileName, '_' . $iSize)) &&
								isset($aRecipe['image_path']) && !empty($aRecipe['image_path']))
							{
							
									Phpfox::getLib('file')->unlink(Phpfox::getParam('recipe.dir_image') . sprintf($aRecipe['image_path'], ''));
									Phpfox::getLib('file')->unlink(Phpfox::getParam('recipe.dir_image') . sprintf($aRecipe['image_path'], '_' . $iSize));
									
									Phpfox::getLib('file')->unlink(Phpfox::getParam('recipe.dir_image') . sprintf($aRecipe['image_path'], '_120'));
									
							}
							
							$this->database()->update($this->_sTable, array('image_path' => $sFileName), 'recipe_id = ' . $iRecipeId);
							$oImage->createThumbnail(Phpfox::getParam('recipe.dir_image') . sprintf($sFileName, ''), Phpfox::getParam('recipe.dir_image') . sprintf($sFileName, '_' . $iSize), $iSize, $iSize);
							$iSize = 120;
							$oImage->createThumbnail(Phpfox::getParam('recipe.dir_image') . sprintf($sFileName, ''), Phpfox::getParam('recipe.dir_image') . sprintf($sFileName, '_' . $iSize), $iSize, $iSize);
						}
					}else{
						if($aVals['need_upload_image']==1){							
							return Phpfox_Error::set(Phpfox::getPhrase('recipe.select_a_image_to_upload'));
						}
					}
				}
			}
			$aSql = array(
				'title' => Phpfox::getLib('parse.input')->clean($aVals['title']),
			);

			$this->database()->update($this->_sTable, $aSql, 'recipe_id = ' . $aRecipe['recipe_id']);
			
			$this->database()->update(Phpfox::getT('recipe_text'), array(
						'description' => Phpfox::getLib('parse.input')->clean($aVals['description']), 
						'description_parsed' => Phpfox::getLib('parse.input')->prepare($aVals["description"]),
						'short_description' => Phpfox::getLib('parse.input')->prepare($aVals['short_description']),
						'keywords' => Phpfox::getLib('parse.input')->prepare($aVals['keywords']),
						'servings' => Phpfox::getLib('parse.input')->prepare($aVals['servings']),
						'prep_time' => Phpfox::getLib('parse.input')->prepare($aVals['prep_time']),
						'cook_time' => Phpfox::getLib('parse.input')->prepare($aVals['cook_time']),
						'ready_in' => (int) Phpfox::getLib('parse.input')->prepare($aVals['prep_time']) + Phpfox::getLib('parse.input')->prepare($aVals['cook_time'])
					), 'recipe_id = ' . (int) $iRecipeId);
			
			$this->database()->delete(Phpfox::getT('recipe_category_data'), 'recipe_id = ' . (int) $iRecipeId);
			//insert tags here
			$this->insertTags($iRecipeId, $aVals['keywords']);
			
			foreach ($this->_aCategories as $iCategoryId)
			{
				$this->database()->insert(Phpfox::getT('recipe_category_data'), array('recipe_id' => $iRecipeId, 'category_id' => $iCategoryId));
			}
			
			return true;	
		}
		return Phpfox_Error::set(Phpfox::getPhrase('recipe.invalid_permissions'));
	}
	
	public function insertTags($iRecipeId, $_keywords) {	
		//delete tags before inserting new ones
		$this->database()->delete(Phpfox::getT('tag'), 'item_id = ' . $iRecipeId);
		//insert tag here added by reykats
		if($_keywords) {			
			$keywords = explode(",", $_keywords);
			foreach($keywords as $keyword):
				$tag_text = trim($keyword);
				$this->database()->insert(Phpfox::getT('tag'), array(
						'item_id' => $iRecipeId,
						'category_id' => 'recipe',
						'user_id' => Phpfox::getUserId(),
						'tag_text' => Phpfox::getLib('parse.input')->clean($tag_text, 255),
						'tag_url' => Phpfox::getLib('parse.input')->cleanTitle($tag_text),
						'added' => PHPFOX_TIME
					)
				);
			endforeach;
		}
	}
	
	public function delete($iRecipeId = null, &$aRecipe = null)
	{
		if ($aRecipe === null)
		{
			$aRecipe = $this->database()->select('c.*')
			->from($this->_sTable, 'c')
			->where('c.recipe_id = ' . (int) $iRecipeId)
			->execute('getRow');
		
			if (!isset($aRecipe['recipe_id']))
			{
				return Phpfox_Error::set(Phpfox::getPhrase('recipe.unable_to_find_the_recipe_you_plan_to_edit'));
			}
		}
		else 
		{
			$bOverPass = true;
		}
		
		if (($aRecipe['user_id'] == Phpfox::getUserId() && Phpfox::getUserParam('recipe.can_edit_own_recipe')) || Phpfox::getUserParam('recipe.can_edit_other_recipe') || isset($bOverPass))
		{
			if (!empty($aRecipe['image_path']))
			{
				$this->deleteImage($iRecipeId, $aRecipe['user_id']);
			}
			(Phpfox::isModule('comment') ? Phpfox::getService('comment.process')->deleteForItem(null, $aRecipe['recipe_id'], 'recipe') : null);		
			(Phpfox::isModule('feed') ? Phpfox::getService('feed.process')->delete('recipe', $aRecipe['recipe_id']) : null);
			(Phpfox::isModule('feed') ? Phpfox::getService('feed.process')->delete('comment_recipe', $aRecipe['recipe_id']) : null);

			$this->database()->delete(Phpfox::getT('recipe'), 'recipe_id = ' . $aRecipe['recipe_id']);
			$this->database()->delete(Phpfox::getT('recipe_text'), 'recipe_id = ' . $aRecipe['recipe_id']);			
			$this->database()->delete(Phpfox::getT('recipe_category_data'), 'recipe_id = ' . $aRecipe['recipe_id']);
			$this->database()->delete(Phpfox::getT('recipe_rating'), 'item_id = ' . $aRecipe['recipe_id']);
			$this->database()->delete(Phpfox::getT('notification'), "type_id = 'comment_recipe' AND item_id = " . (int) $aRecipe['recipe_id']. "");
			return true;
		}
		return Phpfox_Error::set(Phpfox::getPhrase('recipe.invalid_permissions'));
	}
	
	public function deleteImage($iRecipe, $iUser)
	{
		$iUser = (int)$iUser;
		$iRecipe = (int)$iRecipe;
		
		$sFileName = $this->database()->select('image_path')->from(Phpfox::getT('recipe'))->where('recipe_id = ' . $iRecipe)->execute('getSlaveField');
		if (!empty($sFileName))
		{
			$iSize = Phpfox::getParam('recipe.recipe_max_image_pic_size');
			if (file_exists(Phpfox::getParam('recipe.dir_image') . sprintf($sFileName, '')) && file_exists(Phpfox::getParam('recipe.dir_image') . sprintf($sFileName, '_' . $iSize)))
			{
				Phpfox::getLib('file')->unlink(Phpfox::getParam('recipe.dir_image') . sprintf($sFileName, ''));
				Phpfox::getLib('file')->unlink(Phpfox::getParam('recipe.dir_image') . sprintf($sFileName, '_' . $iSize));
				Phpfox::getLib('file')->unlink(Phpfox::getParam('recipe.dir_image') . sprintf($sFileName, '_120'));
			}
			return $this->database()->update(Phpfox::getT('recipe'), array('image_path' => ''), 'recipe_id = ' . $iRecipe);
		}
		return true;
	}
	
	public function feature($iId, $iType)
	{
		Phpfox::isUser(true);
		Phpfox::getUserParam('recipe.can_feature_recipes', true);
		
		$this->database()->update($this->_sTable, array('is_featured' => ($iType ? '1' : '0')), 'recipe_id = ' . (int) $iId);
		
		return true;
	}
	
	
	public function updateView(&$aRecipe)
	{
		$this->database()->query("UPDATE " . Phpfox::getT('recipe') . " SET total_view = total_view + 1 WHERE recipe_id = " . (int) $aRecipe['recipe_id'] . "");
		$aRecipe['total_view'] = $aRecipe['total_view'] + 1;
		return true;
	}
	
	public function approve($iRecipeId)
	{
		$aRecipe = $this->database()->select('*')
			->from(Phpfox::getT('recipe'))
			->where('recipe_id = ' . (int) $iRecipeId)
			->execute('getSlaveRow');
			
		if (!isset($aRecipe['recipe_id']))
		{
			return false;
		}
		
		Phpfox::getService('feed.process')->add('recipe', $aRecipe['recipe_id'], Phpfox::getLib('parse.input')->clean($aRecipe['title']), $aRecipe['user_id']);	
			
	
		$this->database()->update(Phpfox::getT('recipe'), array('view_id' => '0'), 'recipe_id = ' . $aRecipe['recipe_id']);
		
		return true;
	}
	
	
	
	public function __call($sMethod, $aArguments)
	{
		if ($sPlugin = Phpfox_Plugin::get('recipe.service_process__call'))
		{
			eval($sPlugin);
			return;
		}
		Phpfox_Error::trigger('Call to undefined method ' . __CLASS__ . '::' . $sMethod . '()', E_USER_ERROR);
	}	
}

?>