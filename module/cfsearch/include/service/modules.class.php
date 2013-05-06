<?php
defined('PHPFOX') or exit('NO DICE!');

class Cfsearch_Service_Modules extends Phpfox_Service 
{
    
    public function __construct()
    {
        $this->_sTable = phpfox::getT('cfsearch_modules');
    }
    public function getModulesAdminCP()
    {
        $aModules = $this->database()->select('*')
                    ->from($this->_sTable,'m')
                    ->order('ordering ASC')
                    ->execute('getRows');
        return $aModules;
    }
    public function getModulesDisplay()
    {
        $sCacheId = $this->cache()->set('cfsearch_module_display');
        if(!$aModules = $this->cache()->get($sCacheId))
        {
            $aModules = $this->database()->select('*')
                    ->from($this->_sTable,'m')
                    ->where('m.is_active = 1')
                    ->order('ordering ASC')
                    ->execute('getRows');
             $this->cache()->save($sCacheId,$aModules);
        }
        
        return $aModules;
    }
    public function getModuleByName($sName = "user")
    {
        $aModule = $this->database()->select('*')
                    ->from($this->_sTable,'m')
                    ->where('m.is_active = 1 AND module="'.$this->database()->escape($sName).'"')
                    ->execute('getRow');
        return $aModule;
    }
    public function orrderingModules()
    {
        
    }
    public function updateActivity($iId, $iType)
    {
        Phpfox::isUser(true);
        Phpfox::getUserParam('admincp.has_admin_access', true);        
        $this->database()->update($this->_sTable, array('is_active' => (int) ($iType == '1' ? 1 : 0)),'id = ' . (int) $iId);
        $this->cache()->remove('cfsearch_module_display');      
    }    
    public function updateModuleSetting($aVals = array(),$iModuleId = 0)
    {
        $bUpdate = $this->database()->update($this->_sTable,$aVals,'id = '.$iModuleId);
        $this->cache()->remove('cfsearch_module_display'); 
        return $bUpdate;
    }
    public function __call($sMethod, $aArguments)
    {
        if ($sPlugin = Phpfox_Plugin::get('cfsearch.service_process__call'))
        {
            return eval($sPlugin);
        }
        Phpfox_Error::trigger('Call to undefined method ' . __CLASS__ . '::' . $sMethod . '()', E_USER_ERROR);
    }    
}

?>

