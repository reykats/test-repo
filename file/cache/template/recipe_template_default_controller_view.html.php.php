<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 6, 2013, 7:55 am */ ?>
<div class="main_break"></div>
<div id="js_recipe_outer_body">
<div class="long_description">
	<p id="js_recipe_text_<?php echo $this->_aVars['aRecipe']['recipe_id']; ?>">
<?php echo $this->_aVars['aRecipe']['description_parsed']; ?>
	</p>
</div>
<div class="p_4" style="color:#808080;">
<?php echo Phpfox::getPhrase('recipe.category'); ?>: <?php echo $this->_aVars['aRecipe']['breadcrumb']; ?>
</div>
<div class="p_4" style="color:#808080;padding-top:0px; padding-bottom:0px;">
<?php echo Phpfox::getPhrase('recipe.by'); ?>: <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aRecipe']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aRecipe']['user_name'], ((empty($this->_aVars['aRecipe']['user_name']) && isset($this->_aVars['aRecipe']['profile_page_id'])) ? $this->_aVars['aRecipe']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aRecipe']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>'; ?> <?php echo Phpfox::getPhrase('recipe.on'); ?> <?php echo Phpfox::getTime(Phpfox::getParam('core.global_update_time'), $this->_aVars['aRecipe']['time_stamp']); ?>
</div>
<div class="p_4" style="color:#808080;padding-top:5px; padding-bottom:5px;">
<?php echo Phpfox::getPhrase('recipe.total_comments'); ?>: <?php echo $this->_aVars['aRecipe']['total_comment']; ?>
</div>
<div class="p_4" style="color:#808080;padding-top:0px; padding-bottom:5px;">
<?php echo Phpfox::getPhrase('recipe.total_views'); ?>: <?php echo $this->_aVars['aRecipe']['total_view']; ?>
</div>	
<?php Phpfox::getBlock('rate.display', array()); ?>


<div class="t_right">
			<ul class="item_menu moderation_block_<?php echo $this->_aVars['aRecipe']['recipe_id']; ?>">
<?php if (Phpfox ::getUserParam('recipe.can_edit_other_recipe') || ( ( $this->_aVars['aRecipe']['user_id'] == Phpfox ::getUserId()) && Phpfox ::getUserParam('recipe.can_edit_own_recipe') )): ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('recipe', array('delete' => $this->_aVars['aRecipe']['recipe_id'])); ?>"><?php echo Phpfox::getPhrase('recipe.delete'); ?></a></li>
<?php endif; ?>
<?php if (Phpfox ::getUserParam('recipe.can_edit_other_recipe') || ( ( $this->_aVars['aRecipe']['user_id'] == Phpfox ::getUserId()) && Phpfox ::getUserParam('recipe.can_edit_own_recipe') )): ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('recipe.add', array('id' => $this->_aVars['aRecipe']['recipe_id'])); ?>"><?php echo Phpfox::getPhrase('recipe.edit'); ?></a></li>
<?php endif; ?>
			</ul>
			<div class="clear"></div>
</div>

<div class="recipe_share_box">
<?php if (Phpfox ::isModule('favorite')): ?>
			<a href="#?call=favorite.add&amp;height=100&amp;width=400&amp;type=recipe&amp;id=<?php echo $this->_aVars['aRecipe']['recipe_id']; ?>" class="inlinePopup" title="<?php echo Phpfox::getPhrase('recipe.add_to_your_favorites'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/icn_save.png','class' => 'v_middle')); ?> <?php echo Phpfox::getPhrase('recipe.favorite'); ?></a>
<?php endif; ?>
<?php if (Phpfox ::isModule('share')): ?>
<?php Phpfox::getBlock('share.link', array('type' => 'recipe','display' => 'image','url' => $this->_aVars['aRecipe']['bookmark'],'title' => $this->_aVars['aRecipe']['title'])); ?>
<?php endif; ?>
<?php if (Phpfox ::isModule('report')): ?>
<?php if ($this->_aVars['aRecipe']['user_id'] != Phpfox ::getUserId()): ?><a href="#?call=report.add&amp;height=100&amp;width=400&amp;type=recipe&amp;id=<?php echo $this->_aVars['aRecipe']['recipe_id']; ?>" class="inlinePopup" title="<?php echo Phpfox::getPhrase('recipe.report_a_recipe'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/icn_report.png','class' => 'v_middle')); ?> <?php echo Phpfox::getPhrase('recipe.report'); ?></a><?php endif; ?>
<?php endif; ?>
</div>
</div>			
<?php Phpfox::getBlock('feed.comment', array()); ?>
