<?php 

defined('PHPFOX') or exit('NO DICE!'); 

?>
{if !PHPFOX_IS_AJAX}
<script>
    $Core.fullcfsearch.sUrl ="{url link='cfsearch'}";
</script>
<div class="main_search_bar">
    <form method="post" action="{url link='cfsearch'}" onsubmit="$Core.fullcfsearch.submit(this);return false;">
        <input type="text" name="k" id="cfk" value="{if isset($sQuery)}{$sQuery|clean}{/if}" class="main_search_bar_input" />
        <input type="hidden" name="type" id="cftype" value="{if isset($sView)}{$sView|clean}{else}all{/if}" />
        <input type="submit" value="{phrase var='cfsearch.search'}" class="main_search_bar_button" />
    </form>
</div>
{/if}
<div class="cfsearch_results">
    {if $bAll}
        {foreach from=$aResultsSearch item=aFilterCFSearch key=index}
            {if count($aFilterCFSearch.data)}
                <div class="cfsearch_filter_section {$aFilterCFSearch.type}">
                    <div class="cfsearch_filter_section_title {$aFilterCFSearch.type}"><a href="{$aFilterCFSearch.url}">{$index}</a></div>
                    <div class="cfsearch_filter_section_list_results {$aFilterCFSearch.type}">
                        {if $aFilterCFSearch.type == 'user'}
                            {template file='cfsearch.block.supports.user'}
                        {/if}
                        {if $aFilterCFSearch.type == 'pages'}
                            {template file='cfsearch.block.supports.pages'}
                        {/if}
                        {if $aFilterCFSearch.type == 'blog'}
                            {template file='cfsearch.block.supports.blog'}
                        {/if}
                        {if $aFilterCFSearch.type == 'video'}
                            {template file='cfsearch.block.supports.video'}
                        {/if}
                        {if $aFilterCFSearch.type == 'photo'}
                            {template file='cfsearch.block.supports.photo'}
                        {/if}
                        {if $aFilterCFSearch.type == 'marketplace'}
                            {template file='cfsearch.block.supports.marketplace'}
                        {/if}
                         {if $aFilterCFSearch.type == 'poll'}
                            {template file='cfsearch.block.supports.poll'}
                        {/if}
                        {if $aFilterCFSearch.type == 'forum'}
                            {template file='cfsearch.block.supports.poll'}
                        {/if}
                        {if $aFilterCFSearch.type == 'event'}
                            {template file='cfsearch.block.supports.event'}
                        {/if}
                        {if $aFilterCFSearch.type == 'music'}
                            {template file='cfsearch.block.supports.music'}
                        {/if}
                    </div>
                    
                </div>
            {/if}
        {/foreach}
    {else}
         {if count($aFilterCFSearch.data)}
                <div class="cfsearch_filter_section {$aFilterCFSearch.type}">
                    <div class="cfsearch_filter_section_list_results {$aFilterCFSearch.type}" id="cfsearch_filter_section_list_results">
                        {if $aFilterCFSearch.type == 'user'}
                            {template file='cfsearch.block.supports.user'}
                        {/if}
                        {if $aFilterCFSearch.type == 'pages'}
                            {template file='cfsearch.block.supports.pages'}
                        {/if}
                        {if $aFilterCFSearch.type == 'blog'}
                            {template file='cfsearch.block.supports.blog'}
                        {/if}
                        {if $aFilterCFSearch.type == 'video'}
                            {template file='cfsearch.block.supports.video'}
                        {/if}
                        {if $aFilterCFSearch.type == 'photo'}
                            {template file='cfsearch.block.supports.photo'}
                        {/if}
                        {if $aFilterCFSearch.type == 'marketplace'}
                            {template file='cfsearch.block.supports.marketplace'}
                        {/if}
                         {if $aFilterCFSearch.type == 'poll'}
                            {template file='cfsearch.block.supports.poll'}
                        {/if}
                        {if $aFilterCFSearch.type == 'forum'}
                            {template file='cfsearch.block.supports.poll'}
                        {/if}
                        {if $aFilterCFSearch.type == 'event'}
                            {template file='cfsearch.block.supports.event'}
                        {/if}
                        {if $aFilterCFSearch.type == 'music'}
                            {template file='cfsearch.block.supports.music'}
                        {/if}
                    </div>
                    
                </div>
                <div class="js_pager_view_more_link" id="js_pager_view_more_link_cfsearch">
                    <div class="pager_view_more_holder">
                        <div class="pager_view_more_link">
                            <input type="hidden" value="2" name="pageh" id="cfsearch_page_view"/>
                            <input type="hidden" value="{$aFilterCFSearch.type}" name="pageh2" id="cfsearch_page_type"/>
                            <a onclick="$Core.fullcfsearch.searchMore();return false;" class="pager_view_more no_ajax_link" href="#">
                            {phrase var='cfsearch.view_more'}
                            </a>
                        </div>            
                    </div>
                </div>
            {else}     
                {phrase var='cfsearch.no_search_results_found'}
            {/if}
    {/if}
</div>
