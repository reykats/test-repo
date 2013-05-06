<?php 
    defined('PHPFOX') or exit('NO DICE!'); 

?>
<div class="p_4"></div>
<ul>
    {foreach from=$aFilterCFSearch.data item=cfdt name=cfdtn key=cfdtnindex }
    <li class="item_profile">
        <div class="img_profile"><a href="{$cfdt.item_link}">{img user=$cfdt suffix = '_50_square' max_width=50 max_height=50}</a></div>
        <div class="info_profile">
            <div class="p_4"><a href="{$cfdt.item_link}" title="{$cfdt.item_title}">{$cfdt.item_title|shorten:210:'...'}</a></div>
            <div class="p_4">
            </div>
            <div class="pages_browse_add cfsearch_more_action">   
                {phrase var='cfsearch.owner'} {$cfdt|user}&nbsp;-&nbsp;{$cfdt.item_time_stamp|convert_time} 
            </div>
        </div>
        <div class="clear"></div>
    </li>
    {/foreach}                                                               
</ul>