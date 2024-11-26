(function() {

    function checkIfMobile() {
        var $body = $('body');
        if($body.width() > 750) {
            $body.removeClass('mobile').addClass('desktop');
            return false;
        } else {
            $body.removeClass('desktop').addClass('mobile');
            return true;
        }
    }

    function toggleSliderControls(e, opts) {
        var slide = opts.currSlide,
            next = $(this).find(opts.next),
            prev = $(this).find(opts.prev),
            slider = $(this).data('slider');

        if(slide === 0) {
            if(slider == 'marketplace' || slider == 'press' || slider === 'location' || slider === 'films' || slider === 'images') {
              next.show();
            } else {
              next.hide();
            }
            prev.hide();
        } else if(slide === (opts.slideCount - 1)) {
            next.hide();
            prev.show();
        } else {
            next.show();
            prev.show();
        }
    }

    function gotoNextSlide(e) {
        e.preventDefault();
        var slider = e.data.slider;
        $(slider).cycle('next');
    }

    function scrollIfAnchor(href) {
		consoe.log("log");
      var fromTop = checkIfMobile() ? 96 : 124,
          $target;

      href = typeof(href) === "string" ? href : $(this).attr("href");

      if(!href) {return;}

      $target = $(href);

      if($target.length) {
        var $top = $target.offset().top;

        $('html,body').animate({
            scrollTop: $top - (fromTop)
        }, 1500);

        if(history && "pushState" in history) {
            history.pushState({}, document.title, window.location.pathname + href);
        }

        return false;
      }
    }

  function toggleMap(e) {
    var $el = $(e.currentTarget);
    var $img = $el.data('map');
    var $id = $el.data('id');
    var $map = $('.map-overlay');

    e.preventDefault();

    $map.fadeOut(function() {
      $map.attr('src', $img);
    });

    $map.fadeIn();

    $('.map-content').hide();
    $('#map-content-' + $id).show();
  }

    $(function() {
        'use strict';

        $("[data-img]").each(function() {
           var $this = $(this);
            if($this.data("img")) {
                $this.backstretch($this.data("img"));
            }
        });

        $(".section.content:not(:first)").each(function(idx) {
            $(this).waypoint(function(direction) {
               $('.nav-box li, .mobile-menu li').removeClass('active');

                if(direction === 'down') {
                    $('.nav-box li, .mobile-menu li').eq(idx).addClass('active');
                } else {
                    $('.nav-box li, .mobile-menu li').eq(idx - 1).addClass('active');
                }
            }, {
              offset: checkIfMobile() ? 125 : 250
            });
        });

        $('.toggle-icon').click(function(event){
            event.preventDefault();
            $('.mobile-menu').slideToggle();
        });

        $('.mobile-menu li a').click(function(e) {
          e.preventDefault();
          $('.mobile-menu').slideToggle();
        });

      $('[data-map]').on('click', toggleMap);


    //    var slideshows = $('.cycle-slideshow').on('cycle-next cycle-prev', function(e, opts) {
    //        slideshows.not(this).cycle('goto', opts.currSlide);
    //    });

        $(".slider").each(function() {
            var $this = $(this);
            $this.find('.slider-next').on('click', { slider: $this }, gotoNextSlide);
            $this.on('cycle-update-view', toggleSliderControls);
            $this.on('cycle-before', function(event, options, outgoingSlideEl, incomingSlideEl) {
              var incomingHeight = $(incomingSlideEl).innerHeight();
              $this.height(incomingHeight);
            });
            $this.on('cycle-post-initialize', function(event, options) {
              var firstSlideHeight = $(options.slides[0]).innerHeight();
              $this.height(firstSlideHeight);
            });
        });

        $('.slider').cycle({
            allowWrap: false,
            //autoHeight: 'calc',
            fx: 'scrollHorz',
            prev: '> .controls .cycle-prev',
            next: '> .controls .cycle-next',
            slides: '> div.slide',
            swipe: true,
            timeout: 0
        });

        $.stellar({
          horizontalScrolling: false,
          responsive: true,
          hideDistantElements: false
        });

        $(window).trigger('resize');
        $('a[href^=#]:not([href=#])').on('click', scrollIfAnchor);

        setTimeout(function() {
          scrollIfAnchor(window.location.hash);
        }, 300);
    });

    $(window).resize(function() {
        'use strict';

        checkIfMobile();
    });
}());
