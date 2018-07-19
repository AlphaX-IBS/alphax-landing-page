jQuery.fn.setAllToMaxHeight = function(){
	return this.css({ 'height' : '' }).height( Math.max.apply(this, jQuery.map( this , function(e){ return jQuery(e).height() }) ) );
}

jQuery(window).load(function($) {
    'use strict'; 
       
  	jQuery(window).trigger('resize');
  	
});  

jQuery(document).ready(function($) {
    'use strict';      
    
    /*-----------------------------------------------------------------------------------*/
    /*	WP TWEAKS
    /*-----------------------------------------------------------------------------------*/
    $('.image-slider').lightSlider({
        item: 1,
        slideMargin: 0,
        adaptiveHeight: true,
        auto: true,
        pause: 5000,
        loop: false,
        controls: true,
        prevHtml: '<i class="fa fa-angle-left"></i>',
        nextHtml: '<i class="fa fa-angle-right"></i>'
    });
    
    $('.add-image-link > p > img').each(function(){
    	var $this = $(this),
    		$clone = $this[0].outerHTML,
    		$viewPost = $this.parents('.add-image-link').attr('data-js-view-post'),
    		$permalink = $this.parents('.add-image-link').attr('data-js-permalink');
    		
    	$this.before('<figure class="overlay"><a href="'+ $permalink +'"><span class="over"><span>'+ $viewPost +'</span></span>'+ $clone +'</a></figure>');
    	
    	$this.remove();
    });
    
    jQuery('.equal-height').setAllToMaxHeight();
    jQuery( window ).resize(function() {
    	jQuery('.equal-height').setAllToMaxHeight();
    });
    /*-----------------------------------------------------------------------------------*/
    /*	STICKY HEADER
	/*-----------------------------------------------------------------------------------*/
    $(window).on('scroll touchmove', function() {
        var header = $(".navbar");
        var scroll = $(window).scrollTop();

        if (scroll >= 200) {
            header.removeClass('top').addClass("fixed");
        } else {
            header.removeClass("fixed").addClass('top');
        }
    }).scroll();
    /*-----------------------------------------------------------------------------------*/
    /*	SCROLLING NAV
    /*-----------------------------------------------------------------------------------*/	
    var header_height = $('.navbar').outerHeight(),
    	shrinked_header_height = 62,
    	offset = shrinked_header_height,
    	empty_a = $('.navbar ul.navbar-nav a[href="#"]');
    	
    if( $('body').hasClass('admin-bar') ){
    	offset = offset + 32;	
    }

    $(document).on('click', '.navbar ul.navbar-nav a[href*=#]:not([href="#"])', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - offset
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });

	empty_a.on('click', function(e) {
	    e.preventDefault();
	});
	
	$('.navbar .nav li a:not(.has-submenu)').on('click', function() {
        $('.navbar .navbar-collapse.in').collapse('hide');
        $('.nav-bars').removeClass('is-active');
    });
	/*-----------------------------------------------------------------------------------*/
    /*	CENTER DROPDOWN
    /*-----------------------------------------------------------------------------------*/
    $(function() {
		$('.navbar-nav').on('show.smapi', function(e, menu) {
			var $menu = $(menu);
			// check just first-level subs
			if ($menu.dataSM('level') == 2) {
				var obj = $(this).data('smartmenus'),
					$item = $menu.dataSM('parent-a'),
					itemW = obj.getWidth($item),
					menuW = obj.getWidth($menu),
					menuX = (itemW - menuW) / 2;
				// keep supporting keepInViewport
				if (obj.opts.keepInViewport) {
					var $win = $(window),
						winX = $win.scrollLeft(),
						winW = obj.getViewportWidth(),
						itemX = $item.offset().left,
						absX = itemX + menuX;
					if (absX < winX) {
						menuX += winX - absX;
					} else if (absX + menuW > winX + winW) {
						menuX += winX + winW - menuW - absX;
					}
				}
				$menu.css('margin-left', menuX);
				if ($menu.dataSM('ie-shim')) {
					$menu.dataSM('ie-shim').css('margin-left', menuX);
				}
			}
		});
	});
    /*-----------------------------------------------------------------------------------*/
    /*	HAMBURGER MENU ICON
    /*-----------------------------------------------------------------------------------*/
    $(".nav-bars").on("click", function() {
        $(".nav-bars").toggleClass("is-active");
    });
    /*-----------------------------------------------------------------------------------*/
    /*	LIGHTGALLERY
    /*-----------------------------------------------------------------------------------*/
    var $lg = $('.light-gallery');
        $lg.lightGallery({
            thumbnail: false,
            selector: '.lgitem',
            animateThumb: true,
            showThumbByDefault: false,
            download: false,
            autoplayControls: false,
            zoom: false,
            fullScreen: false,
            thumbWidth: 100,
            thumbContHeight: 80,
            videoMaxWidth: '1000px',
            loop: false,
            mousewheel: true
        });
    /*-----------------------------------------------------------------------------------*/
    /*	CUBE
    /*-----------------------------------------------------------------------------------*/
    var $cubesingle = $('#js-grid-single');
    $cubesingle.cubeportfolio({
        filters: '#js-single-filter',
        loadMore: '#js-single-more',
        loadMoreAction: 'click',
        layoutMode: 'grid',
        mediaQueries: [{
            width: 1500,
            cols: 4
        }, {
            width: 1100,
            cols: 3
        }, {
            width: 800,
            cols: 3
        }, {
            width: 670,
            cols: 2
        }, {
            width: 320,
            cols: 1
        }],
        defaultFilter: '*',
        animationType: 'quicksand',
        gapHorizontal: 15,
        gapVertical: 15,
        gridAdjustment: 'responsive',
        caption: 'fadeIn',
        displayType: 'sequentially',
        displayTypeSpeed: 100,

        // singlePage popup
        singlePageDelegate: '.cbp-singlePage',
        singlePageDeeplinking: true,
        singlePageStickyNavigation: true,
        singlePageCounter: '<div class="cbp-popup-singlePage-counter">{{current}} of {{total}}</div>',
        singlePageCallback: function(url, element) {
            // to update singlePage content use the following method: this.updateSinglePage(yourContent)
            var t = this;

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
                timeout: 30000
            }).done(function(result) {
            	result = jQuery(result).find('.light-wrapper').addClass('cbp-l-inline');
                t.updateSinglePage(result);
            }).fail(function() {
                t.updateSinglePage('AJAX Error! Please refresh the page!');
            });
        },

    });
    $cubesingle.on('updateSinglePageStart.cbp', function() {
        $('.image-slider').lightSlider({
            item: 1,
            slideMargin: 0,
            adaptiveHeight: true,
            auto: true,
            pause: 5000,
            loop: false,
            controls: true,
            prevHtml: '<i class="fa fa-angle-left"></i>',
            nextHtml: '<i class="fa fa-angle-right"></i>'
        }); 
        var $lg = $('.light-gallery');       
        $lg.lightGallery({
            thumbnail: false,
            selector: '.lgitem',
            animateThumb: true,
            showThumbByDefault: false,
            download: false,
            autoplayControls: false,
            zoom: false,
            fullScreen: false,
            thumbWidth: 100,
            thumbContHeight: 80,
            videoMaxWidth: '1000px',
            loop: false,
            mousewheel: true
        });
		$lg.on('onAfterOpen.lg',function(event){
			$('#js-grid-single').data('cubeportfolio').singlePage.stopEvents = true;
		});
		$lg.on('onCloseAfter.lg',function(event){
			$('#js-grid-single').data('cubeportfolio').singlePage.stopEvents = false;
		});
    });   
    var $cubelightbox = $('#js-grid-lightbox');
    $cubelightbox.cubeportfolio({
        filters: '#js-lightbox-filter',
        loadMore: '#js-lightbox-more',
        loadMoreAction: 'click',
        layoutMode: 'grid',
        mediaQueries: [{
            width: 1500,
            cols: 4
        }, {
            width: 1100,
            cols: 3
        }, {
            width: 800,
            cols: 3
        }, {
            width: 670,
            cols: 2
        }, {
            width: 320,
            cols: 1
        }],
        defaultFilter: '*',
        animationType: 'quicksand',
        gapHorizontal: 15,
        gapVertical: 15,
        gridAdjustment: 'responsive',
        caption: 'fadeIn',
        displayType: 'fadeIn',
        displayTypeSpeed: 100,

    });
    $cubelightbox.on('onAfterLoadMore.cbp', function(event, newItemsAddedToGrid) {
        // first destroy the gallery
        $lg.data('lightGallery').destroy(true);
        // reinit the gallery
	    $lg.lightGallery({
            thumbnail: false,
            selector: '.lgitem',
            animateThumb: true,
            showThumbByDefault: false,
            download: false,
            autoplayControls: false,
            zoom: false,
            fullScreen: false,
            thumbWidth: 100,
            thumbContHeight: 80,
            videoMaxWidth: '1000px',
            loop: false,
            mousewheel: true
        });
	});
	
	jQuery('.cbp-l-loadMore-link').on('click.cbp', function(e) {
	    e.preventDefault();
	    var clicks, me = jQuery(this),
	        oMsg;
	
	    if (me.hasClass('cbp-l-loadMore-button-stop')) {
	        return;
	    }
	
	    // set loading status
	    oMsg = me.text();
	    me.text(me.attr('data-loading-text'));
	
	    // perform ajax request
	    jQuery.ajax({
	        url: me.attr('href'),
	        type: 'GET',
	        dataType: 'HTML'
	    }).done(function(result) {
	        var items = jQuery(result).find('.cbp-l-grid-inline');
	        if( $('#js-grid-single').length ){
	       	    $cubesingle.cubeportfolio('appendItems', items.html());
	        } else if ( $('#js-grid-lightbox').length ) {
	        	$cubelightbox.cubeportfolio('appendItems', items.html());
	        }
	        me.remove();
	    }).fail(function() {
	        alert('fail');
	    });
	
	});
    /*-----------------------------------------------------------------------------------*/
    /*	LIGHTSLIDER
    /*-----------------------------------------------------------------------------------*/
    $('.text-slider').lightSlider({
        item: 1,
        slideMargin: 0,
        adaptiveHeight: true,
        auto: false,
        loop: false,
        pager: true,
        controls: false,
        onSliderLoad: function(el) {
            $(el).removeClass('cs-hidden');
        }
    });
    var textcarousel = $(".text-carousel").lightSlider({
        item: 3,
        autoWidth: false,
        slideMove: 1,
        slideMargin: 20,
        pager: false,
        controls: false,
        responsive : [
            {
                breakpoint:992,
                settings: {
                    item:2
                  }
            }
        ],
        onSliderLoad: function(el) {
            $(el).removeClass('cs-hidden');
        }
    });
    $('.text-carousel-controls .prev').on('click', function() {
        textcarousel.goToPrevSlide();
    });

    $('.text-carousel-controls .next').on('click', function() {
        textcarousel.goToNextSlide();
    });
    /*-----------------------------------------------------------------------------------*/
    /*	TOGGLE
    /*-----------------------------------------------------------------------------------*/
    var $panelgroup = $('.panel-group');
    $panelgroup.find('.panel-default:has(".in")').addClass('panel-active');
    $panelgroup.on('shown.bs.collapse', function(e) {
        $(e.target).closest('.panel-default').addClass(' panel-active');
    }).on('hidden.bs.collapse', function(e) {
        $(e.target).closest('.panel-default').removeClass(' panel-active');
    });   
    /*-----------------------------------------------------------------------------------*/
    /*	GO TO TOP
    /*-----------------------------------------------------------------------------------*/
    $.scrollUp({
        scrollName: 'scrollUp',
        // Element ID
        scrollDistance: 300,
        // Distance from top/bottom before showing element (px)
        scrollFrom: 'top',
        // 'top' or 'bottom'
        scrollSpeed: 300,
        // Speed back to top (ms)
        easingType: 'linear',
        // Scroll to top easing (see http://easings.net/)
        animation: 'fade',
        // Fade, slide, none
        animationInSpeed: 200,
        // Animation in speed (ms)
        animationOutSpeed: 200,
        // Animation out speed (ms)
        scrollText: '<span class="btn btn-square"><i class="fa fa-angle-up"></i></span>',
        // Text for element, can contain HTML
        scrollTitle: false,
        // Set a custom <a> title if required. Defaults to scrollText
        scrollImg: false,
        // Set true to use image
        activeOverlay: false,
        // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        zIndex: 1001 // Z-Index for the overlay
    });
    /*-----------------------------------------------------------------------------------*/
    /*	COUNTER UP
    /*-----------------------------------------------------------------------------------*/
    $('.fcounter').counterUp({
        delay: 50,
        time: 1000
    });
    /*-----------------------------------------------------------------------------------*/
    /*	DATA REL
    /*-----------------------------------------------------------------------------------*/
    $('a[data-rel]').each(function() {
        $(this).attr('rel', $(this).data('rel'));
    });
    /*-----------------------------------------------------------------------------------*/
    /*	TOOLTIP
    /*-----------------------------------------------------------------------------------*/
    if ($("[rel=tooltip]").length) {
        $("[rel=tooltip]").tooltip();
    }
    /*-----------------------------------------------------------------------------------*/
    /*	PROGRESSBAR
	/*-----------------------------------------------------------------------------------*/
    var $pcircle = $('.circle');
    var $pbar = $('.bar');
    $pcircle.each(function(i) {
        var circle = new ProgressBar.Circle(this, {
            color: 'rgba(255,255,255,0.9)',
            trailColor: 'rgba(255,255,255,0.1)',
            strokeWidth: 2,
            trailWidth: 2,
            duration: 2000,
            easing: 'easeInOut'
        });
        var cvalue = ($(this).attr('data-value') / 100);
        $pcircle.waypoint(function() {
            circle.animate(cvalue);
        }, {
            offset: "100%"
        })
    });
    $pbar.each(function(i) {
        var bar = new ProgressBar.Line(this, {
            color: 'rgba(30,30,30,0.7)',
            trailColor: 'rgba(30,30,30,0.1)',
            strokeWidth: 2,
            trailWidth: 2,
            duration: 3000,
            easing: 'easeInOut',
            text: {
                style: {
                    color: '#808080',
                    position: 'absolute',
                    right: '0',
                    top: '-30px',
                    padding: 0,
                    margin: 0,
                    transform: null
                },
                autoStyleContainer: false
            },
            step: function(state, bar, attachment) {
                bar.setText(Math.round(bar.value() * 100) + ' %');
            }
        });
        var bvalue = ($(this).attr('data-value') / 100);
        $pbar.waypoint(function() {
            bar.animate(bvalue);
        }, {
            offset: "100%"
        })
    });
    /*-----------------------------------------------------------------------------------*/
    /*	PARALLAX MOBILE
    /*-----------------------------------------------------------------------------------*/
    if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i)) {
        $('.parallax').addClass('mobile');
    }
    /*-----------------------------------------------------------------------------------*/
    /*	IMAGE ICON HOVER
    /*-----------------------------------------------------------------------------------*/
    $('.overlay.icon-overlay a').prepend('<span class="over"><span></span></span>');
});

