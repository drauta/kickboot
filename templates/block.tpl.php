<section id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
    
    
  <? 
  	if($block_html_id == 'block-locale-language' || $block_html_id == 'block-menu-menu-acceder' || $block_html_id == 'block-menu-menu-access' ){ ?>
	  	<h3<?php print $title_attributes; ?>><?php print $title; ?></h3>
  <?
  	}else if($title){  ?>
  	
  	<h5<?php print $title_attributes; ?>><?php print $title; ?></h5>
  	
  <? }  ?>

  <?php print render($title_suffix); ?>

  <?php print $content ?>
  
</section> <!-- /.block -->