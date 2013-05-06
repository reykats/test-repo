<?php
/**
 *
 *
 * @copyright        [YouNet_COPYRIGHT]
 * @author           YouNet Company
 * @package          Module_GettingStarted
 * @version          2.01
 */

defined('PHPFOX') or exit('NO DICE!');

class gettingstarted_Component_Ajax_Ajax extends Phpfox_Ajax
{
	public function updateScheduledActivity()
	{

		if (Phpfox::getService('gettingstarted.process')->updateActivity($this->get('id'), $this->get('active')))
		{

		}
	}

	public function loadCategory()
	{
		$category=$this->get('category');
		$aRow_category=Phpfox::getService("gettingstarted")->getAllCategoryMailId($category);
		if(count($aRow_category)>0)
		{
			$des = phpfox::getPhrase($aRow_category['description']);
			$this->html('#div_settings_category',$des) ;
		}
		$this->html('#loading','');
	}

	public function viewTodoList()
	{
		Phpfox::getBlock("gettingstarted.todolist");
	}

	public function viewNextTodoList()
	{
		$iId=$this->get("id");

		$FirstTodoList = Phpfox::getService('gettingstarted.todolist')->getFirstLinetodolist($iId);
		//$FirstTodoList = Phpfox::getService('gettingstarted.todolist')->getCurrentPositionOfUser(Phpfox::getUserId());
		$SecondTodoList = Phpfox::getService('gettingstarted.todolist')->getFirstLinetodolist($FirstTodoList['todolist_id']);
		$preTodoList = Phpfox::getService('gettingstarted.todolist')->getPreTodolist($FirstTodoList['todolist_id']);
		$aVals = array();
		$aVals['item_id']=$FirstTodoList['todolist_id'];
		$aVals['user_id']=phpfox::getUserId();
		Phpfox::getService('gettingstarted.todolist')->updatepositiontodolist($aVals);
		if(count($SecondTodoList)==0)
		{
			$this->html('#nexttodolist','');
			$done_html ='<a href="javascript:void(0);" onclick="doneTodoList(); return false;" ><input type="button" class="button" value="'.Phpfox::getPhrase('gettingstarted.done').'" onclick="tb_remove();"/></a>';
			$this->html('#donetodolist', $done_html);
			$this->html('#closetodolist', '');
		}
		if(count($preTodoList) != 0)
		{
			$pre_html ='<a href="javascript:void(0);" onclick="javascript:viewPreTodoList();return false;" ><input type="button" class="button" value="'.Phpfox::getPhrase('gettingstarted.previous').'"/></a>';
			$this->html('#pretodolist', $pre_html);		
		}
		$this->call("$('#todolist_id').val(".$FirstTodoList['todolist_id'].");");
		$this->html('#title_todolist',$FirstTodoList['title']);
		$this->html('#description_todolist', $FirstTodoList['description_parsed']);
		 
	}

	public function viewPreTodoList()
	{
		$iId=$this->get("id");
		$FirstTodoList = Phpfox::getService('gettingstarted.todolist')->getPreTodolist($iId);
		//$FirstTodoList = Phpfox::getService('gettingstarted.todolist')->getCurrentPositionOfUser(Phpfox::getUserId());
		$SecondTodoList = Phpfox::getService('gettingstarted.todolist')->getPreTodolist($FirstTodoList['todolist_id']);
		$nextTodoList = Phpfox::getService('gettingstarted.todolist')->getFirstLinetodolist($FirstTodoList['todolist_id']);
		$aVals=array();
		$aVals['item_id'] = $FirstTodoList['todolist_id'];
		$aVals['user_id'] = phpfox::getUserId();
		Phpfox::getService('gettingstarted.todolist')->updatepositiontodolist($aVals);
		if(count($SecondTodoList)==0)
		{
			$this->html('#pretodolist','');
		}
		if(count($nextTodoList) != 0)
		{
			$html = '<input type="button" class="button" value="Close"  onclick="tb_remove();" />';
			$this->html('#closetodolist', $html);
			$this->html('#donetodolist', '');
			$next_html = '<a href="javascript:void(0);" onclick="viewNextTodoList(); return false;" ><input type="button" class="button" value="'.Phpfox::getPhrase('gettingstarted.next').'"/></a>';
			$this->html('#nexttodolist', $next_html);
			
		}
		$this->call("$('#todolist_id').val(".$FirstTodoList['todolist_id'].");");
		$this->html('#title_todolist',$FirstTodoList['title']);
		$this->html('#description_todolist', $FirstTodoList['description_parsed']);
		 
	}
	
	public function doneTodoList()
	{
		$active = 0;
		Phpfox::getService("gettingstarted.todolist")->updatepositionactive($active, Phpfox::getUserId());
	}
	public function updateCheckboxTodolist()
	{
		$active=$this->get('active');
		Phpfox::getService("gettingstarted.todolist")->updatepositionactive($active,Phpfox::getUserId());
	}

	public function getToDoListAlert()
	{
		$todolist="tb_show('".Phpfox::getPhrase('gettingstarted.todo_list')."',$.ajaxBox('gettingstarted.viewTodoList'),'height=400&width=600');";
		$alogin = Phpfox::getService("gettingstarted")->getLastestTypeId(phpfox::getUserId(),"login");
		$kq=1;
		if(count($alogin)>0)
		{
			$time_login = $alogin['time_stamp'];
			$PositionTodoList = Phpfox::getService("gettingstarted.todolist")->getPosiontodolist(Phpfox::getUserId());
			if(count($PositionTodoList)>0)
			{

				if($PositionTodoList['active']==0)
				{
					$kq = 0;
					exit;
				}

				$currentTodoList = Phpfox::getService('gettingstarted.todolist')->getCurrentPositionOfUser(Phpfox::getUserId());
				if(count($currentTodoList)==0)
				{
				//	$kq=0;
				//	exit;
				}
				 
				if($time_login>$PositionTodoList['time_stamp'])
				{
					$kq=1;
				}
				else
				$kq=0;
			}
			else
			{
				$kq=1;
				$FirstTodoList=Phpfox::getService('gettingstarted.todolist')->getFirstLinetodolist(0);
				if(count($FirstTodoList) == 0)
				{
					$kq = 0;
					exit;
				}
			}
		}
		if(Phpfox::isUser()==1 && Phpfox::isAdmin()==0 && $kq==1)
		{
			echo $todolist;
		}
	}
}

?>
