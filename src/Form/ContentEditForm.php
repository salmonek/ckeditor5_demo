<?php

namespace Drupal\ckeditor5_demo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\State\State;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a Ckeditor5 demo form.
 */
class ContentEditForm extends FormBase {

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
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ckeditor5_demo_content_edit';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['content'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Edit content'),
      '#required' => FALSE,
      '#default_value' => $this->drupalState->get('ckeditor5_demo.content'),
      '#attributes' => [
        'id' => 'editor',
      ],
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];

    $form['#attached']['library'][] = 'ckeditor5_demo/ckeditor5';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::state()
      ->set('ckeditor5_demo.content', $form_state->getValue('content'));
    $form_state->setRedirect('ckeditor5_demo.view');
  }

}
