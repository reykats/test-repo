<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class Faq_Component_Controller_Admincp_Index extends Phpfox_Component
{
	public function process()
	{
		if (($faqid = $this->request()->getInt('disable')))
		{
			if (Phpfox::getService('faq')->disableFaq($faqid))
			{
				$this->url()->send('admincp.faq', null, 'FAQ disabled with success');
			}

		} elseif (($faqid = $this->request()->getInt('enable'))) {

			if (Phpfox::getService('faq')->enableFaq($faqid))
			{
				$this->url()->send('admincp.faq', null, 'FAQ enabled with success');
			}

		}

		$this->template()->setTitle('FAQs')
			->setBreadcrumb('FAQs', $this->url()->makeUrl('admincp.faq'))
            ->assign(array(
					'aFAQs' => Phpfox::getService('faq')->getFaqForAdmin()
				)
			);
	}


	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('faq.component_controller_admincp_index_clean')) ? eval($sPlugin) : false);
	}
}

?>