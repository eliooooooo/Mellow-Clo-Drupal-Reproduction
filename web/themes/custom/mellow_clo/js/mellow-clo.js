/**
 * @file
 * mellow_clo behaviors.
 */
(function (Drupal) {

  'use strict';

  Drupal.behaviors.mellowClo = {
    attach (context, settings) {

      console.log('It works!');

    }
  };

} (Drupal));

// Remove webform details errors
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('details[data-once="webform-details-save"]').forEach(function(element) {
    var parent = element.parentElement;
    if (parent) {
      parent.remove();
    }
  });
});
