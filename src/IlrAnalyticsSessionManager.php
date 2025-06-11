<?php

namespace Drupal\ilr_analytics_session;

use Symfony\Component\HttpFoundation\RequestStack;

class IlrAnalyticsSessionManager {

  public function __construct(
    protected RequestStack $requestStack
  ) {}

  /**
   * Get the Google Client ID from a cookie, if possible.
   *
   * @return string
   *   A parsed client ID from the `_ga` cookie, or empty string if not found.
   */
  public function getClientId(): string {
    $cookies = $this->requestStack->getCurrentRequest()->cookies;

    foreach ($cookies as $name => $value) {
      if ($name === '_ga') {
        return preg_replace('/^GA\d{1}\.\d{1}\./', '', $value);
      }
    }

    return '';
  }

}
