<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 8, 2013, 8:13 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Admincp
 * @version 		$Id: add.html.php 4622 2012-09-12 07:18:24Z Miguel_Espinoza $
 */
 
 

?>
<?php echo '
<script type="text/javascript">
<!--
	function changeBlockType(oObj)
	{
		$(\'.js_block_type\').hide();
		$(\'.js_block_type_id_\' + oObj.value).show();		
	}
-->
</script>
'; ?>

<?php echo $this->_aVars['sCreateJs']; ?>
<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl("admincp.block.add"); ?>" id="js_form" onsubmit="<?php echo $this->_aVars['sGetJsForm']; ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
<?php if ($this->_aVars['bIsEdit']): ?>
	<div><input type="hidden" name="block_id" value="<?php echo $this->_aVars['aForms']['block_id']; ?>" /></div>
<?php endif; ?>
<?php if (! Phpfox ::getUserParam('admincp.can_view_product_options')): ?>
	<div><input type="hidden" name="val[product_id]" value="1" /></div>
<?php endif; ?>

	<div class="table_header">
<?php echo Phpfox::getPhrase('admincp.block_details'); ?>
	</div>
<?php if (Phpfox ::getUserParam('admincp.can_view_product_options')): ?>
<?php Phpfox::getBlock('admincp.product.form', array()); ?>
<?php endif; ?>
<?php Phpfox::getBlock('admincp.module.form', array('module_form_required' => false)); ?>
	
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.title'); ?>:
		</div>
		<div class="table_right">
			<input type="text" name="val[title]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['title']) : (isset($this->_aVars['aForms']['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['title']) : '')); ?>
" size="30" />
		</div>
	</div>	
	<div class="table"<?php if ($this->_aVars['bIsEdit']): ?> style="display:none;"<?php endif; ?>>
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.type'); ?>:
		</div>
		<div class="table_right">
			<select name="val[type_id]" onchange="return changeBlockType(this);">
				<option value="0"><?php echo Phpfox::getPhrase('admincp.select'); ?>:</option>
				<option value="0"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('type_id') && in_array('type_id', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['type_id'])
								&& $aParams['type_id'] == '0')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['type_id'])
									&& !isset($aParams['type_id'])
									&& $this->_aVars['aForms']['type_id'] == '0')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase('admincp.php_block_file'); ?></option>
				<option value="1"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('type_id') && in_array('type_id', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['type_id'])
								&& $aParams['type_id'] == '1')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['type_id'])
									&& !isset($aParams['type_id'])
									&& $this->_aVars['aForms']['type_id'] == '1')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase('admincp.php_code'); ?></option>
				<option value="2"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('type_id') && in_array('type_id', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['type_id'])
								&& $aParams['type_id'] == '2')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['type_id'])
									&& !isset($aParams['type_id'])
									&& $this->_aVars['aForms']['type_id'] == '2')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase('admincp.html_code'); ?></option>
			</select>
		</div>
	</div>	
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.controller'); ?>:
		</div>
		<div class="table_right">
			<select name="val[m_connection]" id="m_connection">
<?php if (! $this->_aVars['bIsEdit']): ?>
			<option value=""><?php echo Phpfox::getPhrase('admincp.select'); ?>:</option>
<?php endif; ?>
			<option value=""><?php echo Phpfox::getPhrase('admincp.none_site_wide'); ?></option>
<?php if (count((array)$this->_aVars['aControllers'])):  foreach ((array) $this->_aVars['aControllers'] as $this->_aVars['sName'] => $this->_aVars['aController']): ?>
				<option value="<?php echo $this->_aVars['sName']; ?>" style="font-weight:bold;"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('m_connection') && in_array('m_connection', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['m_connection'])
								&& $aParams['m_connection'] == $this->_aVars['sName'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['m_connection'])
									&& !isset($aParams['m_connection'])
									&& $this->_aVars['aForms']['m_connection'] == $this->_aVars['sName'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getLib('phpfox.locale')->translate($this->_aVars['sName'], 'module'); ?></option>
<?php if (count((array)$this->_aVars['aController'])):  foreach ((array) $this->_aVars['aController'] as $this->_aVars['aCont']): ?>
					<option value="<?php echo $this->_aVars['aCont']['m_connection']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('m_connection') && in_array('m_connection', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['m_connection'])
								&& $aParams['m_connection'] == $this->_aVars['aCont']['m_connection'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['m_connection'])
									&& !isset($aParams['m_connection'])
									&& $this->_aVars['aForms']['m_connection'] == $this->_aVars['aCont']['m_connection'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
>-- <?php echo $this->_aVars['aCont']['m_connection']; ?></option>
<?php endforeach; endif; ?>
<?php endforeach; endif; ?>
			</select>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.block_add_connection')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table js_block_type js_block_type_id_0"<?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['type_id'] > 0): ?> style="display:none;"<?php endif; ?>>
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.component'); ?>:
		</div>
		<div class="table_right">
			<select name="val[component]" id="component">
			<option value=""><?php echo Phpfox::getPhrase('admincp.select'); ?>:</option>
<?php if (count((array)$this->_aVars['aComponents'])):  foreach ((array) $this->_aVars['aComponents'] as $this->_aVars['sName'] => $this->_aVars['aComponent']): ?>
				<option value="<?php echo $this->_aVars['sName']; ?>" style="font-weight:bold;"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('m_connection') && in_array('m_connection', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['m_connection'])
								&& $aParams['m_connection'] == $this->_aVars['sName'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['m_connection'])
									&& !isset($aParams['m_connection'])
									&& $this->_aVars['aForms']['m_connection'] == $this->_aVars['sName'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getLib('phpfox.locale')->translate($this->_aVars['sName'], 'module'); ?></option>
<?php if (count((array)$this->_aVars['aComponent'])):  foreach ((array) $this->_aVars['aComponent'] as $this->_aVars['aComp']): ?>
					<option value="<?php echo $this->_aVars['sName']; ?>|<?php echo $this->_aVars['aComp']['component']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('component') && in_array('component', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['component'])
								&& $aParams['component'] == $this->_aVars['sName'].'|'.$this->_aVars['aComp']['component'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['component'])
									&& !isset($aParams['component'])
									&& $this->_aVars['aForms']['component'] == $this->_aVars['sName'].'|'.$this->_aVars['aComp']['component'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
>-- <?php echo $this->_aVars['aComp']['component']; ?></option>
<?php endforeach; endif; ?>
<?php endforeach; endif; ?>
			</select>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.block_add_component')); ?>
		</div>
		<div class="clear"></div>
	</div>		
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.placement'); ?>:
		</div>
		<div class="table_right">
			<select name="val[location]" id="location">	
<?php for ($this->_aVars['i'] = 1; $this->_aVars['i'] <= 13; $this->_aVars['i']++): ?>
					<option value="<?php echo $this->_aVars['i']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('location') && in_array('location', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['location'])
								&& $aParams['location'] == $this->_aVars['i'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['location'])
									&& !isset($aParams['location'])
									&& $this->_aVars['aForms']['location'] == $this->_aVars['i'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase('admincp.block', array('x' => $this->_aVars['i'])); ?></option>
<?php endfor; ?>
			</select><?php if (Phpfox ::getUserParam('theme.can_view_theme_sample')): ?> <a href="#?call=theme.sample&amp;width=1300" class="inlinePopup" title="<?php echo Phpfox::getPhrase('admincp.sample_layout'); ?>"><?php echo Phpfox::getPhrase('admincp.view_sample_layout'); ?></a><?php endif; ?>	
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.block_add_placement')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table js_block_type js_block_type_id_0"<?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['type_id'] > 0): ?> style="display:none;"<?php endif; ?>>
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.can_drag_drop'); ?>:
		</div>
		<div class="table_right">
			<label><input type="radio" name="val[can_move]" value="1"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('can_move') && in_array('can_move', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['can_move']) && $aParams['can_move'] == '1'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['can_move']) && !isset($aParams['can_move']) && $this->_aVars['aForms']['can_move'] == '1')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('admincp.yes'); ?></label>
			<label><input type="radio" name="val[can_move]" value="0"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('can_move') && in_array('can_move', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['can_move']) && $aParams['can_move'] == '0'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['can_move']) && !isset($aParams['can_move']) && $this->_aVars['aForms']['can_move'] == '0')
 {
    echo ' checked="checked" ';}
 else
 {
 if (!isset($this->_aVars['aForms']) || ((isset($this->_aVars['aForms']) && !isset($this->_aVars['aForms']['can_move']) && !isset($aParams['can_move']))))
{
 echo ' checked="checked"';
}
 }
}
?> 
/> <?php echo Phpfox::getPhrase('admincp.no'); ?></label>			
		</div>
		<div class="clear"></div>
	</div>	
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.active'); ?>:
		</div>
		<div class="table_right">
			<label><input type="radio" name="val[is_active]" value="1"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('is_active') && in_array('is_active', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['is_active']) && $aParams['is_active'] == '1'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['is_active']) && !isset($aParams['is_active']) && $this->_aVars['aForms']['is_active'] == '1')
 {
    echo ' checked="checked" ';}
 else
 {
 if (!isset($this->_aVars['aForms']) || ((isset($this->_aVars['aForms']) && !isset($this->_aVars['aForms']['is_active']) && !isset($aParams['is_active']))))
{
 echo ' checked="checked"';
}
 }
}
?> 
/> <?php echo Phpfox::getPhrase('admincp.yes'); ?></label>
			<label><input type="radio" name="val[is_active]" value="0"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('is_active') && in_array('is_active', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['is_active']) && $aParams['is_active'] == '0'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['is_active']) && !isset($aParams['is_active']) && $this->_aVars['aForms']['is_active'] == '0')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('admincp.no'); ?></label>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.block_add_active')); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="js_block_type js_block_type_id_1 js_block_type_id_2"<?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['type_id'] == 0): ?> style="display:none;"<?php endif; ?>>
		<div class="table_header">
			PHP/HTML Code (Optional)
		</div>
		<div class="table">
			<div class="table_span">
				<textarea name="val[source_code]" rows="20" cols="50" style="width:98%;" id="source_code"><?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['source_code']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['source_code']) : (isset($this->_aVars['aForms']['source_code']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['source_code']) : '')); ?>
</textarea>
			</div>
		</div>		
	</div>
	
	<div class="table_header">
<?php echo Phpfox::getPhrase('admincp.user_group_access'); ?>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.allow_access'); ?>:
		</div>
		<div class="table_right">
<?php if (count((array)$this->_aVars['aUserGroups'])):  foreach ((array) $this->_aVars['aUserGroups'] as $this->_aVars['aUserGroup']): ?>
			<div class="p_4">
				<label><input type="checkbox" name="val[allow_access][]" value="<?php echo $this->_aVars['aUserGroup']['user_group_id']; ?>"<?php if (isset ( $this->_aVars['aAccess'] ) && is_array ( $this->_aVars['aAccess'] )):  if (! in_array ( $this->_aVars['aUserGroup']['user_group_id'] , $this->_aVars['aAccess'] )): ?> checked="checked" <?php endif;  else: ?> checked="checked" <?php endif; ?>/> <?php echo Phpfox::getLib('phpfox.parse.output')->clean(Phpfox::getLib('locale')->convert($this->_aVars['aUserGroup']['title'])); ?></label>
			</div>
<?php endforeach; endif; ?>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.block_add_access')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table_clear">
		<input type="submit" value="<?php echo Phpfox::getPhrase('core.submit'); ?>" class="button" />
	</div>

</form>

