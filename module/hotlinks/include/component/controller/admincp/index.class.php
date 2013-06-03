<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		phpfoxguru.com
 * @author  		Nicolas
 * @package  		Module_Recipe
 * @version 		$Id: index.class.php 2009-09-10 Nicolas $
 */
class Hotlinks_Component_Controller_Admincp_Index extends Phpfox_Component
{
	public function process()
	{		
		$this->template()->setTitle('Manage Hotlinks')
			->setBreadcrumb('Manage Hotlinks')
			->setPhrase(array('Are you sure you want to delete this hotlink?'))
			->setHeader(array(
					'jquery/ui.js' => 'static_script',
					'admin.js' => 'module_hotlinks',
					'<script type="text/javascript">$Core.hotlinks.url(\'' . $this->url()->makeUrl('admincp.hotlinks') . '\');</script>'
				)
			)
			->assign(array(
					'sHotlinks' => Phpfox::getService('hotlinks')->get()
				)
			);		
			
	}
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('hotlinks.component_controller_admincp_index_clean')) ? eval($sPlugin) : false);
	}
}

?>