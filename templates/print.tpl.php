<?php

/**
 * @file
 * Default print module template
 *
 * @ingroup print
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $print['language']; ?>" xml:lang="<?php print $print['language']; ?>">
  <head>
    <?php print $print['head']; ?>
    <?php print $print['base_href']; ?>
    <title><?php print $print['title']; ?></title>
    <?php print $print['scripts']; ?>
    <?php print $print['sendtoprinter']; ?>
    <?php print $print['robots_meta']; ?>
    <?php print $print['favicon']; ?>
    <?php print $print['css']; ?>
    <style>
	    
	    .commerce-invoice-commerce-invoice .commerce-invoice-number{
			width:100%;
			border-bottom: 1px solid #999;
			padding:0px 0px 25px 0px;
			margin: 0px 0px 30px;
			text-align: right;
		}
		
		.commerce-invoice-commerce-invoice .commerce-invoice-number .commerce-invoice-number-label{
			margin-right:10px;
		}
		
		.commerce-invoice-commerce-invoice .field-name-company-info{
			float:left;
			width:50%;
		}
		
		.commerce-invoice-commerce-invoice .field-name-company-info span{
			float:left;
			margin-right: 10px;
		}
		
		.commerce-invoice-commerce-invoice .field-name-commerce-customer-billing{
			float:right;
			float:48%;
			margin-top:15px;
		}
		
		.commerce-invoice-commerce-invoice .field-name-commerce-customer-billing .field-label{
			font-weight:bold;
		}
		
		.commerce-invoice-commerce-invoice .field-name-commerce-customer-billing .entity-commerce-customer-profile .field-label{
			font-weight:100;
		}
		
		.commerce-invoice-created{
			clear:both;
			margin:20px 0px;
		}
		
		.field-name-commerce-line-items table{
			width:100%;
			margin:20px 0px;
		}
		
		.field-name-commerce-line-items table thead{
			border-bottom:1px solid #999;
		}
				
		.field-name-commerce-line-items table tr td{
			vertical-align: top;
			border-bottom:1px solid #ccc;
			text-align: center;
			padding:10px 0px;
		}
		
		.field-name-commerce-line-items table tr th.views-field-line-item-title,
		.field-name-commerce-line-items table tr td.views-field-line-item-title{
			text-align:left;	
		}
		
		.field-name-commerce-line-items table tr th.views-field-commerce-total,
		.field-name-commerce-line-items table tr td.views-field-commerce-total{
			text-align:right;
		}
		
		.field-name-commerce-line-items table tr td.views-field-line-item-title .img-order.thumbnail.pull-left{
			display:none;
		}
		
		.field-name-field-more-information{
			margin:0px 0px 30px;	
		}
		
		.field-name-commerce-order-total table.commerce-price-formatted-components{
			width:100%;
		}
		
		.field-name-commerce-order-total table.commerce-price-formatted-components td{
			font-size:14px;
		}
		
		.field-name-commerce-order-total table.commerce-price-formatted-components tr.component-type-commerce-price-formatted-amount td{
			font-size:16px;
			font-weight:bold;
		}
		
		.field-name-commerce-order-total table.commerce-price-formatted-components tr td.component-total{
			text-align:right;	
		}
		
		.entity-commerce-invoice h3.field-label{
			font-size:16px;
		}
		
		
    </style>
    
  </head>
  <body>
    <?php if (!empty($print['message'])) {
      print '<div class="print-message">'. $print['message'] .'</div><p />';
    } ?>
    
    <div class="print-logo"><?php //print $print['logo']; ?></div>
    <div class="print-site_name"><?php //print $print['site_name']; ?></div>
    <p />
    <div class="print-breadcrumb"><?php //print $print['breadcrumb']; ?></div>
    <hr class="print-hr" />
    <div class="print-content">
    
    	<h1><?php print $site_name; ?></h1>
    	<?php 
    	
    		//krumo($print);
    		//print $print['content'];
    	?>
    
    </div>
    <div class="print-footer"><?php print $print['footer_message']; ?></div>
    <hr class="print-hr" />
    <div class="print-source_url"><?php //print $print['source_url']; ?></div>
    <div class="print-links"><?php print $print['pfp_links']; ?></div>
    <?php print $print['footer_scripts']; ?>
  </body>
</html>
