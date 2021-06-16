<?php
/**
 * Useful Helper functions and snippets
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Function which trims supplied text to a specified length.
 *
 * @param $text = Text to Trim
 * @param $maxchar = Maximum characters
 * @param string $end = Appended to text that gets trimmed
 * @return void
 */
function ezpzconsultations_trimpara($text, $maxchar, $end='...') {
  // @link https://www.hashbangcode.com/article/cut-string-specified-length-php
  if (strlen($text) > $maxchar || $text == '') {
      $words = preg_split('/\s/', $text);
      $output = '';
      $i      = 0;
      while (1) {
          $length = strlen($output)+strlen($words[$i]);
          if ($length > $maxchar) {
              break;
          }
          else {
              $output .= " " . $words[$i];
              ++$i;
          }
      }
      $output .= $end;
  }
  else {
      $output = $text;
  }
  return $output;
}

/**
 * Preg match search for [[$string]] and replace with a span with class .text-accent
 */
if ( ! function_exists( 'ezpzconsultations_bracket_tag_replace' ) ) {
  function ezpzconsultations_bracket_tag_replace($text) {
    if (preg_match("~\[\[(.*?)\]\]~",$text,$m)) {
      $find = ['(\[\[)', '(\]\])'];
      $replace = ['<span class="text-accent">', '</span>'];
      return preg_replace($find, $replace,  $text);
    }
    else {
      return $text;
    }
  }
}

/**
 * Adds a function to display SVGs from the spritesheet.
 */
if ( ! function_exists( 'ezpzconsultations_icon' ) ) {
  function ezpzconsultations_icon($icon) {
    // Define SVG sprite file.
    $icon_path = get_theme_file_path( '/dist/icons/'.$icon.'.svg' );
    // If it exists, include it.
    if ( file_exists( $icon_path ) ) {
      $use_link = get_template_directory_uri().'/dist/icons/icons.svg#icon-'.$icon;
      return '<svg class="icon icon__'.$icon.'"><use xlink:href="'.$use_link.'" /></use></svg>';
    }
    else {
      return '';
    }
  }
}

/**
 * Obscure email addresses from spam bots
 * Spam bots will only be able to read the email address if they are capable of executing javascript
 * @link http://www.maurits.vdschee.nl/php_hide_email/
 */
if ( ! function_exists( 'ezpzconsultations_hide_email' ) ) {
  function ezpzconsultations_hide_email($email, $show_icon = false) {
    $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';
    $key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999);
    for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])];
    $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";';
    $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';
    $script.= 'document.getElementById("'.$id.'").innerHTML="<a href=\\"mailto:"+d+"\\">"+d+"</a>"';
    $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")";
    $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>';

    $icon = $show_icon == true ? ezpzconsultations_icon('email') : '';
    return '<span class="email-address">'.$icon.'<span id="'.$id.'">[javascript protected email address]</span></span>'.$script;
  }
}

/**
 * Gets the full URL of the current page
 *
 * @return void
 */
if ( ! function_exists( 'ezpzconsultations_get_full_url' ) ) :
  function ezpzconsultations_get_full_url() {
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
      $url = "https://";
    else
      $url = "http://";
    // Append the host(domain name, ip) to the URL.
    $url.= $_SERVER['HTTP_HOST'];

    // Append the requested resource location to the URL
    $url.= $_SERVER['REQUEST_URI'];
    return $url;
  }
endif;

/**
 * Calculates the approximate reading time for a string.
 * Sanitizes and removes tags to give an accurate read out.
 *
 * @param string $string = text to count
 * @param integer $wpm = Words Per Minute
 * @return integer Approximate reading time in minutes
 */
if ( ! function_exists( 'ezpzconsultations_calculate_reading_time' ) ) :
  function ezpzconsultations_calculate_reading_time($string, $wpm = 265) {
    $text_content = strip_shortcodes($string);    // Remove shortcodes
    $str_content = strip_tags( $text_content );   // Remove tags
    $word_count = str_word_count( $str_content ); // Count Words

    $reading_time = ceil( $word_count / $wpm );
    return $reading_time;
  }
endif;

if ( ! function_exists( 'dunhamco_bracket_tag_replace' ) ) {
  function dunhamco_bracket_tag_replace($text) {
    if (preg_match("~\[\[(.*?)\]\]~",$text,$m)) {
      $find = ['(\[\[)', '(\]\])'];
      $replace = ['<span class="text-accent">', '</span>'];
      return preg_replace($find, $replace,  $text);
    }
    else {
      return $text;
    }
  }
}

