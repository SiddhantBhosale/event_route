<?php

 namespace Drupal\event_request\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Routing\RouteMatchInterface;

/**
 * MyEventSubcriber class to subscribe events.
 */
class MyEventSubscriber implements EventSubscriberInterface {
  protected $currentUser;
  protected $routeMatch;

  /**
   * Construtcor for initialising DI objects.
   */
  public function __construct(AccountProxyInterface $currentUser, RouteMatchInterface $routeMatch) {
    $this->currentUser = $currentUser;
    $this->routeMatch = $routeMatch;
  }

  /**
   * Request Event Subscribed.
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = ['redirectAnonymousUser'];
    return $events;
  }

  /**
   * Action on Kernel Request.
   */
  public function redirectAnonymousUser(GetResponseEvent $event) {
    global $base_url;
    // $var1=\Drupal::currentUser()->isAnonymous();
    // $var = $this->routeMatch->getRouteName();
    // kint($var);
    // kint($var);
    if ($this->currentUser->isAnonymous() &&
        $this->routeMatch->getRouteName() == 'event_routing.content') {
      $response = new RedirectResponse($base_url, 301);
      $event->setResponse($response);
      $event->stopPropagation();
      return;
    }
  }

}
