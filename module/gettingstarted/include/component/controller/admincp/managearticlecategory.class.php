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

class Gettingstarted_component_controller_admincp_managearticlecategory extends Phpfox_Component{
	public function process()
	{
			
		$aVals = array();
		$aVals['title'] = "";
		$bool_test = 0;
		$article_category = array();
		$id = $this->request()->get('edit-id');
		$updateTitle = "";
		if($id != null)
		{
			$updateArticle_Category = phpfox::getService('gettingstarted')->getArticleCategoryforEdit($id);
			$_SESSION['updateArticle_Category'] = $updateArticle_Category;
			$updateTitle = $updateArticle_Category['article_category_name'];
		}
		if(isset($_POST['submit_addarticlecategory']) == true)
		{
			$aVals = $this->request()->get('val');
			if($aVals['title'] == "")
			{
				Phpfox_Error::set(Phpfox::getPhrase('gettingstarted.knowledge_base_category_is_not_allowed_empty'));
				$bool_test = 1;
			}
			if($bool_test==0)
			{

				if(isset($_SESSION['updateArticle_Category']))
				{
					$aUpdate = $_SESSION['updateArticle_Category'];
					$aUpdate['article_category_name '] = phpfox::getLib('parse.input')->clean($aVals['title']);
					Phpfox::getLib('database')->update(phpfox::getT('gettingstarted_article_category'), $aUpdate, 'article_category_id = '.$aUpdate['article_category_id']);
					unset($_SESSION['updateArticle_Category']);
					$this->url()->send('admincp.gettingstarted.managearticlecategory', null, "Knowledge Base Category successfully edited.");
					
				}
				else
				{
					$aVals['title'] = phpfox::getLib('parse.input')->clean($aVals['title']);
					$issuccess=phpfox::getService("gettingstarted.articlecategory")->addArticleCategory($aVals);
					if($issuccess==0)
					{
						Phpfox_Error::set('Knowledge Base Category Name has existed');
					}
					else
					$this->url()->send('current', null,'Add Knowledge Base Category successfully');
				}
			}
		}
		if ($aDeleteIds = $this->request()->getArray('id'))
		{
			if (Phpfox::getService('gettingstarted.articlecategory')->deleteMultiple($aDeleteIds))
			{
				if(isset($_SESSION['updateArticle_Category']))
				{
					unset($_SESSION['updateArticle_Category']);
				}
				$this->url()->send('admincp.gettingstarted.managearticlecategory', null, 'Knowledge Base Category successfully deleted.');
			}
		}

		//        $aSettings=phpfox::getService("gettingstarted.settings")->getSettings(0);

		//        if(isset($aSettings['number_of_manage_mail'])==null)
		//            $iLimit=10;
		//        else
		//            $iLimit=$aSettings['number_of_manage_mail'];
		$iLimit = 10;
		$iPage = $this->request()->get("page");
		if(!$iPage)
		{
			$iPage = 1;
		}
		$iCnt=Phpfox::getService("gettingstarted.articlecategory")->getCount();
		$aCategories = Phpfox::getService('gettingstarted.articlecategory')->getCategoriesForEdit($iPage,$iLimit,$iCnt);
		Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iLimit, 'count' => $iCnt));
		$this->template()->setBreadCrumb(Phpfox::getPhrase('gettingstarted.manage_articles_categories'), $this->url()->makeUrl('admincp.gettingstarted.managearticlecategory'));
		$this->template()->assign(array(
			                        'aCategories' => $aCategories,
			                        'corepath' => phpfox::getParam("core.path"),
									'ArticleCategory' => $aVals,
									'updateTitle'=>$updateTitle
					)
		)
		->setHeader('cache', array(
                    'quick_edit.js' => 'static_script'
                    )
                    );
	}
}
?>
