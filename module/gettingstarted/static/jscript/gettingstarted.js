/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function viewNextTodoList()
{
    var iId=$('#todolist_id').val();
    $.ajaxCall("gettingstarted.viewNextTodoList",'id='+iId);
}

function viewPreTodoList()
{
    var iId=$('#todolist_id').val();
    $.ajaxCall("gettingstarted.viewPreTodoList",'id='+iId);
}

function doneTodoList()
{
    $.ajaxCall("gettingstarted.doneTodoList");
}