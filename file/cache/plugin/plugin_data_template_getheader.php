<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = '/**
 *
 *
 * @copyright        [YouNet_COPYRIGHT]
 * @author           YouNet Company
 * @package          Module_Advancesearch
 * @version          2.01
 */

defined(\'PHPFOX\') or exit(\'NO DICE!\');

$settings = phpfox::getService(\'gettingstarted.settings\')->getSettings(0);
if (isset($settings[\'active_knowledge_base\']) != null)
{
	if($settings[\'active_knowledge_base\'] == true)
	{
		Phpfox::getLib(\'database\')->update(phpfox::getT(\'menu\'),array(\'is_active\'=>1),\'m_connection="\'.\'main\'.\'" and module_id="\'."gettingstarted".\'"\');
		Phpfox::getLib("cache")->remove(\'menu\', \'substr\');
	}
	else 
	{
		Phpfox::getLib(\'database\')->update(phpfox::getT(\'menu\'),array(\'is_active\'=>0),\'m_connection="\'.\'main\'.\'" and module_id="\'."gettingstarted".\'"\');
		Phpfox::getLib("cache")->remove(\'menu\', \'substr\');
	}
}
else 
{
		Phpfox::getLib(\'database\')->update(phpfox::getT(\'menu\'),array(\'is_active\'=>0),\'m_connection="\'.\'main\'.\'" and module_id="\'."gettingstarted".\'"\');
		Phpfox::getLib("cache")->remove(\'menu\', \'substr\');
} '; ?>