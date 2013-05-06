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

class Gettingstarted_Component_Controller_Index extends Phpfox_Component{
	public function process()
	{
		$bIsCategory = false;
		$temp = $this->request()->get('req2');
		$flag = 1;
		if($temp == null)
		{
			$flag = 0;
			$this->template()->setBreadCrumb('Knowledge Base', $this->url()->makeUrl('gettingstarted'));
			if (defined('PHPFOX_IS_AJAX_CONTROLLER'))
			{
				$bIsProfile = true;
				$aUser = Phpfox::getService('user')->get($this->request()->get('profile_id'));
				$this->setParam('aUser', $aUser);
			}
			else
			{
				$bIsProfile = $this->getParam('bIsProfile');
				if ($bIsProfile === true)
				{
					$aUser = $this->getParam('aUser');
				}
			}

			$bIsSearch = false;
			$settings = phpfox::getService('gettingstarted.settings')->getSettings(0);
			$sView = $this->request()->get('view');
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


			$iLimit = $this->request()->get('show');
			if($iLimit == '')
			{
				$iLimit = 5;
			}
			$iPage = $this->request()->get("page");
			if(!$iPage)
			{
				$iPage = 1;
			}
			$all_articlecategories = Phpfox::getService("gettingstarted.articlecategory")->getArticleCategory();
			$aTypes = array();
			$aTypes[0] = "Any";
			$aPages = array(5, 10, 15);

			$aDisplays = array();
			foreach ($aPages as $iPageCnt)
			{
				$aDisplays[$iPageCnt] = Phpfox::getPhrase('core.per_page', array('total' => $iPageCnt));
			}

			$aSorts = array(
                            'gettingstarted_article.time_stamp' => '',
                            'gettingstarted_article.total_view' => ''
                            );
                            $aFilters = array(
                    'title' => array(
                        'type' => 'input:text',
                        'search' => "[VALUE]"
                        ),
                       'display' => array(
                                    'type' => 'select',
                                    'options' => $aDisplays,
                                    'default' => '5'
                                    ),
                                    'sort' => array(
                        'type' => 'select',
                        'options' => $aSorts,
                        'default' => 'gettingstarted_article.time_stamp'
                        ),
                        );
                        $oSearch = Phpfox::getLib('search')->set(array(
                        'type' => 'gettingstarted_article',
                        //'cache'=>true,
                        'filters' => $aFilters,
                        // 'search' => 'search',
                        'search_tool' => array(
                                            'search' => array(
                                            'action' => ($bIsProfile === true ? $this->url()->makeUrl($aUser['user_name'], array('gettingstarted', 'view' => $this->request()->get('gettingstarted'))) : $this->url()->makeUrl('gettingstarted', array('view' => $this->request()->get('view')))),
                                            'default_value' => Phpfox::getPhrase('gettingstarted.search_articles_dot'),
                                            'name' => 'title',
                                            'field' => 'gettingstarted_article.article_id'
                                            ),
                        'sort' => array(
                                        'latest' => array('gettingstarted_article.time_stamp', 'Latest'),
                                        'most-viewed' => array('gettingstarted_article.total_view', 'Most Viewed'),
                                            //	'most-liked' => array('fb.total_like', 'Most Liked'),
                                            //	'most-talked' => array('fb.total_comment', Phpfox::getPhrase('blog.most_discussed'))
                                            ),
                        'show' => array(5, 10, 15)
                                            )
                                            )
                                            );

                                            foreach($all_articlecategories as $iKey=>$articlecategory)
                                            {
                                            	$aTypes[$articlecategory['article_category_id']] = $articlecategory['article_category_name'];
                                            }

                                            if ($this->request()->get(($bIsProfile === true ? 'req3' : 'req2')) == 'categories')
                                            {
                                            	$bIsSearch = true;
                                            	if ($aFeedBackCategory = Phpfox::getService('gettingstarted')->getArticleCategoryforEdit($this->request()->getInt(($bIsProfile === true ? 'req4' : 'req3'))))
                                            	{
                                            		$this->template()->setBreadCrumb(Phpfox::getPhrase('gettingstarted.category'));

                                            		$this->template()->setTitle(Phpfox::getLib('locale')->convert($aFeedBackCategory['article_category_name']));
                                            		$this->template()->setBreadCrumb(Phpfox::getLib('locale')->convert($aFeedBackCategory['article_category_name']), $this->url()->makeUrl('current'), true);

                                            		$this->search()->setFormUrl($this->url()->permalink(array('gettingstarted.categories', 'view' => $this->request()->get('view')), $aFeedBackCategory['article_category_id'], $aFeedBackCategory['article_category_name']));
                                            	}
                                            }

                                            $sSearch = $this->request()->get('search-id');
                                            $arrSearch = $oSearch->getConditions();
                                            if(($sSearch != '')||(!empty($arrSearch)))
                                            {
                                            	$bIsSearch = true;

                                            }
                                            if($this->request()->get('makesearch') && $this->request()->get('makesearch') == 1)
                                            {
                                            	$bIsSearch = true;
                                            }
                                            if($bIsSearch == false)
                                            {
                                            	$iCnt = Phpfox::getService("gettingstarted.articlecategory")->getCount() + 1;
                                            	$articlecategories = Phpfox::getService("gettingstarted.articlecategory")->get($iPage,$iCnt,$iCnt);
                                            	Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iLimit, 'count' => $iCnt));

                                            	$iLimit = 5;
                                            	$aSettings = phpfox::getService("gettingstarted.settings")->getSettings(0);
                                            	if(!isset($aSettings['number_of_article_category']))
                                            	{
                                            		$iLimit = 5;
                                            	}
                                            	else
                                            	{
                                            		$iLimit = $aSettings['number_of_article_category'];
                                            	}

                                            	foreach($articlecategories as $iKey => $articlecategory)
                                            	{
                                            		$article = Phpfox::getService("gettingstarted.articlecategory")->getArticleByCategoryId($articlecategory['article_category_id'],$iLimit);
                                            		phpfox::getService('gettingstarted.articlecategory')->getExtra($article);
                                            		$pagination = 0;
                                            		$dsArticle = Phpfox::getService("gettingstarted.articlecategory")->getdsArticleByCategoryId($articlecategory['article_category_id']);
                                            		if(count($dsArticle)>$iLimit)
                                            		{
                                            			$pagination = 1;
                                            		}
                                            		$articlecategories[$iKey]['pagination'] = $pagination;
                                            		$articlecategories[$iKey]['article'] = $article;
                                            		//$articlecategories[$iKey]['info'] = Phpfox::getPhrase('gettingstarted.posted_on_post_time', array('post_time'=>Phpfox::getTime(Phpfox::getParam('gettingstarted.display_time_stamp'), $articlecategory['time_stamp'])));
                                            	}
                                           		$this->template()->assign(array('articlecategories' => $articlecategories));
                                            }

                                            else
                                            {
                                            	$iLimit = $this->request()->get('show');
                                            	if($iLimit == '')
                                            	{
                                            		$iLimit = 5;
                                            	}
                                            	$sort_by = $this->request()->get('sort');
                                            	$sSortBy = 'article.time_stamp desc';
                                            	if(isset($sort_by))
                                            	{
                                            		if($sort_by == 'most-viewed')
                                            		{
                                            			$sSortBy = 'article.total_view desc';
                                            		}
                                            	}
                                            	$arrSearch = $oSearch->getConditions();

                                            	$title_search = '';
                                            	if(!empty($arrSearch))
                                            	{
                                            		$title_search = $arrSearch[0];
                                            	}
                                            	$category_search = $this->request()->getInt(($bIsProfile === true ? 'req4' : 'req3'));
                                            	$iCnt = Phpfox::getService("gettingstarted.articlecategory")->getCountArticle($title_search,$category_search);
                                            	$aArticle = Phpfox::getService("gettingstarted.articlecategory")->getArticle($title_search, $category_search, $sSortBy, $iPage, $iLimit, $iCnt);
												phpfox::getService('gettingstarted.articlecategory')->getExtra($aArticle);
                                            	$aCategoryArticles = array();
                                            	$iCount = 0;
                                            	$aTemp = array();
                                            	foreach($aArticle as $iKey =>$aValue)
                                            	{
                                            		if(!empty($aTemp) && ($aValue['article_category_id'] == $aTemp['article_category_id']))
                                            		{
                                            			$aCategoryArticles[$iCount]['article'][] = $aValue;
                                            			if($aValue['article_category_id'] == -1)
                                            			{
                                            				$aCategoryArticles[$iCount]['article_category_name'] = Phpfox::getPhrase('gettingstarted.uncategorized');
                                            			}
                                            			else
                                            			{
                                            				$aCategoryArticles[$iCount]['article_category_name'] = $aValue['article_category_name'];
                                            			}
                                            		}
                                            		else
                                            		{
                                            			$iCount = $iCount + 1;
                                            			$aCategoryArticles[$iCount]['article'][] = $aValue;
                                            			if($aValue['article_category_id'] == -1)
                                            			{
                                            				$aCategoryArticles[$iCount]['article_category_name'] = Phpfox::getPhrase('gettingstarted.uncategorized');
                                            			}
                                            			else
                                            			{
                                            				$aCategoryArticles[$iCount]['article_category_name'] = $aValue['article_category_name'];
                                            			}
                                            		}
                                            		$aTemp = $aValue;
                                            	}

                                            	phpfox::getService('gettingstarted.articlecategory')->getExtra($aArticle);
                                            	Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iLimit, 'count' => $iCnt));
                                            	$this->template()->assign(array(
                                            									'aArticle' => $aArticle,
                                            									'aCategoryArticles' => $aCategoryArticles
                                            	));
                                            }


                                            $this->template()->assign(array(
                                                    'bIsSearch' => $bIsSearch,
                                            ))
                                            ->setHeader(array(
                                                        'gettingstarted.css' => 'module_gettingstarted',
                                                        'thickbox.css' => 'module_gettingstarted',
                                                        'gettingstarted.js' => 'module_gettingstarted',
                                                        'pager.css' => 'style_css',
                                            ));
		}
		else
		{

			$bIsCategory = true;
			$this->template()->setBreadCrumb(phpfox::getPhrase('gettingstarted.knowledge_base'), $this->url()->makeUrl('gettingstarted'));

			if (defined('PHPFOX_IS_AJAX_CONTROLLER'))
			{
				$bIsProfile = true;
				$aUser = Phpfox::getService('user')->get($this->request()->get('profile_id'));
				$this->setParam('aUser', $aUser);
			}
			else
			{
				$bIsProfile = $this->getParam('bIsProfile');
				if ($bIsProfile === true)
				{
					$aUser = $this->getParam('aUser');
				}
			}

			$bIsSearch = false;
			$settings = phpfox::getService('gettingstarted.settings')->getSettings(0);
			$sView = $this->request()->get('view');
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


			$iLimit = $this->request()->get('show');
			if($iLimit == '')
			{
				$iLimit = 5;
			}
			$iPage = $this->request()->get("page");
			if(!$iPage)
			{
				$iPage = 1;
			}
			$all_articlecategories = Phpfox::getService("gettingstarted.articlecategory")->getArticleCategory();
			$aTypes = array();
			$aTypes[0] = "Any";
			$aPages = array(5, 10, 15);

			$aDisplays = array();
			foreach ($aPages as $iPageCnt)
			{
				$aDisplays[$iPageCnt] = Phpfox::getPhrase('core.per_page', array('total' => $iPageCnt));
			}

			$aSorts = array(
                            'gettingstarted_article.time_stamp' => '',
                            'gettingstarted_article.total_view' => ''
                            );
                            $aFilters = array(
                    'title' => array(
                        'type' => 'input:text',
                        'search' => "[VALUE]"
                        ),
                       'display' => array(
                                    'type' => 'select',
                                    'options' => $aDisplays,
                                    'default' => '5'
                                    ),
                                    'sort' => array(
                        'type' => 'select',
                        'options' => $aSorts,
                        'default' => 'gettingstarted_article.time_stamp'
                        ),
                        );

                        $oSearch = Phpfox::getLib('search')->set(array(
                        'type' => 'gettingstarted_article',
                        'filters' => $aFilters,
                        'search_tool' => array(
                                            'search' => array(
                                            'action' => ($bIsProfile === true ? $this->url()->makeUrl($aUser['user_name'], array('gettingstarted', 'view' => $this->request()->get('gettingstarted'))) : $this->url()->makeUrl('gettingstarted', array('view' => $this->request()->get('view')))),
                                            'default_value' => Phpfox::getPhrase('gettingstarted.search_articles_dot'),
                                            'name' => 'title',
                                            'field' => 'gettingstarted_article.article_id'
                                            ),
                      					 	'sort' => array(
                                            // 'latest' => array('gettingstarted_article.time_stamp', 'Latest'),
                                            // 'most-viewed' => array('gettingstarted_article.total_view', 'Most Viewed'),
                                        	'most-liked' => array('fb.total_like', 'Most Liked'),
                                        	'most-talked' => array('fb.total_comment', Phpfox::getPhrase('blog.most_discussed'))
                                            ),
                       						 'show' => array(10)
                                            )
                                            )
                                            );
                                            foreach($all_articlecategories as $iKey=>$articlecategory)
                                            {
                                            	$aTypes[$articlecategory['article_category_id']] = $articlecategory['article_category_name'];
                                            }

                                            if ($this->request()->get(($bIsProfile === true ? 'req3' : 'req2')) == 'categories')
                                            {
                                            	$bIsSearch = true;
                                            	$this->template()->setBreadCrumb('Category');
                                            	if ($aFeedBackCategory = Phpfox::getService('gettingstarted')->getArticleCategoryforEdit($this->request()->getInt(($bIsProfile === true ? 'req4' : 'req3'))))
                                            	{
                                            		$this->template()->setTitle(Phpfox::getLib('locale')->convert($aFeedBackCategory['article_category_name']));
                                            		$this->template()->setBreadCrumb(Phpfox::getLib('locale')->convert($aFeedBackCategory['article_category_name']), $this->url()->makeUrl('current'), true);
                                            		$this->search()->setFormUrl($this->url()->permalink(array('gettingstarted.categories', 'view' => $this->request()->get('view')), $aFeedBackCategory['article_category_id'], $aFeedBackCategory['article_category_name']));

                                            	}
                                            	else
                                            	{
                                            		$aFeedBackCategory['article_category_name'] = 'Uncategorized';
                                            		$aFeedBackCategory['article_category_id'] = -1;
                                            		$this->template()->setTitle(Phpfox::getLib('locale')->convert($aFeedBackCategory['article_category_name']));
                                            		$this->template()->setBreadCrumb(Phpfox::getLib('locale')->convert($aFeedBackCategory['article_category_name']), $this->url()->makeUrl('current'), true);
                                            		$this->search()->setFormUrl($this->url()->permalink(array('gettingstarted.categories', 'view' => $this->request()->get('view')), $aFeedBackCategory['article_category_id'], $aFeedBackCategory['article_category_name']));
                                            	}
                                            }


                                            $sSearch = $this->request()->get('search-id');
                                            $arrSearch = $oSearch->getConditions();
                                            if(($sSearch != '')||(!empty($arrSearch)))
                                            {
                                            	$bIsSearch = true;

                                            }
                                            if($this->request()->get('makesearch') && $this->request()->get('makesearch') == 1)
                                            {
                                            	$bIsSearch = true;
                                            }
                                            if($bIsSearch == false)
                                            {
                                            	$iCnt = Phpfox::getService("gettingstarted.articlecategory")->getCount() + 1;
                                            	$iPage = 1;
                                            	$articlecategories = Phpfox::getService("gettingstarted.articlecategory")->get($iPage,$iCnt,$iCnt);
                                            	Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iLimit, 'count' => $iCnt));

                                            	$iLimit = 10;
                                            	$aSettings = phpfox::getService("gettingstarted.settings")->getSettings(0);
                                            	if(!isset($aSettings['number_of_article_category']))
                                            	{
                                            		$iLimit = 10;
                                            	}
                                            	else
                                            	{
                                            		$iLimit = 10;
                                            	}

                                            	foreach($articlecategories as $iKey => $articlecategory)
                                            	{
                                            		$article = Phpfox::getService("gettingstarted.articlecategory")->getArticleByCategoryId($articlecategory['article_category_id'],$iLimit);
                                            		phpfox::getService('gettingstarted.articlecategory')->getExtra($article);
                                            		$pagination = 0;
                                            		$dsArticle = Phpfox::getService("gettingstarted.articlecategory")->getdsArticleByCategoryId($articlecategory['article_category_id']);
                                            		if(count($dsArticle)>$iLimit)
                                            		{
                                            			$pagination = 1;
                                            		}
                                            		$articlecategories[$iKey]['pagination'] = $pagination;
                                            		$articlecategories[$iKey]['article'] = $article;
                                            		$this->template()->assign(array('articlecategories' => $articlecategories));
                                            	}
                                          
                                            }
                                           

                                            else
                                            {
                                            	
                                            	$iLimit = $this->request()->get('show');
                                            	if($iLimit == '')
                                            	{
                                            		$iLimit = 10;
                                            	}
                                            	$sort_by = $this->request()->get('sort');
                                            	$sSortBy = 'article.time_stamp desc';
                                            	if(isset($sort_by))
                                            	{
                                            		if($sort_by == 'most-viewed')
                                            		{
                                            			$sSortBy = 'article.total_view desc';
                                            		}
                                            	}
                                            	$arrSearch = $oSearch->getConditions();

                                            	$title_search = '';
                                            	if(!empty($arrSearch))
                                            	{
                                            		$title_search = $arrSearch[0];
                                            	}
                                            	$category_search = $this->request()->getInt(($bIsProfile === true ? 'req4' : 'req3'));
                                            	$iCnt = Phpfox::getService("gettingstarted.articlecategory")->getCountArticle($title_search,$category_search);
                                            	$aArticle = Phpfox::getService("gettingstarted.articlecategory")->getArticle($title_search, $category_search, $sSortBy, $iPage, $iLimit, $iCnt);
                                            	$aCategoryArticles = array();
                                            	$iCount = 0;
                                            	$aTemp = array();
                                            	phpfox::getService('gettingstarted.articlecategory')->getExtra($aArticle); 
                                            	foreach($aArticle as $iKey =>$aValue)
                                            	{       
                                            		                   		 
                                            		if(!empty($aTemp) && ($aValue['article_category_id'] == $aTemp['article_category_id']))
                                            		{
                                            			$aCategoryArticles[$iCount]['article'][] = $aValue;
                                            			if($aValue['article_category_id'] == -1)
                                            			{
                                            				$aCategoryArticles[$iCount]['article_category_name'] = Phpfox::getPhrase('gettingstarted.uncategorized');
                                            			}
                                            			else
                                            			{
                                            				$aCategoryArticles[$iCount]['article_category_name'] = $aValue['article_category_name'];
                                            			}
                                            		}
                                            		else
                                            		{
                                            			$iCount = $iCount + 1;
                                            			$aCategoryArticles[$iCount]['article'][] = $aValue;
                                            			if($aValue['article_category_id'] == -1)
                                            			{
                                            				$aCategoryArticles[$iCount]['article_category_name'] = Phpfox::getPhrase('gettingstarted.uncategorized');
                                            			}
                                            			else
                                            			{
                                            				$aCategoryArticles[$iCount]['article_category_name'] = $aValue['article_category_name'];
                                            			}
                                            		}
                                            		$aTemp = $aValue;
                                            	}
                                            	phpfox::getService('gettingstarted.articlecategory')->getExtra($aArticle);
                                            	Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iLimit, 'count' => $iCnt));
                                            	$this->template()->assign(array(
                                            									'aArticle' => $aArticle,
                                            									'aCategoryArticles' => $aCategoryArticles
                                            	));
                                            }

                                            $this->template()->assign(array(
                                                    'bIsSearch' => $bIsSearch,

                                            ))
                                            ->setHeader(array(
                                                        'gettingstarted.css' => 'module_gettingstarted',
                                                        'thickbox.css' => 'module_gettingstarted',
                                                        'gettingstarted.js' => 'module_gettingstarted',
                                                        'pager.css' => 'style_css',
                                            ));
		}
		$this->template()->assign(array(
									'flag'=> $flag,
									'bIsCategory' => $bIsCategory
		));
	}
}
?>
