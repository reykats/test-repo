<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = array (
  6 => 
  array (
    'menu_id' => '6',
    'parent_id' => '0',
    'm_connection' => 'main_right',
    'var_name' => 'menu_admincp',
    'disallow_access' => NULL,
    'module' => 'core',
    'url' => 'admincp',
    'module_is_active' => '1',
    'mobile_icon' => NULL,
  ),
  23 => 
  array (
    'menu_id' => '23',
    'parent_id' => '0',
    'm_connection' => 'main_right',
    'var_name' => 'menu_settings',
    'disallow_access' => 'a:1:{i:0;s:1:"3";}',
    'module' => 'user',
    'url' => 'user.setting',
    'module_is_active' => '1',
    'mobile_icon' => NULL,
    'children' => 
    array (
      0 => 
      array (
        'menu_id' => '31',
        'parent_id' => '23',
        'm_connection' => NULL,
        'var_name' => 'menu_user_account_settings_73c8da87d666df89aabd61620c81c24c',
        'disallow_access' => NULL,
        'module' => 'user',
        'url' => 'user.setting',
        'module_is_active' => '1',
      ),
      1 => 
      array (
        'menu_id' => '32',
        'parent_id' => '23',
        'm_connection' => NULL,
        'var_name' => 'menu_user_privacy_settings_73c8da87d666df89aabd61620c81c24c',
        'disallow_access' => NULL,
        'module' => 'user',
        'url' => 'user.privacy',
        'module_is_active' => '1',
      ),
      2 => 
      array (
        'menu_id' => '30',
        'parent_id' => '23',
        'm_connection' => NULL,
        'var_name' => 'menu_user_logout_4ee1a589029a67e7f1a00990a1786f46',
        'disallow_access' => 'a:1:{i:0;s:1:"3";}',
        'module' => 'user',
        'url' => 'user.logout',
        'module_is_active' => '1',
      ),
    ),
  ),
  54 => 
  array (
    'menu_id' => '54',
    'parent_id' => '0',
    'm_connection' => 'main_right',
    'var_name' => 'menu_recipe_recipes_972c97bdc47dfc8def0e74c55da0bbfd',
    'disallow_access' => NULL,
    'module' => 'recipe',
    'url' => 'recipe',
    'module_is_active' => '1',
    'mobile_icon' => NULL,
    'children' => 
    array (
      0 => 
      array (
        'menu_id' => '55',
        'parent_id' => '54',
        'm_connection' => NULL,
        'var_name' => 'menu_recipe_add_a_recipe_5d00ad2f33769452cd7eb260698db4c8',
        'disallow_access' => NULL,
        'module' => 'recipe',
        'url' => 'recipe.add',
        'module_is_active' => '1',
      ),
    ),
  ),
); ?>