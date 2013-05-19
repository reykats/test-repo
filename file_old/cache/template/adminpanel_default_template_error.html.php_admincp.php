<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 8, 2013, 8:12 am */ ?>
<?php if ($this->_aVars['sPublicMessage']): ?>
<div class="public_message" id="public_message">
<?php echo $this->_aVars['sPublicMessage']; ?>
</div>
<script type="text/javascript">
	$('#public_message').show();
</script>
<?php endif; ?>
<div id="core_js_messages">
<?php if (count ( $this->_aVars['aErrors'] )): ?>
<?php if (count((array)$this->_aVars['aErrors'])):  foreach ((array) $this->_aVars['aErrors'] as $this->_aVars['sErrorMessage']): ?>
	<div class="error_message"><?php echo $this->_aVars['sErrorMessage']; ?></div>
<?php endforeach; endif; ?>
<?php unset($this->_aVars['sErrorMessage'], $this->_aVars['sample']); ?>
<?php endif; ?>
</div>
