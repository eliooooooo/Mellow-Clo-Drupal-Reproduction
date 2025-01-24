<?php

declare(strict_types=1);

namespace Drupal\mellow_clo_helper\Plugin\Block;

use Drupal;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Provides an user links block.
 */
#[Block(
  id: 'mellow_clo_helper_user_links',
  admin_label: new TranslatableMarkup('User links'),
  category: new TranslatableMarkup('Custom'),
)]
final class UserLinksBlock extends BlockBase implements ContainerFactoryPluginInterface {

  public function __construct(
    private readonly EntityTypeManagerInterface $entityTypeManager,
    private readonly AccountInterface $currentUser,
    private readonly UrlGeneratorInterface $urlGeneratorInterface,
    ) {}
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): UserLinksBlock {
    return new UserLinksBlock(
        $container->get('entity_type.manager'),
        $container->get('current_user'),
        $container->get('url_generator')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $build = [];

    $cartCount = $this->entityTypeManager->getStorage('node')->loadByProperties(
      ['type' => 'cart', 'field_cart_user' => $this->currentUser->id()]
    );
    $cartCount = array_pop($cartCount);

    $build['user_links_block'] = [
      '#theme' => 'mellow_clo_helper_user_links_block_theme',
      '#user_cart' => [
        'url' => '/cart',
        'count' => $cartCount ? $cartCount->get('field_cart_products')->count() : 0,
      ],
      '#user_account' => [
        'url' => '/user',
      ],
    ];

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account): AccessResult {
    // @todo Evaluate the access condition here.
    return AccessResult::allowedIf(TRUE);
  }

}
