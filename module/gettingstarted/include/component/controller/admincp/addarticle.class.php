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

class gettingstarted_component_controller_admincp_addarticle extends Phpfox_Component{
	public function process()
	{
		$aVals = array();
		$aVals['title'] = "";
		$aVals['article_category_id'] = 0;
		$aVals['description'] = "";
		$bool_test=0;
		if(isset($_POST['submit_addarticlecategory']) == true)
		{
			$aVals=$this->request()->get('val');
			if($aVals['title']=="")
			{
				Phpfox_Error::set(Phpfox::getPhrase('gettingstarted.fill_in_a_title_for_your_knowledgebase_article'));
				$bool_test=1;
			}
			if($aVals['description'] == "")
			{
				Phpfox_Error::set(Phpfox::getPhrase('gettingstarted.fill_in_a_description_for_your_knowledgebase_article'));
				$bool_test = 1;
			}
			if($bool_test==0)
			{
				phpfox::getService("gettingstarted.articlecategory")->addarticle($aVals);
				$this->url()->send('current',null,'Knowledge Base Article successfully added.');
			}
		}

		//$this->template()->setBreadcrumb('Create schedule mail') ;

		$scheduled_category = phpfox::getService('gettingstarted.articlecategory')->getArticleCategory();
		//$scheduled_category[0] = 'Uncategorized';
		$this->template()->assign(array(
               'scheduled_category' => $scheduled_category,
                'aScheduledMail' => $aVals,
		));
		$this->template()->setBreadCrumb(Phpfox::getPhrase('gettingstarted.add_articles'), $this->url()->makeUrl('admincp.gettingstarted.addarticle'));
		$this->template()->assign(array('aForms' => array('description' => $aVals['description'])));
		$this->template()->setEditor(array('wysiwyg' => true))
		->setHeader(array(
				'jquery/plugin/jquery.highlightFade.js' => 'static_script',
				'switch_legend.js' => 'static_script',
				'switch_menu.js' => 'static_script',
				'quick_edit.js' => 'static_script',
				'pager.css' => 'style_css',
				'admin_editor.css' => 'module_gettingstarted'
				));
				$this->setParam('attachment_share', array(
				'type' => 'blog',
				'id' => 'core_js_blog_form'
				)
				);

	}
}
?>
