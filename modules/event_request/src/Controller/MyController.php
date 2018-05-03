<?php

 namespace Drupal\event_request\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for content.
 */
class MyController extends ControllerBase {

  /**
   * Content to be displyed.
   */
  public function content() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('This is restricted content.'),
    ];
  }

}
