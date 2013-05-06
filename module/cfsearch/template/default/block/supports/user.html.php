<?php 
    defined('PHPFOX') or exit('NO DICE!'); 

?>
<div class="p_4"></div>
<ul>
    {foreach from=$aFilterCFSearch.data item=cfdt name=cfdtn key=cfdtnindex }
    <li class="item_profile">
        <div class="img_profile"><a href="{$cfdt.item_url}"><img src="{$cfdt.user_image}" alt="{$cfdt.item_title}"/></a></div>
        <div class="info_profile">
            <div class="p_4">{$cfdt|user}</div>
            <div class="p_4"></div>
            <div class="user_browse_add_friend">
                {if isset($cfdt.mutual_friends) && $cfdt.mutual_friends>0}
                 <a href="#" onclick="$Core.box('friend.getMutualFriends', 300, 'user_id={$cfdt.user_id}'); return false;">{if $cfdt.mutual_friends == 1}
                    {phrase var='cfsearch.1_mutual_friend'}
                {else}
                    {phrase var='cfsearch.total_mutual_friends' total=$cfdt.mutual_friends}
                {/if}</a>&nbsp;&nbsp;&nbsp;
                {/if}
                {img theme='misc/friend_added.png' class='v_middle'} <a href="#" onclick="return $Core.addAsFriend('{$cfdt.user_id}');">{phrase var='user.add_friend'}</a>
            </div>
        </div>
        <div class="clear"></div>
    </li>
    {/foreach}                                                               
</ul>