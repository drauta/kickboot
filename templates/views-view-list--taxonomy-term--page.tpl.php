<?php
/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
?>
<div class="item-list row-fluid">
  <?php if (!empty($title)) : ?>
    <h3><?php print $title; ?></h3>
  <?php endif; ?>
  <ul class="products-per-term thumbnails">      
    <?php foreach ($rows as $id => $row): ?>
      <li class="span3 thumbnail <?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
    <?php endforeach; ?>
  </ul>
<?php print $wrapper_suffix; ?>