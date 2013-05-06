<?php

defined('PHPFOX') or exit('NO DICE!');

/**
 * author  		Teamwurkz
 * Components  	Components_Teamwurkz
 */
 
class Core_Component_Block_Tm_Boom_Blog extends Phpfox_Component
{

	public function process()
	{
	
		$dbase = Phpfox::getLib('database');
		
		$aRows = $dbase->select('b.blog_id, b.time_stamp, b.title, bt.text_parsed, att.destination, att.server_id, att.is_image, ' . Phpfox::getUserField())
			->from(Phpfox::getT('blog'), 'b')
			->join(Phpfox::getT('blog_text'), 'bt', 'bt.blog_id = b.blog_id')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = b.user_id')
			->leftJoin(Phpfox::getT('attachment'),'att','att.item_id=b.blog_id')
			->where('u.user_group_id=1')
			->limit(2)
			->order('b.time_stamp DESC')
			->execute('getRows');	
			
		foreach ($aRows as $iKey => $aRow)
		{
			$aRows[$iKey]['posted_on'] = Phpfox::getTime('d-m-y', $aRow['time_stamp']);			
		}			
		
		$this->template()->assign(array(				
				'aBlogs' => $aRows
			)
		);
		return 'block';
	}
		
}

?>