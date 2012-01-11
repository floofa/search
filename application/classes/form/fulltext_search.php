<?php defined('SYSPATH') or die('No direct script access.');

class Form_Fulltext_Search extends Forms
{
  public function build()
  {
    $this->_formo->view()->attr(array ('method' => 'get', 'action' => Route::url('search')));
    
    $this->add('q', 'input', 'hledat');
  }
  
  public function do_form($values = array (), $refresh = TRUE, $redirect = FALSE)
  {}
}