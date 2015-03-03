<?php

namespace Drupal\titanquote\Controller;

use Drupal\Core\Controller\ControllerBase;

class DefaultController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function quoteAction() {
     return array(
      '#type' => 'markup',
      '#markup' => t('He who dares to teach must never cease to learn.'),
    );
  }

}