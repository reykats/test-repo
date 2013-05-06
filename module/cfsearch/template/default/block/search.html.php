<?php 
    defined('PHPFOX') or exit('NO DICE!'); 

?>
<style>
    .cfsearch_bg
    {l}
      background:url('{$sCoreUrl}module/cfsearch/static/image/loading.gif') no-repeat center center ;
    {r}
</style>
<script>
    var $oFilterCFOptions = {$oFilterCFOptionsJ};
    var $sFormUrl = "{url link='cfsearch'}";
</script>
<script>$Core.loadStaticFile('{$sCoreUrl}module/cfsearch/static/css/default/default/cfsearch.css');</script>    
<script>$Core.loadStaticFile('{$sCoreUrl}module/cfsearch/static/jscript/cfsearch.js');</script>    
<div id="cfsearch_filter_section_init" style="display:none;">
 <div id="cfsearch_filter_section" style="display:none;"> 
    <input type="hidden" value="user" name="cfsearch_input_filter" id="cfsearch_input_filter"/>
     {if count($aFilterCFOptions)}
         {foreach from=$aFilterCFOptions item=aFilterCFOption}
            <div class="cfsearch_filter_item" rel="{$aFilterCFOption.module}">
                <div class="cfsearch_filter_item_img" style="background:url('{$sCoreUrl}module/cfsearch/static/image/{$aFilterCFOption.module}.png') no-repeat center center"></div>
                <div class="cfsearch_filter_item_phrase">{phrase var=$aFilterCFOption.phrase_var_name}</div>
                <div class="clear"></div> 
            </div>
         {/foreach}
     {/if}
 </div>    
</div>
<div id="cfsearch_results_init" style="display:none;">
 <div id="cfsearch_results" style="display:none;"> 
     {if count($aFilterCFOptions)}
         <div class="cfsearch_vertical_filter">
         {foreach from=$aFilterCFOptions item=aFilterCFOption}
            <div class="cfsearch_filter_item_result" rel="{$aFilterCFOption.module}">
                <div class="cfsearch_filter_item_img_result" style="background:url('{$sCoreUrl}module/cfsearch/static/image/{$aFilterCFOption.module}.png') no-repeat center center"></div>
            </div>
         {/foreach}
         </div>
         <div class="cfsearch_vertical_result_search" id="cfsearch_vertical_result_search">
               {foreach from=$aFilterCFOptions item=aFilterCFOption}
                <div id ="cfsearch_filter_item_content_{$aFilterCFOption.module}" class="cfsearch_filter_item_content cfsearch_bg" rel="{$aFilterCFOption.module}" style="display:none;">
                     <div class="cfsearch_title_search">{phrase var='cfsearch.search_results'} {phrase var=$aFilterCFOption.phrase_var_name}</div>
                     <div id ="cfsearch_filter_item_content_list_{$aFilterCFOption.module}"></div>
                </div>
             {/foreach}
         </div>
         <div class="clear"></div>
         <div class="cfsearch_view_more_from_search">
            
         </div>
     {/if}
 </div>    
</div>
