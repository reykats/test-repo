<?php
defined('PHPFOX') or exit('NO DICE!');

class Cfsearch_Service_supports_pages extends Phpfox_Service 
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
        $iOffset = ($this->_iLimit * $iPage);
        $aRows = $this->database()->select('pages.*,pu.vanity_url, ' . Phpfox::getUserField())
                ->from(phpfox::getT('pages'),'pages')
                ->leftJoin(Phpfox::getT('pages_url'), 'pu', 'pu.page_id = pages.page_id')   
                ->join(Phpfox::getT('user'), 'u', 'u.user_id = pages.user_id')
                ->where('pages.title LIKE "%'.$this->database()->escape($sKeyword).'%"')
                ->limit($iOffset, $this->_iLimit)
                ->order('time_stamp DESC')                
                ->execute('getSlaveRows');
        $aResults = array();
        if(count($aRows))
        {
            foreach($aRows as $iKey => $aRow)
            {
                $aResults[$iKey]= $aRow;
                if(!empty($aRow['image_path']))
                {
                    $aResults[$iKey]['user_image'] = phpfox::getParam('core.path').'file/pic/pages/'.sprintf($aResults[$iKey]['image_path'],"_50");
                }
                else
                {
                    $aResults[$iKey]['user_image']= phpfox::getParam('core.path').'module/cfsearch/static/image/noimg.png';                                 
                }
                $aResults[$iKey]['item_title']= $aRow['title']; 
                if(phpfox::isModule('pages'))
                {
                    $aResults[$iKey]['item_url'] = phpfox::getService('pages')->getUrl($aRow['page_id'],$aRow['title'],$aRow['vanity_url']);
                }
                else
                {
                    $aResults[$iKey]['item_url'] = phpfox::getParam('core.path');
                }
                if($this->_bSearchDetail && phpfox::isModule('pages'))
                {
                    list($iTotalMembers, $aMembers) = Phpfox::getService('pages')->getMembers($aRow['page_id']);  
                    $aResults[$iKey]['total_liked_member'] =  $iTotalMembers;
                }
                
                
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
