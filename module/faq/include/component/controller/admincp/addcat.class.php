<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class Faq_Component_Controller_Admincp_Addcat extends Phpfox_Component
{
	public function process()
	{

        if (($editThis = $this->request()->getInt('edit'))){
           $isEdit = 1;
        }else $isEdit = 0;

        $aLinkForEdit[0] = array(
            'is_active'=>'',
            'faq_cat_id'=>'',
            'cat_name'=>'',
            'cat_addon_name'=>'',
            'ordering'=>''
        );

        $this->template()->assign('isEdit', $isEdit);

        if($isEdit==1){

            $aLinkForEdit = Phpfox::getService('faq')->getOneCatForEdit($editThis);

        }

        $this->template()->assign('aLinkForEdit', $aLinkForEdit[0]);

		if (($aVal = $this->request()->getArray('val')))
		{
		  if(isset($aVal['addnew']) && !empty($aVal['addnew'])){
			if (Phpfox::getService('faq')->addThisCat($aVal))
			{
			    $this->url()->send('admincp.faq', null, 'Added with success');
			}
		  }elseif(isset($aVal['update']) && !empty($aVal['update'])){
			if (Phpfox::getService('faq')->editThisCat($aVal))
			{
				$this->url()->send('admincp.faq', null, 'Edited with success');
			}
		  }
		}

		$this->template()->setTitle('FAQ Form')
        ->setBreadcrumb('FAQ Form', $this->url()->makeUrl('admincp.faq.add'));

	}
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('faq.component_controller_admincp_addcat_clean')) ? eval($sPlugin) : false);
	}
}

?>