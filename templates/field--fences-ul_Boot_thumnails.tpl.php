<?php
/**
 * @file field--fences-ul.tpl.php
 * Wrap each field value in the <li> element and all of them in the <ul> element.
 *
 * @see http://developers.whatwg.org/grouping-content.html#the-ul-element
 */
?> 
<?php if ($element['#label_display'] == 'inline'): ?>
  <span class="field-label"<?php print $title_attributes; ?>>
    <?php print $label; ?>:
  </span>
<?php elseif ($element['#label_display'] == 'above'): ?>
  <h3 class="field-label"<?php print $title_attributes; ?>>
    <?php print $label; ?>
  </h3>
<?php endif; ?>
<div class="row-fluid thumbnails">
	
	<ul class="thumbnails <?php print $classes; ?>"<?php print $attributes; ?>>

 		<?php foreach ($items as $delta => $item): ?>
			 <? $item_attributes[$delta] = ' class="pull-left"' ?>
    	<li<?php print $item_attributes[$delta]; ?>>
      	<?php print render($item); ?>
    	</li>
  	<?php endforeach; ?>
	</ul>  
</div>
