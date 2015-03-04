<?php

namespace Drupal\titanquote\Service;


class QuoteFactory{
  public function __construct($dbquote, $localquote){
    $this->dbquote = $dbquote;

    $this->localquote = $localquote;
  }
  public function createCollection(){

    $config = \Drupal::config('titanquote.settings');

    $db_active = $config->get('database.active');

    $service = ($db_active ? $this->dbquote : $this->localquote);

    return $service;

  }
}