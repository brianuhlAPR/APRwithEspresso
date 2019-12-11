<?php
/**
 * Essence Pro pricing page.
 *
 * Pricing page content optionally installed after theme activation.
 *
 * Visit `/wp-admin/admin.php?page=genesis-getting-started` to trigger import.
 *
 * @package Essence Pro
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/essence/
 */

return <<<CONTENT
<!-- wp:heading {"align":"center"} -->
<h2 style="text-align:center">Two Columns</h2>
<!-- /wp:heading -->

<!-- wp:atomic-blocks/ab-pricing {"columnsGap":1,"align":"full"} -->
<div class="wp-block-atomic-blocks-ab-pricing ab-pricing-columns-2 alignfull"><div class="ab-pricing-table-wrap ab-block-pricing-table-gap-1"><!-- wp:atomic-blocks/ab-pricing-table {"borderWidth":6,"borderColor":"#f4f4f4","backgroundColor":"#f4f4f4","padding":5} -->
<div class="wp-block-atomic-blocks-ab-pricing-table ab-block-pricing-table-center ab-block-pricing-table" itemscope itemtype="http://schema.org/Product"><div class="ab-block-pricing-table-inside" style="border-width:6px;border-style:solid;border-color:#f4f4f4;background-color:#f4f4f4;padding:5%"><!-- wp:atomic-blocks/ab-pricing-table-title {"title":"<strong>Package #1</strong>","fontSize":"larger","paddingTop":30} -->
<div itemprop="name" style="padding-top:30px;padding-right:20px;padding-bottom:10px;padding-left:20px" class="wp-block-atomic-blocks-ab-pricing-table-title ab-pricing-table-title has-larger-font-size"><strong>Package #1</strong></div>
<!-- /wp:atomic-blocks/ab-pricing-table-title -->

<!-- wp:atomic-blocks/ab-pricing-table-subtitle {"subtitle":"<em>This is a basic web design.</em>","customTextColor":"#555555"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-subtitle ab-pricing-table-subtitle" style="color:#555555;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><em>This is a basic web design.</em></div>
<!-- /wp:atomic-blocks/ab-pricing-table-subtitle -->

<!-- wp:atomic-blocks/ab-pricing-table-price {"price":"<strong>2999</strong>","currency":"$","term":"/mo","showTerm":false} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-price ab-pricing-table-price-wrap ab-pricing-has-currency" style="padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><div itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="priceCurrency" placeholder="$" class="ab-pricing-table-currency" style="font-size:24px">$</span><div itemprop="price" class="ab-pricing-table-price" style="font-size:60px"><strong>2999</strong></div></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-price -->

<!-- wp:atomic-blocks/ab-pricing-table-features {"paddingTop":15,"paddingBottom":15} -->
<ul itemprop="description" class="wp-block-atomic-blocks-ab-pricing-table-features ab-pricing-table-features ab-list-border-none ab-list-border-width-1" style="padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px"><li> Logo concept<br> 3-page web design<br> 1 hour of training<br>1 email template </li></ul>
<!-- /wp:atomic-blocks/ab-pricing-table-features -->

<!-- wp:atomic-blocks/ab-pricing-table-button {"buttonText":"Get Started","buttonBackgroundColor":"#666666","buttonSize":"ab-button-size-small","buttonShape":"ab-button-shape-square","paddingTop":15,"paddingBottom":35} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-button ab-pricing-table-button" style="padding-top:15px;padding-right:20px;padding-bottom:35px;padding-left:20px"><div class="ab-block-button"><a class="ab-button ab-button-shape-square ab-button-size-small" style="color:#ffffff;background-color:#666666">Get Started</a></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-button -->

</div></div>
<!-- /wp:atomic-blocks/ab-pricing-table -->

<!-- wp:atomic-blocks/ab-pricing-table {"borderColor":"#cccccc","backgroundColor":"#ffffff","padding":5,"className":"pricing-featured"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table ab-block-pricing-table-center ab-block-pricing-table pricing-featured" itemscope itemtype="http://schema.org/Product"><div class="ab-block-pricing-table-inside" style="border-width:2px;border-style:solid;border-color:#cccccc;background-color:#ffffff;padding:5%"><!-- wp:atomic-blocks/ab-pricing-table-title {"title":"<strong>Package #2</strong>","fontSize":"larger","paddingTop":30} -->
<div itemprop="name" style="padding-top:30px;padding-right:20px;padding-bottom:10px;padding-left:20px" class="wp-block-atomic-blocks-ab-pricing-table-title ab-pricing-table-title has-larger-font-size"><strong>Package #2</strong></div>
<!-- /wp:atomic-blocks/ab-pricing-table-title -->

<!-- wp:atomic-blocks/ab-pricing-table-subtitle {"subtitle":"<em>This is a premium web design.</em>","customTextColor":"#555555"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-subtitle ab-pricing-table-subtitle" style="color:#555555;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><em>This is a premium web design.</em></div>
<!-- /wp:atomic-blocks/ab-pricing-table-subtitle -->

<!-- wp:atomic-blocks/ab-pricing-table-price {"price":"<strong>4999</strong>","currency":"$","term":"/mo","showTerm":false} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-price ab-pricing-table-price-wrap ab-pricing-has-currency" style="padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><div itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="priceCurrency" placeholder="$" class="ab-pricing-table-currency" style="font-size:24px">$</span><div itemprop="price" class="ab-pricing-table-price" style="font-size:60px"><strong>4999</strong></div></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-price -->

<!-- wp:atomic-blocks/ab-pricing-table-features {"paddingTop":15,"paddingBottom":15} -->
<ul itemprop="description" class="wp-block-atomic-blocks-ab-pricing-table-features ab-pricing-table-features ab-list-border-none ab-list-border-width-1" style="padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px"><li> Logo concept<br> 5-page web design<br> 3 hours of training<br> 2 Email templates </li></ul>
<!-- /wp:atomic-blocks/ab-pricing-table-features -->

<!-- wp:atomic-blocks/ab-pricing-table-button {"buttonText":"Get Started","buttonBackgroundColor":"#a86500","buttonShape":"ab-button-shape-square","paddingTop":15,"paddingBottom":35} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-button ab-pricing-table-button" style="padding-top:15px;padding-right:20px;padding-bottom:35px;padding-left:20px"><div class="ab-block-button"><a class="ab-button ab-button-shape-square ab-button-size-medium" style="color:#ffffff;background-color:#a86500">Get Started</a></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-button --></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table --></div></div>
<!-- /wp:atomic-blocks/ab-pricing -->

<!-- wp:heading {"align":"center"} -->
<h2 style="text-align:center">Three Columns</h2>
<!-- /wp:heading -->

<!-- wp:atomic-blocks/ab-pricing {"columns":3,"columnsGap":1,"align":"full"} -->
<div class="wp-block-atomic-blocks-ab-pricing ab-pricing-columns-3 alignfull"><div class="ab-pricing-table-wrap ab-block-pricing-table-gap-1"><!-- wp:atomic-blocks/ab-pricing-table {"borderWidth":6,"borderColor":"#f4f4f4","backgroundColor":"#f4f4f4"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table ab-block-pricing-table-center ab-block-pricing-table" itemscope itemtype="http://schema.org/Product"><div class="ab-block-pricing-table-inside" style="border-width:6px;border-style:solid;border-color:#f4f4f4;background-color:#f4f4f4"><!-- wp:atomic-blocks/ab-pricing-table-title {"title":"<strong>Package #1</strong>","fontSize":"larger","paddingTop":30} -->
<div itemprop="name" style="padding-top:30px;padding-right:20px;padding-bottom:10px;padding-left:20px" class="wp-block-atomic-blocks-ab-pricing-table-title ab-pricing-table-title has-larger-font-size"><strong>Package #1</strong></div>
<!-- /wp:atomic-blocks/ab-pricing-table-title -->

<!-- wp:atomic-blocks/ab-pricing-table-subtitle {"subtitle":"<em>This is a basic web design.</em>","customTextColor":"#555555"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-subtitle ab-pricing-table-subtitle" style="color:#555555;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><em>This is a basic web design.</em></div>
<!-- /wp:atomic-blocks/ab-pricing-table-subtitle -->

<!-- wp:atomic-blocks/ab-pricing-table-price {"price":"<strong>2999</strong>","currency":"$","customFontSize":50,"term":"/mo","showTerm":false} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-price ab-pricing-table-price-wrap ab-pricing-has-currency" style="padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><div itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="priceCurrency" placeholder="$" class="ab-pricing-table-currency" style="font-size:20px">$</span><div itemprop="price" class="ab-pricing-table-price" style="font-size:50px"><strong>2999</strong></div></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-price -->

<!-- wp:atomic-blocks/ab-pricing-table-features {"customFontSize":16,"paddingTop":15,"paddingBottom":15} -->
<ul itemprop="description" class="wp-block-atomic-blocks-ab-pricing-table-features ab-pricing-table-features ab-list-border-none ab-list-border-width-1" style="font-size:16px;padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px"><li> Logo concept<br> 3-page web design<br> 1 hour of training<br>1 Email template<br><del>eCommerce setup </del></li></ul>
<!-- /wp:atomic-blocks/ab-pricing-table-features -->

<!-- wp:atomic-blocks/ab-pricing-table-button {"buttonText":"Get Started","buttonBackgroundColor":"#666666","buttonSize":"ab-button-size-small","buttonShape":"ab-button-shape-square","paddingTop":15,"paddingBottom":35} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-button ab-pricing-table-button" style="padding-top:15px;padding-right:20px;padding-bottom:35px;padding-left:20px"><div class="ab-block-button"><a class="ab-button ab-button-shape-square ab-button-size-small" style="color:#ffffff;background-color:#666666">Get Started</a></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-button -->

</div></div>
<!-- /wp:atomic-blocks/ab-pricing-table -->

<!-- wp:atomic-blocks/ab-pricing-table {"borderColor":"#cccccc","backgroundColor":"#ffffff","className":"pricing-featured"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table ab-block-pricing-table-center ab-block-pricing-table pricing-featured" itemscope itemtype="http://schema.org/Product"><div class="ab-block-pricing-table-inside" style="border-width:2px;border-style:solid;border-color:#cccccc;background-color:#ffffff"><!-- wp:atomic-blocks/ab-pricing-table-title {"title":" <strong>Package #2</strong> ","fontSize":"larger","paddingTop":30} -->
<div itemprop="name" style="padding-top:30px;padding-right:20px;padding-bottom:10px;padding-left:20px" class="wp-block-atomic-blocks-ab-pricing-table-title ab-pricing-table-title has-larger-font-size"> <strong>Package #2</strong> </div>
<!-- /wp:atomic-blocks/ab-pricing-table-title -->

<!-- wp:atomic-blocks/ab-pricing-table-subtitle {"subtitle":"<em>This is an advanced web design.</em>","customTextColor":"#555555"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-subtitle ab-pricing-table-subtitle" style="color:#555555;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><em>This is an advanced web design.</em></div>
<!-- /wp:atomic-blocks/ab-pricing-table-subtitle -->

<!-- wp:atomic-blocks/ab-pricing-table-price {"price":"<strong>4999</strong>","currency":"$","customFontSize":50,"term":"/mo","showTerm":false} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-price ab-pricing-table-price-wrap ab-pricing-has-currency" style="padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><div itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="priceCurrency" placeholder="$" class="ab-pricing-table-currency" style="font-size:20px">$</span><div itemprop="price" class="ab-pricing-table-price" style="font-size:50px"><strong>4999</strong></div></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-price -->

<!-- wp:atomic-blocks/ab-pricing-table-features {"customFontSize":16,"paddingTop":15,"paddingBottom":15} -->
<ul itemprop="description" class="wp-block-atomic-blocks-ab-pricing-table-features ab-pricing-table-features ab-list-border-none ab-list-border-width-1" style="font-size:16px;padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px"><li> Logo concept<br> 5-page web design<br> 3 hours of training<br> 2 Email templates <br><del>eCommerce setup </del> </li></ul>
<!-- /wp:atomic-blocks/ab-pricing-table-features -->

<!-- wp:atomic-blocks/ab-pricing-table-button {"buttonText":"Get Started","buttonBackgroundColor":"#a86500","buttonShape":"ab-button-shape-square","paddingTop":15,"paddingBottom":35} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-button ab-pricing-table-button" style="padding-top:15px;padding-right:20px;padding-bottom:35px;padding-left:20px"><div class="ab-block-button"><a class="ab-button ab-button-shape-square ab-button-size-medium" style="color:#ffffff;background-color:#a86500">Get Started</a></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-button -->

</div></div>
<!-- /wp:atomic-blocks/ab-pricing-table -->

<!-- wp:atomic-blocks/ab-pricing-table {"borderWidth":6,"borderColor":"#f4f4f4","backgroundColor":"#f4f4f4"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table ab-block-pricing-table-center ab-block-pricing-table" itemscope itemtype="http://schema.org/Product"><div class="ab-block-pricing-table-inside" style="border-width:6px;border-style:solid;border-color:#f4f4f4;background-color:#f4f4f4"><!-- wp:atomic-blocks/ab-pricing-table-title {"title":"<strong>Package #3</strong>","fontSize":"larger","paddingTop":30} -->
<div itemprop="name" style="padding-top:30px;padding-right:20px;padding-bottom:10px;padding-left:20px" class="wp-block-atomic-blocks-ab-pricing-table-title ab-pricing-table-title has-larger-font-size"><strong>Package #3</strong></div>
<!-- /wp:atomic-blocks/ab-pricing-table-title -->

<!-- wp:atomic-blocks/ab-pricing-table-subtitle {"subtitle":"<em>This is a premium web design.</em>","customTextColor":"#555555"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-subtitle ab-pricing-table-subtitle" style="color:#555555;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><em>This is a premium web design.</em></div>
<!-- /wp:atomic-blocks/ab-pricing-table-subtitle -->

<!-- wp:atomic-blocks/ab-pricing-table-price {"price":"<strong>7999</strong>","currency":"$","customFontSize":50,"term":"/mo","showTerm":false} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-price ab-pricing-table-price-wrap ab-pricing-has-currency" style="padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><div itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="priceCurrency" placeholder="$" class="ab-pricing-table-currency" style="font-size:20px">$</span><div itemprop="price" class="ab-pricing-table-price" style="font-size:50px"><strong>7999</strong></div></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-price -->

<!-- wp:atomic-blocks/ab-pricing-table-features {"customFontSize":16,"paddingTop":15,"paddingBottom":15} -->
<ul itemprop="description" class="wp-block-atomic-blocks-ab-pricing-table-features ab-pricing-table-features ab-list-border-none ab-list-border-width-1" style="font-size:16px;padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px"><li> Logo concept<br> 10-page web design<br> 5 hours of training<br> 2 Email templates<br>&nbsp; eCommerce setup </li></ul>
<!-- /wp:atomic-blocks/ab-pricing-table-features -->

<!-- wp:atomic-blocks/ab-pricing-table-button {"buttonText":"Get Started","buttonBackgroundColor":"#666666","buttonSize":"ab-button-size-small","buttonShape":"ab-button-shape-square","paddingTop":15,"paddingBottom":35} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-button ab-pricing-table-button" style="padding-top:15px;padding-right:20px;padding-bottom:35px;padding-left:20px"><div class="ab-block-button"><a class="ab-button ab-button-shape-square ab-button-size-small" style="color:#ffffff;background-color:#666666">Get Started</a></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-button -->

</div></div>
<!-- /wp:atomic-blocks/ab-pricing-table --></div></div>
<!-- /wp:atomic-blocks/ab-pricing -->

<!-- wp:heading {"align":"center"} -->
<h2 style="text-align:center">Four Columns</h2>
<!-- /wp:heading -->

<!-- wp:atomic-blocks/ab-pricing {"columns":4,"columnsGap":1,"align":"full"} -->
<div class="wp-block-atomic-blocks-ab-pricing ab-pricing-columns-4 alignfull"><div class="ab-pricing-table-wrap ab-block-pricing-table-gap-1"><!-- wp:atomic-blocks/ab-pricing-table {"borderWidth":6,"borderColor":"#f4f4f4","backgroundColor":"#f4f4f4"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table ab-block-pricing-table-center ab-block-pricing-table" itemscope itemtype="http://schema.org/Product"><div class="ab-block-pricing-table-inside" style="border-width:6px;border-style:solid;border-color:#f4f4f4;background-color:#f4f4f4"><!-- wp:atomic-blocks/ab-pricing-table-title {"title":"<strong>Package #1</strong>","fontSize":"larger","paddingTop":30} -->
<div itemprop="name" style="padding-top:30px;padding-right:20px;padding-bottom:10px;padding-left:20px" class="wp-block-atomic-blocks-ab-pricing-table-title ab-pricing-table-title has-larger-font-size"><strong>Package #1</strong></div>
<!-- /wp:atomic-blocks/ab-pricing-table-title -->

<!-- wp:atomic-blocks/ab-pricing-table-subtitle {"subtitle":"<em>Basic web design.</em>","customTextColor":"#555555"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-subtitle ab-pricing-table-subtitle" style="color:#555555;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><em>Basic web design.</em></div>
<!-- /wp:atomic-blocks/ab-pricing-table-subtitle -->

<!-- wp:atomic-blocks/ab-pricing-table-price {"price":"<strong>2999</strong>","currency":"$","customFontSize":40,"term":"/mo","showTerm":false} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-price ab-pricing-table-price-wrap ab-pricing-has-currency" style="padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><div itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="priceCurrency" placeholder="$" class="ab-pricing-table-currency" style="font-size:16px">$</span><div itemprop="price" class="ab-pricing-table-price" style="font-size:40px"><strong>2999</strong></div></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-price -->

<!-- wp:atomic-blocks/ab-pricing-table-features {"customFontSize":16,"paddingTop":15,"paddingBottom":15} -->
<ul itemprop="description" class="wp-block-atomic-blocks-ab-pricing-table-features ab-pricing-table-features ab-list-border-none ab-list-border-width-1" style="font-size:16px;padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px"><li> Logo concept<br> 3-page web design<br> 1 hour of training<br>1 Email template<br> e<del>Commerce setup </del><br><del>Search optimization</del>  </li></ul>
<!-- /wp:atomic-blocks/ab-pricing-table-features -->

<!-- wp:atomic-blocks/ab-pricing-table-button {"buttonText":"Get Started","buttonBackgroundColor":"#666666","buttonSize":"ab-button-size-small","buttonShape":"ab-button-shape-square","paddingTop":15,"paddingBottom":35} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-button ab-pricing-table-button" style="padding-top:15px;padding-right:20px;padding-bottom:35px;padding-left:20px"><div class="ab-block-button"><a class="ab-button ab-button-shape-square ab-button-size-small" style="color:#ffffff;background-color:#666666">Get Started</a></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-button --></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table -->

<!-- wp:atomic-blocks/ab-pricing-table {"borderWidth":6,"borderColor":"#f4f4f4","backgroundColor":"#f4f4f4"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table ab-block-pricing-table-center ab-block-pricing-table" itemscope itemtype="http://schema.org/Product"><div class="ab-block-pricing-table-inside" style="border-width:6px;border-style:solid;border-color:#f4f4f4;background-color:#f4f4f4"><!-- wp:atomic-blocks/ab-pricing-table-title {"title":" <strong>Package #2</strong> ","fontSize":"larger","paddingTop":30} -->
<div itemprop="name" style="padding-top:30px;padding-right:20px;padding-bottom:10px;padding-left:20px" class="wp-block-atomic-blocks-ab-pricing-table-title ab-pricing-table-title has-larger-font-size"> <strong>Package #2</strong> </div>
<!-- /wp:atomic-blocks/ab-pricing-table-title -->

<!-- wp:atomic-blocks/ab-pricing-table-subtitle {"subtitle":"<em>Advanced web design.</em>","customTextColor":"#555555"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-subtitle ab-pricing-table-subtitle" style="color:#555555;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><em>Advanced web design.</em></div>
<!-- /wp:atomic-blocks/ab-pricing-table-subtitle -->

<!-- wp:atomic-blocks/ab-pricing-table-price {"price":"<strong>4999</strong>","currency":"$","customFontSize":40,"term":"/mo","showTerm":false} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-price ab-pricing-table-price-wrap ab-pricing-has-currency" style="padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><div itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="priceCurrency" placeholder="$" class="ab-pricing-table-currency" style="font-size:16px">$</span><div itemprop="price" class="ab-pricing-table-price" style="font-size:40px"><strong>4999</strong></div></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-price -->

<!-- wp:atomic-blocks/ab-pricing-table-features {"customFontSize":16,"paddingTop":15,"paddingBottom":15} -->
<ul itemprop="description" class="wp-block-atomic-blocks-ab-pricing-table-features ab-pricing-table-features ab-list-border-none ab-list-border-width-1" style="font-size:16px;padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px"><li> Logo concept<br> 5-page web design<br> 3 hours of training<br> 2 Email templates <br><del>eCommerce setup </del><br><del>Search optimization</del> </li></ul>
<!-- /wp:atomic-blocks/ab-pricing-table-features -->

<!-- wp:atomic-blocks/ab-pricing-table-button {"buttonText":"Get Started","buttonBackgroundColor":"#666666","buttonSize":"ab-button-size-small","buttonShape":"ab-button-shape-square","paddingTop":15,"paddingBottom":35} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-button ab-pricing-table-button" style="padding-top:15px;padding-right:20px;padding-bottom:35px;padding-left:20px"><div class="ab-block-button"><a class="ab-button ab-button-shape-square ab-button-size-small" style="color:#ffffff;background-color:#666666">Get Started</a></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-button --></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table -->

<!-- wp:atomic-blocks/ab-pricing-table {"borderColor":"#cccccc","backgroundColor":"#ffffff","className":"pricing-featured"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table ab-block-pricing-table-center ab-block-pricing-table pricing-featured" itemscope itemtype="http://schema.org/Product"><div class="ab-block-pricing-table-inside" style="border-width:2px;border-style:solid;border-color:#cccccc;background-color:#ffffff"><!-- wp:atomic-blocks/ab-pricing-table-title {"title":"<strong>Package #3</strong>","fontSize":"larger","paddingTop":30} -->
<div itemprop="name" style="padding-top:30px;padding-right:20px;padding-bottom:10px;padding-left:20px" class="wp-block-atomic-blocks-ab-pricing-table-title ab-pricing-table-title has-larger-font-size"><strong>Package #3</strong></div>
<!-- /wp:atomic-blocks/ab-pricing-table-title -->

<!-- wp:atomic-blocks/ab-pricing-table-subtitle {"subtitle":"<em>Premium web design.</em>","customTextColor":"#555555"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-subtitle ab-pricing-table-subtitle" style="color:#555555;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><em>Premium web design.</em></div>
<!-- /wp:atomic-blocks/ab-pricing-table-subtitle -->

<!-- wp:atomic-blocks/ab-pricing-table-price {"price":"<strong>7999</strong>","currency":"$","customFontSize":40,"term":"/mo","showTerm":false} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-price ab-pricing-table-price-wrap ab-pricing-has-currency" style="padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><div itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="priceCurrency" placeholder="$" class="ab-pricing-table-currency" style="font-size:16px">$</span><div itemprop="price" class="ab-pricing-table-price" style="font-size:40px"><strong>7999</strong></div></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-price -->

<!-- wp:atomic-blocks/ab-pricing-table-features {"customFontSize":16,"paddingTop":15,"paddingBottom":15} -->
<ul itemprop="description" class="wp-block-atomic-blocks-ab-pricing-table-features ab-pricing-table-features ab-list-border-none ab-list-border-width-1" style="font-size:16px;padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px"><li> Logo concept<br> 10-page web design<br> 5 hours of training<br> 2 Email templates<br> eCommerce setup <br><del>Search optimization</del> </li></ul>
<!-- /wp:atomic-blocks/ab-pricing-table-features -->

<!-- wp:atomic-blocks/ab-pricing-table-button {"buttonText":"Get Started","buttonBackgroundColor":"#a86500","buttonShape":"ab-button-shape-square","paddingTop":15,"paddingBottom":35} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-button ab-pricing-table-button" style="padding-top:15px;padding-right:20px;padding-bottom:35px;padding-left:20px"><div class="ab-block-button"><a class="ab-button ab-button-shape-square ab-button-size-medium" style="color:#ffffff;background-color:#a86500">Get Started</a></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-button --></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table -->

<!-- wp:atomic-blocks/ab-pricing-table {"borderWidth":6,"borderColor":"#f4f4f4","backgroundColor":"#f4f4f4"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table ab-block-pricing-table-center ab-block-pricing-table" itemscope itemtype="http://schema.org/Product"><div class="ab-block-pricing-table-inside" style="border-width:6px;border-style:solid;border-color:#f4f4f4;background-color:#f4f4f4"><!-- wp:atomic-blocks/ab-pricing-table-title {"title":"<strong>Package #4</strong>","fontSize":"larger","paddingTop":30} -->
<div itemprop="name" style="padding-top:30px;padding-right:20px;padding-bottom:10px;padding-left:20px" class="wp-block-atomic-blocks-ab-pricing-table-title ab-pricing-table-title has-larger-font-size"><strong>Package #4</strong></div>
<!-- /wp:atomic-blocks/ab-pricing-table-title -->

<!-- wp:atomic-blocks/ab-pricing-table-subtitle {"subtitle":"<em>Platinum web design.</em>","customTextColor":"#555555"} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-subtitle ab-pricing-table-subtitle" style="color:#555555;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><em>Platinum web design.</em></div>
<!-- /wp:atomic-blocks/ab-pricing-table-subtitle -->

<!-- wp:atomic-blocks/ab-pricing-table-price {"price":"<strong>9999</strong>","currency":"$","customFontSize":40,"term":"/mo","showTerm":false} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-price ab-pricing-table-price-wrap ab-pricing-has-currency" style="padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"><div itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="priceCurrency" placeholder="$" class="ab-pricing-table-currency" style="font-size:16px">$</span><div itemprop="price" class="ab-pricing-table-price" style="font-size:40px"><strong>9999</strong></div></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-price -->

<!-- wp:atomic-blocks/ab-pricing-table-features {"customFontSize":16,"paddingTop":15,"paddingBottom":15} -->
<ul itemprop="description" class="wp-block-atomic-blocks-ab-pricing-table-features ab-pricing-table-features ab-list-border-none ab-list-border-width-1" style="font-size:16px;padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px"><li> Logo concept<br> 20-page web design<br> 10 hours of training<br> Email template<br>&nbsp; eCommerce setup<br> Search optimization </li></ul>
<!-- /wp:atomic-blocks/ab-pricing-table-features -->

<!-- wp:atomic-blocks/ab-pricing-table-button {"buttonText":"Get Started","buttonBackgroundColor":"#666666","buttonSize":"ab-button-size-small","buttonShape":"ab-button-shape-square","paddingTop":15,"paddingBottom":35} -->
<div class="wp-block-atomic-blocks-ab-pricing-table-button ab-pricing-table-button" style="padding-top:15px;padding-right:20px;padding-bottom:35px;padding-left:20px"><div class="ab-block-button"><a class="ab-button ab-button-shape-square ab-button-size-small" style="color:#ffffff;background-color:#666666">Get Started</a></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table-button --></div></div>
<!-- /wp:atomic-blocks/ab-pricing-table --></div></div>
<!-- /wp:atomic-blocks/ab-pricing -->
CONTENT;
