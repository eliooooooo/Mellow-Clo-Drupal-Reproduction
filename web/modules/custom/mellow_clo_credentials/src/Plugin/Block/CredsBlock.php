<?php

declare(strict_types=1);

namespace Drupal\mellow_clo_credentials\Plugin\Block;

use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Provides a credentials block block.
 */
#[Block(
  id: 'mellow_clo_credentials_block',
  admin_label: new TranslatableMarkup('Credentials Block'),
  category: new TranslatableMarkup('Custom'),
)]
final class CredsBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $build['content'] = [
      '#markup' => $this->t('<p class="text-center container !mt-6">Identifiant: admin | Mot de passe: admin123</p>'),
    ];
    return $build;
  }

}
