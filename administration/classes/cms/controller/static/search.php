<?php defined('SYSPATH') or die('No direct script access.');

class Cms_Controller_Static_Search extends Cms_Controller_Static
{
  protected $_folder = 'search';
  
  /**
  * main menu
  */
  public function action_regenerate()
  {
    Database::instance()->query(Database::DELETE, 'TRUNCATE TABLE ' . ORM::factory('search')->table_name());
    
    // pages
    foreach (ORM::factory('page')->where('cms_status', '=', 1)->find_all() as $page) {
      $item = array (
        'name' => $page->head_title,
        'content' => strip_tags($page->content),
        'link' => URL::site($page->rew_id, TRUE, FALSE),
        'type' => 'page',
        'model_id' => $page->id,
      );
      
      ORM::factory('search')->values($item)->save();
    }
  }
}