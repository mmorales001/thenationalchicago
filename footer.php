        <div id="footer" class="row">
            <?php dynamic_sidebar('footer_section'); ?>
            <div class="clearfix"></div>
        </div>    

        </div>
        <?php wp_footer(); ?>
        </div>
    </div>
    <script type="text/javascript" src="<?php get_bloginfo( 'template_url' ) . '/js/vendor.min.js' ?>"></script>

    <?php if(!is_front_page()): ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.nav-box li a, .mobile-menu li a').each(function() {
                    var ancor = $(this).attr('href');
                    $(this).attr('href', '<?php echo home_url('/'); ?>' + ancor);
                });
            });
        </script>
    <?php endif; ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.external a').on('click',function(e) {
					e.preventDefault();
                    var ancor = $(this).attr('href');
                    window.location.href = ancor;
                });
            });
        </script>
</body>
</html>