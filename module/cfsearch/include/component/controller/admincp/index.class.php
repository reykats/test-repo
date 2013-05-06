<?php
defined('PHPFOX') or exit('NO DICE!');
class CFSearch_Component_Controller_Admincp_Index extends Phpfox_Component
{
	public function process()
	{
        $oModules = phpfox::getService('cfsearch.modules');
        $this->template()->setBreadCrumb(Phpfox::getPhrase('cfsearch.manage_supported_modules'));
		$this->template()->assign(
           array() 
        );
        $this->template()->setTitle(Phpfox::getPhrase('cfsearch.manage_supported_modules'))
            ->setBreadcrumb(Phpfox::getPhrase('cfsearch.manage_supported_modules'))
            ->setHeader(array(
                    'drag.js' => 'static_script',
                    '<script type="text/javascript">Core_drag.init({table: \'#js_drag_drop\', ajax: \'' . 'cfsearch.moduleOrdering' . '\'});</script>'        
                )
            )            
            ->assign(array(
                    'aModules' => $oModules->getModulesAdminCP()
                )
            );
	}
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('cfsearch.component_controller_admincp_index_clean')) ? eval($sPlugin) : false);
	}
}

?>
