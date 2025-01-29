// import Swiper bundle with all modules installed
import Swiper from 'swiper/bundle';

// import styles bundle
import 'swiper/css/bundle';

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

document.addEventListener('DOMContentLoaded', function() {
  // Remove webform details errors
  document.querySelectorAll('details[data-once="webform-details-save"]').forEach(function(element) {
    var parent = element.parentElement;
    if (parent) {
      parent.remove();
    }
  });

});
