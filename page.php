<?php get_header(); ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <div id="portfolio_entry">
            <?php if(get_field('slides')): ?>
                <div class="portfolio_slideshow">
                    <div id="main-slider" class="cycle-slideshow" 
                        data-cycle-fx="scrollHorz" 
                        data-cycle-timeout="60000"
                        data-cycle-slides="> div.slide"
                        data-cycle-log=false
                        data-cycle-swipe=true
                        >
                        <?php $first_slide = ''; ?>
                        <?php $index = 0; foreach(get_field('slides') as $slide): ?>
                            <?php if($index == 0) $first_slide = $slide['slide']; ?>
                            <div class="slide">
                                <img src="<?php echo $slide['slide']; ?>" alt="slide_<?php echo ++$index; ?>" class="bg-image" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div id="cycle-pager">
                        <div class="cycle-slideshow"
                            data-cycle-slides="> div.slide"
                            data-cycle-timeout="0"
                            data-cycle-fx="carousel"
                            data-cycle-carousel-visible="4"
                            data-allow-wrap=true
                            data-cycle-log=false
                            data-cycle-prev="#cycle-pager .cycle-prev"
                            data-cycle-next="#cycle-pager .cycle-next"
                            >
                            <?php $index = 0; foreach(get_field('slides') as $slide): ?>
                            <div class="slide">
                                <img src="<?php echo $slide['slide']; ?>" alt="thumb_<?php echo ++$index; ?>" />
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <div class="controls">
                            <div class="cycle-prev"></div>
                            <div class="cycle-next"></div>
                        </div>
                    </div>
                    <div class="options">
                        <!-- BEGIN TOOLTIP -->
                        <div class="bonfire-share-tooltip
                            <?php if(get_option('bonfire_socialshare_position') == "positionleft") { ?> social-share-left-position-tooltip
                            <?php } elseif(get_option('bonfire_socialshare_position') == "positioncenter") { ?> social-share-centered-position-tooltip
                            <?php } ?>">
                        </div>
                        <!-- END TOOLTIP -->
                        <!-- BEGIN ACTIVATION BUTTON -->
                        <div class="bonfire-share-activate-button share 
                            <?php if( get_option('bonfire_socialshare_scroll_to_show') ) { ?>bonfire-share-activate-button-visible
                            <?php } ?>
                            <?php if(get_option('bonfire_socialshare_position') == "positionleft") { ?> social-share-left-position-button
                            <?php } elseif(get_option('bonfire_socialshare_position') == "positioncenter") { ?> social-share-centered-position-button
                            <?php } ?>">
                            <?php if( get_option('bonfire_socialshare_hidelabel') ) { ?>
                            <?php } else { ?>
                            <div class="share-desc">SHARE</div>
                            <?php } ?>
                            <i class="fa 
                                <?php if( get_option('bonfire_socialshare_activation') ) { ?>
                                <?php echo get_option('bonfire_socialshare_activation'); ?>
                                <?php } else { ?> fa-plus-circle
                                <?php } ?>">
                            </i>
                        </div>
                        <!-- END ACTIVATION BUTTON -->
                        <!-- BEGIN BUTTONS WRAPPER -->
                        <ul class="social-share-wrapper
                            <?php if(get_option('bonfire_socialshare_position') == "positionleft") { ?> social-share-left-position
                            <?php } elseif(get_option('bonfire_socialshare_position') == "positioncenter") { ?> social-share-centered-position
                            <?php } ?>">
                            <!-- BEGIN TWITTER BUTTON -->
                            <?php if( get_option('bonfire_socialshare_twitter') ) { ?>
                            <li>
                                <a class="bonfire-twitter-button" target="_blank" href="http://twitter.com/share?url=
                                    <?php the_permalink(); ?>&text=
                                    <?php the_title(); ?>">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <?php } ?>
                            <!-- END TWITTER BUTTON -->
                            <!-- BEGIN FACEBOOK BUTTON -->
                            <?php if( get_option('bonfire_socialshare_facebook') ) { ?>
                            <li>
                                <a class="bonfire-facebook-button" target="_blank" href="http://www.facebook.com/sharer.php?u=
                                    <?php the_permalink(); ?>&t=
                                    <?php the_title(); ?>">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <?php } ?>
                            <!-- END FACEBOOK BUTTON -->
                            <!-- BEGIN GOOGLEPLUS BUTTON -->
                            <?php if( get_option('bonfire_socialshare_googleplus') ) { ?>
                            <li>
                                <a class="bonfire-googleplus-button" target="_blank" href="https://plus.google.com/share?url=
                                    <?php the_permalink(); ?>">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                            <?php } ?>
                            <!-- END GOOGLEPLUS BUTTON -->
                            <!-- BEGIN TUMBLR BUTTON -->
                            <?php if( get_option('bonfire_socialshare_tumblr') ) { ?>
                            <li>
                                <a class="bonfire-tumblr-button" target="_blank" href="http://www.tumblr.com/share">
                                    <i class="fa fa-tumblr"></i>
                                </a>
                            </li>
                            <?php } ?>
                            <!-- END TUMBLR BUTTON -->
                            <!-- BEGIN EMAIL BUTTON -->
                            <?php if( get_option('bonfire_socialshare_email') ) { ?>
                            <li>
                                <a class="bonfire-email-button" href="mailto:?subject=
                                    <?php the_title(); ?>&body=
                                    <?php the_permalink(); ?>">
                                    <i class="fa fa-envelope"></i>
                                </a>
                            </li>
                            <?php } ?>
                            <!-- END EMAIL BUTTON -->
                        </ul>
                        <!-- END BUTTONS WRAPPER -->
                        <a class="download" href="<?php echo $first_slide; ?>" download target="_blank"></a>
                    </div>
                </div>
            <?php endif; ?>
            <div class="main-content">
                <h1><?php the_title(); ?></h1>
                <div class="clearfix"></div>
                <div class="half-col">
                    <?php the_content(); ?>
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

    <?php endwhile; ?>

<?php get_footer(); ?>