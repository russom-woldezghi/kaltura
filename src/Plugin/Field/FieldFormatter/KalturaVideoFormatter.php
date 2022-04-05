<?php

namespace Drupal\kaltura_media\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'Kaltura Video' formatter.
 *
 * @FieldFormatter(
 *   id = "kaltura_video_formatter",
 *   label = @Translation("Kaltura Video"),
 *   field_types = {
 *     "string"
 *   }
 * )
 */
class KalturaVideoFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t('Displays the Kaltura iframe.');
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {
      $properties = $this->parseURL($item->value);
      // Render each element as iframe.
      $element[$delta] = $this->generateIframe($properties);
    }

    return $element;
  }

  /**
   * Parse URL to get entity id and uiconfid from URL submitted.
   */
  private function parseurl($url) {
    $path = parse_url($url, PHP_URL_PATH);
    $values = explode('&', $path);

    $result[] = str_replace("/uiconfid", "", $values[0]);
    $result[] = str_replace("entryid=", "", $values[1]);
    /** @var array $result */
    return $result;
  }

  /**
   * Generates iframe from properties passed.
   *
   * @param array $properties
   *   Kaltura video values.
   *
   * @return array
   *   Returns iframe element for Drupal rendering.
   */
  private function generateIframe(array $properties) {
    $url = '//cdnapisec.kaltura.com/html5/html5lib/v2.82.2/mwEmbedFrame.php/p/1038472/uiconf_id/' . $properties[0] . '/entry_id/' . $properties[1] . '?wid=_1038472&iframeembed=true&playerId=kaltura_player&entry_id=' . $properties[1];
    return [
      '#type' => 'html_tag',
      '#tag' => 'iframe',
      '#attributes' => [
        'allowfullscreen' => '',
        'webkitallowfullscreen' => '',
        'mozallowfullscreen' => '',
        'src' => $url,
        'frameborder' => 0,
        'scrolling' => FALSE,
        'allowtransparency' => TRUE,
        'width' => '100%',
        'height' => '500px',
      ],
    ];

  }

}