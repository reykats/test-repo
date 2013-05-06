<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: April 27, 2013, 5:17 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		phpfoxguru.com
 * @author  		Nicolas
 * @package  		Module_Recipe
 * @version 		$Id: index.html.php 2009-09-10 Nicolas $
 */
 
 
?>
<?php if (! count ( $this->_aVars['aRecipes'] )): ?>
<?php if (defined ( 'PHPFOX_IS_USER_PROFILE' )): ?>
<?php if ($this->_aVars['aUser']['user_id'] == Phpfox ::getUserId()): ?>
		<div class="extra_info"><?php echo Phpfox::getPhrase('recipe.you_have_not_added_any_recipe'); ?></div>
		<ul class="action">
			<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl(''.$this->_aVars['sParentLink'].'.add'); ?>"><?php echo Phpfox::getPhrase('recipe.recipe_add_a_recipe'); ?></a></li>
		</ul>
<?php else: ?>
		<div class="extra_info"><?php echo Phpfox::getPhrase('recipe.user_link_has_not_added_any_recipe', array('user' => $this->_aVars['aUser'])); ?></div>
		<ul class="action">
			<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['sParentLink']); ?>"><?php echo Phpfox::getPhrase('recipe.browse_other_recipe'); ?></a></li>
		</ul>
<?php endif; ?>
<?php else: ?>
		<div class="main_break"></div>
		<div class="extra_info"><?php echo Phpfox::getPhrase('recipe.no_recipe_have_been_added_yet'); ?></div>
		<ul class="action">
			<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl(''.$this->_aVars['sParentLink'].'.add'); ?>"><?php echo Phpfox::getPhrase('recipe.be_the_first_to_add'); ?></a></li>
		</ul>
<?php endif; ?>
<?php else: ?>
	<div id="js_recipe_outer_body">
<?php if (count((array)$this->_aVars['aRecipes'])):  $this->_aPhpfoxVars['iteration']['arecipes'] = 0;  foreach ((array) $this->_aVars['aRecipes'] as $this->_aVars['aRecipe']):  $this->_aPhpfoxVars['iteration']['arecipes']++; ?>

		<div id="js_recipe_<?php echo $this->_aVars['aRecipe']['recipe_id']; ?>" class="js_recipe_inline <?php if (is_int ( $this->_aPhpfoxVars['iteration']['arecipes'] / 2 )): ?>row1<?php else: ?>row2<?php endif;  if ($this->_aPhpfoxVars['iteration']['arecipes'] == 1): ?> row_first<?php endif;  if ($this->_aVars['aRecipe']['is_featured']): ?> row_featured<?php endif;  if ($this->_aVars['aRecipe']['view_id'] == '1'): ?> row_moderate<?php endif; ?>">
		<span class="row_featured_link"<?php if (! $this->_aVars['aRecipe']['is_featured']): ?> style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('recipe.featured'); ?>
		</span>	
		<div style="width:130px; position:absolute; text-align:center; left:10px;">
			<a href="/network/recipe/view/<?php echo $this->_aVars['aRecipe']['title_url']; ?>" class="js_recipe_title_<?php echo $this->_aVars['aRecipe']['recipe_id']; ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('path' => 'recipe.url_image','file' => $this->_aVars['aRecipe']['image_path'],'suffix' => $this->_aVars['sSuffix'],'max_width' => 'recipe.recipe_max_image_pic_size','max_height' => 'recipe.recipe_max_image_pic_size','class' => 'js_mp_fix_width','title' => $this->_aVars['aRecipe']['title'])); ?></a>
			
<?php Phpfox::getBlock('rate.display', array('aRatingCallback' => $this->_aVars['aRecipe']['aRatingCallback'])); ?>
			
		</div>
		<div style="margin-left:145px; height:160px;">
			<a href="/network/recipe/view/<?php echo $this->_aVars['aRecipe']['title_url']; ?>" style="font-size:11pt;"><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aRecipe']['title']); ?></a>
			
			<div style="color:#808080;padding-top:5px; padding-bottom:5px;">
<?php echo Phpfox::getPhrase('recipe.by'); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aRecipe']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aRecipe']['user_name'], ((empty($this->_aVars['aRecipe']['user_name']) && isset($this->_aVars['aRecipe']['profile_page_id'])) ? $this->_aVars['aRecipe']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aRecipe']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>'; ?> <?php echo Phpfox::getPhrase('recipe.on'); ?> <?php echo Phpfox::getTime(Phpfox::getParam('core.global_update_time'), $this->_aVars['aRecipe']['time_stamp']); ?>
			</div>
			<div style="color:#808080;padding-top:5px; padding-bottom:5px;">
<?php echo Phpfox::getPhrase('recipe.total_comments'); ?>: <?php echo $this->_aVars['aRecipe']['total_comment']; ?>
			</div>
			<div style="color:#808080;padding-top:0px; padding-bottom:5px;">
<?php echo Phpfox::getPhrase('recipe.total_views'); ?>: <?php echo $this->_aVars['aRecipe']['total_view']; ?>
			</div>	
			<div class="extra_info" style="padding-top:0px;">
<?php echo $this->_aVars['aRecipe']['breadcrumb']; ?>
			</div>
			
			
		</div>
		<div class="t_right">
			<ul class="item_menu_bar" style="margin:0px;">
<?php if (Phpfox ::getUserParam('recipe.can_feature_recipes')): ?>
					<li class="js_recipe_is_not_featured"<?php if ($this->_aVars['aRecipe']['is_featured']): ?> style="display:none;"<?php endif; ?>><a href="#" onclick="$(this).parents('.js_recipe_inline:first').find('.row_featured_link:first').show(); $(this).parents('.js_recipe_inline:first').addClass('row_featured'); $(this).parents('.item_menu:first').find('.js_recipe_is_not_featured:first').hide(); $(this).parents('.item_menu:first').find('.js_recipe_is_featured:first').show(); $.ajaxCall('recipe.feature', 'id=<?php echo $this->_aVars['aRecipe']['recipe_id']; ?>&amp;type=1'); return false;"><?php echo Phpfox::getPhrase('recipe.feature'); ?></a></li>
					<li class="js_recipe_is_featured"<?php if (! $this->_aVars['aRecipe']['is_featured']): ?> style="display:none;"<?php endif; ?>><a href="#" onclick="$(this).parents('.js_recipe_inline:first').find('.row_featured_link:first').hide(); $(this).parents('.js_recipe_inline:first').removeClass('row_featured'); $(this).parents('.item_menu:first').find('.js_recipe_is_not_featured:first').show(); $(this).parents('.item_menu:first').find('.js_recipe_is_featured:first').hide(); $.ajaxCall('recipe.feature', 'id=<?php echo $this->_aVars['aRecipe']['recipe_id']; ?>&amp;type=0'); return false;"><?php echo Phpfox::getPhrase('recipe.unfeature'); ?></a></li>
<?php endif; ?>
<?php if ($this->_aVars['aRecipe']['view_id'] != 0 && Phpfox ::getUserParam('recipe.can_approve_recipes')): ?>
					<li><a href="#" onclick="$.ajaxCall('recipe.approve', 'id=<?php echo $this->_aVars['aRecipe']['recipe_id']; ?>'); $('#js_recipe_<?php echo $this->_aVars['aRecipe']['recipe_id']; ?>').removeClass('row_moderate'); $(this).parent().remove();return false;"><?php echo Phpfox::getPhrase('recipe.approve'); ?></a></li>
<?php endif; ?>
<?php if (( Phpfox ::getUserParam('recipe.can_edit_own_recipe') && Phpfox ::getUserId() == $this->_aVars['aRecipe']['user_id'] ) || Phpfox ::getUserParam('recipe.can_edit_other_recipe')): ?>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('recipe.add', array('id' => $this->_aVars['aRecipe']['recipe_id'])); ?>"><?php echo Phpfox::getPhrase('core.edit'); ?></a></li>
<?php endif; ?>
<?php if (( $this->_aVars['aRecipe']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('recipe.can_delete_own_recipe')) || Phpfox ::getUserParam('recipe.can_delete_other_recipe')): ?>
					<li><a href="#" onclick="if (confirm('<?php echo Phpfox::getPhrase('recipe.are_you_sure', array('phpfox_squote' => true)); ?>')) <?php echo '{'; ?>
 $.ajaxCall('recipe.delete', 'id=<?php echo $this->_aVars['aRecipe']['recipe_id']; ?>'); <?php echo '}'; ?>
 return false;"><?php echo Phpfox::getPhrase('recipe.delete'); ?></a></li>
<?php endif; ?>
				
				<li><!-- --></li>
			</ul>	
		</div>	
	</div>
<?php endforeach; endif; ?>
	<div class="clear"></div>
	<div class="t_right">
<?php if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager'); ?>
	</div>
	</div>
<?php endif; ?>
