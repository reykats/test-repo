<?php
defined('PHPFOX') or exit('NO DICE!');

class CFSearch_Component_Ajax_Ajax extends Phpfox_Ajax
{
    public function searchmore()
    {
        $sKeyword = $this->get('k');
        $sType = $this->get('type');
        $iPage = $this->get('page');
        $oSearch = phpfox::getService('cfsearch');
        $oSearch->setSearchDetail(true); 
        $aFilterCFSearch = array(
            'url' => phpfox::getLib('url')->makeUrl('cfsearch').$sType.'/k_'.urlencode($sKeyword),
            'type'=> $sType,
            'data' => $oSearch->search($sType,$sKeyword,$iPage)
        ); 
        $sHTML = phpfox::getLib('template')->assign(array(
                'aFilterCFSearch' => $aFilterCFSearch)
                )
                ->getTemplate('cfsearch.block.supports.'.$sType,true);
        $sHTML = str_replace(array("\n", "\t"), '', $sHTML);                    
        $sHTML = str_replace('\\', '\\\\', $sHTML);
        $sHTML = str_replace("'", "\\'", $sHTML);            
        $sHTML = str_replace('"', '\"', $sHTML);
        $this->call('$("#cfsearch_filter_section_list_results").append("'.$sHTML.'");');
        
        if(count($aFilterCFSearch['data'])<=0)
        {
            $this->call('$Core.fullcfsearch.hideSearchMore();');                             
        }
        $iPage++;
        $this->call('$Core.fullcfsearch.setPage('.$iPage.');');
        $this->call('$Core.loadInit();');
    }
    public function updateActivity()
    {
        if (Phpfox::getService('cfsearch.modules')->updateActivity($this->get('id'), $this->get('active')))
        {

        }
    }    
    public function search()
    {
        $sKeyword = $this->get('key');
        $sType = $this->get('type');
        $aResults = array();
        $aResults['type'] = $sType;
        if(empty($sKeyword))
        {
            $aResults['data'] = array();
            $aResults['status'] = 0;
            $aResults['message'] = Phpfox::getPhrase('cfsearch.no_search_results_found');
        }
        else
        {
            $aData = phpfox::getService('cfsearch')->search($sType,$sKeyword);
            if(count($aData) <=0)
            {
                $aResults['data'] = array();
                $aResults['status'] = 0;
                $aResults['message'] = Phpfox::getPhrase('cfsearch.no_search_results_found');    
            }
            else
            {
                $aResults['data'] = $aData;
                $aResults['status'] = 1;
                //$aResults['message'] = Phpfox::getPhrase('cfsearch.no_search_results_found');
            }
            
            
        }
        echo json_encode($aResults);
    }
    public function moduleOrdering()
    {
        $aVals = $this->get('val');
        Phpfox::getService('core.process')->updateOrdering(array(
                'table' => 'cfsearch_modules',
                'key' => 'id',
                'values' => $aVals['ordering']
            )
        );        
        
    }    
    
    
}

?>