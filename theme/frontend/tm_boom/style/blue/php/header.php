<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

$oTpl->setHeader('cache', array(
		'main.js' => 'style_script'
	)
);
if(Phpfox::getLib('module')->getfullControllerName()=='core.index-visitor'){
	$oTpl->setHeader('cache', array('tm-jqueryfx.js'=>'style_script'));
}
$oTpl->setHeader(array(
		"<!--[if IE 7]>\n\t\t\t<script type=\"text/javascript\" src=\"" . $oTpl->getStyle('jscript', 'ie7.js') . "?v=" . Phpfox::getLib('template')->getStaticVersion() . "\"></script>\n\t\t<![endif]-->",
		"<link rel=\"stylesheet\" type=\"text/css\" href=\"" . $oTpl->getStyle('font', 'stylesheet.css') . "\" />"
	)
);

?>