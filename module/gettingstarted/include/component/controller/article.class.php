<?php
/**
 *
 *
 * @copyright        [YouNet_COPYRIGHT]
 * @author           YouNet Company
 * @package          Module_GettingStarted
 * @version          2.01
 */

defined('PHPFOX') or exit('NO DICE!');

class Gettingstarted_component_controller_article extends Phpfox_Component{
	public function process()
	{
		$settings = phpfox::getService('gettingstarted.settings')->getSettings(0);
        if (Phpfox::isUser())
		{
			Phpfox::getService('notification.process')->delete('comment_gettingstarted', $this->request()->get('article'), Phpfox::getUserId());
			Phpfox::getService('notification.process')->delete('gettingstarted_like', $this->request()->get('article'), Phpfox::getUserId());
		}
		if (isset($settings['active_knowledge_base']))
		{
			if($settings['active_knowledge_base'] == false)
			{
				Phpfox::getLib('database')->update(phpfox::getT('menu'),array('is_active'=>0),'m_connection="'.'main'.'" and module_id="'."gettingstarted".'"');
				Phpfox::getLib("cache")->remove('menu', 'substr');
				return Phpfox::getLib('module')->setController('error.404');
			}
			else
			{
				Phpfox::getLib('database')->update(phpfox::getT('menu'),array('is_active'=>1),'m_connection="'.'main'.'" and module_id="'."gettingstarted".'"');
				Phpfox::getLib("cache")->remove('menu', 'substr');
			}
		}
                
		$article_id = $this->request()->get('article');
		$dsarticle = Phpfox::getService('gettingstarted.articlecategory')->getArticleById($article_id);
		
		//get all hotLinks and replace all keywords
		$dsarticle['description_parsed'] = Phpfox::getLib('hotlinks')->replaceKeywordsToLinks($dsarticle['description_parsed']);
		
		
		if(empty($dsarticle))
		{
			return Phpfox_Error::display(Phpfox::getPhrase('gettingstarted.article_not_found'));
		}
                $dsarticle['bookmark_url'] = Phpfox::getLib('url')->makeUrl('gettingstarted/article', array('article' => $dsarticle['article_id']));
                $this->setParam('aFeed', array(
				'comment_type_id' => 'gettingstarted',
				'privacy' => $dsarticle['privacy'],
				'comment_privacy' => $dsarticle['privacy_comment'],
				'like_type_id' => 'gettingstarted',
				'feed_is_liked' => $dsarticle['is_liked'],
				'feed_is_friend' => $dsarticle['is_friend'],
				'item_id' => $dsarticle['article_id'],
				'user_id' => $dsarticle['user_id'],
				'total_comment' => $dsarticle['total_comment'],
				'total_like' => $dsarticle['total_like'],
				'feed_link' => $dsarticle['bookmark_url'],
				'feed_title' => $dsarticle['title'],
				'feed_display' => 'view',
				'feed_total_like' => $dsarticle['total_like'],
				'report_module' => 'gettingstarted',
				'report_phrase' => 'Report this article',
				'time_stamp' => $dsarticle['time_stamp']
			)
		);

        if(count($article_id)==0)
		{
			Phpfox_Error::set("Id not found");
		}
		if(Phpfox::isUser() && Phpfox::isAdmin()==0)
		{
			Phpfox::getService('gettingstarted.process')->updateView($article_id);
		}
		$isExistRating=Phpfox::getService("gettingstarted.articlecategory")->isExistRating(Phpfox::getUserId(),$article_id);
		$this->template()->setTitle($dsarticle['title'])
			->setTitle(Phpfox::getPhrase('gettingstarted.knowledge_base'))
			->setBreadcrumb('Knowledge Base', $this->url()->makeUrl('gettingstarted'))
			->setBreadcrumb($dsarticle['title'], $this->url()->makeUrl('gettingstarted.article/article_'.$dsarticle['article_id']),true );
		
                $this->setParam('aRatingCallback', array(
				'type' => 'gettingstarted',
				'total_rating' => Phpfox::getPhrase('video.total_rating_ratings', array('total_rating' => $dsarticle['total_rating'])),//$aVideo['total_rating'] . ' Ratings',
				'default_rating' => $dsarticle['total_score'],
				'item_id' => $article_id,
				'stars' => array(
					'2' => Phpfox::getPhrase('gettingstarted.poor'),
					'4' => Phpfox::getPhrase('gettingstarted.nothing_special'),
					'6' => Phpfox::getPhrase('gettingstarted.worth_watching'),
					'8' => Phpfox::getPhrase('gettingstarted.pretty_cool'),
					'10' => Phpfox::getPhrase('gettingstarted.awesome')
		)
		)
		);
               
		$this->template()->assign(array(
                                            'dsarticle' => $dsarticle,

		))
		->setHeader('cache', array(
                            'video.js' => 'module_video',
                            'jquery.rating.css' => 'style_css',
                            'jquery/plugin/star/jquery.rating.js' => 'static_script',
                            'jquery/plugin/jquery.highlightFade.js' => 'static_script',
                            'rate.js' => 'module_rate',
                            'jquery/plugin/jquery.scrollTo.js' => 'static_script',
                            'quick_edit.js' => 'static_script',
                            'comment.css' => 'style_css',
                            'pager.css' => 'style_css',
                            'switch_legend.js' => 'static_script',
                            'switch_menu.js' => 'static_script',
                            'video.css' => 'module_video',
                            'view.css' => 'module_video',
                            'feed.js' => 'module_feed'
                            )
                            )
                ->setPhrase(array(
                'rate.thanks_for_rating'
                )
                );

            if (Phpfox::isModule('rate'))
            {
                    $this->template()->setHeader(array(
                    '<script type="text/javascript">$Behavior.rateVideo = function() { $Core.rate.init({module: \'gettingstarted\', display: ' . ($isExistRating == 1 ? 'false' : (Phpfox::isAdmin()==true ? 'false' : 'true')) . ', error_message: \'' . ($isExistRating ? Phpfox::getPhrase('video.you_have_already_voted', array('phpfox_squote' => true)) : Phpfox::getPhrase('gettingstarted.you_cannot_rate_your_own_article', array('phpfox_squote' => true))) . '\'}); }</script>'
                    )
                    );
            }
            if (Phpfox::getUserId())
            {
                    $this->template()->setEditor(array(
                                    'load' => 'simple',
                                    'wysiwyg' => ((Phpfox::isModule('comment') && Phpfox::getParam('comment.wysiwyg_comments')) && Phpfox::getUserParam('comment.wysiwyg_on_comments'))
                            )
                    );
            }
	}
}
?>
