<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * @copyright		phpfoxguru.com
 * @author  		Nicolas
 * @package  		Module_Recipe
 * @version 		$Id: callback.class.php 2009-09-10 Nicolas $
 */
class Recipe_Service_Callback extends Phpfox_Service 
{
	
	public function __construct()
	{	
		$this->_sTable = Phpfox::getT('recipe');
	}
	public function getAjaxCommentVar()
	{	
		return 'recipe.can_post_comment_on_recipe';
	}
	public function getProfileLink()
	{
		return 'profile.recipe';
	}
	
	public function getNewsFeed($aRow)
	{	
		$oUrl = Phpfox::getLib('url');
		$oParseOutput = Phpfox::getLib('parse.output');		
		
		$aRow['text'] = Phpfox::getPhrase('recipe.a_href_user_link_owner_full_name_a_added_a_new_recipe_a_href_title_link_title_a', array(
				'owner_full_name' => $this->preParse()->clean($aRow['owner_full_name']),
				'title' => Phpfox::getService('feed')->shortenTitle($aRow['content']),
				'user_link' => $oUrl->makeUrl('feed.user', array('id' => $aRow['user_id'])),
				'title_link' => $aRow['link']
			)
		);
		$aRecipe = Phpfox::getService('recipe')->getRecipe($aRow['item_id'],true);
		if (isset($aRecipe['recipe_id']))
		{
			$sImage = Phpfox::getLib('image.helper')->display(array(
						'server_id' => $aRecipe['server_id'],
						'path' => 'recipe.url_image',
						'file' => $aRecipe['image_path'],
						'suffix' => '_120',
						'max_width' => 120,
						'max_height' => 120,
						'style' => 'vertical-align:top; padding-right:5px;'
					)
			);
			
			$sImage = '<a href="' . $aRow['link'] . '">' . $sImage . '</a>';
			
			$aRow['text'] .= '<div class="p_4">' . $sImage . '</div>';
		}
		$aRow['icon'] = 'module/recipe.png';
		$aRow['enable_like'] = true;
		
		return $aRow;
	}
	
	public function getCommentItem($iId)
	{
		$aRow = $this->database()->select('recipe_id AS comment_item_id, user_id AS comment_user_id')
			->from($this->_sTable)
			->where('recipe_id = ' . (int) $iId)
			->execute('getSlaveRow');
		
		$aRow['comment_view_id'] = 1;
			
		return $aRow;
	}
	
	public function addComment($aVals, $iUserId = null, $sUserName = null)
	{
		$aRow = $this->database()->select('m.recipe_id, m.title, m.title_url, u.full_name, u.user_id, u.user_name')
			->from($this->_sTable, 'm')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = m.user_id')
			->where('m.recipe_id = ' . (int) $aVals['item_id'])
			->execute('getSlaveRow');
			
		if (!isset($aRow['recipe_id']))
		{
			return Phpfox_Error::trigger('Invalid callback on recipe.');
		}	
		
		if (!defined('PHPFOX_SKIP_FEED_ENTRY'))
		{
			(Phpfox::isModule('feed') ? Phpfox::getService('feed.process')->add('comment_recipe', $aVals['item_id'], $aVals['text_parsed'], $iUserId, $aRow['user_id'], $aVals['comment_id']) : null);
		}
		$sLink = Phpfox::getLib('url')->makeUrl('recipe.view', $aRow['title_url']);
		Phpfox::getLib('mail')
				->to($aRow['user_id'])
				->subject(array('recipe.user_name_left_you_a_comment_on_site_title', array('user_name' => $sUserName, 'site_title' => Phpfox::getParam('core.site_title'))))
				->message(array('recipe.user_name_left_you_a_comment_on_your_recipe_title', array(
							'user_name' => $sUserName,
							'title' => $aRow['title'],
							'link' => $sLink
						)
					)
				)
				->notification('comment.add_new_comment')
				->send();
				
		$this->database()->updateCounter('recipe', 'total_comment', 'recipe_id', $aRow['recipe_id']);
			
		Phpfox::getService('notification.process')->add('comment_recipe', $aRow['recipe_id'], $aRow['user_id'], array(
					'title' => $aRow['title'],
					'user_id' => Phpfox::getUserId(),
					'image' => Phpfox::getUserBy('user_image'),
					'server_id' => Phpfox::getUserBy('server_id')
				)
		);			
	}
	
	public function updateCommentText($aVals, $sText)
	{
		(Phpfox::isModule('feed') ? Phpfox::getService('feed.process')->update('comment_recipe', $aVals['item_id'], $sText, $aVals['comment_id']) : null);
	}
	public function deleteComment($iId)
	{
		$this->database()->updateCounter('recipe', 'total_comment', 'recipe_id', $iId, true);
	}
	
	public function getCommentNewsFeed($aRow)
	{		
		$oUrl = Phpfox::getLib('url');
		$oParseOutput = Phpfox::getLib('parse.output');		
		
		if ($aRow['owner_user_id'] == $aRow['item_user_id'])
		{
			$aRow['text'] = Phpfox::getPhrase('recipe.a_href_user_link_full_name_a_added_a_new_comment_on_their_own_a_href_title_link_recipe_a', array(
					'user_link' => $oUrl->makeUrl('feed.user', array('id' => $aRow['user_id'])),
					'full_name' => $this->preParse()->clean($aRow['owner_full_name']),
					'title_link' => $aRow['link']
				)
			);
		}
		else 
		{
			if ($aRow['item_user_id'] == Phpfox::getUserBy('user_id'))
			{
				$aRow['text'] = Phpfox::getPhrase('recipe.a_href_user_link_full_name_a_added_a_new_comment_on_your_a_href_title_link_recipe_a', array(
						'user_link' => $oUrl->makeUrl('feed.user', array('id' => $aRow['user_id'])),
						'full_name' => $this->preParse()->clean($aRow['owner_full_name']),
						'title_link' => $aRow['link']				
					)
				);
			}
			else 
			{
				$aRow['text'] = Phpfox::getPhrase('recipe.a_href_user_link_full_name_a_added_a_new_comment_on_a_href_item_user_link_item_user_name_s_a_a_href', array(
						'user_link' => $oUrl->makeUrl('feed.user', array('id' => $aRow['user_id'])),
						'full_name' => $this->preParse()->clean($aRow['owner_full_name']),
						'title_link' => $aRow['link'],
						'item_user_link' => $oUrl->makeUrl('feed.user', array('id' => $aRow['viewer_user_id'])),
						'item_user_name' => $this->preParse()->clean($aRow['viewer_full_name'])
					)
				);
			}
		}
			
		$aRow['text'] .= Phpfox::getService('feed')->quote($aRow['content']);
		
		return $aRow;
	}
	
	public function getCommentNotificationFeed($aRow)
	{
		$aRecipe = $this->database()->select('m.recipe_id, m.title, m.title_url, u.full_name, u.user_id, u.user_name')
			->from($this->_sTable, 'm')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = m.user_id')
			->where('m.recipe_id = ' . (int) $aRow['item_id'])
			->execute('getSlaveRow');
			
		if (!isset($aRecipe['recipe_id']))
		{
			return Phpfox_Error::trigger('Invalid callback on recipe.');
		}
		return array(
			'message' => Phpfox::getPhrase('recipe.full_name_wrote_a_comment_on_your_recipe', array(
					'user_link' => Phpfox::getLib('url')->makeUrl($aRow['user_name']),
					'full_name' => $aRow['full_name'],
					'link' => Phpfox::getLib('url')->makeUrl('recipe.view', array($aRecipe['title_url'])),
					'title' => Phpfox::getLib('parse.output')->shorten($aRow['item_title'], 20, '...')	
				)
			),
			'link' => Phpfox::getLib('url')->makeUrl('recipe.view', array($aRecipe['title_url'])),
			'path' => 'core.url_user',
			'suffix' => '_50'
		);	
	}
	
	public function getCommentNotification($aNotification)
	{
		$aRecipe = $this->database()->select('m.recipe_id, m.title, m.title_url, u.full_name, u.user_id, u.user_name')
			->from($this->_sTable, 'm')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = m.user_id')
			->where('m.recipe_id = ' . (int) $aNotification['item_id'])
			->execute('getSlaveRow');
			
		if (!isset($aRecipe['recipe_id']))
		{
			return Phpfox_Error::trigger('Invalid callback on recipe.');
		}
		$sUsers = Phpfox::getService('notification')->getUsers($aNotification);
		
		return array(
			'link' => Phpfox::getLib('url')->makeUrl('recipe.view', array($aRecipe['title_url'])),
			'message' => Phpfox::getPhrase('recipe.full_name_wrote_a_comment_on_your_recipe_notification', array(
					'users' => $sUsers,
					'link' => Phpfox::getLib('url')->makeUrl('recipe.view', array($aRecipe['title_url'])),
					'title' => Phpfox::getLib('parse.output')->shorten($aRecipe['title'], 20, '...')	
				)
			),
			'icon' => Phpfox::getLib('template')->getStyle('image', 'activity.png', 'blog')
		);
	}
	
	public function getFeedRedirect($iId, $iChild = 0)
	{
		$aRow = $this->database()->select('m.recipe_id,m.title, m.title_url, u.full_name, u.user_id, u.user_name')
			->from($this->_sTable, 'm')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = m.user_id')
			->where('m.recipe_id = ' . (int) $iId)
			->execute('getSlaveRow');;
			
		if (!isset($aRow['recipe_id']))
		{
			return false;
		}
					
			
		if ($iChild > 0)
		{
			return Phpfox::getLib('url')->makeUrl('recipe.view', array($aRow['title_url'], 'comment' => $iChild, '#comment-view'));
		}		
		return Phpfox::getLib('url')->makeUrl('recipe.view', array($aRow['title_url']));
	}	
	
	public function getReportRedirect($iId)
	{
		return $this->getFeedRedirect($iId);
	}
	
	
	public function getWhatsNew()
	{
		return array(
			'recipe.recipes' => array(
				'ajax' => '#recipe.getNew?id=js_new_item_holder',
				'id' => 'recipe',
				'block' => 'recipe.new'
			)
		);
	}

	public function getRatingData($iId)
	{
		return array(
			'field' => 'recipe_id',
			'table' => 'recipe',
			'table_rating' => 'recipe_rating'
		);
	}
	
	public function onDeleteUser($iUser)
	{
		$aRecipes = $this->database()
			->select('recipe_id')
			->from($this->_sTable)
			->where('user_id = ' . (int)$iUser)
			->execute('getSlaveRows');

		if (empty($aRecipes))
		{
			return false;
		}
		foreach ($aRecipes as $aRecipe)
		{
			Phpfox::getService('recipe.process')->delete($aRecipe['recipe_id']);
		}
	}
	
	
	public function verifyFavorite($iItemId)
	{
		$aItem = $this->database()->select('i.recipe_id')
			->from(Phpfox::getT('recipe'), 'i')
			->where('i.recipe_id = ' . (int) $iItemId . ' AND i.view_id = 0')
			->execute('getSlaveRow');
			
		if (!isset($aItem['recipe_id']))
		{
			return false;
		}

		return true;
	}		
	
	public function getFavorite($aFavorites)
	{
		$oServiceRecipeBrowse = Phpfox::getService('recipe.browse');		
		
		$oServiceRecipeBrowse->condition('m.recipe_id IN(' . implode(',', $aFavorites) . ') AND m.view_id = 0')
			->execute();	
			
		$aRecipes = $oServiceRecipeBrowse->get();
		
		foreach ($aRecipes as $iKey => $aRecipe)
		{
			$aRecipes[$iKey]['image'] = Phpfox::getLib('image.helper')->display(array(
					'path' => 'recipe.url_image',
					'file' => $aRecipe['image_path'],
					'suffix' => '_120',
					'max_width' => 75,
					'max_height' => 75
				)
			);				
		}
		
		return array(
			'title' => Phpfox::getPhrase('recipe.recipes'),
			'items' => $aRecipes
		);		
	}
	public function getDashboardLinks()
	{
		return array(
			'submit' => array(
				'phrase' => Phpfox::getPhrase('recipe.add_a_recipe'),
				'link' => 'recipe.add',
				'image' => 'module/recipe_add.png'
			),
			'edit' => array(
				'phrase' => Phpfox::getPhrase('recipe.manage_recipes'),
				'link' => 'recipe.view_my',
				'image' => 'module/recipe_edit.png'
			)
		);
	}
	
	public function __call($sMethod, $aArguments)
	{
		if ($sPlugin = Phpfox_Plugin::get('recipe.service_callback__call'))
		{
			eval($sPlugin);
			return;
		}
		Phpfox_Error::trigger('Call to undefined method ' . __CLASS__ . '::' . $sMethod . '()', E_USER_ERROR);
	}	
	
	public function getProfileMenu($aUser)
	{
		$iTotal = $this->database()->select('count(*)')
			->from($this->_sTable, 'c')
			->where('c.view_id = 0 AND c.user_id='.$aUser['user_id'])
			->execute('getSlaveField');
		
		$aMenus[] = array(
			'phrase' => 'Recipe',
			'url' => 'profile.recipe',
			'total' => (int) $iTotal,
			'icon' => 'module/recipe.png'
		);		
		
		return $aMenus;
	}
}

?>