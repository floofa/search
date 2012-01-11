<?php defined('SYSPATH') or die('No direct script access.');

class Cms_Controller_Search extends Cms_Controller_Builder_Template_Application
{
  protected $_type = FALSE;
  
  public function action_index()
  {
    Head::set('head_title', 'Výsledky vyhledávání');
    Navigation::add('Výsledky vyhledávání', Request::initial_url());
    
    $query = $this->request->query('q');
    
    if (strlen($query)) {
      $count = ORM::factory('search')->count_results($query, $this->_type);
      $results = ORM::factory('search')->find_results($query, $this->_type);
      
      $this->_view->query = $query;
      $this->_view->count = $count;
      $this->_view->results = $results;
      $this->_view->type = $this->_type;
    }
  }
}
