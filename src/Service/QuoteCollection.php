<?php

namespace Drupal\titanquote\Service;

class QuoteCollection{

  protected $quotes = array();

  public function setQuotes($quotes){
    $this->quotes = $quotes;
  }

  public function getRandom() {
    $max = count($this->quotes) - 1;

    $index = floor(rand(0, $max));

    return $this->quotes[$index];
  }
}