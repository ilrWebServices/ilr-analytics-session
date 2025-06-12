<?php

namespace Drupal\ilr_analytics_session\Hook;

use Drupal\Core\Hook\Attribute\Hook;
use Drupal\Core\Render\BubbleableMetadata;

class TokenHooks {

  #[Hook('token_info')]
  public function tokenInfo(): array {
    $info = [];
    $info['tokens']['site']['analytics_session_id'] = [
      'name' => 'Analytics session id',
      'description' => 'A session ID for the current analytics implementation (often GA4).'
    ];
    return $info;
  }

  #[Hook('tokens')]
  public function tokens($type, $tokens, array $data, array $options, BubbleableMetadata $bubbleable_metadata): array {
    $replacements = [];
    if ($type === 'site' && !empty($tokens['analytics_session_id'])) {
      $replacements['[site:analytics_session_id]'] = \Drupal::service('ilr_analytics_session_manager')->getClientId();
    }
    return $replacements;
  }

}
