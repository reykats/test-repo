<?php
defined('PHPFOX') or exit('NO DICE!');

class Cfsearch_Service_supports_user extends Phpfox_Service 
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
         $this->_sView = "user";
         $this->_bSearchDetail = false;
    }
    public function setSearchDetail($bSearchDetail = false)
    {
         $this->_bSearchDetail = $bSearchDetail;
    }
    public function getFromCache($mAllowCustom = false, $sUserSearch = false,$iPage = 0)
    {
        $mAllowCustom = false;
        if (Phpfox::getUserBy('profile_page_id'))
        {
            $mAllowCustom = true;
        }
        if($iPage > 1)
        {
            $iPage--;
        }
        $iOffset = $this->_iLimit*$iPage;
        
        if ($sUserSearch != false)
        {
            /*if (Phpfox::getUserParam('mail.restrict_message_to_friends') == true)
            {
                $this->database()->join($this->_sTable, 'f', 'u.user_id = f.friend_user_id AND f.user_id=' . Phpfox::getUserId());
            }*/
            
            $aRows = $this->database()->select('' . Phpfox::getUserField())
                ->from(Phpfox::getT('user'),'u')
                ->where('u.full_name LIKE "%'. Phpfox::getLib('parse.input')->clean($sUserSearch) .'%" AND u.profile_page_id = 0')
                ->limit($iOffset,$this->_iLimit)
                ->order('u.last_activity DESC')
                ->execute('getSlaveRows');
        }
        /*else
        {
            $aRows = $this->database()->select('f.*, ' . Phpfox::getUserField())
                ->from($this->_sTable, 'f')
                ->join(Phpfox::getT('user'), 'u', 'u.user_id = f.friend_user_id')
                ->where(($mAllowCustom ? '' : 'f.is_page = 0 AND') . ' f.user_id = ' . Phpfox::getUserId())
                ->limit($iOffset,Phpfox::getParam('friend.friend_cache_limit'))
                ->order('u.last_activity DESC')
                ->execute('getSlaveRows');
        }*/    
        
        foreach ($aRows as $iKey => $aRow)
        {            
            $aRows[$iKey]['full_name'] = html_entity_decode(Phpfox::getLib('parse.output')->split($aRow['full_name'], 20), null, 'UTF-8');                        
            $aRows[$iKey]['user_profile'] = ($aRow['profile_page_id'] ? Phpfox::getService('pages')->getUrl($aRow['profile_page_id'], '', $aRow['user_name']) : Phpfox::getLib('url')->makeUrl($aRow['user_name']));
            $aRows[$iKey]['is_page'] = ($aRow['profile_page_id'] ? true : false);
            $aRows[$iKey]['user_image'] = Phpfox::getLib('image.helper')->display(array(
                    'user' => $aRow,
                    'suffix' => '_50_square',
                    'max_height' => 50,
                    'max_width' => 50,
                    'return_url' => true
                )
            );
            $aRows[$iKey]['item_url'] = phpfox::getLib('url')->makeUrl($aRows[$iKey]['user_name']);
            $aRows[$iKey]['item_title'] = $aRows[$iKey]['full_name'];
            if (Phpfox::isModule('friend') && $this->_bSearchDetail)
            {
                $aRows[$iKey]['mutual_friends'] = (Phpfox::getUserId() == $aRow['user_id'] ? 0 : $this->database()->select('COUNT(*)')
                        ->from(Phpfox::getT('friend'), 'f')
                        ->innerJoin('(SELECT friend_user_id FROM ' . Phpfox::getT('friend') . ' WHERE is_page = 0 AND user_id = ' . $aRow['user_id'] . ')', 'sf', 'sf.friend_user_id = f.friend_user_id')
                        ->where('f.user_id = ' . Phpfox::getUserId())
                        ->execute('getSlaveField'));                
            }
        }        
        
        return $aRows;
    }
    public function get($sKeyword = "",$iPage = 0)
    {
        $aResults = array();
        $aResults = $this->getFromCache(false,$sKeyword,$iPage);
        if(count($aResults) > 0)
        {
            foreach($aResults as $iKey => $aResult)
            {
                $aResults[$iKey]['item_title'] = $aResults[$iKey]['full_name'];
            }
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
