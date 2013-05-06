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

class Gettingstarted_component_controller_admincp_managetodolist extends Phpfox_Component{
    public function process()
    {
        if ($aDeleteIds = $this->request()->getArray('id'))
        {
            if (Phpfox::getService('gettingstarted.articlecategory')->deleteMultipleTodoList($aDeleteIds))
            {
            	
            	$this->url()->send('admincp.gettingstarted.managetodolist', null, Phpfox::getPhrase('gettingstarted.todo_list_successfully_deleted'));
            }
        }

//        $aSettings=phpfox::getService("gettingstarted.settings")->getSettings(0);

//        if(isset($aSettings['number_of_manage_mail'])==null)
//            $iLimit=10;
//        else
//            $iLimit=$aSettings['number_of_manage_mail'];
        $iLimit=10;
        $iPage = $this->request()->get("page");
        if(!$iPage)
            $iPage = 1;
        $iCnt=Phpfox::getService("gettingstarted.todolist")->getCountTodolist();
        $aCategories = Phpfox::getService('gettingstarted.todolist')->getTodolist($iPage,$iLimit,$iCnt);
        Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iLimit, 'count' => $iCnt));
        $this->template()
            ->assign(array(
                        'aCategories' => $aCategories,
                        'corepath' => phpfox::getParam("core.path"),
                    )
            )
            ->setHeader('cache', array(
                    'quick_edit.js' => 'static_script'
            )
        );
         $this->template()->setBreadCrumb(Phpfox::getPhrase('gettingstarted.manage_todo_lists'), $this->url()->makeUrl('admincp.gettingstarted.managetodolist'));
    }
}
?>

