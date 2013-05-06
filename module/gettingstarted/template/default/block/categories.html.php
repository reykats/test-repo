<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="sub_section_menu">
    <ul>
    {foreach from=$articlecategories_block item=articlecategory_block}
    <li {if $articlecategory_block.article_category_id == $iCategoryView}class="active"{/if}>
        <a href="{$articlecategory_block.url}" class="ajax_link">{$articlecategory_block.article_category_name|convert|clean}</a>
    </li>
    {/foreach}
    </ul>
</div>
