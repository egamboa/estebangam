<?php
$root =dirname(dirname(dirname(dirname(dirname(__FILE__)))));
//echo $root; 
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}
header("Content-type: text/css; charset=utf-8");
global $theme_option; 
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}
$b=$theme_option['main-color'];
$rgba = hex2rgb($b); 
?>
/* Color Theme - Amethyst /Violet/

color - <?php echo $theme_option['main-color']; ?>

/* 01 MAIN STYLES
****************************************************************************************************/
a {
  color: <?php echo $theme_option['main-color']; ?>;
}
::selection {
  color: #fff;
  background: <?php echo $theme_option['main-color']; ?>;
}
::-moz-selection {
  color: #fff;
  background: <?php echo $theme_option['main-color']; ?>;
}
.item a .desc {background: rgba(<?php echo $rgba[0]; ?>, <?php echo $rgba[1]; ?>, <?php echo $rgba[2]; ?>, 0.95);}

.aboutSocial li, .aboutSocial li a, ul#category li a:hover, #category .current a,
.postMeta a:hover, .postDetails .more a:hover, .commentContent .date a, .searchForm  .submitSearch,
.widget_categories li, .widget_archive li a,.widget_meta abbr, .widget_categories li span.countCat
{color: <?php echo $theme_option['main-color']; ?>;}

.tagsListSingle li a, #wp-calendar tbody td#today, .download, .download span, .download i,
.dtIco span.date, .getCv i, .postCount.short h3, .tagsListSingle li a
{background: <?php echo $theme_option['main-color']; ?>;}
#category .current a:after {border-bottom: 1px solid <?php echo $theme_option['main-color']; ?>;}	

/************** FOOTER *******************/
.footerholder {
  background: none repeat scroll 0 0 <?php echo $theme_option['background-footer']; ?>;
  color: <?php echo $theme_option['color-footer']; ?>;
}
.footerholder p {color: <?php echo $theme_option['color-footer']; ?>;}