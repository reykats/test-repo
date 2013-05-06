<?php
defined('PHPFOX') or exit('NO DICE!');

class Cfsearch_Service_supports_video extends Phpfox_Service 
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
         $this->_sView = "video";
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
            
        }
        $aVideos = $this->database()->select('ma.*,mat.text_parsed,'.phpfox::getUserField())
                    ->from(phpfox::getT('video'),'ma')
                    ->leftjoin(phpfox::getT('video_text'),'mat','mat.video_id = ma.video_id')
                    ->join(Phpfox::getT('user'), 'u', 'u.user_id = ma.user_id')
                    ->where('( ma.title LIKE "%'.$this->database()->escape($sKeyword).'%" OR mat.text LIKE "%'.$this->database()->escape($sKeyword).'%" ) AND ma.privacy = 0 AND ma.view_id = 0')
                    ->limit($this->_iLimit*$iPage, $this->_iLimit)
                    ->order('time_stamp DESC')                
                    ->execute('getSlaveRows');
        $aResults = array();
        if(count($aVideos)>0)
        {
            foreach($aVideos as $aVideo)
            {
                $aAl = $aVideo;
                if(!empty($aAl['image_path']))
                {
                    $aAl['image_path'] = str_replace("\\","/",$aAl['image_path']);
                    $aAl['user_image'] = phpfox::getParam('core.path').'file/pic/video/'.sprintf($aAl['image_path'],"_120");
                }
                else
                {
                    //$aAl['user_image']=""; 
                    $aAl['user_image'] = phpfox::getParam('core.path').'file/pic/user/'.sprintf($aAl['user_image'],'_50_square');
                                                    
                }
                
                $aAl['item_title']= $aAl['title']; 
                $aAl['item_url'] = phpfox::getLib('url')->permalink('video', $aAl['video_id'], $aAl['title']);
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
