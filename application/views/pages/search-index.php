<h1>Výsledky vyhledávání</h1>

<?if (isset($query)):?>
  <?if ($count):?>
    <p class="search-message correct"><?=___('search_message', $count, array (':query' => $query, ':count' => $count))?></p>
    
    <?foreach ($results as $result):?>
      <div>
        <h2><a href="<?=$result['link']?>"><?=$result['name']?></a></h2>
        <span><?=$result['link']?></span>
      </div>
    
    <?endforeach;?>
  <?else:?>
    <p class="search-message correct">Na hledanou frázi <strong>„<?=$query?>“</strong> nebyly nalezeny žádné výsledky.</p>
  <?endif;?>
<?endif;?>