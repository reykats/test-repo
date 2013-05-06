<?php

defined('PHPFOX') or exit('NO DICE!');

class Newhome_Component_Block_Guestview extends Phpfox_Component
{
	
	public function process()
	{

        $aRandomUsers = $this->getRandomUser();

		$this->template()->assign(array(
				'aUsers' => $aRandomUsers,				
			)
		);
		return 'block';
	}

    public function getRandomUser(){

        return Phpfox::getLib('database') ->select('u.*')
              ->from('phpfox_user u')
              ->where('u.view_id != 7')
              ->order('rand()')
              ->limit(10)
              ->execute('getSlaveRows');
    }
	
	
	
}

?>