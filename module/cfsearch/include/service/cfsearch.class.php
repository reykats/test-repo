<?php
defined('PHPFOX') or exit('NO DICE!');

class Cfsearch_Service_cfsearch extends Phpfox_Service 
{
    public function __construct()
    {
         $this->_bSearchDetail = false;
    }
    public function setSearchDetail($bSearchDetail = false)
    {
         $this->_bSearchDetail = $bSearchDetail;
    }
    public function showSearchBar($aParams = array())
    {
        phpfox::getBlock('cfsearch.search',$aParams);
    }
    public function getSearchOptions()
    {
        $aOptions = array();
        $aOptions = phpfox::getService('cfsearch.modules')->getModulesDisplay();
        return $aOptions;
    }
    public function search($sType ="user",$sKeyword ="",$iPage = 0)
    {
        $aModule = phpfox::getService('cfsearch.modules')->getModuleByName($sType);
        if(!isset($aModule['module']))
        {
            return array();
        }
        $sFile = PHPFOX_DIR.'module'.PHPFOX_DS.'cfsearch'.PHPFOX_DS.'include'.PHPFOX_DS.'service'.PHPFOX_DS.'supports'.PHPFOX_DS.$sType.'.class.php';
        if(!file_exists($sFile))
        {
            return array();
        }
        
        $oService = phpfox::getService('cfsearch.supports.'.$sType);
        $oService->setSearchDetail($this->_bSearchDetail);
        $aData = $oService->get($sKeyword,$iPage);
        return $aData;
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
