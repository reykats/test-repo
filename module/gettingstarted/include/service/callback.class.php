<?php
/**
 *
 *
 * @copyright        [YouNet_COPYRIGHT]
 * @author           YouNet Company
 * @package          Module_ScheduledMail
 * @version          2.01
 */

defined('PHPFOX') or exit('NO DICE!');

class Gettingstarted_service_callback extends Phpfox_Service
{
        public function getRatingData($iId)
        {
		return array(
			'field' => 'article_id',
			'table' => 'gettingstarted_article',
			'table_rating' => 'gettingstarted_rating'
		);
	}
        
        public function getAjaxCommentVar()
	{
		return 'gettingstarted.can_post_comment_on_article';
	}

        public function __construct()
	{
		$this->_sTable = Phpfox::getT('gettingstarted_article');
	}

        public function getCommentNewsFeed($aRow, $iUserId = null)
	{
		(($sPlugin = Phpfox_Plugin::get('gettingstarted.component_service_callback_getcommentnewsfeed__start')) ? eval($sPlugin) : false);
		$oUrl = Phpfox::getLib('url');
		$oParseOutput = Phpfox::getLib('parse.output');

		if ($aRow['owner_user_id'] == $aRow['item_user_id'])
		{
			$aRow['text'] = Phpfox::getPhrase('gettingstarted.user_added_a_new_comment_on_their_own_article', array(
					'user_name' => $aRow['owner_full_name'],
					'user_link' => $oUrl->makeUrl('feed.user', array('id' => $aRow['user_id'])),
					'title_link' => $aRow['link']
				)
			);
		}
		elseif ($aRow['item_user_id'] == Phpfox::getUserBy('user_id'))
		{
			$aRow['text'] = Phpfox::getPhrase('gettingstarted.user_added_a_new_comment_on_your_article', array(
					'user_name' => $aRow['owner_full_name'],
					'user_link' => $oUrl->makeUrl('feed.user', array('id' => $aRow['user_id'])),
					'title_link' => $aRow['link']
				)
			);
		}
		else
		{
			$aRow['text'] = Phpfox::getPhrase('gettingstarted.user_name_added_a_new_comment_on_item_user_name_article', array(
					'user_name' => $aRow['owner_full_name'],
					'user_link' => $oUrl->makeUrl('feed.user', array('id' => $aRow['user_id'])),
					'title_link' => $aRow['link'],
					'item_user_name' => $aRow['viewer_full_name'],
					'item_user_link' => $oUrl->makeUrl('feed.user', array('id' => $aRow['viewer_user_id']))
				)
			);
		}

		$aRow['text'] .= Phpfox::getService('feed')->quote($aRow['content']);
		(($sPlugin = Phpfox_Plugin::get('gettingstarted.component_service_callback_getcommentnewsfeed__end')) ? eval($sPlugin) : false);
		return $aRow;
	}

        public function addComment($aVals, $iUserId = null, $sUserName = null)
	{
		(($sPlugin = Phpfox_Plugin::get('gettingstarted.component_service_callback_addcomment__start')) ? eval($sPlugin) : false);

		$aBlog = $this->database()->select('u.full_name, u.user_id, u.gender, u.user_name, b.title, b.article_id, b.privacy')
			->from($this->_sTable, 'b')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = b.user_id')
			->where('b.article_id = ' . (int) $aVals['item_id'])
			->execute('getSlaveRow');

		// Update the post counter if its not a comment put under moderation or if the person posting the comment is the owner of the item.
		$this->database()->updateCounter('gettingstarted_article', 'total_comment', 'article_id', $aVals['item_id']);

		// Send the user an email
		$sLink = Phpfox::permalink('gettingstarted_article', $aBlog['article_id'], $aBlog['title']);

		/*Phpfox::getService('comment.process')->notify(array(
				'user_id' => $aBlog['user_id'],
				'item_id' => $aBlog['article_id'],
				'owner_subject' => Phpfox::getUserBy('full_name') . ' commented on your article "' . $aBlog['title'] . '".',
				'owner_message' => Phpfox::getUserBy('full_name') . " commented on your article \"<a href=\"" . $sLink . "\">" . $aBlog['title'] . "</a>\".\nTo see the comment thread, follow the link below:\n<a href=\"" . $sLink . "\">" . $sLink . "</a>",
				'owner_notification' => '.add_new_comment',
				'notify_id' => '',
				'mass_id' => '',
				'mass_subject' => (Phpfox::getUserId() == $aBlog['user_id'] ? Phpfox::getUserBy('full_name') . ' commented on ' . Phpfox::getService('user')->gender($aBlog['gender'], 1) . ' article.' : Phpfox::getUserBy('full_name') . ' commented on ' . $aBlog['full_name'] . '\'s article.'),
				'mass_message' => (Phpfox::getUserId() == $aBlog['user_id'] ? Phpfox::getUserBy('full_name') . " commented on " . Phpfox::getService('user')->gender($aBlog['gender'], 1) . " article \"<a href=\"" . $sLink . "\">" . $aBlog['title'] . "</a>\".\nTo see the comment thread, follow the link below:\n<a href=\"" . $sLink . "\">" . $sLink . "</a>" : Phpfox::getUserBy('full_name') . " commented on " . $aBlog['full_name'] . "'s article \"<a href=\"" . $sLink . "\">" . $aBlog['title'] . "</a>\".\nTo see the comment thread, follow the link below:\n<a href=\"" . $sLink . "\">" . $sLink . "</a>")
			)
		);*/

		(($sPlugin = Phpfox_Plugin::get('gettingstarted.component_service_callback_addcomment__end')) ? eval($sPlugin) : false);
	}

        public function updateCommentText($aVals, $sText)
	{

	}

        public function getCommentItem($iId)
	{
		$aRow = $this->database()->select('article_id AS comment_item_id, privacy_comment, user_id AS comment_user_id')
			->from($this->_sTable)
			->where('article_id = ' . (int) $iId)
			->execute('getSlaveRow');

		$aRow['comment_view_id'] = '0';

		if (!Phpfox::getService('comment')->canPostComment($aRow['comment_user_id'], $aRow['privacy_comment']))
		{
			Phpfox_Error::set('Unable to post a comment on this item due to privacy settings.');

			unset($aRow['comment_item_id']);
		}

		return $aRow;
	}

        public function getRedirectComment($iId)
	{
		return $this->getFeedRedirect($iId);
	}

        public function getCommentItemName()
	{
		return 'article';
	}

        public function processCommentModeration($sAction, $iId)
	{
		(($sPlugin = Phpfox_Plugin::get('gettingstarted.component_service_callback_processcommentmoderation__start')) ? eval($sPlugin) : false);
		// Is this comment approved?
		if ($sAction == 'approve')
		{
			// Update the blog count
			Phpfox::getService('gettingstarted.process')->updateCounter($iId);

			// Get the blogs details so we can add it to our news feed
			$aBlog = $this->database()->select('b.article_id, b.user_id, b.title, ct.text_parsed, c.user_id AS comment_user_id, c.comment_id')
				->from($this->_sTable, 'b')
				->join(Phpfox::getT('comment'), 'c', 'c.type_id = \'article\' AND c.item_id = b.article_id')
				->join(Phpfox::getT('comment_text'), 'ct', 'ct.comment_id = c.comment_id')
				->where('b.article_id = ' . (int) $iId)
				->execute('getSlaveRow');

			// Add to news feed
			(Phpfox::isModule('feed') ? Phpfox::getService('feed.process')->add('comment_artilce', $aBlog['article_id'], $aBlog['text_parsed'], $aBlog['comment_user_id'], $aBlog['user_id'], $aBlog['comment_id']) : null);

			// Send the user an email
			if (Phpfox::getParam('core.is_personal_site'))
			{
				$sLink = Phpfox::getLib('url')->makeUrl('article', $aBlog['title_url']);
			}
			else
			{
				$sLink = Phpfox::getService('user')->getLink(Phpfox::getUserId(), Phpfox::getUserBy('user_name'), array('article', $aBlog['title_url']));
			}

			Phpfox::getLib('mail')->to($aBlog['comment_user_id'])
				->subject(array('comment.full_name_approved_your_comment_on_site_title', array('full_name' => Phpfox::getUserBy('full_name'), 'site_title' => Phpfox::getParam('core.site_title'))))
				->message(array('comment.full_name_approved_your_comment_on_site_title_message', array(
							'full_name' => Phpfox::getUserBy('full_name'),
							'site_title' => Phpfox::getParam('core.site_title'),
							'link' => $sLink
						)
					)
				)
				->notification('comment.approve_new_comment')
				->send();
		}
		(($sPlugin = Phpfox_Plugin::get('gettingstarted.component_service_callback_processcommentmoderation__end')) ? eval($sPlugin) : false);
	}

        public function deleteComment($iId)
	{
		$this->database()->update($this->_sTable, array('total_comment' => array('= total_comment -', 1)), 'article_id = ' . (int) $iId);
	}

        public function getCommentNotification($aNotification)
	{
		$aRow = $this->database()->select('b.article_id, b.title, b.user_id, u.gender, u.full_name')
			->from(Phpfox::getT('gettingstarted_article'), 'b')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = b.user_id')
			->where('b.article_id = ' . (int) $aNotification['item_id'])
			->execute('getSlaveRow');

		$sPhrase = '';
		if ($aNotification['user_id'] == $aRow['user_id'] && !isset($aNotification['extra_users']))
		{
			$sPhrase = Phpfox::getService('notification')->getUsers($aNotification) . ' commented on ' . Phpfox::getService('user')->gender($aRow['gender'], 1) . ' article "' . Phpfox::getLib('parse.output')->shorten($aRow['title'], Phpfox::getParam('notification.total_notification_title_length'), '...') . '"';
		}
		elseif ($aRow['user_id'] == Phpfox::getUserId())
		{
			$sPhrase = Phpfox::getService('notification')->getUsers($aNotification) . ' commented on your article "' . Phpfox::getLib('parse.output')->shorten($aRow['title'], Phpfox::getParam('notification.total_notification_title_length'), '...') . '"';
		}
		else
		{
			$sPhrase = Phpfox::getService('notification')->getUsers($aNotification) . ' commented on <span class="drop_data_user">' . $aRow['full_name'] . '\'s</span> article "' . Phpfox::getLib('parse.output')->shorten($aRow['title'], Phpfox::getParam('notification.total_notification_title_length'), '...') . '"';
		}

		return array(
			'link' => Phpfox::getLib('url')->makeUrl('gettingstarted/article', array('article' => $aRow['article_id'])),
			'message' => $sPhrase,
			'icon' => Phpfox::getLib('template')->getStyle('image', 'activity.png', 'gettingstarted')
		);
	}

	public function getCommentNotificationFeed($aRow)
	{
		return array(
			'message' => Phpfox::getPhrase('gettingstarted.full_name_wrote_a_comment_on_your_blog_article_title', array(
					'user_link' => Phpfox::getLib('url')->makeUrl($aRow['user_name']),
					'full_name' => $aRow['full_name'],
					'article_link' => Phpfox::getLib('url')->makeUrl('article', array('redirect' => $aRow['item_id'])),
					'article_title' => Phpfox::getLib('parse.output')->shorten($aRow['item_title'], 20, '...')
				)
			),
			'link' => Phpfox::getLib('url')->makeUrl('gettingstarted/article', array('article' => $aRow['article_id'])),
			'path' => 'core.url_user',
			'suffix' => '_50'
		);
	}

        public function addLike($iItemId, $bDoNotSendEmail = false)
	{
		$aRow = $this->database()->select('article_id, title, user_id')
			->from(Phpfox::getT('gettingstarted_article'))
			->where('article_id = ' . (int) $iItemId)
			->execute('getSlaveRow');

		if (!isset($aRow['article_id']))
		{
			return false;
		}

		$this->database()->updateCount('like', 'type_id = \'gettingstarted\' AND item_id = ' . (int) $iItemId . '', 'total_like', 'gettingstarted_article', 'article_id = ' . (int) $iItemId);

		if (!$bDoNotSendEmail)
		{
			$sLink = Phpfox::permalink('article', $aRow['article_id'], $aRow['title']);

			Phpfox::getLib('mail')->to($aRow['user_id'])
				->subject(Phpfox::getUserBy('full_name') . " liked your article \"" . $aRow['title'] . "\"")
				->message(Phpfox::getUserBy('full_name') . " liked your article \"<a href=\"" . $sLink . "\">" . $aRow['title'] . "</a>\"\nTo view this article follow the link below:\n<a href=\"" . $sLink . "\">" . $sLink . "</a>")
				->send();

			//Phpfox::getService('notification.process')->add('gettingstarted_like', $aRow['article_id'], $aRow['user_id']);
		}
	}

        public function getNotificationLike($aNotification)
	{
		$aRow = $this->database()->select('b.article_id, b.title, b.user_id, u.gender, u.full_name')
			->from(Phpfox::getT('gettingstarted_article'), 'b')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = b.user_id')
			->where('b.article_id = ' . (int) $aNotification['item_id'])
			->execute('getSlaveRow');
		$sPhrase = '';
		if ($aNotification['user_id'] == $aRow['user_id'])
		{
			$sPhrase = Phpfox::getService('notification')->getUsers($aNotification) . ' liked ' . Phpfox::getService('user')->gender($aRow['gender'], 1) . ' own article "' . Phpfox::getLib('parse.output')->shorten($aRow['title'], Phpfox::getParam('notification.total_notification_title_length'), '...') . '"';
		}
		elseif ($aRow['user_id'] == Phpfox::getUserId())
		{
			$sPhrase = Phpfox::getService('notification')->getUsers($aNotification) . ' liked your article "' . Phpfox::getLib('parse.output')->shorten($aRow['title'], Phpfox::getParam('notification.total_notification_title_length'), '...') . '"';
		}
		else
		{
			$sPhrase = Phpfox::getService('notification')->getUsers($aNotification) . ' liked <span class="drop_data_user">' . $aRow['full_name'] . '\'s</span> article "' . Phpfox::getLib('parse.output')->shorten($aRow['title'], Phpfox::getParam('notification.total_notification_title_length'), '...') . '"';
		}

		return array(
			'link' => Phpfox::getLib('url')->makeUrl('gettingstarted/article', array('article' => $aRow['article_id'])),
			'message' => $sPhrase,
			'icon' => Phpfox::getLib('template')->getStyle('image', 'activity.png', 'gettingstarted')
		);
	}

	public function deleteLike($iItemId)
	{
		$this->database()->updateCount('like', 'type_id = \'gettingstarted\' AND item_id = ' . (int) $iItemId . '', 'total_like', 'gettingstarted_article', 'article_id = ' . (int) $iItemId);
	}

        public function getFeedRedirectFeedLike($iId, $iChildId = 0)
	{
		return $this->getFeedRedirect($iChildId);
	}

	public function getNewsFeedFeedLike($aRow)
	{
		(($sPlugin = Phpfox_Plugin::get('gettingstarted.component_service_callback_ondeleteuser__start')) ? eval($sPlugin) : false);
		if ($aRow['owner_user_id'] == $aRow['viewer_user_id'])
		{
			$aRow['text'] = Phpfox::getPhrase('gettingstarted.a_href_user_link_full_name_a_likes_their_own_a_href_link_article_a', array(
					'full_name' => Phpfox::getLib('parse.output')->clean($aRow['owner_full_name']),
					'user_link' => Phpfox::getLib('url')->makeUrl($aRow['owner_user_name']),
					'gender' => Phpfox::getService('user')->gender($aRow['owner_gender'], 1),
					'link' => $aRow['link']
				)
			);
		}
		else
		{
			$aRow['text'] = Phpfox::getPhrase('gettingstarted.a_href_user_link_full_name_a_likes_a_href_view_user_link_view_full_name_a_s_a_href_link_article_a', array(
					'full_name' => Phpfox::getLib('parse.output')->clean($aRow['owner_full_name']),
					'user_link' => Phpfox::getLib('url')->makeUrl($aRow['owner_user_name']),
					'view_full_name' => Phpfox::getLib('parse.output')->clean($aRow['viewer_full_name']),
					'view_user_link' => Phpfox::getLib('url')->makeUrl($aRow['viewer_user_name']),
					'link' => $aRow['link']
				)
			);
		}

		$aRow['icon'] = 'misc/thumb_up.png';
		(($sPlugin = Phpfox_Plugin::get('gettingstarted.component_service_callback_ondeleteuser__end')) ? eval($sPlugin) : false);
		return $aRow;
	}

	public function getNotificationFeedNotifyLike($aRow)
	{
		return array(
			'message' => Phpfox::getPhrase('gettingstarted.a_href_user_link_full_name_a_likes_your_a_href_link_artile_a', array(
					'full_name' => Phpfox::getLib('parse.output')->clean($aRow['full_name']),
					'user_link' => Phpfox::getLib('url')->makeUrl($aRow['user_name']),
					'link' => Phpfox::getLib('url')->makeUrl('blog', array('redirect' => $aRow['item_id']))
				)
			),
			'link' => Phpfox::getLib('url')->makeUrl('article', array('redirect' => $aRow['item_id']))
		);
	}

	public function sendLikeEmail($iItemId, $aFeed)
	{
		return Phpfox::getPhrase('gettingstarted.a_href_user_link_full_name_a_likes_your_a_href_link_article_a', array(
					'full_name' => Phpfox::getLib('parse.output')->clean(Phpfox::getUserBy('full_name')),
					'user_link' => Phpfox::getLib('url')->makeUrl(Phpfox::getUserBy('user_name')),
					'link' => Phpfox::getLib('url')->makeUrl('blog', array('redirect' => $iItemId))
				)
			);
	}
}
?>
