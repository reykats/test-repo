<?php
defined('PHPFOX') or exit('NO DICE!');

class Cfsearch_Service_supports_forum extends Phpfox_Service 
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
         $this->_sView = "forum";
          $this->_bSearchDetail = false;
    }
    public function setSearchDetail($bSearchDetail = false)
    {
         $this->_bSearchDetail = $bSearchDetail;
    }
    public function get($sKeyword = "",$iPage = 0)
    {
        $aThreads = $this->database()->select('ma.*,'.phpfox::getUserField())
                    ->from(phpfox::getT('forum_post'),'ma')
                    ->leftjoin(phpfox::getT('forum_post_text'),'mat','mat.post_id = ma.post_id')
                    ->join(Phpfox::getT('user'), 'u', 'u.user_id = ma.user_id')
                    ->where('( ma.title LIKE "%'.$this->database()->escape($sKeyword).'%" OR mat.text LIKE "%'.$this->database()->escape($sKeyword).'%")')
                    ->limit($this->_iLimit*$iPage, $this->_iLimit)
                    ->order('time_stamp DESC')                
                    ->execute('getSlaveRows');
        $aResults = array();
        if(count($aThreads)>0)
        {
            foreach($aThreads as $aThread)
            {
                $aAl = $aThread;
                if(!empty($aAl['image_path']))
                {
                    $aAl['user_image'] = phpfox::getParam('core.path').'file/pic/forum/'.sprintf($aAl['image_path'],"_50");
                }
                else
                {
                    //$aAl['user_image']=""; 
                    //$aAl['user_image'] = phpfox::getParam('core.path').'file/pic/user/'.sprintf($aAl['user_image'],'_50_square');
                    if($this->_bSearchDetail && !empty($aAl['user_image']))
                    {
                         $aAl['user_image'] = phpfox::getParam('core.path').'file/pic/user/'.sprintf($aAl['user_image'],'_50_square');   
                    }
                    else
                    {
                         $aAl['user_image'] = phpfox::getParam('core.path').'module/cfsearch/static/image/noimg.png';
                    }
                                                    
                }
                $aAl['item_title']= $aAl['title']; 
                $aAl['item_url'] = phpfox::getLib('url')->permalink('forum.thread', $aAl['post_id'], $aAl['title']);
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
