<?php

/**
 * @file
 * Contains Drupal\shib_auth\Tests\ShibAuthController.
 */

namespace Drupal\shib_auth\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the shib_auth module.
 */
class ShibAuthControllerTest extends WebTestBase {
  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "shib_auth ShibAuthController's controller functionality",
      'description' => 'Test Unit for module shib_auth and controller ShibAuthController.',
      'group' => 'Other',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests shib_auth functionality.
   */
  public function testShibAuthController() {
    // Check that the basic functions of module shib_auth.
    $this->assertEqual(TRUE, TRUE, 'Test Unit Generated via App Console.');
  }

}
