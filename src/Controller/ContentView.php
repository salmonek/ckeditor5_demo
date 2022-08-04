<?php

namespace Drupal\ckeditor5_demo\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\State\State;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for Ckeditor5 demo routes.
 */
class ContentView extends ControllerBase {

  /**
   * @var \Drupal\Core\State\State
   */
  protected $drupalState;

  /**
   * @param \Drupal\Core\State\State $state
   */
  public function __construct(State $state) {
    $this->drupalState = $state;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('state')
    );
  }

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->drupalState->get('ckeditor5_demo.content'),
    ];

    return $build;
  }

}
