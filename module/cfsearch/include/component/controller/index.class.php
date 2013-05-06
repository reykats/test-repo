<?php
defined('PHPFOX') or exit('NO DICE!');
class CFSearch_Component_Controller_Index extends Phpfox_Component
{
	public function process()
	{
        $oModules = phpfox::getService('cfsearch.modules');
        $oSearch = phpfox::getService('cfsearch');
        $sQuery = $this->request()->get('k', null);
        $sView = $this->request()->get('req2','all');
        $iPage = $this->request()->getInt('page');    
	    $aModules = $oModules->getModulesDisplay();
        $aFilterMenu = array(
                Phpfox::getPhrase('cfsearch.all_results') => array(
                    'url' =>$this->url()->makeUrl('cfsearch').'all/k_'.urlencode($sQuery),
                    'type' =>'all'
                )
        );
        if(count($aModules)) 
        {
            foreach($aModules as $aModule)
            {
                $aFilterMenu[phpfox::getPhrase($aModule['phrase_var_name'])]=array(
                    'url' =>$this->url()->makeUrl('cfsearch').$aModule['module'].'/k_'.urlencode($sQuery),
                    'type'=>$aModule['module']
                ); 
                
            }
        }
        $this->setParam('aSearchFilterMenu',$aFilterMenu);
        $this->setParam('sView',$sView);
        $bAll = false;
        $aResultsSearch = array();
        $aFilterCFSearch = array();
        if ($sQuery !== null && !empty($sQuery))  
        {
            if($sView == "all")
            {
                foreach($aModules as $aModule)
                {
                    $oSearch->setSearchDetail(true);
                    $aResultsSearch[phpfox::getPhrase($aModule['phrase_var_name'])]=array(
                        'url' => $this->url()->makeUrl('cfsearch').$aModule['module'].'/k_'.urlencode($sQuery),
                        'type'=> $aModule['module'],
                        'data' => $oSearch->search($aModule['module'],$sQuery)
                    ); 
                    if($aModule['module'] =="music")
                    {
                        //d($aResultsSearch[phpfox::getPhrase($aModule['phrase_var_name'])]);die();
                    }
                    
                }
                $bAll = true;
            }
            else
            {
                 $oSearch->setSearchDetail(true); 
                 $aFilterCFSearch = array(
                        'url' => $this->url()->makeUrl('cfsearch').$sView.'/k_'.urlencode($sQuery),
                        'type'=> $sView,
                        'data' => $oSearch->search($sView,$sQuery)
                    ); 
                 $bAll = false;
            }
        }
        else
        {
            Phpfox_Error::set(Phpfox::getPhrase('cfsearch.please_enter_a_query_in_the_box_above'));
        }
        $this->template()->setTitle(Phpfox::getPhrase('cfsearch.ultimate_search'))
            ->setBreadcrumb(phpfox::getPhrase('cfsearch.search_results_2'),phpfox::getParam('core.path'),true)
            ->setBreadcrumb(Phpfox::getPhrase('cfsearch.ultimate_search'),$this->url()->makeUrl('cfsearch'),false)
            ->setHeader(array(
                'search.css' => 'style_css', 
                'fullsearch.css' => 'module_cfsearch', 
                'fullsearch.js' => 'module_cfsearch', 
                )
            )
            ->assign(array(
                    'aModules' => $aModules,
                    'sQuery' => $sQuery,  
                    'aResultsSearch' => $aResultsSearch,  
                    'aFilterCFSearch' => $aFilterCFSearch,  
                    'bAll' => $bAll,  
                    'sView' => $sView,  
                    
                )
            );
	}
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('cfsearch.component_controller_admincp_index_clean')) ? eval($sPlugin) : false);
	}
}

?>
