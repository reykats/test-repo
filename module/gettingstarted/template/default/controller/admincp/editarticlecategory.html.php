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
<script type="text/css">
    .table_right input{
        width:200px;
    }
</script>
{/literal}
{literal}
<style type="text/css">
#public_message, #core_js_messages
{
	margin-top:30px;
}
</style>
{/literal}
{if $boolean_id==0}
<form method="post" enctype="multipart/form-data" action="{url link='admincp.gettingStarted.editarticlecategory'}id_{$scheduled_mail.article_category_id}" style="margin-top:30px;">
    <input type="hidden" name="val[article_category_id]" value="{$scheduled_mail.article_category_id}"/>
<div class="table_header">
    {phrase var='gettingstarted.edit_knowledge_base_category'}
</div>
<div class="table">
    <div class="table_left">
       {phrase var='gettingstarted.title'}
    </div>
    <div class="table_right">
        <textarea type="text" name="val[title]" cols="30" rows="5" >{$scheduled_mail.article_category_name}</textarea>
    </div>
    <div class="clear"></div>
</div>

<div class="table_clear">
    <input type="submit" id="submit_editarticlecategory" name="submit_editarticlecategory" value="{phrase var='core.submit'}" class="button" />
</div>
</form>
 {/if}