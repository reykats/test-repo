<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: April 27, 2013, 5:16 am */ ?>
<?php echo $this->_aVars['sCreateJs']; ?>
<div class="main_break"></div>
<form method="post" action="<?php echo $this->_aVars['sFormAction']; ?>" id="js_form" name="js_form" onsubmit="<?php echo $this->_aVars['sGetJsForm']; ?>" enctype="multipart/form-data">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
<?php if (isset ( $this->_aVars['aRecipe']['recipe_id'] )): ?>
	  <input type="hidden" name="val[recipe_id]"  value="<?php echo $this->_aVars['aRecipe']['recipe_id']; ?>" />
	  <input type="hidden" name="val[need_upload_image]" id="js_need_upload_image"  value="0" />
<?php endif; ?>
	<div class="table">
			<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('recipe.title'); ?>:
			</div>
			<div class="table_right">
<?php if (isset ( $this->_aVars['aRecipe']['title'] ) && $this->_aVars['aRecipe']['user_id'] == Phpfox ::getUserId()): ?>
				<input type="text" name="val[title]" value="<?php echo $this->_aVars['aRecipe']['title']; ?>" id="title" maxlength="150" size="40" />
<?php else: ?>
				<input type="text" name="val[title]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['title']) : (isset($this->_aVars['aForms']['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['title']) : '')); ?>
" id="title" maxlength="150" size="40" />
<?php endif; ?>
			</div>
	</div>
	<div class="table">
			<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif; ?><label for="category"><?php echo Phpfox::getPhrase('recipe.category'); ?>:</label>
			</div>
			<div class="table_right">
<?php echo $this->_aVars['sCategories']; ?>
			</div>
<?php if (isset ( $this->_aVars['aRecipe']['categories'] )): ?>
			<?php echo '<script type="text/javascript">
			var aCategories = explode(\',\', \'';  echo $this->_aVars['aRecipe']['categories'];  echo '\'); 
			for (i in aCategories) { 
				$(\'#js_mp_holder_\' + aCategories[i]).show(); 
				$(\'#js_mp_category_item_\' + aCategories[i]).attr(\'selected\', true); 
			}
			</script>
			'; ?>

<?php endif; ?>
	</div>
	<div class="table">
			<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('recipe.description'); ?>:
			</div>
			<div class="table_right">
				<?php Phpfox::getBlock('attachment.share');  echo Phpfox::getLib('phpfox.editor')->get('description', array (
  'id' => 'description',
  'type' => 'basic',
  'rows' => '10',
)); ?>
			</div>
	</div>
	<div class="table">
			<div class="table_left">
<?php echo Phpfox::getPhrase('recipe.short_description'); ?>:
			</div>
			<div class="table_right">
				<?php Phpfox::getBlock('attachment.share');  echo Phpfox::getLib('phpfox.editor')->get('short_description', array (
  'id' => 'short_description',
  'type' => 'basic',
  'rows' => '5',
)); ?>
			</div>
	</div>
	<div class="table">
			<div class="table_left">
<?php echo Phpfox::getPhrase('recipe.keywords'); ?>:
			</div>
			<div class="table_right">
<?php if (isset ( $this->_aVars['aRecipe']['keywords'] ) && $this->_aVars['aRecipe']['user_id'] == Phpfox ::getUserId()): ?>
				<input type="text" name="val[keywords]" value="<?php echo $this->_aVars['aRecipe']['keywords']; ?>" id="keywords" maxlength="150" size="40" />
<?php else: ?>
				<input type="text" name="val[keywords]" value="" id="keywords" maxlength="150" size="40" />
<?php endif; ?>
			</div>
	</div>
<?php if (Phpfox ::getParam('recipe.recipe_can_upload_picture')): ?>
		<div class="table">
			<div class="table_left">
<?php echo Phpfox::getPhrase('recipe.image'); ?>:
			</div>

			<div class="table_right" id="js_recipe_current_image" <?php if (! isset ( $this->_aVars['aRecipe']['image_path'] ) || $this->_aVars['aRecipe']['image_path'] == ''): ?> style="display: none;"<?php endif; ?>>
<?php if (isset ( $this->_aVars['aRecipe'] ) && isset ( $this->_aVars['aRecipe']['title'] ) && isset ( $this->_aVars['aRecipe']['image_path'] )): ?>
				 <div class="p_4">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('thickbox' => true,'title' => $this->_aVars['aRecipe']['title'],'path' => 'recipe.url_image','file' => $this->_aVars['aRecipe']['image_path'],'suffix' => $this->_aVars['sSuffix'],'max_width' => 'recipe.recipe_max_image_pic_size','max_height' => 'recipe.recipe_max_image_pic_size')); ?>
					<br />
					<a href="#" onclick="$Core.recipe.deleteImage(<?php echo $this->_aVars['aRecipe']['recipe_id']; ?>);return false;"><?php echo Phpfox::getPhrase('recipe.click_here_to_delete_this_image_and_upload_a_new_one_in_its_place'); ?></a>
				</div>
<?php endif; ?>
			</div>

			<div class="table_right" id="js_submit_upload_image" <?php if (isset ( $this->_aVars['aRecipe']['image_path'] ) && $this->_aVars['aRecipe']['image_path'] != ''): ?> style="display: none;"<?php endif; ?>>
				<input type="file" id='image' name="image" />
				<div class="extra_info">
<?php echo Phpfox::getPhrase('recipe.you_can_upload_a_jpg_gif_or_png_file'); ?>
				</div>
			</div>
		</div>
<?php endif; ?>
		<div class="table_clear">
			<input type="submit" value="<?php if (isset ( $this->_aVars['aRecipe']['recipe_id'] )):  echo Phpfox::getPhrase('recipe.update');  else:  echo Phpfox::getPhrase('recipe.add');  endif; ?>" class="button" onclick="return $Core.recipe.submitForm()"/>
		</div>

</form>

