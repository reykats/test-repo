<?php
defined('PHPFOX') or exit('NO DICE!');
class CFSearch_Component_Block_View extends Phpfox_Component
{

	public function process()
	{
       
	}
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('cfsearch.component_block_getcode_clean')) ? eval($sPlugin) : false);
	}
}

?>