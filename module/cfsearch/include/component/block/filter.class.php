<?php
defined('PHPFOX') or exit('NO DICE!');
class CFSearch_Component_Block_Filter extends Phpfox_Component
{

	public function process()
	{
        $aSearchFilterMenu = $this->getParam('aSearchFilterMenu');
        $sView = $this->getParam('sView');
        if(!is_array($aSearchFilterMenu))
        {
            return false;
        }
        $this->template()->assign(array(
            'aSearchFilterMenu' =>$aSearchFilterMenu,
            'sView'=>$sView,
            )
        );
	}
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('cfsearch.component_block_filter_clean')) ? eval($sPlugin) : false);
	}
}

?>