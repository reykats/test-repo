<?php
defined('PHPFOX') or exit('NO DICE!');

class Cfsearch_Service_supports_photo extends Phpfox_Service 
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
         $this->_sView = "photo";
         $this->_bSearchDetail = false;    
    }
    public function setSearchDetail($bSearchDetail = false)
    {
         $this->_bSearchDetail = $bSearchDetail;
    }
    public function get($sKeyword = "",$iPage = 0)
    {
        $iLimitSearchAlbum = (int)$this->_iLimit/2;
        $aAlbums = $this->database()->select('ma.*,'.phpfox::getUserField())
                    ->from(phpfox::getT('photo_album'),'ma')
                    ->join(Phpfox::getT('user'), 'u', 'u.user_id = ma.user_id')
                    ->where('ma.name LIKE "%'.$this->database()->escape($sKeyword).'%" AND ma.privacy = 0 AND ma.view_id = 0')
                    ->limit($iLimitSearchAlbum*$iPage, $iLimitSearchAlbum)
                    ->order('time_stamp DESC')                
                    ->execute('getSlaveRows');
        $aResults = array();
        if(count($aAlbums)>0)
        {
            foreach($aAlbums as $aAlbum)
            {
                $aAl = $aAlbum;
                $aAl['item_title']= $aAl['name']; 
                $aAl['item_url'] = phpfox::getLib('url')->permalink('photo.album', $aAl['album_id'], $aAl['name']);
                
                if($this->_bSearchDetail)
                {
                    $aAl['user_image']= phpfox::getParam('core.path').'module/cfsearch/static/image/album.png';                                 
                }
                $aResults[] = $aAl;
            }
        }
        $iLimitSearchPhoto = $this->_iLimit - count($aResults);
        $aPhotos = $this->database()->select('photo.*,'.phpfox::getUserField())
                    ->from(phpfox::getT('photo'),'photo')
                    ->join(Phpfox::getT('user'), 'u', 'u.user_id = photo.user_id')
                    ->where('photo.title LIKE "%'.$this->database()->escape($sKeyword).'%" AND photo.privacy = 0 AND photo.view_id = 0')
                    ->limit($iLimitSearchPhoto*$iPage, $iLimitSearchPhoto)
                    ->order('time_stamp DESC')                
                    ->execute('getSlaveRows');
        if(count($aPhotos)>0)
        {
            foreach($aPhotos as $aPhoto)
            {
                $aAl = $aPhoto;
                if(!empty($aAl['destination']))
                {
                    if($this->_bSearchDetail)
                    {
                        $aAl['user_image'] = phpfox::getParam('core.path').'file/pic/photo/'.sprintf($aAl['destination'],"_150");                                
                    }
                    else
                    {
                        $aAl['user_image'] = phpfox::getParam('core.path').'file/pic/photo/'.sprintf($aAl['destination'],"_100");   
                    }
                    
                }
                else
                {
                    if(!empty($aAl['user_image']))
                    {
                        $aAl['user_image'] = phpfox::getParam('core.path').'file/pic/user/'.sprintf($aAl['user_image'],'_50_square');   
                    }
                    else
                    {
                        $aAl['user_image']= phpfox::getParam('core.path').'module/cfsearch/static/image/noimg.png';     
                    }
                    
                }
                
                $aAl['item_title']= $aAl['title']; 
                $aAl['item_url'] = phpfox::getLib('url')->permalink('photo', $aAl['photo_id'], $aAl['title']).'albumid_'.$aAl['album_id'];
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
