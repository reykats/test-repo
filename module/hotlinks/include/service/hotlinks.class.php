<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 *
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Friend
 * @version 		$Id: friend.class.php 4709 2012-09-21 08:37:17Z Raymond_Benc $
 */
class Hotlinks_Service_Hotlinks extends Phpfox_Service
{
	/**
	 * Class constructor
	 */
	public function __construct()
	{
		$this->_sTable = Phpfox::getT('hotlinks');
	}

	public function get()
	{
		$aCond[] = 'status=1';	
		$aRows = $this->database()->select('*')  
			->from($this->_sTable, 'friend')
			->where($aCond)
			->execute('getSlaveRows');
			
		return $aRows;
	}
	
	public function display()
	{
	
	}
	
	public function getForEdit($id) {
		$aCond[] = 'id=' . $id;	
		$aRows = $this->database()->select('*')  
			->from($this->_sTable, 'friend')
			->where($aCond)
			->execute('getSlaveRow');
			
		return $aRows;
	}
	
	public function update($id, $data) {
		$this->database()->update($this->_sTable, array(
			'keyword' => Phpfox::getLib('parse.input')->clean($data['keyword']), 
			'url' => Phpfox::getLib('parse.input')->prepare($data["url"]),
			'status' => 1
		), 'id = ' . (int) $id);
		
		return true;
	}
	
	public function add($data) {
		$id = $this->database()->insert($this->_sTable, array(
			'keyword' => Phpfox::getLib('parse.input')->clean($data['keyword']), 
			'url' => Phpfox::getLib('parse.input')->prepare($data["url"]),
			'status' => 1
			)
		);
		return $id;
	}
	
	public function delete($id) {
		echo 1;
		$this->database()->delete($this->_sTable, 'id = ' . (int) $id);
		return true;
	}
	
	/**
	 * If a call is made to an unknown method attempt to connect
	 * it to a specific plug-in with the same name thus allowing
	 * plug-in developers the ability to extend classes.
	 *
	 * @param string $sMethod is the name of the method
	 * @param array $aArguments is the array of arguments of being passed
	 */
	public function __call($sMethod, $aArguments)
	{
		/**
		 * Check if such a plug-in exists and if it does call it.
		 */
		if ($sPlugin = Phpfox_Plugin::get('hotlinks.service_hotlinks___call'))
		{
			return eval($sPlugin);
		}

		/**
		 * No method or plug-in found we must throw a error.
		 */
		Phpfox_Error::trigger('Call to undefined method ' . __CLASS__ . '::' . $sMethod . '()', E_USER_ERROR);
	}
}

?>