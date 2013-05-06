<?php
/**
 *
 *
 * @copyright        [YouNet_COPYRIGHT]
 * @author           YouNet Company
 * @package          Module_GettingStarted
 * @version          2.01
 */

defined('PHPFOX') or exit('NO DICE!');

?>

<div>
	<div style="padding-bottom:5px;color: #195B85;font-size: 16px; font-weight: bold; border-bottom:1px solid #D8D9DB; ">{phrase var='gettingstarted.knowledge_base_article'}</div>
    {if count($aArticle)>0}
    <div class="kb_listing_holder">
        <ul>
			{foreach from=$aArticle item=article}
 				<div class="row" id="js_article_row_227">
					<a class="link" href="{url link='gettingstarted.article'}article_{$article.article_id}">{$article.title}</a>
					<div class="extra_info">
						Posted {$article.time_stamp|convert_time:'gettingstarted.display_time_stamp'} in <a href="{url link='gettingstarted.category'}category_{$article.article_category_id}">{$article.article_category_name}</a>
					</div>
					<div class="t_right">
						<ul class="item_menu">
						</ul>
					</div>
        		</div>
			{/foreach}
        </ul>
    </div>
	{pager}
    {else}
    	{if $bIsSearch}
    		<div class="row1">
        		<div class="error_message">{phrase var='gettingstarted.no_search_results_found'}</div>
    		</div>
    	{else}
    		<div class="extra_info">{phrase var='gettingstarted.no_articles_have_been_added_yet'}</div>
    	{/if}
	{/if}
</div>