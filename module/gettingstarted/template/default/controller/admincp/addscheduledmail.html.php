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
<form method="post" enctype="multipart/form-data" action="{url link='admincp.gettingStarted.addscheduledmail'}" style="margin-top:30px;">
<div class="table_header">
    {phrase var='gettingStarted.add_a_new_schedule_mail'}
</div>

<div class="table">
    <div class="table_left">
       {required}{phrase var='gettingStarted.time'}
    </div>
    <div class="table_right">
        <input type="text" name="val[time]" value="{$aScheduledMail.time}" class="input" />
        (m: month, w: week, d: day, h: hour, default: hour) 
    </div>
    <div class="clear"></div>
</div>
<div class="table">
    <div class="table_left">
       {phrase var='gettingStarted.scheduled_category'}
    </div>
    <div class="table_right">
       <select id="val[scheduledmail_id]" name="val[scheduledmail_id]" onchange="loadCategory(this.value)">
         {foreach from=$scheduled_category item=cats}
         	<option value="{$cats.scheduledmail_id}" {if $aScheduledMail.scheduledmail_id==$cats.scheduledmail_id}selected{/if}>{$cats.scheduledmail_name}</option>
         {/foreach}

       </select>
       <span id="loading"></span>
    </div>
    <div class="clear"></div>
</div>
<div class="table">
    <div class="table_left">
       {phrase var='gettingstarted.description'}
    </div>
    <div class="table_right">
        <div style="padding-bottom: 10px;" id="div_settings_category">
           {$aScheduledMail.description}
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="table">
    <div class="table_left">
        {required}{phrase var='gettingStarted.subtitle'}
    </div>
    <div class="table_right">
        <input type="text" name="val[name]" value="{$aScheduledMail.name}" class="input" />
        ([full_name]: full name, [user_name] : username)
    </div>
    <div class="clear"></div>
</div>
<div class="table">
	<div class="table_left">
		{required}{phrase var='gettingstarted.allow_users_to_unsubscribe_this_email'}
	</div>
	<div class="table_right">
		 <input type="checkbox" name="val[unsubscribe]" {if $aScheduledMail.active==1}checked="true" value="1" {/if}  />
	</div>
</div>
<div class="table">
    <div class="table_left">
       {phrase var='gettingStarted.message'}
    </div>
    <div class="table_right">

        {editor id='message'}
    </div>
    <div class="clear"></div>
</div>
    <div class="table">
    <div class="table_left">
       {phrase var='gettingStarted.active'}
    </div>
    <div class="table_right">
        <input type="checkbox" name="val[active]" {if $aScheduledMail.active==1}checked="true" value="1" {/if}  />
    </div>
    <div class="clear"></div>
</div>
    
<div class="table_clear">
    <input type="submit" id="submit_addscheduledmail"name="submit_addscheduledmail" value="{phrase var='core.submit'}" class="button" />
</div>
</form>


<script type="text/javascript">
    {literal}
        function loadCategory(value)
        {
           $('#loading').html('Loading data ...');
           $('#div_settings_category').html('');
           $('#div_settings_category').ajaxCall('gettingstarted.loadCategory','category='+value);
        }
        {/literal}
 </script>