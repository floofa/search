<?php defined('SYSPATH') or die('No direct access allowed.');

class Cms_Model_Search extends ORM 
{
  protected $_table_names_plural = FALSE;
  
  public function count_results($query = '', $type = FALSE)
  {
    if ( ! strlen($query))
      return 0;
      
    return $this->find_results($query, $type, FALSE, FALSE, TRUE);
  }
  
  public function find_results($query, $type = FALSE, $limit = FALSE, $offset = FALSE, $count_results = FALSE) 
  {
    $db = Database::instance();

    // podminka pro vyhledani slov kratsich jak ft_min_word_len (4 znaky)
    preg_match_all("~[\\pL\\pN_]+('[\\pL\\pN_]+)*~u", stripslashes($query), $matches);
    
    $where = '';
    $type_where = '';
    
    if ($type) {
      $type_where = $where = ' AND type = \'' . $type . '\'';
    }
    
    // vyhledavani pro mene nez 4 znaky
    foreach ($matches[0] as $part)  {
      if (iconv_strlen($part, "utf-8") < 4 && iconv_strlen($part, "utf-8") > 2) {
        $regexp = "REGEXP '[[:<:]]" . addslashes($part) . "[[:>:]]'";
        $where .= " OR ((name $regexp OR content $regexp)" . ((strlen($type_where)) ? $type_where : "") . ")";
      }
    }
    
    $query = $db->escape(trim($query . '*'));
    $select = ($count_results) ? 'count(*) as total' : '*';

    $res = $db->query(Database::SELECT, 'SELECT ' . $select . ' FROM ' . $this->_table_name . ' WHERE MATCH(name, content) AGAINST ('.$query.' IN BOOLEAN MODE) ' . (($where) ? $where : '') . '  ORDER BY 1000 * MATCH(name) AGAINST ('.$query.') + 50 * MATCH(content) AGAINST ('.$query.') DESC' . (($limit) ? ' LIMIT ' . $limit : '') . (($offset) ? ' OFFSET ' . $offset : ''));
    
    if ($count_results) {
      if (count($res)) {
        $rows = $res->as_array();
        return $rows[0]['total'];
      }
      
      return 0;
    }
    
    $res = $res->as_array();
    
    return $res;
  }
}