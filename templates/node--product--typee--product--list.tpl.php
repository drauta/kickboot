<article<?php print $attributes; ?>>
    <?php
      // We hide the comments and links.
      hide($content['comments']);
      hide($content['links']);
			// compte! el krumo tarda molt a carregar si la llista és molt gran
			//krumo($content);
			//krumo($node);    
			// image thumbnail

			$img_url = $content['product:field_images'][0]['#item']['uri'];  // the orig image uri
			$style = 'boot_thumb_300xauto';  // or any other custom image style you've created via /admin/config/media/image-styles
			$image_product = image_style_url($style, $img_url);
			//print '<img src="'.print image_style_url($style, $img_url);.'">';  
			print '<img data-src="holder.js/300x200" src="'.$image_product.'">';
			
			//print "<img src=".print($content['product:field_images'][0]['#item']['uri']).">";
			//print render(field_view_field('node', $node, 'field_image', array('settings' => array('image_style' => 'boot_thumb_300xauto'))));    
// 			print render($content['links']); 
//      print render($content['comments']); 
    ?> 
		<div class="caption">
			<?php // print all caption group 
			print render($content['title_field']);
			print render($content['product:commerce_price']);
			print render($content['field_product']);
			?>
	  </div>
</article>
