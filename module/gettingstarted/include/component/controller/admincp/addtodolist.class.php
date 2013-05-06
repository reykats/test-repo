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

class gettingstarted_component_controller_admincp_addtodolist extends Phpfox_Component{
	public function process()
	{
		$aVals=array();
		$aVals['title']="";

		$aVals['description']="";
		$bool_test=0;
		if(isset($_POST['submit_addtodolist'])==true)
		{
			$aVals=$this->request()->get('val');
			if($aVals['title']=="")
			{
				Phpfox_Error::set(Phpfox::getPhrase('gettingstarted.fill_in_a_title_for_your_todo_list'));
				$bool_test=1;
			}
			if($aVals['description']=="")
			{
				Phpfox_Error::set(Phpfox::getPhrase('gettingstarted.fill_in_a_description_for_your_todo_list'));
				$bool_test=1;
			}

			if($bool_test==0)
			{
				phpfox::getService("gettingstarted.articlecategory")->addtodolist($aVals);
				$this->url()->send('current', null, Phpfox::getPhrase('gettingstarted.todo_list_successfully_added'));
			}

		}


		$this->template()->assign(array(
                'aScheduledMail' => $aVals,
		));

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
		 $this->template()->setBreadCrumb(Phpfox::getPhrase('gettingstarted.add_todo_list'), $this->url()->makeUrl('admincp.gettingstarted.addtodolist'));

	}
}
?>
