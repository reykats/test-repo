<?php

class Pinsblock_Component_Block_Display extends Phpfox_Component
{

	public function process() {

      $oPins = Phpfox::getService('pins');
      $oDatabase = Phpfox::getLib('database');
        
      // SEARCH & FILTERS
      // view 
        $sView='all'; 

      // sort
        $sSort='latest';

      // when
        $sWhen='all-time';
        
      // show
        $sShow=30;
        
      // filter
        $sFilter='all';
        
      // search
        $sSearch = '';
        
      // init array
        $aPins = array();
        
      // pagination
        //$iPage1 = $this->request()->get('req1');    core
        //$iPage2 = $this->request()->get('req2');    page
        $iPage = $this->request()->getInt('req3'); 
        
        // pay for pin enable?
        if(Phpfox::getParam('pins.enable_pay_for_pin')) $sFilter = 'featured';

      // run queries
        if(Phpfox::getParam('pins.enable_media_photo') && $sView=='photo'){
          list($iCnt, $aPins) = $oPins->getPhotos($sView, $sSort, $sWhen, $iPage, $sSearch, $sShow, $sFilter);  
        }
        elseif(Phpfox::getParam('pins.enable_media_video') && $sView=='video'){
          list($iCnt, $aPins) = $oPins->getVideos($sView, $sSort, $sWhen, $iPage, $sSearch, $sShow, $sFilter); 
        }
        elseif(Phpfox::getParam('pins.enable_media_song_with_album') && Phpfox::getParam('pins.enable_media_song_without_album') && $sView=='music'){
          list($iCnt, $aPins) = $oPins->getMusicsAndSongs($sView, $sSort, $sWhen, $iPage, $sSearch, $sShow, $sFilter);  
        }
        elseif(Phpfox::getParam('pins.enable_media_song_with_album') && $sView=='music'){
          list($iCnt, $aPins) = $oPins->getMusics($sView, $sSort, $sWhen, $iPage, $sSearch, $sShow, $sFilter);   
        } 
        elseif(Phpfox::getParam('pins.enable_media_song_without_album') && $sView=='music'){
          list($iCnt, $aPins) = $oPins->getSongs($sView, $sSort, $sWhen, $iPage, $sSearch, $sShow, $sFilter); 
        }
        elseif(Phpfox::getParam('pins.enable_media_blog') && $sView=='blog'){
          list($iCnt, $aPins) = $oPins->getBlogs($sView, $sSort, $sWhen, $iPage, $sSearch, $sShow, $sFilter);   
        }
        elseif(Phpfox::getParam('pins.enable_media_poll') && $sView=='poll'){
          list($iCnt, $aPins) = $oPins->getPolls($sView, $sSort, $sWhen, $iPage, $sSearch, $sShow, $sFilter); 
        } 
        elseif(Phpfox::getParam('pins.enable_media_quiz') && $sView=='quiz'){
          list($iCnt, $aPins) = $oPins->getQuizzes($sView, $sSort, $sWhen, $iPage, $sSearch, $sShow, $sFilter);
        } 
        else{
          list($iCnt, $aPins) = $oPins->getAllBaby($sView, $sSort, $sWhen, $iPage, $sSearch, $sShow, $sFilter);
        } 

    // check if there is data returned
      if($aPins==1) $aPins = array();

    // prepare current url for paging
      $currentUrl = $this->url()->makeUrl('current');    

      $currentUrl = str_replace('page/'.$iPage.'/', '', $currentUrl);   
  
      $currentUrl = str_replace('page/'.$iPage, '', $currentUrl);
                                                        
    // set pager link 
      $oPins->oPaging->setLink($currentUrl.'core/page/%s');
                              
    // assign final array to view
      $this->template()->assign('aPins', $aPins);
        
    // assign js player only if we use songs
      if((Phpfox::getParam('pins.enable_media_song_without_album') or Phpfox::getParam('pins.enable_media_song_with_album')) && ($sView=='all' or $sView=='music')) {
          $this->template()
           ->setHeader(array(
    					'player/' . Phpfox::getParam('core.default_music_player') . '/core.js' => 'static_script'
            )); 
      }
         
      $this->template()->assign('macpager', $oPins->oPaging->create_links());
      
      $nextUrlPaginator = '';
               
      if ($iPage < $oPins->oPaging->getMacPinsNextPage()){

        $iPage = $iPage == 0? 1 : $iPage;
        $nextPageNum = $iPage+1;    
        $nextUrlPaginator = $currentUrl.'core/page/'.$nextPageNum;
        $nextUrlPaginator = '<nav id="page-nav"><a href="'.$nextUrlPaginator.'"></a></nav>';
        
      } elseif(empty($sSearch) && !empty($aPins)) die();// stop infinite scroll

                  
      $this->template()->assign('currentUrlForForm', $currentUrl);
      $this->template()->assign('nextUrlPaginator', $nextUrlPaginator);
    
  }

}

?>