<?php defined('SYSPATH') or die('No direct script access.');

Route::set('search', 'hledat(/<type>)')
  ->defaults(array(
    'controller' => 'search',
    'action' => 'index',
));


