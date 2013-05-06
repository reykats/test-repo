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

class Gettingstarted_component_controller_allarticle extends Phpfox_Component{
	public function process()
	{
		$settings = phpfox::getService('gettingstarted.settings')->getSettings(0);
		if (isset($settings['active_base_knowledge']))
		{
			if($settings['active_base_knowledge'] == false)
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
		$articlecategories = Phpfox::getService("gettingstarted.articlecategory")->getArticleCategory();
		$aTypes = array();
		$aTypes[0]="Any";
		foreach($articlecategories as $iKey=>$articlecategory)
		{
			$aTypes[$articlecategory['article_category_id']]=$articlecategory['article_category_name'];
		}

		$aFilters = array(
                'title' => array(
                    'type' => 'input:text',
                    'search' => "[VALUE]"
                    ),
                'type' => array(
                    'type' => 'select',
                    'options' => $aTypes,
                    'default' => '1',
                    'search' =>"type_[VALUE]"
                    )
                    );

                    $oSearch = Phpfox::getLib('search')->set(array(
                    'type' => '',
                    'filters' => $aFilters,
                    'search' => 'search'
                    )
                    );
                    $arrSearch = $oSearch->getConditions();
                    $title_search="";
                    $category_search=0;

                    if(count($arrSearch) > 2)
                    {
                    	$title_search=$arrSearch[0];
                    	$arrtemp_search=explode("type_", $arrSearch[1]);
                    	$category_search=$arrtemp_search[1];
                    }
                    else if(count($arrSearch==2))
                    {
                    	$arrtemp_search=explode("type_", $arrSearch[0]);
                    	if(is_numeric($arrtemp_search[1])==true)
                    	$category_search=$arrtemp_search[1];
                    }
                    $aSettings=phpfox::getService("gettingstarted.settings")->getSettings(0);
                    $bIsSearch = false;
                    $sSearch = $this->request()->get('search-id');
                    if($sSearch != '')
                    {
                    	$bIsSearch = true;
                    }
                    if(isset($aSettings['number_of_article'])==null)
						$iLimit = 10;
                    else
						$iLimit = $aSettings['number_of_article'];
                    $iPage = $this->request()->get("page");
                    if(!$iPage)
                    $iPage = 1;
                    $iCnt=Phpfox::getService("gettingstarted.articlecategory")->getCountArticle($title_search,$category_search);
					
                    $aArticle = Phpfox::getService("gettingstarted.articlecategory")->getArticle($title_search,$category_search,$iPage,$iLimit,$iCnt);
                   	phpfox::getService('gettingstarted.articlecategory')->getExtra($aArticle);
                    Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iLimit, 'count' => $iCnt));
					$this->template()->setBreadCrumb('Knowledge base', $this->url()->makeUrl('gettingstarted'));	
                    $this->template()->assign(array(
              			 'aArticle' => $aArticle,
                    	'bIsSearch' => $bIsSearch
                    ))->setHeader(array(
                    'gettingstarted.css' => 'module_gettingstarted',
                    'pager.css' => 'style_css',
                    'jquery/plugin/jquery.highlightFade.js' => 'static_script',
                    'jquery/plugin/jquery.scrollTo.js' => 'static_script',
                    'quick_edit.js' => 'static_script',
                    'comment.css' => 'style_css',
                    'pager.css' => 'style_css',
                    'feed.js' => 'module_feed'
                    ));
	}
}
?>
