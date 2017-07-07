<?php get_header(); ?>
    <section class="blog">
      <div class="container">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        <?php the_excerpt(); ?>
        <?php echo paginate_links(); ?>
  <?php endwhile; endif; ?>
      </div>
    </section>
<?php get_footer(); ?>
