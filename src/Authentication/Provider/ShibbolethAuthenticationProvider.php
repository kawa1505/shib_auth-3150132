<?php

/**
 * @file
 * Contains Drupal\shib_auth\Authentication\Provider\ShibbolethAuthenticationProvider.
 */

namespace Drupal\shib_auth\Authentication\Provider;

use Drupal\Core\Authentication\AuthenticationProviderInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Class ShibbolethAuthenticationProvider.
 *
 * @package Drupal\shib_auth\Authentication\Provider
 */
class ShibbolethAuthenticationProvider implements AuthenticationProviderInterface {
  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;
  /**
   * The entity manager.
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $entityManager;
  /**
   * Constructs a HTTP basic authentication provider object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   *   The entity manager service.
   */
  public function __construct(ConfigFactoryInterface $config_factory, EntityManagerInterface $entity_manager) {
    $this->configFactory = $config_factory;
    $this->entityManager = $entity_manager;
  }
  /**
   * {@inheritdoc}
   */
  public function applies(Request $request) {
    // If Authentication Provider is enabled always apply.
    return TRUE;
  }
  /**
   * {@inheritdoc}
   */
  public function authenticate(Request $request) {
    $consumer_ip = $request->getClientIp(TRUE);
    if (in_array($consumer_ip, $ips)) {
      // Return Anonymous user.
      return $this->entityManager->getStorage('user')->load(0);
    }
    else {
      throw new AccessDeniedHttpException();
    }
  }
  /**
   * {@inheritdoc}
   */
  public function cleanup(Request $request) {}
  /**
   * {@inheritdoc}
   */
  public function handleException(GetResponseForExceptionEvent $event) {
    $exception = $event->getException();
    if ($exception instanceof AccessDeniedHttpException) {
      $event->setException(new UnauthorizedHttpException('Invalid consumer origin.', $exception));
      return TRUE;
    }
    return FALSE;
  }

}
