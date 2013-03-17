<section id="<?php print $block_html_id; ?>" class="pull-left span3 <?php print $classes; ?>"<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <? if($title){ ?>
		<p<?php print $title_attributes; ?>><?php print $title; ?></p>
  <? }   ?>
  <?php print render($title_suffix); ?>
  <?php print $content ?>
</section> <!-- /.block -->