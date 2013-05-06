<?php 

defined('PHPFOX') or exit('NO DICE!'); 

?>
<div class="table_header">
   {phrase var='cfsearch.manage_supported_modules'}
</div>

<table id="js_drag_drop" cellpadding="0" cellspacing="0">
    <tr>
        <th></th>
        <th style="width:20px;"></th>
        <th>{phrase var='cfsearch.name'}</th>
        <th>{phrase var='cfsearch.phrase_var_name'}</th>
        <th class="t_center" style="width:60px;">{phrase var='pages.active'}</th>    
    </tr>
    {foreach from=$aModules key=iKey item=aModule}
    <tr class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
        <td class="drag_handle"><input type="hidden" name="val[ordering][{$aModule.id}]" value="{$aModule.ordering}" /></td>
        <td class="t_center">
            <a href="#" class="js_drop_down_link" title="Manage">{img theme='misc/bullet_arrow_down.png' alt=''}</a>
            <div class="link_menu">
                <ul>
                    <li><a href="{url link='admincp.cfsearch.add' id=$aModule.id}">{phrase var='core.edit'}</a></li>        
                    <li><a href="{url link='admincp.cfsearch' delete=$aModule.id} onclick="return confirm('{phrase var='core.are_you_sure'}');">{phrase var='core.delete'}</a></li>        
                </ul>
            </div>        
        </td>    
        <td>{$aModule.module|convert}</td>
        <td>{$aModule.phrase_var_name}</td>
        <td class="t_center">
            <div class="js_item_is_active"{if !$aModule.is_active} style="display:none;"{/if}>
                <a href="#?call=cfsearch.updateActivity&amp;id={$aModule.id}&amp;active=0" class="js_item_active_link" title="{phrase var='cfsearch.deactivate'}">{img theme='misc/bullet_green.png' alt=''}</a>
            </div>
            <div class="js_item_is_not_active"{if $aModule.is_active} style="display:none;"{/if}>
                <a href="#?call=cfsearch.updateActivity&amp;id={$aModule.id}&amp;active=1" class="js_item_active_link" title="{phrase var='cfsearch.activate'}">{img theme='misc/bullet_red.png' alt=''}</a>
            </div>        
        </td>        
    </tr>
    {/foreach}
</table>
