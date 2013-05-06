<?php
defined('PHPFOX') or exit('NO DICE!');

class Cfsearch_Service_supports_music extends Phpfox_Service 
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
         $this->_sView = "music";
         $this->_bSearchDetail = false;
    }
    public function setSearchDetail($bSearchDetail = false)
    {
         $this->_bSearchDetail = $bSearchDetail;
    }
    public function get($sKeyword = "",$iPage = 0)
    {
        $iLimitSearchAlbum = (int)$this->_iLimit/2;
        $aAlbums = $this->database()->select('ma.*,mat.text,mat.text_parsed,'.phpfox::getUserField())
                    ->from(phpfox::getT('music_album'),'ma')
                    ->join(phpfox::getT('music_album_text'),'mat','mat.album_id = ma.album_id')
                    ->join(Phpfox::getT('user'), 'u', 'u.user_id = ma.user_id')
                    ->where('mat.text LIKE "%'.$this->database()->escape($sKeyword).'%" AND ma.privacy = 0 AND ma.view_id = 0')
                    ->limit($iLimitSearchAlbum*$iPage, $iLimitSearchAlbum)
                    ->order('time_stamp DESC')                
                    ->execute('getSlaveRows');
        $aResults = array();
        if(count($aAlbums)>0)
        {
            foreach($aAlbums as $aAlbum)
            {
                $aAl = $aAlbum;
                if(!empty($aAl['image_path']))
                {
                    $aAl['user_image'] = phpfox::getParam('core.path').'file/pic/music/'.sprintf($aAl['image_path'],"_50");
                }
                else
                {
                    //$aAl['user_image']=""; 
                    $aAl['user_image'] = phpfox::getParam('core.path').'file/pic/user/'.sprintf($aAl['user_image'],'_50_square');
                                                    
                }
                
                $aAl['item_title']= $aAl['text']; 
                $aAl['item_url'] = phpfox::getLib('url')->permalink('music.album', $aAl['album_id'], $aAl['text']);
                $aResults[] = $aAl;
            }
        }
        $iLimitSearchSong = $this->_iLimit - count($aResults);
        $aSongs = $this->database()->select('song.*,'.phpfox::getUserField())
                    ->from(phpfox::getT('music_song'),'song')
                    ->join(Phpfox::getT('user'), 'u', 'u.user_id = song.user_id')
                    ->where('song.title LIKE "%'.$this->database()->escape($sKeyword).'%" AND song.privacy = 0 AND song.view_id = 0')
                    ->limit($iLimitSearchSong*$iPage, $iLimitSearchSong)
                    ->order('time_stamp DESC')                
                    ->execute('getSlaveRows');
        if(count($aSongs)>0)
        {
            foreach($aSongs as $aSong)
            {
                $aAl = $aSong;
                $aAl['item_title']= $aAl['title']; 
                $aAl['item_url'] = phpfox::getLib('url')->permalink('music', $aAl['song_id'], $aAl['title']);
                if($this->_bSearchDetail)
                {
                   if(!empty($aAl['user_image']))
                    {
                        $aAl['user_image'] = phpfox::getParam('core.path').'file/pic/user/'.sprintf($aAl['user_image'],"_50_square");
                    }
                    else
                    {
                        //$aAl['user_image']=""; 
                        $aAl['user_image'] = phpfox::getParam('core.path').'module/cfsearch/static/image/song.png';
                                                        
                    } 
                }
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
