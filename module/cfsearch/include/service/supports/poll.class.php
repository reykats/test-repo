<?php
defined('PHPFOX') or exit('NO DICE!');

class Cfsearch_Service_supports_poll extends Phpfox_Service 
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
         $this->_sView = "poll";
         $this->_bSearchDetail = false;    
    }
    public function setSearchDetail($bSearchDetail = false)
    {
         $this->_bSearchDetail = $bSearchDetail;
    }
    public function get($sKeyword = "",$iPage = 0)
    {
        $aPolls = $this->database()->select('ma.*,'.phpfox::getUserField())
                    ->from(phpfox::getT('poll'),'ma')
                    ->join(Phpfox::getT('user'), 'u', 'u.user_id = ma.user_id')
                    ->where('ma.question LIKE "%'.$this->database()->escape($sKeyword).'%" AND ma.privacy = 0 AND ma.view_id = 0')
                    ->limit($this->_iLimit*$iPage, $this->_iLimit)
                    ->order('time_stamp DESC')                
                    ->execute('getSlaveRows');
        $aResults = array();
        if(count($aPolls)>0)
        {
            foreach($aPolls as $aPoll)
            {
                $aAl = $aPoll;
                if(!empty($aAl['image_path']))
                {
                    $aAl['user_image'] = phpfox::getParam('core.path').'file/pic/poll/'.sprintf($aAl['image_path'],"_75");
                }
                else
                {
                    //$aAl['user_image']=""; 
                    if(!empty($aAl['user_image']))
                    {
                       $aAl['user_image'] = phpfox::getParam('core.path').'file/pic/user/'.sprintf($aAl['user_image'],'_50_square'); 
                    }
                    else
                    {
                        $aAl['user_image']= phpfox::getParam('core.path').'module/cfsearch/static/image/noimg.png';
                    }
                    
                                                    
                }
                
                $aAl['item_title']= $aAl['question']; 
                $aAl['item_url'] = phpfox::getLib('url')->permalink('marketplace', $aAl['poll_id'], $aAl['question']);
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
