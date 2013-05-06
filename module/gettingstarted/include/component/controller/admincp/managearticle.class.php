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

class Gettingstarted_component_controller_admincp_managearticle extends Phpfox_Component{
	public function process()
	{
		if ($aDeleteIds = $this->request()->getArray('id'))
		{
			if (Phpfox::getService('gettingstarted.articlecategory')->deleteMultipleArticle($aDeleteIds))
			{
				$this->url()->send('admincp.gettingstarted.managearticle', null, 'Knowledge Base Articles successfully deleted.');
			}
		}

		//        $aSettings=phpfox::getService("gettingstarted.settings")->getSettings(0);

		//        if(isset($aSettings['number_of_manage_mail'])==null)
		//            $iLimit=10;
		//        else
		//            $iLimit=$aSettings['number_of_manage_mail'];
		$articlecategories=Phpfox::getService("gettingstarted.articlecategory")->getArticleCategory();
		$aTypes = array();
		$aTypes[0]="Any";
		$aTypes[-1] = 'Uncategorized';
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
               
                $bIsSearch = false;
                $sSearch = $this->request()->get('search-id');
               
                if($sSearch != '')
                {
                    $bIsSearch = true;
                }
                $arrSearch = $oSearch->getConditions();
                /*
                if($arrSearch[0] == "#")
                {
                    $arrSearch[0] = "";
                }
                */
                $title_search="";
                $category_search=0;
                if(count($arrSearch) > 2)
                {
                    $title_search=$arrSearch[0];
                    $arrtemp_search=explode("type_", $arrSearch[1]);
                    $category_search = $arrtemp_search[1];
                }
                else if(count($arrSearch==2))
                {
                    $arrtemp_search=explode("type_", $arrSearch[0]);
                    if(is_numeric($arrtemp_search[1])==true)
                    $category_search = $arrtemp_search[1];
                }

                $iLimit=5;
                $iPage = $this->request()->get("page");
                if(!$iPage)
                {
                    $iPage = 1;
                }
                $sSortBy = 'article.time_stamp desc';
                $iCnt=Phpfox::getService("gettingstarted.articlecategory")->getCountArticle($title_search, $category_search);
                $aCategories = Phpfox::getService('gettingstarted.articlecategory')->getArticle($title_search, $category_search, $sSortBy, $iPage, $iLimit, $iCnt);
                Phpfox::getService('gettingstarted.articlecategory')->getExtra($aCategories);
                Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iLimit, 'count' => $iCnt));
                $this->template()
                ->assign(array(
                    'aCategories' => $aCategories,
                    'corepath' => phpfox::getParam("core.path"),
                    'bIsSearch' =>$bIsSearch,
                    'iPage' => $iPage
                )
                )
                ->setHeader('cache', array(
                'quick_edit.js' => 'static_script'
                )
                );
                $this->template()->setBreadCrumb(Phpfox::getPhrase('gettingstarted.manage_articles'), $this->url()->makeUrl('admincp.gettingstarted.managearticle'));
	}
}
?>
