<?php
/**
 * @file field--fences-div.tpl.php
 * Wrap each field value in the <div> element.
 *
 * @see http://developers.whatwg.org/grouping-content.html#the-div-element
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

<div class="carousel slide" id="myCarousel">
	<div class="carousel-inner">		
		<?php foreach ($items as $delta => $item): ?>
			<? if($delta == '0'){ ?>
		  		<div class="item <?php print $classes; ?> active"<?php print $attributes; ?>>
			<? }else{ ?>
		  		<div class="item <?php print $classes; ?>"<?php print $attributes; ?>>
			<? } ?>
		    <?php print render($item); ?>
		    <div class="carousel-caption">
		    	<h4><? print $item['#item']['alt']; ?></h4>
		    	<p><? print $item['#item']['title']; ?></p>
		    </div>
		  </div>
		<?php endforeach; ?>	
	</div>
	<a data-slide="prev" href="#myCarousel" class="carousel-control left">&lsaquo;</a>
	<a data-slide="next" href="#myCarousel" class="carousel-control right">&rsaquo;</a>
</div>
