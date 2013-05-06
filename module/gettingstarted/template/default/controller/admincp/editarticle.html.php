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
{literal}
<script>
$Behavior.initDocument = function(){
    $('.global_attachment_list li').eq(2).hide();
    $('.global_attachment_list li').eq(3).hide();
}
</script>
{/literal}

{literal}
<script type="text/css">
    .table_right input{
        width:200px;
    }
</script>
{/literal}
{literal}
<style type="text/css">
	.error_message
	{
		margin: 5px 8px 0px 0px;
	}
    .global_attachment
{
	position:relative;
	border-top:0px #dfdfdf solid;
}
#public_message, #core_js_messages
{
	margin-top:30px;
}
.global_attachment_manage
{
	line-height:26px;
	height:26px;
	padding:4px 0px 4px 0px;
	position:absolute;
	right:0px;
	display:none;
}
</style>
{/literal}
{if $boolean_id==0}
<form method="post" enctype="multipart/form-data" action="{url link='admincp.gettingStarted.editarticle'}id_{$scheduled_mail.article_id}" style="margin-top:30px;">
    <input type="hidden" name="val[article_id]" value="{$scheduled_mail.article_id}"/>
    <div class="table_header">
        {phrase var='gettingstarted.edit_knowledge_base_article'}
    </div>

    <div class="table">
        <div class="table_left">
           {phrase var='gettingstarted.title'}
        </div>
        <div class="table_right"  style="margin-top:-10px">
            <input type="text" name="val[title]" size="50" value="{$scheduled_mail.title}" >
        </div>
        <div class="clear"></div>
    </div>

        <div class="table">
        <div class="table_left">
           Category
        </div>
        <div class="table_right">

           <select id="val[article_category_id]" name="val[article_category_id]" >
                    <option value="-1" {if $scheduled_mail.article_category_id == -1}selected{/if}>{phrase var='gettingstarted.uncategorized'}</option>
             {foreach from=$scheduled_category item = cats}
             <option value="{$cats.article_category_id}" {if $scheduled_mail.article_category_id==$cats.article_category_id}selected{/if}>{$cats.article_category_name}</option>
             {/foreach}

           </select>
           <span id="loading"></span>
        </div>
        <div class="clear"></div>
    </div>

    <div class="table">
        <div class="table_left">
           Description
        </div>
        <div class="table_right">

            {editor id='description' rows='15'}
        </div>
        <div class="clear"></div>
    </div>

    <input type="hidden" name="val[iPage]" value="{$iPage}">


    <div class="table_clear">
        <input type="submit" id="submit_editarticle" name="submit_editarticle" value="{phrase var='core.submit'}" class="button" />
    </div>
</form>
 {/if}