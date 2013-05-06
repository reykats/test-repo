<?php
/**
 *
 *
 * @copyright        [YouNet_COPYRIGHT]
 * @author           YouNet Company
 * @package          Module_ScheduledMail
 * @version          2.01
 */

defined('PHPFOX') or exit('NO DICE!');

class gettingStarted_service_settings extends Phpfox_Service{

	public function getSettings($user_group_id=0)
	{
		$settings = array();
		/*$prefix=Phpfox::getParam(array('db', 'prefix'));
		$aRows=$this->database()->select("*")
		->from(phpfox::getT('gettingstarted_settings'))
		->where("user_group_id=".$user_group_id)
		->execute('getSlaveRows');

		foreach ($aRows as $aRow)
		{
			$settings[$aRow['name']] = $aRow['default_value'];
		}
		*/
		$settings['number_of_article_category'] = phpfox::getParam('gettingstarted.article_limit');
		$settings['active_getting_started'] = phpfox::getParam('gettingstarted.active_getting_started');
		$settings['active_knowledge_base'] = phpfox::getParam('gettingstarted.active_knowledge_base');
		$settings['active_email_remainder'] = phpfox::getParam('gettingstarted.active_email_remainder');
		$settings['number_of_letters'] = phpfox::getParam('gettingstarted.letter_limit_will_be_sent_in_one_time');
		//$settings['number_of_article'] = Phpfox::getParam('gettingstarted.articles_limit_can_be_displayed');
		$settings['number_of_article'] = 10;
		if(!is_int($settings['number_of_letters'])||($settings['number_of_letters'] <= 0))
		{
			$settings['number_of_letters'] = 10;
		}
		if(!is_int($settings['number_of_article_category'])||($settings['number_of_article_category'] <= 0))
		{
			$settings['number_of_article_category'] = 10;
		}
		if(!is_int($settings['number_of_article'])||($settings['number_of_article'] <= 0))
		{
			$settings['number_of_article'] = 10;
		}
		//$settings[]
		return $settings;
	}

	public function setSettings($params = array(),$user_group_id)
	{
		$prefix=Phpfox::getParam(array('db', 'prefix'));
		
		$this->database()->delete(phpfox::getT('gettingstarted_settings'),"user_group_id=".$user_group_id);
		foreach($params as $key=>$value)
		{
			$this->database()->insert(phpfox::getT('gettingstarted_settings'),array('user_group_id' => $user_group_id,
                'module_id' => 'scheduledmail',
                'name' => $key,
                'default_value' => $value));
		}
		$this->database()->update(phpfox::getT('menu'),array('is_active'=>$params["active_base_knowledge"]),'m_connection="'.'main'.'" and module_id="'."gettingstarted".'"');
		Phpfox::getLib("cache")->remove('menu', 'substr');
	}

}
?>
