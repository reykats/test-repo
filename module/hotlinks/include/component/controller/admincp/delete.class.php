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
 * @version 		$Id: add.class.php 2009-09-10 Nicolas $
 */
class Hotlinks_Component_Controller_Admincp_Delete extends Phpfox_Component
{
	public function process()
	{
		$hotlink_id = $this->request()->getInt('req4');
		if(Phpfox::getService('hotlinks')->delete($hotlink_id)) {
			$this->url()->send($sUserName, array('admincp/hotlinks'), 'Hotlink has been deleted.');
		}
	}
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('hotlinks.component_controller_admincp_delete_clean')) ? eval($sPlugin) : false);
	}
}

?>