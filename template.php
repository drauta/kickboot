<?php
function kickboot_process_node(&$vars) {

    // If some node type then...
    if ($vars['node']->type) {
                // add a template suggestion
        $vars['theme_hook_suggestions'][] = 'node__product';
    }
} 

function kickboot_cloud_zoom_image_gallery($variables) {
  // Add the Cloud Zoom Library
  drupal_add_library('cloud_zoom', 'cloud-zoom');

  $items = $variables['items'];

  // Create the gallery thumb syntax of cloud zoom.
  $gallery_item = '<div class="cloud-zoom-gallery-thumbs span3">';
  $options_rel = cloud_zoom_get_rel_string($variables);
  $main_item = '';

  $id = drupal_html_id('cloud-zoom');

  foreach ($items as $delta => $item) {
    // Build images.
    $zoomed = $variables['zoom_style'] ? image_style_url($variables['zoom_style'], $item['uri']) : file_create_url($item['uri']);
    $slide = cloud_zoom_get_img_tag($variables['slide_style'], $item);
    $thumb = cloud_zoom_get_img_tag($variables['thumb_style'], $item);

    $slide_url = $variables['slide_style'] ? image_style_url($variables['slide_style'], $item['uri']) : $item['uri'];

    if ($delta == 0) {
      // This is the large image.
      $options = array(
        'html' => TRUE,
        'attributes' => array(
          'class' => 'cloud-zoom',
          'id' => $id,
          'rel' =>  $options_rel ,  
        ),
      );
      $main_item = '<div class="span7 offset2">'.l($slide, $zoomed, $options).'</div>';
    }

    // These are the thumbnail.
    $options = array(
      'html' => TRUE,
      'attributes' => array(
        'class' => 'cloud-zoom-gallery thumbnail',
        'rel' =>'useZoom: \'' . $id . '\',smallImage: \'' . $slide_url . '\'',
      ),
    );
    $gallery_item .= l($thumb, $zoomed, $options);
  }
  $gallery_item .= '</div>';

  // Return the preview image as a link to the larger image with a cloud-zoom
  // CSS class.
 return '<div class="cloud-zoom-container">' . $gallery_item . $divblanc . $main_item . '</div>';
}


function kickboot_links($variables) {

  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];
  global $language_url;
  $output = '';

  if (count($links) > 0) {
    $output = '';

    // Treat the heading first if it is present to prepend it to the
    // list of links.
    if (!empty($heading)) {
      if (is_string($heading)) {
        // Prepare the array that will be used when the passed heading
        // is a string.
        $heading = array(
          'text' => $heading,
          // Set the default level of the heading.
          'level' => 'h2',
        );
      }
      $output .= '<' . $heading['level'];
      if (!empty($heading['class'])) {
        $output .= drupal_attributes(array('class' => $heading['class']));
      }
      $output .= '>' . check_plain($heading['text']) . '</' . $heading['level'] . '>';
    }
	
    $output .= '<ul' . drupal_attributes($attributes) . '>';

    $num_links = count($links);
    $i = 1;


    foreach ($links as $key => $link) {
      $class = array($key);

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class[] = 'first';
      }
      if ($i == $num_links) {
        $class[] = 'last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
          && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $class[] = 'active';
      }
      $output .= '<li' . drupal_attributes(array('class' => $class)) . '>';

      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $output .= l($link['title'], $link['href'], $link);
      }
      elseif (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes.
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>';
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }
	return $output;
}


function kickboot_preprocess_button(&$vars) {
	
	$vars['element']['#attributes']['class'][] = 'btn';

	if (isset($vars['element']['#value'])) {
	$classes = array(
	  //specifics
	  t('Save and add') => 'btn-info',
	  t('Add another item') => 'btn-info',
	  t('Add effect') => 'btn-primary',
	  t('Add and configure') => 'btn-primary',
	  t('Update style') => 'btn-primary',
	  t('Download feature') => 'btn-primary',
	
	  //generals
	  t('Send Review') => 'btn-primary',
	  t('Send Message') => 'btn-primary',
	  t('Send') => 'btn-primary',
	  t('Save') => 'btn-primary',
	  t('Apply') => 'btn-primary',
	  t('Create') => 'btn-primary',
	  t('Confirm') => 'btn-primary',
	  t('Submit') => 'btn-primary',
	  t('Export') => 'btn-primary',
	  t('Import') => 'btn-primary',
	  t('Restore') => 'btn-primary',
	  t('Rebuild') => 'btn-primary',
	  t('Search') => 'btn-primary',
	  t('Add') => 'btn-info',
	  t('Update') => 'btn-info',
	  t('Delete') => 'btn-danger',
	  t('Remove') => 'btn-danger',
	);
    foreach ($classes as $search => $class) {
      if (strpos($vars['element']['#value'], $search) !== FALSE) {
        $vars['element']['#attributes']['class'][] = $class;
        break;
      }
    }
  }

	switch ($vars['element']['#value']) {
    	
    case t('Add to cart'):
	$vars['element']['#attributes']['class'][1]= 'btn-success';
	$vars['element']['#attributes']['class'][3] = 'btn-large';
    break;
    
    case t('Add to Wishlist'):
	$vars['element']['#attributes']['class'][0]= 'btn-success';
	$vars['element']['#attributes']['class'][3] = 'btn-link';
	$vars['element']['#attributes']['title'][0] = 'Add to Wishlist';
    break;
	
	case t('Checkout'):
	$vars['element']['#attributes']['class'][1]= 'btn-success';
	break;

	case t('Validate and Order'):
	$vars['element']['#attributes']['class'][1]= 'btn-success';
	break;
		
	case t('Create new account'):
	$vars['element']['#attributes']['class'][1]= '';
	$vars['element']['#attributes']['class'][3] = '';
	break;
	
	case t('E-mail new password'):
	$vars['element']['#attributes']['class'][1]= '';
	$vars['element']['#attributes']['class'][3] = '';
	break;
	
	case t('Go'):
	$vars['element']['#value'] = t('Search');
	break;
	
	case t('Continue to next step'):
	$vars['element']['#attributes']['class'][2]='btn-success';
	break;
}

}


function kickboot_button($variables) {

  $element = $variables['element'];

  if ($element['#id']=="edit-submit-display-products"){
  	$element['#value']=t('Search');
  }
  $label = check_plain($element['#value']);
  element_set_attributes($element, array('id', 'name', 'value', 'type'));

  $element['#attributes']['class'][] = 'form-' . $element['#button_type'];
  
  if($element['#button_type'] == 'submit'){
  	
  }

  if (!empty($element['#attributes']['disabled'])) {
    $element['#attributes']['class'][] = 'form-button-disabled';
  }

  // Prepare input whitelist - added to ensure ajax functions don't break
  $whitelist = _bootstrap_element_whitelist();

  if (in_array($element['#id'], $whitelist)) {
    return '<input' . drupal_attributes($element['#attributes']) . ">\n"; // This line break adds inherent margin between multiple buttons
  }
  else {
    return '<button' . drupal_attributes($element['#attributes']) . '>'. $label ."</button>\n"; // This line break adds inherent margin between multiple buttons
  }
}


function kickboot_menu_link(array $variables) {
	
  $element = $variables['element'];

  $sub_menu = '';
   
  unset($element['#below']['#theme_wrappers']);
  
  if ($element['#below']) {
    // Ad our own wrapper
	
	if($element['#theme'] == 'menu_link__menu_footer_navigation' || $element['#theme'] == 'menu_link__management'){
		$sub_menu = '<ul>' . drupal_render($element['#below']) . '</ul>';
	}else{
		$sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
	}

    $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
    $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';

    // Check if this element is nested within another
    if ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] > 1)) {
      // Generate as dropdown submenu
      $element['#attributes']['class'][] = 'dropdown-submenu';
    }
    else {
      // Generate as standard dropdown
      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;
	  
		if($element['#theme'] == 'menu_link__menu_footer_navigation' || $element['#theme'] == 'menu_link__management'){
      		
		}else{
      		$element['#title'] .= '<span class="caret"></span>';
		}
    }
	if($element['#theme'] == 'menu_link__menu_footer_navigation'){
      $element['#attributes']['class'][] = 'span2';
	}
    // Set dropdown trigger element to # to prevent inadvertant page loading with submenu click
    $element['#localized_options']['attributes']['data-target'] = '#';
  }


  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}


function kickboot_menu_tree__menu_destacat(&$variables) {
  return '<ul class="menu nav nav-pills">' . $variables['tree'] . '</ul>';
}

function kickboot_menu_tree__menu_acerca_de(&$variables) {
  return '<ul class="menu unstyled">' . $variables['tree'] . '</ul>';
}
function kickboot_menu_link__menu_acerca_de(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';
  unset($element['#below']['#theme_wrappers']);
  
  if ($element['#below']) {
    // Ad our own wrapper
	
		$sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';

    $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
    $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';

    // Check if this element is nested within another
    if ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] > 1)) {
      // Generate as dropdown submenu
      $element['#attributes']['class'][] = 'dropdown-submenu';
    }
    else {
      // Generate as standard dropdown
      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;
	  
    }
    // Set dropdown trigger element to # to prevent inadvertant page loading with submenu click
    $element['#localized_options']['attributes']['data-target'] = '#';
  }
  $element['#attributes']['class']['0'] = 'first';
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
} 
function kickboot_menu_tree__menu_en_que_podemos_ayudarte(&$variables) {
  return '<ul class="menu unstyled">' . $variables['tree'] . '</ul>';
}
function kickboot_menu_link__menu_en_que_podemos_ayudarte(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';
  unset($element['#below']['#theme_wrappers']);
  
  if ($element['#below']) {
    // Ad our own wrapper
	
		$sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';

    $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
    $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';

    // Check if this element is nested within another
    if ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] > 1)) {
      // Generate as dropdown submenu
      $element['#attributes']['class'][] = 'dropdown-submenu';
    }
    else {
      // Generate as standard dropdown
      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;
	  
    }
    // Set dropdown trigger element to # to prevent inadvertant page loading with submenu click
    $element['#localized_options']['attributes']['data-target'] = '#';
  }
  $element['#attributes']['class']['0'] = 'first';
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}
function kickboot_menu_tree__menu_acceder(&$variables) {
  return '<ul class="menu unstyled">' . $variables['tree'] . '</ul>';
}
function kickboot_menu_link__menu_acceder(array $variables) {
  $element = $variables['element'];  
  $sub_menu = '';
  unset($element['#below']['#theme_wrappers']);
  
  if ($element['#below']) {
    // Ad our own wrapper
	
		$sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';

    $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
    $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';

    // Check if this element is nested within another
    if ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] > 1)) {
      // Generate as dropdown submenu
      $element['#attributes']['class'][] = 'dropdown-submenu';
    }
    else {
      // Generate as standard dropdown
      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;
	  
    }
    // Set dropdown trigger element to # to prevent inadvertant page loading with submenu click
    $element['#localized_options']['attributes']['data-target'] = '#';
  }
  $element['#attributes']['class']['0'] = 'first';
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}
function kickboot_menu_tree__menu_access(&$variables) {
  return '<ul class="menu unstyled">' . $variables['tree'] . '</ul>';
}
function kickboot_menu_link__menu_access(array $variables) {
  $element = $variables['element'];  
  $sub_menu = '';
  unset($element['#below']['#theme_wrappers']);
  
  if ($element['#below']) {
    // Ad our own wrapper
	
		$sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';

    $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
    $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';

    // Check if this element is nested within another
    if ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] > 1)) {
      // Generate as dropdown submenu
      $element['#attributes']['class'][] = 'dropdown-submenu';
    }
    else {
      // Generate as standard dropdown
      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;
	  
    }
    // Set dropdown trigger element to # to prevent inadvertant page loading with submenu click
    $element['#localized_options']['attributes']['data-target'] = '#';
  }
  $element['#attributes']['class']['0'] = 'first';
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}





function kickboot_status_messages($variables) {
  $display = $variables['display'];
  $output = '';
  $status_heading = array(
    'status' => t('Status message'),
    'error' => t('Error message'),
    'warning' => t('Warning message'),
  );
  // Map Drupal message types to their corresponding Bootstrap classes.
  // @see http://twitter.github.com/bootstrap/components.html#alerts
  $status_class = array(
    'status' => 'success',
    'error' => 'error',
    'warning' => 'info',
  );

  foreach (drupal_get_messages($display) as $type => $messages) {
  	
	$class = (isset($status_class[$type])) ? ' alert-' . $status_class[$type] : '';
	
	$findme = 'added-product';
	$pos = strpos($messages[0], $findme);
		
	if($pos){
		$output .= "<div class=\"messages $type \">\n";
	}else{
		$output .= "<div class=\"alert alert-block$class \">\n";
	}
    
    //$output .= "  <a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>\n";
	
    if (!empty($status_heading[$type])) {
      $output .= '<h2 class="element-invisible">' . $status_heading[$type] . "</h2>\n";
    }
    if (count($messages) > 1) {
      $output .= " <ul>\n";
      foreach ($messages as $message) {
        $output .= '  <li>' . $message . "</li>\n";
      }
      $output .= " </ul>\n";
    }
    else {
      $output .= $messages[0];
    }
    $output .= "</div>\n";
  }
//$output=str_replace("added-product-title clearfix","",$output);
  return $output;
}

function kickboot_links__locale_block($variables) { 
  $variables['attributes']['class']['0'] = 'language-switcher-locale-url inline'; 
  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];
  global $language_url;
  $output = '';

  if (count($links) > 0) {
    $output = '';

    // Treat the heading first if it is present to prepend it to the
    // list of links.
    if (!empty($heading)) {
      if (is_string($heading)) {
        // Prepare the array that will be used when the passed heading
        // is a string.
        $heading = array(
          'text' => $heading,
          // Set the default level of the heading. 
          'level' => 'h2',
        );
      }
      $output .= '<' . $heading['level'];
      if (!empty($heading['class'])) {
        $output .= drupal_attributes(array('class' => $heading['class']));
      }
      $output .= '>' . check_plain($heading['text']) . '</' . $heading['level'] . '>';
    }

    $output .= '<ul' . drupal_attributes($attributes) . '>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = array($key);

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class[] = 'first';
      }
      if ($i == $num_links) {
        $class[] = 'last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
           && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $class[] = 'active';
      }
      $output .= '<li' . drupal_attributes(array('class' => $class)) . '>';

      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $output .= l($link['title'], $link['href'], $link);
      }
      elseif (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes.
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>';
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}

function kickboot_colorbox_imagefield($variables) {
	$class = array('colorbox');

	if ($variables['image']['style_name'] == 'hide') {
		$image = '';
	    $class[] = 'js-hide';
	}
	elseif (!empty($variables['image']['style_name'])) {
		$image = theme('image_style', $variables['image']);
	}
	else {
		$image = theme('image', $variables['image']);
	}
	array_push($class, 'thumbnail');
  	$options = array(
    	'html' => TRUE,
    	'attributes' => array(
      	'title' => $variables['title'],
      	'class' => implode(' ', $class),
      	/*'class' => 'thumbnail',*/
      	'rel' => $variables['gid'],
    	)
  	);
  return l($image, $variables['path'], $options);
} 

function kickboot_jquerymenu_menu($variables) {
  $tree = $variables['tree'];
  $trail = $variables['trail'];
  $menu_output = recursive_link_creator($tree, $trail);
  if (!empty($menu_output)) {
    // We create the shell to hold the menu outside the recursive function.
    // Add a div that only shows up for that pesky IE so that we can style it into obedience.
    $output  = '<!--[if IE]><div class="ie"><![endif]-->';
    $output .= '<ul class="menu jquerymenu nav nav-pills nav-stacked">';
    $output .= $menu_output;
    $output .= '</ul>';
    $output .= '<!--[if IE]></div><![endif]-->';
    return $output;
  }
}

function kickboot_preprocess_block(&$variables) {
		
	if($variables['block_html_id'] == 'block-menu-menu-submenu-user'){
		$aviam = explode('menu nav', $variables['content']);
		$variables['content'] = $aviam[0].'nav nav-tabs'.$aviam[1];
	}
	
  static $block_counter = array();
  // All blocks get an independent counter for each region.
  if (!isset($block_counter[$variables['block']->region])) {
    $block_counter[$variables['block']->region] = 1;
  }
  // Same with zebra striping.
  $variables['block_zebra'] = ($block_counter[$variables['block']->region] % 2) ? 'odd' : 'even';
  $variables['block_id'] = $block_counter[$variables['block']->region]++;

  $variables['template_files'][] = 'block-' . $variables['block']->region;
  $variables['template_files'][] = 'block-' . $variables['block']->module;
  $variables['template_files'][] = 'block-' . $variables['block']->module . '-' . $variables['block']->delta;


	if($variables['block_html_id']=="block-search-api-sorts-search-sorts"){
//$variables['content'] = str_replace("search-api-sorts", "search-api-sorts nav nav-pills", $variables['content']);
//$variables['content']="";
		$variables['content']="<div class='pagination'>".$variables['content']."</div>";
	}

if($variables['block_html_id']=="block-views-shopping-cart-block"){

}

}

function kickboot_preprocess_region(&$variables) {


  // Create the $content variable that templates expect.
  $variables['content'] = $variables['elements']['#children'];
  $variables['region'] = $variables['elements']['#region'];

  $variables['classes_array'][] = drupal_region_class($variables['region']);
  $variables['theme_hook_suggestions'][] = 'region__' . $variables['region'];

	if ($variables['region']=="sidebar_first"){

		$variables['content'] = str_replace("block block-facetapi", "block block-facetapi well", $variables['content']);
		$variables['classes_array'][2] = "";

	}

}

function kickboot_preprocess_views_view(&$vars) {

if ($vars['name']=="shopping_cart"){
	global $language;
	
	//$vars['footer']=$language->prefix;
	$vars['footer']=str_replace("/cart","/".$language->prefix."/cart",$vars['footer']);

}

}
 
function kickboot_form_alter(&$form, &$form_state, $form_id) {
		
	if($form['#id'] == 'user-login'){

		$my_account = t("My account");
		$form['name']['#prefix'] = "<div id='user_login_form'><h1>".$my_account."</h1>";
		//dpm($form);	
		
	  $cadena = explode ('I don\'t have an account', $form['actions']['#suffix']);
		$titol = t('Are you a new customer? Create an account!');
		$form['actions']['#suffix'] = $cadena[0].$titol.$cadena[1];
		$frase = explode('</h2>', $form['actions']['#suffix']);
		
		$frase_options = array(
    	'attributes' => array(
      	'class' => 'login-register btn',
      	'title' => t('Create new account'),
      	)
      );
  	$frasefinal = l(t('Create new account'), 'user/register', $frase_options );
		
		$frasenova = "<p>".t('Create an account with us and you\'ll be able to:')."</p><ul><li>".t('Check out faster')."</li><li>".t('Save multiple shipping addresses')."</li><li>".t('Access your order history')."</li><li>".t('Track new orders')."</li><li>".t('Save items to your wish list')."</li></ul>";
		$form['actions']['#suffix'] = $frase['0'].'</h2>'.$frasenova.$frasefinal;

			
			
			/* Si ve del checkout canvia la url Ferran R. */
			$q=current_path();
			if (strpos($q,'checkout') !== false) { //if contains checkout

			    $q = explode("/", $q);
							    
				global $language;
			   	$idiomapath = $language->language;
				
			    $checkout_url=$q[0]."/".$q[1]."/user/register"; //checkout/43
			    
			    $new=explode("user/register",$form['actions']['#suffix']);
				
				$form['actions']['#suffix']=$new[0].$checkout_url.$new[1];
			}
			
			
			
			
	}
	switch ($form_id) {
		case 'webform_client_form_15':
			$form['submitted']['camp_ocult']['#access'] = false;
		break;
 		case 'webform_client_form_70':
			$form['submitted']['camp_ocult']['#access'] = false;
		break;
		case 'webform_client_form_69':
			$form['submitted']['camp_ocult']['#access'] = false;
		break;
		case 'views_form_commerce_cart_form_default':
			$form['actions']['checkout']['#value'] = t('Validate and Order');
		break;
		case 'commerce_checkout_form_checkout':
			$form['customer_profile_shipping']['commerce_customer_profile_copy']['#weight']= -120;
			$form['customer_profile_shipping']['commerce_customer_address']['und']['0']['country']['#weight'] = '70';			
			$form['customer_profile_billing']['commerce_customer_address']['und']['0']['country']['#weight'] = '70';			
		break;
		case 'commerce_checkout_line_item_views_form_submit':
		break;
		case 'commerce_addressbook_customer_profile_form':
			$form['commerce_customer_address']['und']['0']['#type'] = '';
			$form['commerce_customer_address']['und']['0']['country']['#weight'] = '70';			
		break; 
		case 'user_profile_form':
			$form['field_terms_conditions']['#access'] = '0';
			$form['field_terms_conditions']['und']['#default_value'] = 1;
			$form['locale']['#collapsed'] = TRUE;
			$form['locale']['#collapsible'] = TRUE;
		break;
		case 'user_register_form':
			$register_title= t("Create new account");
			$form['account']['name']['#prefix'] =  '<div id="user_register_form"><h1>'.$register_title.'</h1>';
		break;
		case 'user_pass':
			$form['actions']['submit']['#value'] = t("Send");
			$form['actions']['submit']['#attributes']['class']['0'] = 'btn btn-primary';
		break;
		case 'forward_form':
			$form['message']['recipients']['#type'] = 'textfield';
			$form['message']['recipients']['#size'] = '58';
			$form['message']['recipients']['#maxlength'] = '35';
			unset ($form['message']['recipients']['#cols']);
			unset ($form['message']['recipients']['#description']);
			unset ($form['message']['recipients']['#rows']);
			unset ($form['message']['body']);
			unset ($form['message']['subject']);
			$form['message']['message']['#cols'] = '56';
			$form['message']['message']['#rows'] = '3';
		break;
		case 'comment_node_product_display_form':
			$form['actions']['submit']['#value'] = t('Send Review');
			$form['field_product_rating']['und'][0]['#title'] = t('Product Rating');
			//dpm($form);
		break;
		case 'comment_node_blog_post_form':
			$form['actions']['submit']['#value'] = t('Send');
		break;
	}

	
	if($form['#attributes']['class']['0'] == 'commerce-add-to-cart'){
		$form['add_to_wishlist']['#weight'] = 49;
	}
	
	
}


		
function kickboot_preprocess_page(&$variables) {
	 $variables['page']['content']['system_main']['recent_orders']['#weight']='200';
	 	 
	 	 //dpm(arg(0));
	 	 
	 if(arg(0) == 'user' && arg(2) == 'view'){
		 $variables['title'] = t('My account');
		 drupal_set_title($variables['title']);
	 }
	 if(arg(0) == 'user' && arg(2) == 'addressbook'){
		 $variables['title'] = t('Address book');		 
		 drupal_set_title($variables['title']);

	 }
	 if(arg(0) == 'user' && arg(2) == 'edit'){
		 $variables['title'] = t('Account Settings');
		 drupal_set_title($variables['title']);
	 }
	 if(arg(0) == 'comment' && arg(1) == 'reply'){
		 $variables['title'] = t('Reply to comment');
		 drupal_set_title($variables['title']);
	 }
}



function kickboot_table($variables) {
	//krumo ($variables['rows']);
	//personalitzant
	/*if ($variables['rows'][0]['data'][0]['data']=="Subtotal"){
		if ($variables['rows'][4]['data'][0]['data']="Order total"){
		$variables['rows'][0]['data'][0]['data']=$variables['rows'][4]['data'][0]['data'];
		$variables['rows'][0]['data'][1]['data']=$variables['rows'][4]['data'][1]['data'];
		$variables['rows'][4]['data']="";
		//$variables['rows'][4]['data']="";
		} else if ($variables['rows'][5]['data'][0]['data']="Order total"){
			$variables['rows'][0]['data'][0]['data']=$variables['rows'][5]['data'][0]['data'];
		$variables['rows'][0]['data'][1]['data']=$variables['rows'][5]['data'][1]['data'];
		$variables['rows'][5]['data']="";
		} else if ($variables['rows'][3]['data'][0]['data']="Order total"){
			$variables['rows'][0]['data'][0]['data']=$variables['rows'][3]['data'][0]['data'];
		$variables['rows'][0]['data'][1]['data']=$variables['rows'][3]['data'][1]['data'];
		$variables['rows'][3]['data']="";
		}
	}*/
  
  $header = $variables['header'];
  $rows = $variables['rows'];
  $attributes = $variables['attributes'];
  $caption = $variables['caption'];
  $colgroups = $variables['colgroups'];
  $sticky = $variables['sticky'];
  $empty = $variables['empty'];

  // Add sticky headers, if applicable.
  if (count($header) && $sticky) {
    drupal_add_js('misc/tableheader.js');
    // Add 'sticky-enabled' class to the table to identify it for JS.
    // This is needed to target tables constructed by this function.
    $attributes['class'][] = 'sticky-enabled';
  }

  $output = '<table' . drupal_attributes($attributes) . ">\n";

  if (isset($caption)) {
    $output .= '<caption>' . $caption . "</caption>\n";
  }

  // Format the table columns:
  if (count($colgroups)) {
    foreach ($colgroups as $number => $colgroup) {
      $attributes = array();

      // Check if we're dealing with a simple or complex column
      if (isset($colgroup['data'])) {
        foreach ($colgroup as $key => $value) {
          if ($key == 'data') {
            $cols = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $cols = $colgroup;
      }

      // Build colgroup
      if (is_array($cols) && count($cols)) {
        $output .= ' <colgroup' . drupal_attributes($attributes) . '>';
        $i = 0;
        foreach ($cols as $col) {
          $output .= ' <col' . drupal_attributes($col) . ' />';
        }
        $output .= " </colgroup>\n";
      }
      else {
        $output .= ' <colgroup' . drupal_attributes($attributes) . " />\n";
      }
    }
  }

  // Add the 'empty' row message if available.
  if (!count($rows) && $empty) {
    $header_count = 0;
    foreach ($header as $header_cell) {
      if (is_array($header_cell)) {
        $header_count += isset($header_cell['colspan']) ? $header_cell['colspan'] : 1;
      }
      else {
        $header_count++;
      }
    }
    $rows[] = array(array(
        'data' => $empty,
        'colspan' => $header_count,
        'class' => array('empty', 'message'),
      ));
  }

  // Format the table header:
  if (count($header)) {
    $ts = tablesort_init($header);
    // HTML requires that the thead tag has tr tags in it followed by tbody
    // tags. Using ternary operator to check and see if we have any rows.
    $output .= (count($rows) ? ' <thead><tr>' : ' <tr>');
    foreach ($header as $cell) {
      $cell = tablesort_header($cell, $header, $ts);
      $output .= _theme_table_cell($cell, TRUE);
    }
    // Using ternary operator to close the tags based on whether or not there are rows
    $output .= (count($rows) ? " </tr></thead>\n" : "</tr>\n");
  }
  else {
    $ts = array();
  }

  // Format the table rows:
  if (count($rows)) {
    $output .= "<tbody>\n";
    $flip = array(
      'even' => 'odd',
      'odd' => 'even',
    );
    $class = 'even';
    foreach ($rows as $number => $row) {
      $attributes = array();

      // Check if we're dealing with a simple or complex row
      if (isset($row['data'])) {
        foreach ($row as $key => $value) {
          if ($key == 'data') {
            $cells = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $cells = $row;
      }
      if (count($cells)) {
        // Add odd/even class
        if (empty($row['no_striping'])) {
          $class = $flip[$class];
          $attributes['class'][] = $class;
        }

        // Build row
        $output .= ' <tr' . drupal_attributes($attributes) . '>';
        $i = 0;
        foreach ($cells as $cell) {
          $cell = tablesort_cell($cell, $header, $ts, $i++);
          $output .= _theme_table_cell($cell);
        }
        $output .= " </tr>\n";
      }
    }
    $output .= "</tbody>\n";
  }

  $output .= "</table>\n";
  return $output;
}

function kickboot_commerce_price_savings_formatter_formatter($vars) {
  // Build an array of table rows based on the prices passed in.
  //krumo($vars);
  $vars['prices']['list']['#price_label']= '';
  $rows = array();

  // exit if no prices
  if (empty($vars['prices'])) {
    return '';
  }

  // store prices count
  $prices_count = count($vars['prices']);

  // build rows
  foreach ($vars['prices'] as $key => $price_element) {
    $row_data = array();

    // add label
    if (isset($price_element['#price_label'])) {
      if (!empty($price_element['#price_label'])) {
        $label = t('@label:', array('@label' => $price_element['#price_label']));
      }
      else {
        $label = '';
      }

      $row_data[] = array('data' => $label, 'class' => array('price-label'));
    }

    // add price
    if($key=="price"){
    	$row_data[] = array('data' => drupal_render($price_element), 'class' => array('price-amount'), 'itemprop' => array('price'));
    } else {
	    $row_data[] = array('data' => drupal_render($price_element), 'class' => array('price-amount'));
    }
    
    $rows[] = array(
      'data' => $row_data,
      'class' => array('commerce-price-savings-formatter-' . $key),
    );
  }

  return theme('table', array('rows' => $rows, 'attributes' => array('class' => array('commerce-price-savings-formatter-prices', 'commerce-price-savings-formatter-prices-count-' . $prices_count))));
}


function kickboot_link($variables) {
	//Modify Add new comment link path
	if (strpos($variables['path'], 'comment')){
		$nid = explode('comment/reply/', $variables['options']['href']);
	  $variables['path'] = 'node/'.$nid[1];
	  $variables['options']['fragment'] = 'comment-form-wrapper';
	}

	if(strlen($variables['text']) != strlen(strip_tags($variables['text']))){

    }else{
    	$variables['options']['attributes']['title'] = $variables['text'];
    }

	$cadena1 = $variables['path'];
	$cadena2 = '/addressbook/billing/edit';
	$editar = strstr($cadena1,$cadena2);
	$cadena3 = '/addressbook/billing/delete';
	$eliminar = strstr($cadena1,$cadena3);
	$cadena4 = '/addressbook/billing/default';
	$prede = strstr($cadena1,$cadena4);
	if($eliminar){
		$variables['options']['attributes']['class']= 'btn btn-danger testtest';	
	}else if($editar){
		$variables['options']['attributes']['class']= 'btn';	
	}else if($prede){
		$variables['options']['attributes']['class']= 'btn';	
		//hola
	}
	
	return '<a href="' . check_plain(url($variables['path'], $variables['options'])) . '"' . drupal_attributes($variables['options']['attributes']) . '>' . ($variables['options']['html'] ? $variables['text'] : check_plain($variables['text'])) . '</a>';

}

function kickboot_image($variables) {
  $attributes = $variables['attributes'];
  $attributes['src'] = file_create_url($variables['path']);
  if ($variables['style_name']=="product_full"){
	  $attributes['itemprop'] = "image";
  }
  
  foreach (array('width', 'height', 'alt', 'title') as $key) {

    if (isset($variables[$key])) {
      $attributes[$key] = $variables[$key];
    }
  }
  return '<img' . drupal_attributes($attributes) . ' />';
}

function kickboot_preprocess_comment(&$variables){
  // Change submitted text to review comments
  switch ($variables['elements']['#node']->type){
	  case 'product_display':
		$variables['submitted'] = t('Reviewed by !username on !datetime', array('!username' => $variables['author'], '!datetime' => $variables['created']));
	  break;
	  case 'blog_post':
	  unset ($variables['permalink']);
	    $comment = $variables['elements']['#comment'];
	    $variables['author'] = theme('username', array('account' => $comment));
	    $variables['created'] = format_date($comment->created, 'mes_curt');
	    $variables['submitted'] = t('Submitted by !username on !datetime', array('!username' => $variables['author'], '!datetime' => $variables['created']));
	  break;
	  
  }
}
function kickboot_preprocess_node(&$variables) {
  switch ($variables['type']){
	  case 'blog_post':
		unset ($variables['content']['links']['comment']['#links']['comment-comments']);
	  unset ($variables['content']['links']['comment']['#links']['comment-new-comments']);

	  break;
  }
}



function kickboot_forward_email($variables) {
	
	$vars = $variables['vars'];
	$output = '<table width="600" cellspacing="0" cellpadding="10" border="0">
      <tbody>
        <tr>
          <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
          
          	<h3 style="margin: 0;padding: 0;font-family: &quot;HelveticaNeue-Light&quot;, &quot;Helvetica Neue Light&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 500;font-size: 27px">'.t('Hello').',</h3>
          
          	<p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6">'.$vars['forward_message'].'</p>
          
          
          	<table width="100%">
          		<tr>
          			<td style="background-color: #ECF8FF; padding:15px;ont-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;font-weight: normal;font-size: 14px;line-height: 1.6;">
          		<p class="callout" style="margin: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;font-weight: normal;font-size: 14px;line-height: 1.6">'.
          		$vars['message']          
          .'</p>
          			</td>
          		</tr>
          	</table>
          
          
          
          </td>
        </tr>
        <tr>
        	<td>
        		<table>
        			<tr>
        				<td valign="top">
        					<div>' . $vars['content']->teaser . '</div>
        				</td>	
        				<td valign="top">
        					<h2 style="font-size: 14px;">' . l($vars['content']->title, 'forward/emailref', array('absolute' => TRUE, 'query' => array('path' => $vars['path']))) . '</h2>
        					<p>' . l(t('Click here to read more on our site'), 'forward/emailref', array('absolute' => TRUE, 'query' => array('path' => $vars['path']))) . '</p>
        				</td>
        			</tr>
  				</table>
  			</td>
  		</tr>
      </tbody>
</table>'; 

  return $output;
}