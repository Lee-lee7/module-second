<?php
namespace Drupal\guestbook\Form;
use Drupal\Core\Form\mysql;
use Drupal\file\Entity\File;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\MessageCommand;
use Drupal\Core\Messenger\Messenger;


class Guestform extends FormBase {
  /**
   * {@inheritdoc}
   */
  // ID form
  public function getFormId(): string {
        return 'guestbook_form';
  } 

  // Build a form with such fields:
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your name:'),
      '#placeholder' => $this->t("min 2 ---- max 100 symbols"),
      '#required' => TRUE,
    ];
    $form['email'] = [
      '#title' => 'Your email:',
      '#type' => 'email',
      '#required' => TRUE,
      '#placeholder' => $this->t('Email can only contain Latin letters, "_" or "-" '),
      '#ajax' => [
        'callback' => '::validateEmailAjax',
        'event' => 'change',
        'progress' => array(
          'type' => 'throbber',
          'message' => t('Verifying email..'),
        ),
      ],
      '#attached' => [
        'library' => [
          'guestbook/ajax-patch',
        ],
      ],
      '#suffix' => '<div class="email-validation-message"></div>'
    ];
    $form['phone'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Your phone:'),
        '#pattern' => '[+](380)\(\d{2}\)-\d{3}-\d{2}-\d{2}',
        '#placeholder' => $this->t("+380(99)-000-00-00"),
        '#required' => TRUE,
        '#attached' => [
          'library' => [
            'guestbook/inputmask',
          ],
        ],
        '#attributes' => [
          'data-inputmask' => "'mask': '+380(99)-999-99-99'",
        ],
    ];
    $form['text'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Your feedback:'),
        '#placeholder' => $this->t("You can write your feedback here"),
        '#required' => TRUE,
    ];
    $form['avatar'] = [
        '#type' => 'managed_file',
        '#title' => 'Add avatar:',
        '#name' => 'avatar',
        '#description' => $this->t('jpg, png, jpeg <br> max-size: 2MB'),
        '#upload_validators' => [
          'file_validate_extensions' => array('png jpg jpeg'),
          'file_validate_size' => array(2097152)
        ],
        '#upload_location' => 'public://images/avatar/'
      ];
    $form['image'] = [
      '#type' => 'managed_file',
      '#title' => 'Add image:',
      '#name' => 'image',
      '#description' => $this->t('jpg, png, jpeg <br> max-size: 5MB'),
      '#upload_validators' => [
        'file_validate_extensions' => array('png jpg jpeg'),
        'file_validate_size' => array(5242880),
      ],
      '#upload_location' => 'public://images/image/'
    ];
   
    $form['actions']['#type'] = 'actions';
   
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add feedback'),
      '#button_type' => 'primary',
      '#ajax' => [
        'event' => 'click',
        'progress' => 'none',
        'callback' => '::submitAjax',
      ],
    ];
    return $form; 
  }
   // Submit form with Ajax.
  public function submitAjax(array &$form, FormStateInterface $form_state): AjaxResponse {
    $response = new AjaxResponse();
    // Modal message about errors in form
    if ($form_state->getErrors()) {
      foreach ($form_state->getErrors() as $err) {
        $response->addCommand(new MessageCommand($err, NULL, ['type' => 'error']));
      }
      $form_state->clearErrors();
    }
    // Modal message about successful data save.
    else {
      $response->addCommand(new MessageCommand($this->t('Your feedback has been saved successfully.'), NULL, ['type' => 'status'], TRUE));
      $form_state->setRebuild(TRUE);
    }
    $this->messenger()->deleteAll();
    return $response;
  }


  // Validate form
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Modal message if the name has less than two characters
    if (strlen($form_state->getValue('name')) < 2 ) {
      $form_state->setErrorByName('name', $this->t('Name is too short.'));
    }
    // Modal message if the name has more than one hundred characters
    if (strlen($form_state->getValue('name')) > 100){
      $form_state->setErrorByName('name', $this->t('Name is too long.'));
    }
  }
   /*
  Email validation
  */
  public function validateEmailAjax(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $input = $form_state->getValue('email');
    $regex = '/^[A-Za-z_\-]+@\w+(?:\.\w+)+$/';
    //Modal messsage if the email complies with the rules
    if (preg_match($regex, $input)) {
    $response->addCommand(new MessageCommand(t('Email valid')));
    }
     //Modal messsage if the email don't complies with the rules
    else {
    $response->addCommand(new MessageCommand(t('E-mail name can only contain latin characters, hyphens and underscores.'), NULL, ['type' => 'error']));
    }
    return $response;
  }

  // Submit form
  public function submitForm(array &$form, FormStateInterface $form_state) {
      $image = $form_state->getValue('image');
      $avatar = $form_state->getValue('avatar');
      //If the image is uploaded, save it in the database
      if ($image) {
          $file = File::load($image[0]);
          $file->setPermanent();
          $file->save();
      }
      //If the avatar is uploaded, save it in the database
      if ($avatar) {
          $file = File::load($avatar[0]);
          $file->setPermanent();
          $file->save();
      }
      // Database connection
      $database = \Drupal::database();
      $database->insert('guestbook')
      ->fields([
      'name' => $form_state->getValue('name'),
      'email' => $form_state->getValue('email'),
      'phone' => $form_state->getValue('phone'),
      'text' => $form_state->getValue('text'),
      'avatar' => $avatar[0],
      'image' => $image[0],
     // 'timestamp' => date('Y-m-d h:m:s'),
  
      ])
        ->execute();
    }

  }