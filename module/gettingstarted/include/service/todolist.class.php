<?php
/**
 *
 *
 * @copyright        [YouNet_COPYRIGHT]
 * @author           YouNet Company
 * @package          Module_Gettingstarted
 * @version          2.01
 */

defined('PHPFOX') or exit('NO DICE!');

class Gettingstarted_service_todolist extends Phpfox_Service{



	public function getFirstLinetodolist($iId)
	{
		/* $aRow=$this->database()->select('*')
		 ->from(phpfox::getT('gettingstarted_todolist'),'todolist')
		 ->where('todolist.todolist_id > '.$iId)
		 ->order('todolist.todolist_id asc')
		 ->limit(1)
		 ->execute('getSlaveRow');
		 return $aRow;*/
		$aRow = $this->database()->select('*')
				->from(phpfox::getT('gettingstarted_todolist'),'todolist')
				->where('todolist.todolist_id > '.$iId)
				->order('todolist.todolist_id asc')
				->limit(1)
				->execute('getSlaveRow');
		return $aRow;
	}
	/*
	 * get current position of sser
	 */
	public function getCurrentPositionOfUser($user_id)
	{
		$aRow = $this->database()->select('t.*, p.item_id, p.active')
				->from(phpfox::getT('gettingstarted_todolist'),'t')
				->join(phpfox::getT('gettingstarted_position'), 'p', 't.todolist_id = p.item_id')
				->where('p.user_id = '.$user_id)
				//->order('todolist.todolist_id asc')
				->limit(1)
				->execute('getSlaveRow');
		return $aRow;
	}

	
	public function updateTodoListofUser($iId)
	{		
		$aNextPosition = $this->getFirstLinetodolist($iId);
		if(!empty($aNextPosition))
		{
			$positionUpdate['item_id'] = $aNextPosition['todolist_id'];
		}
		else 
		{
			$aPrePosition = $this->getPreTodolist($iId);
			if(!empty($aPrePosition))
			{
				$positionUpdate['item_id'] = $aPrePosition['todolist_id'];
			}
			else 
			{
				$this->database()->delete(phpfox::getT('gettingstarted_position'), 'item_id = '.$iId);
			}
			
		}
		if(isset($positionUpdate['item_id']))
		{
			$this->database()->update(phpfox::getT('gettingstarted_position'), $positionUpdate, 'item_id = '.$iId);
		}
	}
	
	/*
	 * get Previous step of todo list
	 */
	public function getPreTodolist($iId)
	{
		/* $aRow=$this->database()->select('*')
		 ->from(phpfox::getT('gettingstarted_todolist'),'todolist')
		 ->where('todolist.todolist_id > '.$iId)
		 ->order('todolist.todolist_id asc')
		 ->limit(1)
		 ->execute('getSlaveRow');
		 return $aRow;*/
		$aRow = $this->database()->select('*')
				->from(phpfox::getT('gettingstarted_todolist'),'todolist')
				->where('todolist.todolist_id < '.$iId)
				->order('todolist.todolist_id desc')
				->limit(1)
				->execute('getSlaveRow');
		return $aRow;
	}
	public function getTodolist($iPage,$iLimit,$iCnt)
	{
		$aRows = $this->database()->select('*')
				->from(phpfox::getT('gettingstarted_todolist'))
				->limit($iPage,$iLimit,$iCnt)
				->execute('getSlaveRows');
		return $aRows;
	}

	public function getCountTodolist()
	{
		$iCount=(int)$this->database()->select('count(*)')
		->from(phpfox::getT('gettingstarted_todolist'))
		->execute('getSlaveField');
		return $iCount;
	}

	public function getTodolistById($iId)
	{
		$aRow=$this->database()->select('*')
		->from(phpfox::getT('gettingstarted_todolist'))
		->where('todolist_id='.$iId)
		->execute('getSlaveRow');
		return $aRow;
	}

	public function updateTodolist($aVals)
	{
		$aUpdates = array();
		$aUpdates['title'] = $aVals['title'];
		$aUpdates['description'] = $aVals['description'];
		$aUpdates['description_parsed'] = $aVals['description_parsed'];
		$this->database()->update(phpfox::getT('gettingstarted_todolist'),$aUpdates,'todolist_id='.$aVals['todolist_id']);
	}

	public function addpositiontodolist($aVals)
	{
		$aInsert=array();
		$aInsert['user_id']=Phpfox::getUserId();
		$aInsert['time_stamp']=PHPFOX_TIME;
		$aInsert['item_id']=$aVals['item_id'];
		$aInsert['active']='1';
		$this->database()->insert(phpfox::getT('gettingstarted_position'),$aInsert);
	}
	/*
	 *  Get step of todolist of one user having user_id
	 */
	public function getPosiontodolist($user_id)
	{
		$aRow=$this->database()->select('*')
		->from(phpfox::getT('gettingstarted_position'))
		->where('user_id='.$user_id)
		->execute('getSlaveRow');
		return $aRow;
	}

	public function deletepostiontodolist($iId)
	{
		$this->database()->delete(phpfox::getT('gettingstarted_position'),'position_id='.$iId);
	}

	public function updatepositiontodolist($aVals)
	{
		$aUpdate=array();
		$aUpdate['item_id']=$aVals['item_id'];
		$aUpdate['time_stamp']=PHPFOX_TIME;
		$this->database()->update(phpfox::getT('gettingstarted_position'),$aUpdate,'user_id='.$aVals['user_id']);
	}

	public function updatepositionactive($acvite,$user_id)
	{
		$aUpdate=array();
		$aUpdate['active']=$acvite;
		$aUpdate['time_stamp']=PHPFOX_TIME;
		$this->database()->update(phpfox::getT('gettingstarted_position'),$aUpdate,'user_id='.$user_id);
	}

	public function showTodoList()
	{
		$todolist="<script type='text/javascript'>
        function viewGettingStart()
        {
            $.ajaxCall('gettingstarted.getToDoListAlert');
            //tb_show('To do list',$.ajaxBox('gettingstarted.viewTodoList'),'height=360&width=550');
        }
        $(document).ready(function($) {
            viewGettingStart();
        });
        </script>";
		echo $todolist;
	}

}
?>
