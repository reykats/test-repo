<?php 
    defined('PHPFOX') or exit('NO DICE!'); 

?>
{if count($aSearchFilterMenu)}
<div  class="sub_section_menu">
<ul>
    {foreach from=$aSearchFilterMenu item=aSearchFilter key=index}
        <li class="{if $aSearchFilter.type == $sView}active{/if}"> 
            <a href="{$aSearchFilter.url}">{$index}</a>
        </li>
    {/foreach}
</ul>
</div>
{/if}
	