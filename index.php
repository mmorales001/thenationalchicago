<?php get_header(); ?>

    <div id="portfolio">
        <div class="portfolio-box">
            
            <h2>
                <?php if(is_search()) : ?>
              <?php esc_attr_e('Search results') ?>
              <?php elseif(is_year()) : ?>
                  <?php echo get_query_var('m'); esc_attr_e(' Archive') ?>
              <?php elseif(is_month()) : ?>
                  <?php echo get_query_var('m'); esc_attr_e(' Archive') ?>
              <?php elseif(is_day()) : ?>
                  <?php echo get_query_var('m'); esc_attr_e(' Archive') ?>
              <?php elseif(is_archive()) : ?>
                  <?php echo single_cat_title(); ?>
              <?php else: ?>
                  <?php esc_attr_e('Archive Results') ?>
              <?php endif; ?>
                </h2>

            <?php while ( have_posts() ) : the_post(); ?>

                <div class="portfolio-entry">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?> <span class="title"><?php the_title() ?></span></a>
                    </div>

            <?php endwhile; ?>
            
        </div>
    </div>

<?php get_footer(); ?>