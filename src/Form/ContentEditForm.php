<?php

namespace Drupal\ckeditor5_demo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Ckeditor5 demo form.
 */
class ContentEditForm extends FormBase {

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
      '#default_value' => \Drupal::state()->get('ckeditor5_demo.content'),
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
    \Drupal::state()->set('ckeditor5_demo.content', $form_state->getValue('content'));
    $form_state->setRedirect('ckeditor5_demo.view');
  }

}
