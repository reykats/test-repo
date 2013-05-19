<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 8, 2013, 8:12 am */ ?>
<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Admincp
 * @version 		$Id: add.html.php 1344 2009-12-21 19:50:14Z Raymond_Benc $
 */



?>
<?php echo $this->_aVars['sCreateJs']; ?>

<?php echo '
<script type="text/javascript">
<!--
function doHideConnection(sValue)
{
	if(sValue == "2")
	{
		$(\'#url_connection\').hide();

	}
	else
	{
		$(\'#url_connection\').show();
	}
}
-->
</script>
'; ?>

<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl("admincp.component.add"); ?>" id="js_form" onsubmit="<?php echo $this->_aVars['sGetJsForm']; ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
<?php if ($this->_aVars['bIsEdit']): ?>
	<div><input type="hidden" name="id" value="<?php echo $this->_aVars['aForms']['component_id']; ?>" /></div>
<?php endif; ?>
	<div class="table_header">
<?php echo Phpfox::getPhrase('admincp.component_details'); ?>
	</div>
<?php if (Phpfox ::getUserParam('admincp.can_view_product_options')): ?>
	<div class="table">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('admincp.product'); ?>:
		</div>
		<div class="table_right">
			<select name="val[product_id]" id="product_id">
<?php if (count((array)$this->_aVars['aProducts'])):  foreach ((array) $this->_aVars['aProducts'] as $this->_aVars['aProduct']): ?>
				<option value="<?php echo $this->_aVars['aProduct']['product_id']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('product_id') && in_array('product_id', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['product_id'])
								&& $aParams['product_id'] == $this->_aVars['aProduct']['product_id'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['product_id'])
									&& !isset($aParams['product_id'])
									&& $this->_aVars['aForms']['product_id'] == $this->_aVars['aProduct']['product_id'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo $this->_aVars['aProduct']['title']; ?></option>
<?php endforeach; endif; ?>
			</select>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.component_add_product')); ?>
		</div>
		<div class="clear"></div>
	</div>
<?php endif; ?>
	<div class="table">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('admincp.module'); ?>:
		</div>
		<div class="table_right">
			<select name="val[module_id]" id="module_id">
<?php if (count((array)$this->_aVars['aModules'])):  foreach ((array) $this->_aVars['aModules'] as $this->_aVars['sModule'] => $this->_aVars['iModuleId']): ?>
				<option value="<?php echo $this->_aVars['iModuleId']; ?>|<?php echo $this->_aVars['sModule']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('module_id') && in_array('module_id', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['module_id'])
								&& $aParams['module_id'] == $this->_aVars['iModuleId'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['module_id'])
									&& !isset($aParams['module_id'])
									&& $this->_aVars['aForms']['module_id'] == $this->_aVars['iModuleId'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getLib('phpfox.locale')->translate($this->_aVars['sModule'], 'module'); ?></option>
<?php endforeach; endif; ?>
			</select>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.component_add_module')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('admincp.component'); ?>:
		</div>
		<div class="table_right">
			<input type="text" name="val[component]" id="component" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['component']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['component']) : (isset($this->_aVars['aForms']['component']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['component']) : '')); ?>
" size="30" />
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.component_add_componen')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('admincp.type'); ?>:
		</div>
		<div class="table_right">
			<select name="val[type]" id="type" onchange="doHideConnection(this.value);">
				<option value=""><?php echo Phpfox::getPhrase('admincp.select'); ?></option>
				<option value="1"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('type') && in_array('type', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['type'])
								&& $aParams['type'] == '1')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['type'])
									&& !isset($aParams['type'])
									&& $this->_aVars['aForms']['type'] == '1')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase('admincp.controller'); ?></option>
				<option value="2"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('type') && in_array('type', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['type'])
								&& $aParams['type'] == '2')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['type'])
									&& !isset($aParams['type'])
									&& $this->_aVars['aForms']['type'] == '2')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase('admincp.block_actual'); ?></option>
			</select>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.component_add_type')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table" id="url_connection"<?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['type'] == '2'): ?> style="display:none;"<?php endif; ?>>
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.url_connection'); ?>:
		</div>
		<div class="table_right">
			<input type="text" name="val[m_connection]" id="m_connection" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['m_connection']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['m_connection']) : (isset($this->_aVars['aForms']['m_connection']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['m_connection']) : '')); ?>
" size="30" />
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.component_add_connection')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('admincp.active'); ?>:
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
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.component_add_active')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table_clear">
<?php if (Phpfox ::getParam('core.display_required')): ?>
		<div class="go_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif; ?> <?php echo Phpfox::getPhrase('core.required_fields'); ?>
		</div>
		<div class="t_right">
			<input type="submit" value="<?php echo Phpfox::getPhrase('core.submit'); ?>" class="button" />
		</div>
		<div class="clear"></div>
<?php else: ?>
			<input type="submit" value="<?php echo Phpfox::getPhrase('core.submit'); ?>" class="button" />
<?php endif; ?>
	</div>

</form>

