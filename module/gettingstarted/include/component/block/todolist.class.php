<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class gettingstarted_component_block_todolist extends Phpfox_component{
	
	public function process()
	{
		$position = 0;
		$aRowPosition = Phpfox::getService("gettingstarted.todolist")->getPosiontodolist(Phpfox::getUserId());
		if(count($aRowPosition)>0)
		{
			if($aRowPosition['active'] == 0)
			{
				print_r("You can not see it again. Thanks.");
				exit;
			}
			$position = $aRowPosition['item_id'];
		}
		if($position == 0)
		{	
			$currentTodoList = Phpfox::getService('gettingstarted.todolist')->getFirstLinetodolist($position);
		}
		else
		{
			$currentTodoList = Phpfox::getService('gettingstarted.todolist')->getCurrentPositionOfUser(Phpfox::getUserId());
		}

		$showbuttonNext = 0;
		$showbuttonPre = 0;
		$showbuttonDone = 0;
		$showbuttonClose = 1;
		if(count($currentTodoList)>0)
		{
			$nextTodoList = Phpfox::getService('gettingstarted.todolist')->getFirstLinetodolist($currentTodoList['todolist_id']);
			$preTodoList = Phpfox::getService('gettingstarted.todolist')->getPreTodolist($currentTodoList['todolist_id']);
			if(count($nextTodoList)>0)
			{
				$showbuttonNext = 1;
			}
			else
			{
				$showbuttonClose = 0;
				$showbuttonDone = 1;
			}
			if(count($preTodoList) > 0)
			{
				$showbuttonPre = 1;
			}
			$aVals=array();
			$aVals['item_id'] = $currentTodoList['todolist_id'];
			if(count($aRowPosition) == 0)
			{
				Phpfox::getService('gettingstarted.todolist')->addpositiontodolist($aVals);
			}
			else 
			{
				$aVals['user_id']=phpfox::getUserId();
				Phpfox::getService('gettingstarted.todolist')->updatepositiontodolist($aVals);
			}
		}
		else
		{
			print_r("You can not see it again. Thanks.");
			exit;
		}

		$this->template()->assign(array(
           'FirstTodoList' => $currentTodoList,
           'showbuttonNext' => $showbuttonNext,
			'showbuttonPre' => $showbuttonPre,
			'showbuttonDone' => $showbuttonDone,
			'showbuttonClose' => $showbuttonClose
		));
		return 'block';
	}
}
?>
