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
<form method="post" enctype="multipart/form-data" action="{url link='admincp.gettingStarted.addarticlecategory'}" style="margin-top:30px;">
<div class="table_header">
    {phrase var='gettingstarted.add_knowledge_base_category'}
</div>
    <div class="table">
    <div class="table_left">
        Title :
    </div>
    <div class="table_right">
        <input type="text" name="val[title]" cols="30" rows="5" >{$ArticleCategory.title}</input>
    </div>
    <div class="clear"></div>
</div>

<div class="table_clear">
    <input type="submit" id="submit_addarticlecategory"name="submit_addarticlecategory" value="{phrase var='core.submit'}" class="button" />
</div>
</form>
