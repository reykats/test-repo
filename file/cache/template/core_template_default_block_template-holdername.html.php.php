<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 19, 2013, 9:43 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: template-holdername.html.php 2817 2011-08-08 16:59:43Z Raymond_Benc $
 */
 
 

?>
<?php if (defined ( 'PHPFOX_IS_USER_PROFILE' ) || defined ( 'PHPFOX_IS_PAGES_VIEW' )): ?>id="js_is_user_profile"<?php else: ?>id="js_controller_<?php echo $this->_aVars['sFullControllerName']; ?>"<?php endif; ?>
