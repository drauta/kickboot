<?php

/**
 * @file
 * Default theme implementation to provide an HTML container for comments.
 *
 * Available variables:
 * - $content: The array of content-related elements for the node. Use
 *   render($content) to print them all, or
 *   print a subset such as render($content['comment_form']).
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default value has the following:
 *   - comment-wrapper: The current template type, i.e., "theming hook".
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * The following variables are provided for contextual information.
 * - $node: Node object the comments are attached to.
 * The constants below the variables show the possible values and should be
 * used for comparison.
 * - $display_mode
 *   - COMMENT_MODE_FLAT
 *   - COMMENT_MODE_THREADED
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess_comment_wrapper()
 *
 * @ingroup themeable
 */
?>
<?
//Build render array of node 
	$node_build = node_view($content['#node'], 'product_list');
//Overwrite add new comment link
	$node_build['links']['comment']['#links']['0'] = array(
			'title' => t('Write a review'),
			'attributes' => array('class' => array('btn', 'btn-info')),
			'href' => 'node/' . $node->nid . '/talk',
			'fragment' => 'comment-form',
		);
//	$login_path = '/user?destination=node/'.$node->nid.'/talk';
//	$register_path = '/user/register?destination=node/'.$node->nid.'/talk';
	$login = l("Login", "user", array( 'html' => TRUE, 'query' => drupal_get_destination()));
	$register = l("register", "user/register", array( 'html' => TRUE, 'query' => drupal_get_destination()));
?>

<?php // Message anonymous users to register
	if (in_array ('anonymous user', $user->roles) ){
			drupal_set_message(t('!login or !register to post reviews', array ('!login' => $login, '!register' => $register )));	
	}
	else {
	// render add new comment link
	// print render($node_build['links']['comment']);
	}
?>

<div id="product" class="node product-list">
	<? print render($node_build); ?>
</div>

<section id="reviews" class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php if ($content['comment_form']): ?>
    <section id="comment-form-wrapper" class="well">
    	<h4 class="title comment-form"><?php print t('Write a review'); ?></h4>
      <?php print render($content['comment_form']); ?>
    </section> <!-- /#comment-form-wrapper -->
  <?php endif; ?>

  <?php if ($content['comments'] && $node->type != 'forum'): ?>
    <?php print render($title_prefix); ?>
    <h2 class="title"><?php print t('Reviews'); ?></h2>
    <?php print render($title_suffix); ?>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

</section> <!-- /#comments -->