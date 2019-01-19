<?php

namespace Drupal\shib_auth\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class LogoutController.
 *
 * @package Drupal\shib_auth\Controller
 */
class LogoutController extends ControllerBase {

  /**
   * Logout-- kills drupal then Redirects to shib logout page.
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function logout() {

    // Logs the current user out of drupal.
    user_logout();

    // Get shib config settings.
    $config = \Drupal::config('shib_auth.shibbolethsettings');
    // Get shib advanced config settings.
    $adv_config = \Drupal::config('shib_auth.advancedsettings');

    // The shib logout URL to redirect to.
    $logout_url = $config->get('shibboleth_logout_handler_url');

    // Append the return url if it is set in the admin.
    if ($adv_config->get('url_redirect_logout')) {
      $logout_url .= '?return=' . $adv_config->get('url_redirect_logout');
    }
    // Redirect to the shib logout page.
    return new RedirectResponse($logout_url);

  }

  /**
   * Logout error.
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function logoutError() {

    // Logs the current user out of drupal.
    user_logout();

    // Get shib config settings.
    $config = \Drupal::config('shib_auth.shibbolethsettings');

    // The shib logout URL to redirect to with drupal error appended.
    $logout_url = $config->get('shibboleth_logout_handler_url') . '?return=' . Url::fromRoute('shib_auth.logout_controller_logout_error_page')
      ->toString();

    // Redirect to the shib logout page.
    return new RedirectResponse($logout_url);

  }

  /**
   * Error page for logout.
   *
   * @return array
   */
  public function logoutErrorPage() {

    // Get shib advanced config settings.
    $adv_config = \Drupal::config('shib_auth.advancedsettings');

    return [
      '#type' => 'markup',
      '#markup' => $adv_config->get('logout_error_message'),
    ];
  }

}
