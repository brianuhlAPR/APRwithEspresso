<?php
/**
 * Essence Pro.
 *
 * Homepage content optionally installed after theme activation.
 *
 * @package Essence Pro
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/essence/
 */

return <<<CONTENT
<!-- wp:atomic-blocks/ab-post-grid {"className":"margin-overlay","postsToShow":2,"postTitleTag":"h2","align":"full","excerptLength":16,"imageSize":"featured-image"} /-->

<!-- wp:atomic-blocks/ab-post-grid {"postsToShow":3,"displayPostDate":false,"displayPostExcerpt":false,"displayPostAuthor":false,"displayPostLink":false,"postTitleTag":"h2","columns":3,"align":"full","offset":2,"imageSize":"featured-image"} /-->

<!-- wp:button {"customTextColor":"#777777","align":"center","className":"is-style-outline button-break alignfull"} -->
<div class="wp-block-button aligncenter is-style-outline button-break alignfull"><a class="wp-block-button__link has-text-color" href="#" style="color:#777777">Read More Posts</a></div>
<!-- /wp:button -->

<!-- wp:atomic-blocks/ab-container {"containerPaddingTop":10,"containerPaddingRight":20,"containerPaddingBottom":15,"containerPaddingLeft":20,"containerMarginTop":12,"containerMarginBottom":10,"containerWidth":"full","containerBackgroundColor":"#ffffff","className":"box-shadow"} -->
<div style="background-color:#ffffff;padding-left:20%;padding-right:20%;padding-bottom:15%;padding-top:10%;margin-top:12%;margin-bottom:10%" class="wp-block-atomic-blocks-ab-container box-shadow ab-block-container alignfull"><div class="ab-container-inside"><div class="ab-container-content" style="max-width:1600px"><!-- wp:heading {"align":"center"} -->
<h2 style="text-align:center" id="newsletter">Join Our Weekly Newsletter </h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p style="text-align:center">Get our best articles about body, mind, soul, style, travel, and culture. No charge. No spam. Only love. </p>
<!-- /wp:paragraph -->

<!-- wp:atomic-blocks/newsletter {"buttonShape":"ab-button-shape-square","mailingList":"1a951fe674","customBackgroundColor":"#ffffff","instanceId":0,"className":"inline-submit"} /--></div></div></div>
<!-- /wp:atomic-blocks/ab-container -->
CONTENT;
