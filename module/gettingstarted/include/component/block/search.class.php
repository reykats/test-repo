<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class gettingstarted_component_block_search extends Phpfox_Component{
    public function process()
    {
        $this->template()->assign(array(
           'sHeader' => 'Search Filter',
        ));
        return 'block';
    }
}
?>
