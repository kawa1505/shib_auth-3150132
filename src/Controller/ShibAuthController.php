<?php

/**
 * @file
 * Contains Drupal\shib_auth\Controller\ShibAuthController.
 */

namespace Drupal\shib_auth\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ShibAuthController.
 *
 * @package Drupal\shib_auth\Controller
 */
class ShibAuthController extends ControllerBase {
  /**
   * Index.
   *
   * @return string
   *   Return Hello string.
   */
  public function index() {
    return [
        '#type' => 'markup',
        '#markup' => $this->t('Implement method: index')
    ];
  }

}
