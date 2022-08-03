<?php

namespace Drupal\ckeditor5_demo\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;

/**
 * Returns responses for Ckeditor5 demo routes.
 */
class ContentView extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => \Drupal::state()->get('ckeditor5_demo.content'),
    ];
    $build['edit'] = [
      '#type' => 'item',
      '#markup' => Link::createFromRoute('Edit', 'ckeditor5_demo.content_edit')->toString(),
    ];

    return $build;
  }

}
