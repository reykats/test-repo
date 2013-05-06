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
<form method="post" enctype="multipart/form-data" action="{url link='admincp.gettingStarted.edittodolist'}id_{$scheduled_mail.todolist_id}">
    <input type="hidden" name="val[todolist_id]" value="{$scheduled_mail.todolist_id}"/>
<div class="table_header">
    {phrase var='gettingstarted.edit_todo_list'}
</div>

<div class="table">
    <div class="table_left">
       {phrase var='gettingstarted.title'}
    </div>
    <div class="table_right"  style="margin-top:-10px">
        <textarea type="text" name="val[title]" cols="30" rows="1" >{$scheduled_mail.title}</textarea>
    </div>
    <div class="clear"></div>
</div>

<div class="table">
    <div class="table_left">
       {phrase var='gettingstarted.description'}
    </div>
    <div class="table_right">
        {editor id='description'}
    </div>
    <div class="clear"></div>
</div>



<div class="table_clear">
    <input type="submit" id="submit_editarticle" name="submit_edittodolist" value="{phrase var='core.submit'}" class="button" />
</div>
</form>
 {/if}