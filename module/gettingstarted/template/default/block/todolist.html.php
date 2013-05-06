<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
{literal}
	<style type="text/css">
		#donot_show_me
		{
			margin-left:15px;
			padding-top:15px;
		}
		#todolist
		{
			max-height:400px;
			min-height:150px;
			overflow:auto;
			max-width:600px;
		}
		.donot_show_me_message
		{
			float: left;
    		margin-top:-17px;
    		
		}
		.check_box_show_message
		{
			float: left;
    		margin-left: 4px;
    		margin-top: -15px;
    		padding-bottom: 1px;
    		padding-right:4px;
		}
	</style>
	<!--[if ie]>
	<style type="text/css">
		.donot_show_me_message
		{
			float: left;
    		margin-top: -16px;
		}
	</style>	
	<![endif]-->
{/literal}
<div id="todolist">
	<input type="hidden" id="todolist_id" value="{$FirstTodoList.todolist_id}"/>
	<div class="title_todolist" id="title_todolist">
    	{$FirstTodoList.title}
	</div>
	<div style="clear:both"></div>
	<div style="padding-bottom: 7px;" id="description_todolist">
    	{$FirstTodoList.description_parsed}
    	<div style="clear:both"></div>
	</div>
	<div style="padding-top:7px; height:37px;" class="border_todolist">
    	
    	<div style="float: right" id ="command_button_gts">   		
    			<span id="pretodolist" style="padding-left:2px;">
    			{if $showbuttonPre == 1}
    				<a href="javascript:void(0);" onclick="javascript:viewPreTodoList();return false;" ><input type="button" class="button" value="{phrase var='gettingstarted.previous'}"/></a>
    			{/if}
    			</span>
    			<span id="nexttodolist" style="padding-left:2px;">
            		{if $showbuttonNext == 1}
            			<a href="javascript:void(0);" onclick="javascript:viewNextTodoList(); return false;" ><input type="button" class="button" value="{phrase var='gettingstarted.next'}"/></a>
            		{/if}
            	</span>
    			<span id="donetodolist" style="padding-left:2px;">
    				{if $showbuttonDone == 1}
    					<a href="javascript:void(0);" onclick="javascript:doneTodoList(); return false;"><input type="button" class="button" value="{phrase var='gettingstarted.done'}" onclick="tb_remove();"/></a>
    				{/if}
    			</span>
        		
        		
    	</div>
	</div>
</div>
<div id="donot_show_me">
	<span class="check_box_show_message"><input id="checkbox_todolist" type="checkbox" value="" name="autohidden" onclick="validate_checkbox_todolist()"/></span>
	<span class="donot_show_me_message">{phrase var='gettingstarted.do_not_show_it_again'}.</span></div>
{literal}
<script type="text/javascript">

	var append_do_not_show_me = document.getElementById('donot_show_me');
	$('.js_box_close').append(append_do_not_show_me);

    function validate_checkbox_todolist()
    {
        var checkbox=document.getElementById('checkbox_todolist');
        var checkbox_check = 1;
        if(checkbox.checked==true)
        {
            checkbox_check=0;
        }
        $.ajaxCall('gettingstarted.updateCheckboxTodolist','active='+checkbox_check);
    }
</script>
{/literal}