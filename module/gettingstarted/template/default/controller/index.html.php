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
{if $flag == 0}
<script type="text/javascript">
  /*  $('div.header_bar_menu').css("display","none");*/
</script>
{/if}

{if $bIsSearch == true}
    {if $aArticle == null}
        <div class="extra_info">
            {phrase var='gettingstarted.no_articles_found'}
        </div>
    {/if}
{/if}

{if $bIsSearch == true}
	
    	{if count($aCategoryArticles)>0}
    		<div class="kb_listing_holder">
        		<ul>
					{foreach from=$aCategoryArticles item=aArticleCat}
						{if !$bIsCategory}
						<div  style="padding-top: 4px; padding-bottom:5px;color: #195B85;font-size: 16px; font-weight: bold; border-bottom:1px solid #D8D9DB;">
                    		<a href="{url link='gettingstarted.categories'}{$article.article_category_id}/{$aArticleCat.article_category_name}">{$aArticleCat.article_category_name}</a>
            			</div>
            			{/if}
						{foreach from=$aArticleCat.article item=article}
							<div class="row" id="js_article_row_227">
								<a class="item_content item_view_content" href="{url link='gettingstarted.article'}article_{$article.article_id}">{$article.title}</a>
								<div class="extra_info">{$article.info}</div> 
								<div class="t_right">
									<ul class="item_menu">
									</ul>
								</div>
        					</div>
        				{/foreach}
					{/foreach}
        		</ul>
    		</div>
    	{/if}
  		{if $flag == 1}
        	{pager}
    	{/if}
	{else}
		{if count($articlecategories)>0}
			{foreach from=$articlecategories item=articlecategory}
    			<div  style="padding-top: 4px; padding-bottom:5px;color: #195B85;font-size: 16px; font-weight: bold; border-bottom:1px solid #D8D9DB;">
                    <a href="{url link='gettingstarted.categories'}{$articlecategory.article_category_id}/{$articlecategory.article_category_name}">{$articlecategory.article_category_name}</a>
            	</div>
    			<div class="kb_listing_holder">
        			<ul>
        				{if count($articlecategory.article)>0}
        					{foreach from=$articlecategory.article item=article}
								<div class="row">
									<a class="item_content item_view_content" href="{url link='gettingstarted.article'}article_{$article.article_id}">{$article.title}</a>
									<div class="extra_info">{$article.info}</div> 	
        						</div>
        					{/foreach}
        				{else}
        					<div class="extra_info">
								{phrase var='gettingstarted.no_articles_have_been_added_yet'}
							</div>
        				{/if}
        				{if $articlecategory.pagination==1}
        					<div class="t_right">
              					<a href="{url link='gettingstarted.categories'}{$articlecategory.article_category_id}/{$articlecategory.article_category_name}">View More: {$articlecategory.article_category_name}</a>
							</div>
        				{/if}
        			</ul>
    			</div>
			{/foreach}
			{if $flag == 1}
            	{pager}
            {/if}
		{else}
				<div class="extra_info">
					{phrase var='gettingstarted.no_articles_have_been_added_yet'}
				</div>
		{/if}
	{/if}

{literal}
<style type="text/css">
.header_filter_holder
{
    display:none;
}
</style>
{/literal}
