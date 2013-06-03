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
class Hotlinks_Component_Controller_Admincp_Add extends Phpfox_Component
{
	public function process()
	{
		
		$aValidation = array(
			'keyword' => array(
				'def' => 'required',
				'title' => 'Keyword must not be empty.'
			),
			'url' => array(
				'def' => 'required',
				'title' => 'URL must not be empty.'
			)
		);
		$oValid = Phpfox::getLib('validator')->set(array(
				'sFormName' => 'js_form',	
				'aParams' => $aValidation
			)
		); 
		
		$bIsEdit = false;
		if ($iEditId = $this->request()->getInt('req4'))
		{
			if ($aHotlink = Phpfox::getService('hotlinks')->getForEdit($iEditId))
			{
				$bIsEdit = true;
			}
		}

		if($aVals = $this->request()->getArray("val")) {
			if ($oValid->isValid($aVals)) {
				if($hotlink_id = $this->request()->getInt('id')) {
					if(Phpfox::getService('hotlinks')->update($hotlink_id, $aVals)) {
						$this->url()->send($sUserName, array('admincp/hotlinks', 'add/' . $hotlink_id), 'Hotlink has been updated.');
					}
				} else {
					if($hotlink_id = Phpfox::getService('hotlinks')->add($aVals)) {
						$this->url()->send($sUserName, array('admincp/hotlinks', 'add/' . $hotlink_id), 'Hotlink has been added.');
					}
				}	
			} else {
				$this->template()->assign(array(
						'bErrors' => true
				));
			}			
		}
		
		$this->template()->setTitle(($bIsEdit ? 'Edit Hotlink' : 'Create Hotlink'))
			->setBreadcrumb(($bIsEdit ? 'Edit Hotlink' : 'Create Hotlink'))
			->assign(array(
					'sData' => $aHotlink,
					'bIsEdit' => $bIsEdit,
					'sCreateJs' => $oValid->createJS()
				)
			);	
	}
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('recipe.component_controller_admincp_add_clean')) ? eval($sPlugin) : false);
	}
}

?>