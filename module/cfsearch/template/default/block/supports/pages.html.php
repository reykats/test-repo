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
            <div class="p_4">
            </div>
            <div class="pages_browse_add cfsearch_more_action">   
                {phrase var='cfsearch.owner'} {$cfdt|user}&nbsp;&nbsp;&nbsp;{if isset($cfdt.total_liked_member) && $cfdt.total_liked_member>0}{img theme='layout/like.png' class='v_middle'} {$cfdt.total_liked_member|number_format} <a href="#" onclick="return $Core.box('like.browse', 400, 'type_id=pages&amp;item_id={$cfdt.page_id}&amp;force_like=1');">{if $cfdt.total_liked_member == 1}{phrase var='pages.person_likes_this'}{else}{phrase var='pages.people_like_this'}{/if}</a>{else}{phrase var='pages.no_members_yet'}{/if}
            </div>
        </div>
        <div class="clear"></div>
    </li>
    {/foreach}                                                               
</ul>