<?php defined('SYSPATH') or die('No direct access allowed.');

return array
(
  'events' => array (
    'daily' => array (
      'regenerate_search' => array ('route' => 'default', 'params' => array ('controller' => 'static_search', 'action' => 'regenerate')),
    ),
  ),
);
