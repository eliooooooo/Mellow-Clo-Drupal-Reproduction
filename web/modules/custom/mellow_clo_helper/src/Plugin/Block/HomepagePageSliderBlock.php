<?php

declare(strict_types=1);

namespace Drupal\mellow_clo_helper\Plugin\Block;

use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Provides a homepage page slider block block.
 */
#[Block(
  id: 'homepage_page_sliderblock',
  admin_label: new TranslatableMarkup('Homepage Page Slider Block'),
  category: new TranslatableMarkup('Custom'),
)]
final class HomepagePageSliderBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Constructs the plugin instance.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    private readonly EntityTypeManager $entityTypeManager,
    private readonly UrlGeneratorInterface $urlGenerator,
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): self {
    return new self(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager'),
      $container->get('url_generator'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $nodes = $this->entityTypeManager->getStorage('node')->loadByProperties(
      ['type' => 'slider']
    );

    $slides = [];
    foreach ($nodes as $node) {
      if ($node->hasField('field_slider_image') && !$node->get('field_slider_image')->isEmpty()) {
        $media_entity = $node->get('field_slider_image')->entity;
        if ($media_entity && $media_entity->hasField('field_media_image') && !$media_entity->get('field_media_image')->isEmpty()) {
          $file_entity = $media_entity->get('field_media_image')->entity;
          if ($file_entity) {
            $image_url = \Drupal::service('file_url_generator')->generateAbsoluteString($file_entity->getFileUri());
            $slides[] = [
              'title' => $node->getTitle(),
              'image' => $image_url,
              'link' => $node->get('field_slider_link')->first()->getUrl()->toString(),
            ];
          }
        }
      }
    }

    $build['content'] = [
      '#theme' => "mellow_clo_homepage_page_sliderblock",
      '#slides' => $slides
    ];

    return $build;
  }

}
