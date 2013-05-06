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
<form method="post" enctype="multipart/form-data" action="{url link='admincp.gettingStarted.editscheduledmail'}id_{$scheduled_mail.scheduledmail_id}">
    <input type="hidden" name="val[scheduledmail_id]" value="{$scheduled_mail.scheduledmail_id}"/>
<div class="table_header">
    {phrase var='gettingstarted.edit_schedule_mail'}
</div>

<div class="table">
    <div class="table_left">
       {required}{phrase var='gettingStarted.time'}
    </div>
    <div class="table_right">
        <input type="text" name="val[time]" value="{$scheduled_mail.time}" class="input" />
        (m: month, w: week d: day, h: hour, default: hour)
    </div>
    <div class="clear"></div>
</div>
<div class="table">
    <div class="table_left">
       {phrase var='gettingstarted.scheduled_category'}
    </div>
    <div class="table_right">

       <select id="val[scheduledmail_category_id]" name="val[scheduledmail_category_id]">

         {foreach from=$scheduled_category item=cats}
         <option value="{$cats.scheduledmail_id}" {if $scheduled_mail.scheduledmail_category_id==$cats.scheduledmail_id}selected{/if}>{$cats.scheduledmail_name}</option>
         {/foreach}

       </select>

    </div>
    <div class="clear"></div>
</div>

<div class="table">
    <div class="table_left">
        {phrase var='gettingstarted.subtitle'}:
    </div>
    <div class="table_right">
        <input type="text" name="val[name]" value="{$scheduled_mail.name}" class="input" />
        ([full_name]: full name, [user_name] : username)
    </div>
    <div class="clear"></div>
</div>
<div class="table">
	<div class="table_left">
		{required}{phrase var='gettingstarted.allow_users_to_unsubscribe_this_email'}
	</div>
	<div class="table_right">
		 <input type="checkbox" name="val[unsubscribe_email]" value="1" {if $scheduled_mail.unsubscribe_email == 1}checked{/if}  />
	</div>
</div> 
<div class="table">
    <div class="table_left">
       {required}{phrase var='gettingStarted.message'}
    </div>
    <div class="table_right">
        {editor id='message'}
    </div>
    <div class="clear"></div>
</div>


<!--    <div class="table">
    <div class="table_left">
       {phrase var='gettingStarted.active'}
    </div>
    <div class="table_right">
        <input type="checkbox" name="val[active]" {if $scheduled_mail.active==1}checked="true"{/if} />
    </div>
    <div class="clear"></div>
</div>-->

<div class="table_clear">
    <input type="submit" id="submit_editscheduledmail" name="submit_editscheduledmail" value="{phrase var='core.submit'}" class="button" />
</div>
</form>
 {/if}