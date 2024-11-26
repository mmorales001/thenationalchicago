<?php
// Template Name: Homepage
?>
<?php get_header(); ?>
<div class="col-lg-10 col-md-10 col-sm-9 fill">
    <?php while (have_posts()):
        the_post(); ?>

        <div id="home" class="content section row">
            <?php if (get_field('slider')): ?>
                <!--div class="cycle-slideshow"-->
                <div class="slider" data-cycle-log=false data-cycle-swipe=true data-slider="home">
                    <div class="controls">
                        <div class="cycle-prev sprite sprite-arrow-near"></div>
                        <div class="cycle-next sprite sprite-arrow-far"></div>
                    </div>
                    <?php $index = 0;
                    foreach (get_field('slider') as $slide): ?>
                        <div id="home-slide-<?php echo $index + 1; ?>" class="slide" data-img="<?php echo $slide['image']; ?>">
                            <?php echo $slide['caption']; ?>
                        </div>
                        <?php $index++; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="transition section backstretch row" style="background-image: url(<?php echo get_field('blueprint_image_1'); ?>); filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
src='<?php echo get_field('blueprint_image_1'); ?>',
sizingMethod='scale'); -ms-filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
src='<?php echo get_field('blueprint_image_1'); ?>',
sizingMethod='scale');" data-stellar-background-ratio="0.2"></div>

        <div id="building" class="content section row">
            <?php if (get_field('building_slider')): ?>
                <!--div class="cycle-slideshow"-->
                <div class="slider" data-cycle-log=false data-cycle-swipe=true data-slider="building">
                    <div class="controls">
                        <div class="cycle-prev sprite sprite-arrow-near"></div>
                        <div class="cycle-next sprite sprite-arrow-far"></div>
                    </div>
                    <?php $index = 0;
                    foreach (get_field('building_slider') as $slide): ?>
                        <div id="building-slide-<?php echo $index + 1; ?>" class="slide <?php echo $slide['background_color']; ?>"
                            data-img="<?php echo $slide['image']; ?>">
                            <?php echo $slide['caption']; ?>
                        </div>
                        <?php $index++; endforeach; ?>
                </div>
                <?php $index++; ?>
            <?php endif; ?>
            <a href="#foodhall" class="center-block sprite sprite-down-arrow"></a>
        </div>

        <div class="transition section backstretch row" style="background-image: url(<?php echo get_field('blueprint_image_2'); ?>); filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
src='<?php echo get_field('blueprint_image_2'); ?>',
sizingMethod='scale'); -ms-filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
src='<?php echo get_field('blueprint_image_2'); ?>',
sizingMethod='scale');" data-stellar-background-ratio="0.5"></div>

        <div id="foodhall" class="content section row">
            <?php if (get_field('marketplace_slider')): ?>
                <div class="slider" data-cycle-swipe='true' data-slider='marketplace'>
                    <div class="controls">
                        <div class="cycle-prev sprite sprite-arrow-near"></div>
                        <div class="cycle-next sprite sprite-arrow-far"></div>
                    </div>
                    <?php $index = 0;
                    foreach (get_field('marketplace_slider') as $slide): ?>
                        <div id="marketplace-slide-<?php echo $index + 1; ?>" class="slide"
                            data-img="<?php echo $slide['image']; ?>">
                            <?php echo $slide['caption']; ?>
                        </div>
                        <?php $index++; endforeach; ?>
                </div>
            <?php endif; ?>
            <a href="#location" class="center-block sprite sprite-down-arrow"></a>
        </div>

        <div class="transition section backstretch row" style="background-image: url(<?php echo get_field('blueprint_image_3'); ?>); filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
src='<?php echo get_field('blueprint_image_3'); ?>',
sizingMethod='scale'); -ms-filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
src='<?php echo get_field('blueprint_image_3'); ?>',
sizingMethod='scale');" data-stellar-background-ratio="0.2"></div>

        <div id="location" class="content section row">
            <?php if (get_field('location_slider')): ?>
                <div class="slider" data-cycle-log=false data-cycle-swipe=true data-slider="location">
                    <div class="controls">
                        <div class="cycle-prev sprite sprite-arrow-near"></div>
                        <div class="cycle-next sprite sprite-arrow-far"></div>
                    </div>
                    <?php $index = 0;
                    foreach (get_field('location_slider') as $slide): ?>
                        <div class="slide" data-img="<?php echo $slide['image']; ?>">
                            <?php echo $slide['caption']; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <a href="#images" class="center-block sprite sprite-down-arrow"></a>
        </div>

        <div class="transition section backstretch row" style="background-image: url(<?php echo get_field('blueprint_image_4'); ?>); filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
src='<?php echo get_field('blueprint_image_4'); ?>',
sizingMethod='scale'); -ms-filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
src='<?php echo get_field('blueprint_image_4'); ?>',
sizingMethod='scale');" data-stellar-background-ratio="0.5"></div>

        <?php
        $films = get_posts(array('posts_per_page' => '-1', 'post_type' => 'film'));
        $film_last_row = count($films) - 1;
        $film_wrapper = 8;
        ?>
        <div id="films" style="display:none;" class="content section row">
            <div class="col-xs-12">
                <h5 class="media-heading">The National <span class="blue">Films</span></h5>
            </div>
            <div class="col-xs-12 no-padding">
                <div class="slider" data-cycle-log=false data-cycle-swipe=true data-slider="films">
                    <?php if (count($films) > 8): ?>
                        <div class="controls">
                            <div class="cycle-prev sprite sprite-arrow-near"></div>
                            <div class="cycle-next sprite sprite-arrow-far"></div>
                        </div>
                    <?php endif; ?>

                    <?php foreach ($films as $film_id => $film_row): ?>
                        <?php if ($film_id % $film_wrapper == 0) {
                            print '<div class="slide"><div class="row"><div class="col-xs-12">';
                            $film_i = 0;
                        }
                        ?>
                        <div class="col-md-3 center-block media-item">
                            <a href="<?php echo get_video_url(get_post_meta($film_row->ID, 'video_type', true), get_post_meta($film_row->ID, 'video_url', true)); ?>"
                                class="play" rel="lightbox films">
                                <!--[if IE 8]><span></span><![endif]-->
                                <?php echo get_the_post_thumbnail($film_row->ID, 'full', array('class' => 'img-responsive center-block')) ?>
                            </a>
                        </div>
                        <?php
                        $film_i++;
                        if ($film_i == $film_wrapper || $film_id == $film_last_row) {
                            print '</div></div></div>';
                        }
                        ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <a href="#images_gallery" class="center-block sprite sprite-down-arrow"></a>
        </div>

        <div class="transition section backstretch row" style="background-image: url(<?php echo get_field('blueprint_image_5'); ?>); filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
src='<?php echo get_field('blueprint_image_5'); ?>',
sizingMethod='scale'); -ms-filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
src='<?php echo get_field('blueprint_image_5'); ?>',
sizingMethod='scale');" data-stellar-background-ratio="0.2"></div>

        <?php
        $gallery_args = array(
            'post_status' => 'published',
            'category_name' => 'main',
            'posts_per_page' => '1',
        );

        // The Query
        $gallery_query = new WP_Query($gallery_args);
        $gallery_post = $gallery_query->post;
        $gallery = get_post_galleries($gallery_post->ID, false)[0];
        $image_rows = explode(',', $gallery['ids']);
        $image_last_row = count($image_rows) - 1;
        $image_wrapper = 8;
        ?>
        <div id="images" class="content section row">
            <div class="col-xs-12">
                <h5 class="media-heading">The National <span class="blue">Images</span></h5>
            </div>
            <div class="col-xs-12 no-padding">
                <div class="slider" data-cycle-log=false data-cycle-swipe=true data-slider="images">
                    <?php if (count($image_rows) > 8): ?>
                        <div class="controls">
                            <div class="cycle-prev sprite sprite-arrow-near"></div>
                            <div class="cycle-next sprite sprite-arrow-far"></div>
                        </div>
                    <?php endif; ?>

                    <?php foreach ($image_rows as $image_id => $image_row): ?>
                        <?php if ($image_id % $image_wrapper == 0) {
                            print '<div class="slide"><div class="container-fluid"><div class="row">';
                            $image_i = 0;
                        }
                        ?>
                        <div class="col-md-3 center-block media-item">
                            <a href="<?php echo wp_get_attachment_url($image_row); ?>" rel="lightbox main-images">
                                <?php echo wp_get_attachment_image($image_row, 'medium', false, array('class' => 'img-responsive center-block')); ?>
                            </a>
                        </div>
                        <?php
                        $image_i++;
                        if ($image_id == $image_last_row) {
                            print '<div class="col-md-3 center-block media-item"><a href="https://my.matterport.com/show/?m=XUMnXT9ASN9" target="_blank" rel="nofollow"><img class="img-responsive center-block" src="http://thenationalchicago.com/wp-content/uploads/2015/03/3d-tour.jpg" /></a></div></div</div>';
                        }
                        ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <a href="#leasing" class="center-block sprite sprite-down-arrow"></a>
    </div>

    <div class="transition section backstretch row" style="display:none;background-image: url(<?php echo get_field('blueprint_image_6'); ?>); filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
src='<?php echo get_field('blueprint_image_6'); ?>',
sizingMethod='scale'); -ms-filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
src='<?php echo get_field('blueprint_image_6'); ?>',
sizingMethod='scale');" data-stellar-background-ratio="0.2"></div>

    <?php
    $press_rows = get_posts(array('posts_per_page' => '-1', 'post_type' => 'press'));
    $press_last_row = count($press_rows) - 1;
    $press_wrapper = 8;
    ?>
    <div id="press" class="content section row" style="display:none;">
        <div class="visible-sm visible-xs col-xs-12">
            <h5 class="media-heading">Press</h5>
        </div>
        <div class="slider" style="margin-top: 35px;" data-cycle-log=false data-cycle-swipe=true data-slider="press">
            <?php if (count($press_rows) > 8): ?>
                <div class="controls">
                    <div class="cycle-prev sprite sprite-arrow-near"></div>
                    <div class="cycle-next sprite sprite-arrow-far"></div>
                </div>
            <?php endif; ?>

            <?php foreach ($press_rows as $press_id => $press_row): ?>
                <?php if ($press_id % $press_wrapper == 0) {
                    print '<div class="slide"><div class="row">';
                    $press_i = 0;
                }
                ?>
                <div class="col-md-3 press-entry text-center">
                    <a href="<?php echo get_permalink($press_row->ID) ?>">
                        <img class="center-block img-responsive" alt="<?php echo $press_row->post_title ?>"
                            src="<?php echo wp_get_attachment_image_src(get_post_meta($press_row->ID, 'cover_image', true), 'full')[0]; ?>" />
                        <h4 class="title"><?php echo $press_row->post_title; ?></h4>
                    </a>
                    <p>"...<?php echo $press_row->post_excerpt; ?>"</p>
                </div>
                <?php
                $press_i++;
                if ($press_i == $press_wrapper || $press_id == $press_last_row) {
                    print '</div></div>';
                }
                ?>
            <?php endforeach; ?>
        </div>
        <p class="text-center" style="font-weight: bold; margin-bottom: 50px; text-transform: uppercase;">For press
            inquiries email: <a href="mailto:press@thenationalchicago.com">press@thenationalchicago.com</a></p>
        <a href="#leasing" class="center-block sprite sprite-down-arrow"></a>
    </div>

    <div class="transition section backstretch row" style="background-image: url(<?php echo get_field('blueprint_image_7'); ?>); filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
src='<?php echo get_field('blueprint_image_7'); ?>',
sizingMethod='scale'); -ms-filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
src='<?php echo get_field('blueprint_image_7'); ?>',
sizingMethod='scale');" data-stellar-background-ratio="0.2"></div>

    <div id="leasing" class="content section row">
        <div class="slider" data-cycle-log=false data-cycle-swipe=true data-slider="leasing">
            <div class="controls">
                <div class="cycle-prev sprite sprite-arrow-near"></div>
                <div class="cycle-next sprite sprite-arrow-far"></div>
            </div>
            <div id="leasing-slide-1" class="slide" data-img="<?php echo get_field("leasing_background_image"); ?>">
                <div class="row">
                    <div class="col-sm-6 col-md-8 col-lg-9"></div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="panel panel-accented panel-blue panel-blue-bottom-left panel-blue-bottom-right">
                            <div class="panel-body">
                                <?php echo get_field("leasing_copy"); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php foreach (get_field('leasing_slider') as $leasing_id => $leasing_slide): ?>
                <div class="slide" data-img="<?php echo $leasing_slide['image']; ?>">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-1 panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-5 col-sm-offset-1 col-xs-offset-2">
                                        <img class="img-responsive" src="<?php echo $leasing_slide['floor_image']; ?>" />
                                    </div>
                                    <div class="col-md-12 col-sm-5 col-sm-offset-1 col-xs-offset-2">
                                        <h3>Floors <span class="blue"><?php echo $leasing_slide['floor_numbers']; ?></span></h5>
                                            <?php echo $leasing_slide['floor_details'] ?>
                                            <?php if ($leasing_slide['download_link']): ?>
                                                <a class="download-link" href="<?php echo $leasing_slide['download_link']['url'] ?>"
                                                    target="_blank" download><span
                                                        class="sprite sprite-btn_download"></span><?php echo $leasing_slide['download_label'] ?></a>
                                            <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 panel panel-default">
                            <img class="img-responsive center-block" src="<?php echo $leasing_slide['floor_plan']; ?>" />
                            <div class="text-right">
                                <a class="enlarge-link" rel="lightbox" href="<?php echo $leasing_slide['floor_plan'] ?>">Enlarge
                                    View <span class="sprite sprite-btn_expand"></span></a>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="transition section row backstretch" style="background-image: url(<?php echo get_field('blueprint_image_8'); ?>); filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
src='<?php echo get_field('blueprint_image_8'); ?>',
sizingMethod='scale'); -ms-filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
src='<?php echo get_field('blueprint_image_8'); ?>',
sizingMethod='scale');" data-stellar-background-ratio="0.2"></div>

    <div id="contact" class="content section row"
        style="background: no-repeat right top; background-image: url('<?php echo get_field("contact_background_image"); ?>'); background-size: contain;">
        <br />
        <div class="col-md-12">
            <h2 class="heading">Contact</h2>
            <div class="panel-body contact-form">
                <?php echo get_field("contact_copy"); ?>
                <?php //echo do_shortcode('[contact-form-7 title="Contact form"]'); ?>
                <br /><br />
            </div>
        </div>
    </div>

<?php endwhile; ?>
<?php get_footer(); ?>