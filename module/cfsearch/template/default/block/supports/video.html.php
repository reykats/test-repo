<?php 
    defined('PHPFOX') or exit('NO DICE!'); 

?>
<div class="p_4"></div>
<ul>
    {foreach from=$aFilterCFSearch.data item=cfdt name=cfdtn key=cfdtnindex }
    <li class="item_profile">
        <div class="img_profile"><a href="{$cfdt.item_url}"><img src="{$cfdt.user_image}" alt="{$cfdt.item_title}"/></a></div>
        <div class="info_profile">
            <div class="p_4"><a href="{$cfdt.item_url}">{$cfdt.item_title}</a></div>
            <div class="p_4">{$cfdt.text_parsed|shorten:300:'cfsearch.view_more':true}</div>
            <div class="pages_browse_add cfsearch_more_action">   
                {phrase var='cfsearch.owner'} {$cfdt|user}&nbsp;-&nbsp;{$cfdt.time_stamp|convert_time} 
            </div>
        </div>
        <div class="clear"></div>
    </li>
    {/foreach}                                                               
</ul>