<?php

namespace Drupal\guestbook\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\MessageCommand;
use Drupal\Core\Ajax\RemoveCommand;
use Drupal\Core\Ajax\CloseModalDialogCommand;


class Guestedit extends Guestform {
  /**
   *
   * @var int
   */
  protected object $review;
  /**
   * {@inheritdoc}
   */

   /*
  ID for edit form
  */
  public function getFormId() : string {
    return "guestbook_edit";
  }


    /*
    Build edit form already with available data from the database.
    */
  public function buildForm(array $form, FormStateInterface $form_state, int $id = NULL): array {
    // Database connection
    $database = \Drupal::database();
    $result = $database->select('guestbook', 'g')
      ->fields('g', ['id', 'name', 'email','phone','text','avatar','image'])
      ->condition('id', $id)
      ->execute()->fetch();
    $this->review = $result;
    $form = parent::buildForm($form, $form_state);
    //Output result from database.
    $form['name']['#default_value'] = $result->name;
    $form['name']['#prefix'] = '<div class="error-massage-modal"></div>';
    $form['email']['#default_value'] = $result->email;
    $form['email']['#prefix'] = '<div class="error-massage-modal"></div>';
    $form['phone']['#default_value'] = $result->phone;
    $form['phone']['#prefix'] = '<div class="error-massage-modal"></div>';
    $form['text']['#default_value'] = $result->text;
    $form['text']['#suffix'] = '<div class="email-massage-modal"></div>';
    if ($result->avatar) {
      $form['avatar']['#default_value'][] = $result->avatar;
    }
    if ($result->image) {
      $form['image']['#default_value'][] = $result->image;
    }
    $form['submit']['#value'] = $this->t('Edit feedback');
    return $form;
  }


  /*
  Email validation
  */
  public function emailValidator(array &$form, FormStateInterface $form_state): AjaxResponse {
    $response = new AjaxResponse();
    $input = $form_state->getValue('email');
    $regex = '/^[A-Za-z_\-]+@\w+(?:\.\w+)+$/';
    //Modal messsage if the email complies with the rules
    if (preg_match($regex, $input)) {
      $response->addCommand(new MessageCommand(
        $this->t('Email valid'),
        '.email-massage-modal'));
    }
    //Modal messsage if the email don't complies with the rules
    else {
      $response->addCommand(new MessageCommand(
        $this->t('E-mail name can only contain latin characters, hyphens and underscores.'),
        '.email-massage-modal', ['type' => 'error']));
    }
    //Modal messsage if the email field is empty
    if (empty($input)) {
      $response->addCommand(new RemoveCommand('.email-massage-modal .messages--error'));
    }
    return $response;
  }

  // Submit edit form.
  public function submitAjax(array &$form, FormStateInterface $form_state): AjaxResponse {
    $response = new AjaxResponse();
    // Modal message about errors in form
    if ($form_state->getErrors()) {
      foreach ($form_state->getErrors() as $err) {
        $response->addCommand(new MessageCommand(
          $err, '.error-massage-modal', ['type' => 'error']));
      }
      $form_state->clearErrors();
    }
    // Modal message about successful data change.
    else {
      $response->addCommand(new MessageCommand(
        $this->t('Feedback information changed successfully.'),
        NULL,
        ['type' => 'status'],
        TRUE));
      $response->addCommand(new CloseModalDialogCommand());
    }
    $this->messenger()->deleteAll();
    return $response;
  } 
  

  /**
   * {@inheritdoc}
   */
  // Submit updated form
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $avatar = NULL;
    $image = NULL;

 
    if ($form_state->getValue('avatar')[0] && $form_state->getValue('avatar')[0] != $this->response->avatar) {
      $avatar = $form_state->getValue('avatar')[0];
      $file = File::load($avatar);
      $file->setPermanent();
      $file->save();
    }
    elseif ($form_state->getValue('avatar')[0]) {
      $avatar = $this->response->avatar;
    }
    elseif ($this->response->avatar) {
      File::load($this->response->avatar)->delete();
    }

   
    if ($form_state->getValue('image')[0] && $form_state->getValue('image')[0] != $this->response->image) {
      $image = $form_state->getValue('image')[0];
      $file = File::load($image);
      $file->setPermanent();
      $file->save();
    }
    elseif ($form_state->getValue('image')[0]) {
      $image = $this->response->image;
    }
    elseif ($this->response->image) {
      File::load($this->response->image)->delete();
    }

    // Create an array of data to update.
    $updated = [
      'name' => $form_state->getValue('name'),
      'email' => $form_state->getValue('email'),
      'phone' => $form_state->getValue('phone'),
      'text' => $form_state->getValue('text'),
      'avatar' => $avatar,
      'image' => $image,
    ];

    // Database connection
    $database = \Drupal::database();
    // Update changed fields
    $database->update('guestbook')
      ->condition('id', $this->review->id)
      ->fields($updated)
      ->execute();

  
  }
 
}
