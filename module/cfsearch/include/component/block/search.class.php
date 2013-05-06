<?php
defined('PHPFOX') or exit('NO DICE!');
class CFSearch_Component_Block_Search extends Phpfox_Component
{

	public function process()
	{
       $aParams = $this->getParam('aParams');
       $aOptions = phpfox::getService('cfsearch')->getSearchOptions();
       if(!is_array($aOptions))
       {
           $aOptions = array();
       }
       $this->template()->assign(
            array(
                'sCoreUrl' => phpfox::getParam('core.path'),
                'oFilterCFOptionsJ' => json_encode($aOptions),
                'aFilterCFOptions' => $aOptions,
            )
       );
       
	}
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('cfsearch.component_block_getcode_clean')) ? eval($sPlugin) : false);
	}
}

?>