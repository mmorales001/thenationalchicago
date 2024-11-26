<?php get_header(); ?>
<div class="col-lg-10 col-md-10 col-sm-9 fill">
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-5 col-md-push-8">
          <div class="panel-body">
            <a href="/#press" class="btn btn-back">
              <span class="sprite sprite-back"></span>
              Back to Press
            </a>
          </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-7 col-md-pull-4">
          <div id="panel">
              <div class="panel-body">
                  <h1><?php the_title(); ?></h1>
                  <h2 class="black"><?php the_excerpt(); ?></h2>
                  <?php if(has_post_thumbnail()) : ?>
                    <div>
                      <a href="#" title="<?php the_title(); ?>">
                        <?php the_post_thumbnail('large', array('class'=>'img-responsive')); ?>
                      </a>
                    </div>
                  <?php endif; ?>
                  <div class="">
                      <p></p>
                      <?php the_content(); ?>
                      <br/>
                  </div>
                  <?php if(get_field('highlights_title')): ?>
                      <div class="half-col">
                          <div class="highlights">
                              <h2><?php echo get_field('highlights_title'); ?></h2>
                              <div class="highlight-inner">
                                  <div class="col-left">
                                      <?php echo get_field('highlights_left_col'); ?>
                                  </div>
                                  <div class="col-right">
                                      <?php echo get_field('highlights_right_col'); ?>
                                  </div>
                                  <div class="clearfix"></div>
                              </div>
                          </div>
                      </div>
                  <?php endif; ?>
                  <div class="clearfix"></div>
              </div>
          </div>
        </div>
      </div>

    <?php endwhile; ?>
  <?php get_footer(); ?>
</div>
