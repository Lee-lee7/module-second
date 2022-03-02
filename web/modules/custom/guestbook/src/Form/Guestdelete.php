<?php

namespace Drupal\guestbook\Form;

use Drupal\Core\Url;
use Drupal\file\Entity\File;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Generator\UrlGenerator;


class Guestdelete extends ConfirmFormBase {
  /**
   *
   * @var int
   */
  protected int $id;

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, int $id = NULL) : array {
    $this->id = $id;
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Database connection
    $database = \Drupal::database();
    // Delete an image from the database
    $result = $database->select('guestbook', 'g')
      ->fields('g', ['image'])
      ->condition('id', $this->id)
      ->execute()->fetch();
      if ($result->image) {
        File::load($result->image)->delete();
      }
    // Delete an avatar from the database
    $result = $database->select('guestbook', 'g')
      ->fields('g', ['avatar'])
      ->condition('id', $this->id)
      ->execute()->fetch();
      if ($result->avatar) {
        File::load($result->avatar)->delete();
      }
    // Delete a row from the database
    $database->delete('guestbook')
      ->condition('id', $this->id)
      ->execute();
     // Displays a successful removal message
    \Drupal::messenger()->addStatus('Succesfully deleted.');
    $form_state->setRedirect('guestbook.content');
  }

  /**
   * {@inheritdoc}
   */
  /*
  ID for delete form
  */
  public function getFormId() : string {
    return "guestbook_delete";
  }
  /**
   * {@inheritdoc}
   */
  /*
  Go to the main page of the form
  */
  public function getCancelUrl() : Url {
    return new Url('guestbook.content');
  }

  /**
   * {@inheritdoc}
   */

   /*
   Derivation of the modal form with the question of removal
   */
  public function getQuestion() {
    $database = \Drupal::database();
    $result = $database->select('guestbook', 'g')
      ->fields('g', ['name'])
      ->condition('id', $this->id)
      ->execute()->fetch();
    return $this->t('Do you want to delete "%r"?', ['%r' => $result->name]);
  }

}