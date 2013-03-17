<section id="<?php print $block_html_id; ?>" class="pull-left <?php print $classes; ?>"<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <? if($title && $block_html_id != 'block-locale-language'){ ?>
  		<h4<?php print $title_attributes; ?>><?php print $title; ?></h4>
  <? }
  
 
  
  ?>
  <?php print render($title_suffix); ?>
  <?php print $content ?> 
</section> <!-- /.block -->