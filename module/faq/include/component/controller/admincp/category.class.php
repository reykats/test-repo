<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class Faq_Component_Controller_Admincp_Category extends Phpfox_Component
{
	public function process()
	{
		if (($faqid = $this->request()->getInt('disable')))
		{
			if (Phpfox::getService('faq')->disableCat($faqid))
			{
				$this->url()->send('admincp.faq.category', null, 'Category disabled with success');
			}

		} elseif (($faqid = $this->request()->getInt('enable'))) {

			if (Phpfox::getService('faq')->enableCat($faqid))
			{
				$this->url()->send('admincp.faq.category', null, 'Category enabled with success');
			}

		}

		$this->template()->setTitle('FAQs')
			->setBreadcrumb('FAQs', $this->url()->makeUrl('admincp.faq.category'))
            ->assign(array(
					'aFAQs' => Phpfox::getService('faq')->getFaqCatForAdmin()
				)
			);
	}


	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('faq.component_controller_admincp_category_clean')) ? eval($sPlugin) : false);
	}
}

?>