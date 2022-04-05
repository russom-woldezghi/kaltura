# kaltura

Allowing Kaltura video source as Drupal media

### Problem statement

This module provides Drupal 8/9, using the Media module, with a custom media source definition to allow users to add videos from services such as Kaltura. Some media sources are not known to Drupal or Media entities. This module provided an example of adding a media source Drupal recognizes and allows rendering of the media entity.

### Your solution

Using the `hook_media_source_info_alter` hook we can register a media source with Drupal / Media module to recognize the new addition. The `hook_form_FORM_ID_alter` hook is used to add some validation so users can enter the correct video source and build iframe/screenshots from a given media source. The `Drupal\kaltura_media\Form\KalturaForm` allows us to extend the media add/edit form and provide a similar media creation/editing experience in Drupal. There is additional validation to ensure the host is from `kaltura.com`, so the iframe rendering of the video player from Kaltura is properly rendered and provided. Lastly, Drupal's field formatter plugin is used to build out the iframe with video ID and HTML rendering attributes (width, height, etc), see `Drupal\kaltura_media\Plugin\Field\FieldFormatter\KalturaVideoFormatter`.

### Link

<url to code or PR>
