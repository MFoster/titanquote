<?php

namespace Drupal\titanquote\Service;

class DatabaseQuoteCollection extends QuoteCollection 
{
    protected $dbal;

    protected $quotes = false; 
    public function __construct($dbal)
    {
        $this->dbal = $dbal;
    }
    
    protected function getQuotes($limit=50)
    {
    
        $select = $this->dbal->select('node');
        $select = $select->extend('Drupal\Core\Database\Query\PagerSelectExtender');
        $select->condition('type', 'titanquote', '=');
        $select->condition('status', 1, '=');
        $select->fields('nr', array('title'));
        $select->fields('nrb', array('body_value'));
        $select->fields('node', array('nid'));
        $select->groupBy('nrb.entity_id');
        $select->limit($limit);
        $select->join('node_field_revision', 'nr');
        $select->join('node_revision__body', 'nrb');
        
        return $select->execute();
    
    }

    public function setQuotes($quotes)
    {
      $arr = array();
      foreach($quotes as $quote){
        array_push($arr, array('author' => $quote->title, 'quote' => $quote->body_value));
      }
      parent::setQuotes($arr);
    }

    public function getRandom()
    {
      if($this->quotes == false){
        $this->setQuotes($this->getQuotes());
      }
      return parent::getRandom();
    }
}