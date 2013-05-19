<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 8, 2013, 7:53 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: controller.html.php 64 2009-01-19 15:05:54Z Raymond_Benc $
 */
 
 

?>
<div id="js_rating_holder_<?php echo $this->_aVars['aRatingCallback']['type']; ?>">
	<form method="post" action="#">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
		<div><input type="hidden" name="rating[type]" value="<?php echo $this->_aVars['aRatingCallback']['type']; ?>" /></div>
		<div><input type="hidden" name="rating[item_id]" value="<?php echo $this->_aVars['aRatingCallback']['item_id']; ?>" /></div>
		<div style="height:18px;">
			<div style="position:absolute;">		
<?php if (count((array)$this->_aVars['aRatingCallback']['stars'])):  foreach ((array) $this->_aVars['aRatingCallback']['stars'] as $this->_aVars['sKey'] => $this->_aVars['sPhrase']): ?>
				<input type="radio" class="js_rating_star" id="js_rating_star_<?php echo $this->_aVars['sKey']; ?>" name="rating[star]" value="<?php echo $this->_aVars['sKey']; ?>|<?php echo $this->_aVars['sPhrase']; ?>" title="<?php echo $this->_aVars['sKey'];  if ($this->_aVars['sPhrase'] != $this->_aVars['sKey']): ?> (<?php echo $this->_aVars['sPhrase']; ?>)<?php endif; ?>"<?php if ($this->_aVars['aRatingCallback']['default_rating'] >= $this->_aVars['sKey']): ?> checked="checked"<?php endif; ?> />
<?php endforeach; endif; ?>
				<div class="clear"></div>
			</div>
		</div>
<?php if (isset ( $this->_aVars['aRatingCallback']['total_rating'] )): ?>
		<div class="extra_info" style="padding:4px 0px 0px 4px;">
			<span class="js_rating_total"><?php echo $this->_aVars['aRatingCallback']['total_rating']; ?></span>			
		</div>		
<?php endif; ?>
	
</form>

</div>
