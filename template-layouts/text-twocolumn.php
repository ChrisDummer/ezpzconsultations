<?php
/**
 * Flexible layout: Text block (Two Column)
 * Renders a section containing two columns of WYSIWIG text
 *
 * @package jellypress
 */
?>

<?php
  $section_id = get_query_var('section_id');
  $title = get_sub_field( 'title' );
?>

<?php if ($title) : ?>
<header class="row">
  <div class="col">
    <h2 class="section-header"><?php echo $title; ?></h2>
  </div>
</header>
<?php endif; ?>
<div class="row">
  <div class="col xs-12 md-6">
    <?php the_sub_field( 'column_1' ); ?>
  </div>
  <div class="col xs-12 md-6">
    <?php the_sub_field( 'column_2' ); ?>
  </div>
</div>