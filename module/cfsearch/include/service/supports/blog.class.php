<?php
defined('PHPFOX') or exit('NO DICE!');

class Cfsearch_Service_supports_blog extends Phpfox_Service 
{
    public function __construct()
    {
         $this->_iLimit = phpfox::getParam('cfsearch.search_result_limit');
         if($this->_iLimit < 0)
         {
             $this->_iLimit = 10;
         }
         if($this->_iLimit >30)
         {
             $this->_iLimit = 30;
         }
         $this->_sView = "blog";
         $this->_bSearchDetail = false;
         
    }
    public function setSearchDetail($bSearchDetail = false)
    {
         $this->_bSearchDetail = $bSearchDetail;
    }
    public function get($sKeyword = "",$iPage = 0)
    {
        if ($this->_sView !== null && Phpfox::isModule($this->_sView))
        {
            $aModuleResults = Phpfox::callback($this->_sView . '.globalUnionSearch', $this->preParse()->clean($sKeyword));
        }
        $iOffset = ($this->_iLimit * $iPage);
        $aRows = $this->database()->select('item.*, ' . Phpfox::getUserField())
                ->unionFrom('item')        
                ->join(Phpfox::getT('user'), 'u', 'u.user_id = item.item_user_id')
                ->limit($iOffset, $this->_iLimit)
                ->order('item_time_stamp DESC')                
                ->execute('getSlaveRows');
        $aResults = array();
        foreach ($aRows as $iKey => $aRow)
        {
            $aResults[] = array_merge($aRow, (array) Phpfox::callback($aRow['item_type_id'] . '.getSearchInfo', $aRow));
        }
        return $aResults;
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
