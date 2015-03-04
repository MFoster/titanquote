<?php

namespace Drupal\titanquote\Controller;

use Drupal\Core\Controller\ControllerBase;

class DefaultController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function quoteAction() {
    
    $service = \Drupal::service('titan.quote');
    
    $quote = $service->getRandom();

    return array(
      '#type' => 'markup',
      '#markup' => '<p>' . $quote['quote'] . '</p><author>' . $quote['author'] .'</author>',
    );
  }

}