<?php
/**
 * @file
 * Contains \Drupal\guestbook\Controller\GuestController.
 */
namespace Drupal\guestbook\Controller;

use Drupal\file\Entity\File;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\Routing\Generator\UrlGenerator;

class GuestController extends ControllerBase {

  public function build(): array {
    $form = \Drupal::formBuilder()->getForm('Drupal\guestbook\Form\Guestform');
  /*
  Construction of form and table
  */
    $header_title = [
      'avatar' => t('Avatar'),
      'name' => t('Name'),
      'timestamp' => t('Date and time'),
      'text' => t('Feedback'),
      'image' => t('Image'),
      'phone' => t('Phone'),
      'email' => t('Email'),
    ];
    $reviews['table'] = [
      '#type' => 'table',
      '#header' => $header_title,
      '#rows' => $this->getReview(),
    ];
    /*
    Build form with css style
    */
    $build['content'] = [
      '#form' => $form,
      '#theme' => 'guestbook-theme',
      '#attached' => [
        'library' => [
          'guestbook/guestbook-css',
        ],
      ],
      '#reviews' => $reviews,
      '#text' => $this
        ->t('Hello! You can add here a photo of your cat.'),
    ]; 
    return $build;
  }

  /*
  Output of information (fields) from the database
  */
  public function getReview(): array {
    // Database connection
    $database = \Drupal::database();
    $result = $database->select('guestbook', 'g')
      ->fields('g', ['id','name', 'email', 'phone', 'text', 'avatar', 'image', 'timestamp'])
      ->orderBy('id', 'DESC')
      ->execute();
    $reviews = [];
    foreach ($result as $review) {
     $avatar = NULL;
      /**
       * A variable that stores the ID of the image added to the response,
       * if available.
       *
       * @var int
       */
      $image = NULL;

      // Check for avatar ID.
      if ($review->avatar != $avatar) {
        $avatar = File::load($review->avatar)->createFileUrl(false);
      }

      // Check the image for feedback ID.
      if ($review->image != $image) {
        $image = File::load($review->image)->createFileUrl(false);
      }
   

      $reviews[] = [
        'id' => $review->id,
        'name' => $review->name,
        'email' => $review->email,
        'phone' => $review->phone,
        'text' => $review->text,
        'avatar' => $avatar,
        'image' => $image,
        'timestamp' => $review->timestamp,
      ];
    }
    return $reviews;
  }

}


