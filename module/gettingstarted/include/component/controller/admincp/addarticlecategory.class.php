<?php
/**
 *
 *
 * @copyright        [YouNet_COPYRIGHT]
 * @author           YouNet Company
 * @package          Module_gettingstarted
 * @version          2.01
 */

defined('PHPFOX') or exit('NO DICE!');

class gettingstarted_component_controller_admincp_addarticlecategory extends Phpfox_Component{
	public function process()
	{
		$aVals=array();
		$aVals['title']="";
		$bool_test = 0;
		$article_category=array();
		if(isset($_POST['submit_addarticlecategory'])==true)
		{
			$aVals=$this->request()->get('val');
			if($aVals['title']== "")
			{
				Phpfox_Error::set(Phpfox::getPhrase('gettingstarted.knowledge_base_category_is_not_allowed_empty'));
				$bool_test = 1;
			}
			if($bool_test==0)
			{
				$aVals['title']=phpfox::getLib('parse.input')->clean($aVals['title']);
				$issuccess=phpfox::getService("gettingstarted.articlecategory")->addArticleCategory($aVals);
				if($issuccess==0)
				{
					Phpfox_Error::set('Knowledge Base Category Name has existed');
				}
				else
				$this->url()->send('current',null,'Knowledge Base Category successfully added.');
			}
		}


		$this->template()->assign(array(
                'ArticleCategory' => $aVals,
		));

	}
}
?>
