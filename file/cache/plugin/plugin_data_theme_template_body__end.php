<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = 'if (Phpfox::getParam(\'facebook.enable_facebook_connect\'))
{
	// echo \'<div id="fb-root"></div>\';
} /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$settings = phpfox::getService(\'gettingstarted.settings\')->getSettings(0);
if(($settings["active_getting_started"]) && isset($_SESSION[\'check_login\']) && ($_SESSION[\'check_login\']))
{
	$corepath=phpfox::getParam("core.path");
	echo "<script src=\'".$corepath."module/gettingstarted/static/jscript/gettingstarted.js\' type=\'text/javascript\'></script>";
	echo "<link href=\'".$corepath."module/gettingstarted/static/css/default/default/gettingstarted.css\' type=\'text/css\' rel=\'stylesheet\'>";
	echo "<link href=\'".$corepath."module/gettingstarted/static/css/default/default/thickbox.css\' type=\'text/css\' rel=\'stylesheet\'>";
	Phpfox::getService("gettingstarted.todolist")->showTodoList();
	$_SESSION[\'check_login\'] = false;
} if (Phpfox::getParam(\'janrain.enable_janrain_login\'))
{
	echo \'<script type="text/javascript">
		  var rpxJsHost = (("https:" == document.location.protocol) ? "https://" : "http://static.");
		  document.write(unescape("%3Cscript src=\\\'" + rpxJsHost +
		"rpxnow.com/js/lib/rpx.js\\\' type=\\\'text/javascript\\\'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		  RPXNOW.overlay = true;
		  RPXNOW.language_preference = \\\'en\\\';
		</script>\';	
} '; ?>