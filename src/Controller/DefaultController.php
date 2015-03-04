<?php

namespace Drupal\titanquote\Controller;

use Drupal\Core\Controller\ControllerBase;

class DefaultController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function quoteAction() {
  	$config = \Drupal::config('titanquote.settings');

  	$db_active = $config->get('database.active');

    $service = ($db_active ? \Drupal::service('titan.quote.database') : \Drupal::service('titan.quote.local'));

  	$quote = $service->getRandom();
		return array(
			'#type' => 'markup',
			'#markup' => '<p>' . $quote['quote'] . '</p><author>' . $quote['author'] .'</author>',
		);
  }

}