<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = array (
  0 => 
  array (
    'share_id' => '2',
    'product_id' => 'phpfox',
    'module_id' => 'photo',
    'title' => '{phrase var=\'photo.photo\'}',
    'description' => '{phrase var=\'photo.say_something_about_this_photo\'}',
    'block_name' => 'share',
    'no_input' => '0',
    'is_frame' => '1',
    'ajax_request' => NULL,
    'no_profile' => '0',
    'icon' => 'photo.png',
    'ordering' => '1',
    'module_block' => 'photo.share',
  ),
  1 => 
  array (
    'share_id' => '1',
    'product_id' => 'phpfox',
    'module_id' => 'link',
    'title' => '{phrase var=\'link.link\'}',
    'description' => '{phrase var=\'link.say_something_about_this_link\'}',
    'block_name' => 'share',
    'no_input' => '0',
    'is_frame' => '0',
    'ajax_request' => 'addViaStatusUpdate',
    'no_profile' => '0',
    'icon' => 'link.png',
    'ordering' => '3',
    'module_block' => 'link.share',
  ),
); ?>