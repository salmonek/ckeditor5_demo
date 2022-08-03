<?php

namespace Drupal\ckeditor5_demo\Form;

use Drupal\Core\Asset\LibraryDiscovery;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Configure Ckeditor5 demo settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $libraryDiscovery;

  /**
   * @param \Drupal\Core\Session\AccountInterface $current_user
   */
  public function __construct(LibraryDiscovery $library_discovery) {
    $this->libraryDiscovery = $library_discovery;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('library.discovery')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ckeditor5_demo_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['ckeditor5_demo.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $description = $this->t('Enter url for ckeditor.js (CKEditor 5). You can find one at');
    $description .= ' <a href="https://cdn.ckeditor.com/" target="_blank">https://cdn.ckeditor.com/</a><br />';
    $description .= $this->t('Empty value will fallback to v34.0.0');
    $form['cdn_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('CDN Url'),
      '#default_value' => $this->config('ckeditor5_demo.settings')->get('cdn_url'),
      '#description' =>  $description,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('ckeditor5_demo.settings')
      ->set('cdn_url', $form_state->getValue('cdn_url'))
      ->save();
    // Clear library definitions so it can be rebuilt with new file from CDN.
    $this->libraryDiscovery->clearCachedDefinitions();
    parent::submitForm($form, $form_state);
  }

}
