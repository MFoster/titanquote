<?php

namespace Drupal\titanquote\Service;

class DatabaseQuoteCollection
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

    protected function setQuotes($quotes)
    {
    	$arr = array();
    	foreach($quotes as $quote){
    		array_push($arr, array('author' => $quote->title, 'quote' => $quote->body_value));
    	}
    	$this->quotes = $arr;
    }

    public function getRandom()
    {
    	if($this->quotes == false){
    		$this->setQuotes($this->getQuotes());
    	}

			$max = count($this->quotes) - 1;

			$index = floor(rand(0, $max));

			return $this->quotes[$index];
    }
}