$Core.fullcfsearch = {
    sUrl:'',
    submit:function(f)
    {
        $sQuery = $('#cfk').val();
        $sType = $('#cftype').val();
        $sFormUrl = this.sUrl + $sType + '/k_'+encodeURIComponent($sQuery);
        window.location.href = $sFormUrl;
    },
    searchMore:function()
    {
        $iPage = $('#cfsearch_page_view').val();
        $sType = $('#cfsearch_page_type').val();
        $sQuery = $('#cfk').val(); 
        $.ajaxCall('cfsearch.searchmore', 'page='+$iPage+'&type='+encodeURIComponent($sType)+'&k='+encodeURIComponent($sQuery), 'GET');
    },
    hideSearchMore:function()
    {
       $('#js_pager_view_more_link_cfsearch').hide();
    },
    setPage:function($iPage)
    {
        $('#cfsearch_page_view').val($iPage);
    }
};