<?php
defined('PHPFOX') or exit('NO DICE!');

class Cfsearch_Service_supports_event extends Phpfox_Service 
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
         $this->_sView = "event";
         $this->_bSearchDetail = false;  
    }
    public function setSearchDetail($bSearchDetail = false)
    {
         $this->_bSearchDetail = $bSearchDetail;
    }
    public function get($sKeyword = "",$iPage = 0)
    {
        if($this->_bSearchDetail)
        {
            $this->database()->select('mat.description_parsed,');
            $this->database()->leftjoin(phpfox::getT('event_text'),'mat','mat.event_id = ma.event_id');
        }
        $aEvents = $this->database()->select('ma.*,'.phpfox::getUserField())
                    ->from(phpfox::getT('event'),'ma')
                    ->join(Phpfox::getT('user'), 'u', 'u.user_id = ma.user_id')
                    ->where('ma.title LIKE "%'.$this->database()->escape($sKeyword).'%" AND ma.privacy = 0 AND ma.view_id = 0')
                    ->limit($this->_iLimit*$iPage, $this->_iLimit)
                    ->order('time_stamp DESC')                
                    ->execute('getSlaveRows');
        $aResults = array();
        if(count($aEvents)>0)
        {
            foreach($aEvents as $aEvent)
            {
                $aAl = $aEvent;
                if(!empty($aAl['image_path']))
                {
                    if($this->_bSearchDetail)
                    {
                        $aAl['user_image'] = phpfox::getParam('core.path').'file/pic/event/'.sprintf($aAl['image_path'],"_120");    
                    }
                    else
                    {
                        $aAl['user_image'] = phpfox::getParam('core.path').'file/pic/event/'.sprintf($aAl['image_path'],"_50");    
                    }
                    
                }
                else
                {
                    //$aAl['user_image']=""; 
                    if($this->_bSearchDetail && !empty($aAl['user_image']))
                    {
                         $aAl['user_image'] = phpfox::getParam('core.path').'file/pic/user/'.sprintf($aAl['user_image'],'_50_square');   
                    }
                    else
                    {
                         $aAl['user_image'] = phpfox::getParam('core.path').'module/cfsearch/static/image/item.png';
                    }
                    
                                                    
                }
                
                $aAl['item_title']= $aAl['title']; 
                $aAl['item_url'] = phpfox::getLib('url')->permalink('event', $aAl['event_id'], $aAl['title']);
                $aResults[] = $aAl;
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
