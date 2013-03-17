<?
		drupal_add_js("function checkWindowSize() {

		    if ( jQuery(window).width() < 490 ) {
		        jQuery('body .main #page-header .region-header #block-menu-menu-destacat').addClass('nav-collapse');
		        jQuery('body .main #page-header .region-header #block-views-menu-categoria-block').addClass('nav-collapse');
		        jQuery('body .main .rowall .region-sidebar-first').addClass('nav-collapse333');
		        jQuery('body.node-type-page .main .rowall .region-sidebar-first').removeClass('nav-collapse333');
		        jQuery('body.node-type-contacte .main .rowall .region-sidebar-first').removeClass('nav-collapse333');
		        jQuery('body #header-top #block-menu-menu-user-menu').addClass('nav-collapse-user');
		        jQuery('body .main #page-header .region-header #block-views-exp-display-products-page').addClass('nav-collapse333');
		    }
		    else {
		        jQuery('body .main #page-header .region-header #block-menu-menu-destacat').removeClass('nav-collapse');
		        jQuery('body .main #page-header .region-header #block-views-menu-categoria-block').removeClass('nav-collapse');
		        jQuery('body .main .rowall .region-sidebar-first').removeClass('nav-collapse333');
		        jQuery('body #header-top #block-menu-menu-user-menu').removeClass('nav-collapse-user');
		        jQuery('body .main #page-header .region-header #block-views-exp-display-products-page').removeClass('nav-collapse333');
		    }
	    }

		jQuery(document).ready(function(){
		    jQuery(window).resize(checkWindowSize);
		    checkWindowSize();
		});", "inline");
?>

<header id="navbar" role="banner" class="navbar navbar-static-top">
	<?php if (!empty($page['user_bar'])): ?>
	<div id="user-bar" class="container clearfix">
	    <?php print render($page['user_bar']); ?>      
	</div>                                        
	<?php endif; ?>
	<div class="navbar-inner navbar-fixed-top">
		<div id="site-info" class="container">
		<?php if ($logo): ?>
			<a class="logo pull-left" href="<?php print $front_page; ?>" title="<?php print $site_name ?>"><img src="<?php print $logo; ?>" alt="<?php print $site_name; ?>" /></a>
		<?php endif; ?>
		<?php if ($site_name): ?>
			<h1 id="site-name"><a href="<?php print $front_page; ?>" title="<?php print $site_name; ?>" class="brand"><?php print $site_name; ?></a></h1>
		<?php endif; ?>
		<?php if ( $site_slogan ): ?>
			<p class="lead"><?php print $site_slogan; ?></p>
		<?php endif; ?> 
		
		
		<!-- <div class="navbar">
	    <div class="container">-->
  		<a class="btn btn-navbar categories" data-toggle="collapse" data-target=".nav-collapse">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	    </a>
	    
	    <a class="btn btn-navbar personal" data-toggle="collapse" data-target=".nav-collapse-user">
	        <span class="icon-user"></span>
	    </a>
	    
	    <a class="btn btn-navbar filtrado" data-toggle="collapse" data-target=".nav-collapse333">
	    	<span class="icon-search"></span>
	        <? print t('Search'); ?>
	    </a>
	    
	   <!-- </div>
  		</div>
		-->
		
		<?php if (!empty($page['headertop'])): ?>
			<div id="header-top" class="pull-right span9"><?php print render($page['headertop']); ?></div>                                        
		<?php endif; ?> 
    	</div>
	</div>                                        
</header>



<div class="main">
  <header role="banner" id="page-header" class="clearfix container">
  		    <?php print render($page['header']); ?> 
	  <div class="navbar">
	    <div class="container">
	      <?php if ($breadcrumb): print $breadcrumb; endif;?>
	      <?php if ($primary_nav || $secondary_nav || !empty($page['navigation'])): ?>
	        <div class="nav-collapse">
	          <nav role="navigation">
	            <?php if ($primary_nav): ?>
	            <?php print render($primary_nav); ?>
	            <?php endif; ?>
	            <?php if (!empty($page['navigation'])): ?>
	              <?php print render($page['navigation']); ?>
	            <?php endif; ?>
	            <?php if ($secondary_nav): ?>
	              <?php print render($secondary_nav); ?>
	            <?php endif; ?>
	          </nav>
	        </div>
	      <?php endif; ?>
	    </div>
	  </div>

  </header> <!-- /#header -->
  
  <div class="rowall <? print $node->type; ?> <? print $page['#views_contextual_links_info']['views_ui']['view_name']; ?>">
	<?php print render($page['pre_content']); ?>
	  <div class="row container">
	    <?php if ($page['sidebar_first']): ?>
	      <aside class="span3" role="complementary">
	        <?php print render($page['sidebar_first']); ?>
	      </aside>  <!-- /#sidebar-first -->
	    <?php endif; ?>  
	
	<? if($node->type == 'page' || $node->type == 'contacte'){ ?>
	    <section class="offset1 span8"> 
	<? }else if($page['content']['system_main']['#id'] == 'user-register-form'){ ?>
	   <section class="no-page span8">
	<? }else{ ?>
	   <section class="no-page <?php print _bootstrap_content_span($columns); ?>">
	<? }  ?>
 
      <?php if ($page['highlighted']): ?>
        <div class="highlighted hero-unit"><?php print render($page['highlighted']); ?></div>
      <?php endif; ?>
      		<a id="main-content"></a>
      		<?php print render($title_prefix); 
      
			  if($page['content']['system_main']['#id'] == 'commerce-addressbook-customer-profile-form'){
		      	$title = t('Add an addressbook');
		      }
      ?>
      <?php if ($title): ?>
				<?php if(($page['content']['system_main']['#id'] == 'user-register-form')
							|| ($page['content']['system_main']['#id'] == 'user-login')
							|| ($page['content']['system_main']['#id'] == 'user-pass')): ?>
        <?php else:?>       	
					<h1 class="page-header"><?php print $title; ?></h1>
		<? 	endif;?>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
       <?
       	if(!$page['content']['menu_menu-submenu-user']){
       		 if ($tabs):
       		 		if (in_array ('anonymous user', $user->roles) ){}
	            else{ print render($tabs);}
      		 endif; 
       	}
       ?>
      <?php if ($page['help']): ?> 
        <div class="well"><?php print render($page['help']); ?></div>
      <?php endif; ?>
      <?php if ($action_links): ?>
      	<?        		
      		if($action_links['0']['#link']['path'] == 'user/%/addressbook/billing/create'){
      	?>
      	<?		
      		}else{
      	?>
        	<ul class="action-links"><?php print render($action_links); ?></ul>
      	<?		
      		}
      	?>
      <?php endif; ?>
      <?php print render($page['content']); ?>
     
    <? 	if($action_links){ ?>
    <?		if($action_links['0']['#link']['path'] == 'user/%/addressbook/billing/create'){  ?>
      			<ul class="action-links btn btn-info"><?php print render($action_links); ?></ul>     
	<? 		} 
      	}
    ?>
      
    </section>

    <?php if ($page['sidebar_second']): ?>
      <aside class="span3" role="complementary">
        <?php print render($page['sidebar_second']); ?>
      </aside>  <!-- /#sidebar-second -->
    <?php endif; ?>

  </div>
  </div>
  <footer class="footer container">
    <?php if ($page['footer_social']): ?> 
      <div class="social clearfix row-fluid"><?php print render($page['footer_social']); ?></div>
    <?php endif; ?>
    <?php if ($page['footer_nav']): ?> 
      <div class="nav clearfix row-fluid"><?php print render($page['footer_nav']); ?></div>
    <?php endif; ?>
    <?php print render($page['footer']); ?>
  </footer>
</div>
