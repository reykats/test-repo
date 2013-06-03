<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		phpfoxguru.com
 * @author  		Nicolas
 * @package  		Module_Recipe
 * @version 		$Id: add.html.php 2009-09-10 Nicolas $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
{$sCreateJs}
<form method="post" action="{url link='admincp.hotlinks.add'}">
{if $bIsEdit}
	<div><input type="hidden" name="id" value="{$sData.id}" /></div>
{/if}
	<div class="table_header">
		Add Hotlink
	</div>
	<div class="table">
		<div class="table_left">
			Keyword:
		</div>
		<div class="table_right">
			<input type="text" name="val[keyword]" size="30" maxlength="100" value="{if isset($sData.keyword)}{$sData.keyword}{/if}" />
		</div>
		<div class="clear"></div>
	</div>	
	<div class="table">
		<div class="table_left">
			URL:
		</div>
		<div class="table_right">
			<input type="text" name="val[url]" size="30" maxlength="100" value="{if isset($sData.url)}{$sData.url}{/if}" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="table_clear">
		<input type="submit" value="Submit" class="button" />
	</div>
</form>