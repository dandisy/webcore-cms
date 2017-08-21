/**
  * isMobile
  * responsiveMenu
  * headerFixed
  * flatreviews
  * goTop
  * toggles
  * flatreviews1
  * flatClient
  * flatClient1
  * flatClient2
  * flatClient3
  * detectViewport
  * portfolioIsotope
  * parallax
  * googleMap
*/

;(function($) {

   'use strict'

    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    var responsiveMenu = function() {
        var menuType = 'desktop';

        $(window).on('load resize', function() {
            var currMenuType = 'desktop';

            if ( $(window).width() < 992 ) {
                currMenuType = 'mobile';
            }

            if ( currMenuType !== menuType ) {
                menuType = currMenuType;

                if ( currMenuType === 'mobile' ) {
                    var $mobileMenu = $('#mainnav').attr('id', 'mainnav-mobi').hide();
                    var hasChildMenu = $('#mainnav-mobi').find('li:has(ul)');

                    $('#header').find('.header-wrap').after($mobileMenu);
                    hasChildMenu.children('ul').hide();
                    hasChildMenu.children('a').after('<span class="btn-submenu"></span>');
                    $('.btn-menu').removeClass('active');
                } else {
                    var $desktopMenu = $('#mainnav-mobi').attr('id', 'mainnav').removeAttr('style');

                    $desktopMenu.find('.submenu').removeAttr('style');
                    $('#header').find('.nav-wrap').append($desktopMenu);
                    $('.btn-submenu').remove();
                }
            }
        });

        $('.btn-menu').on('click', function() {
            $('#mainnav-mobi').slideToggle(300);
            $(this).toggleClass('active');
        });

        $(document).on('click', '#mainnav-mobi li .btn-submenu', function(e) {
            $(this).toggleClass('active').next('ul').slideToggle(300);
            e.stopImmediatePropagation()
        });
    }

    var headerFixed = function() {
        if ( $('body').hasClass('header-sticky') ) {
            var nav = $('.header');

            if ( nav.size() != 0 ) {
                var offsetTop = $('.header').offset().top,
                    headerHeight = $('.header').height(),
                    injectSpace = $('<div />', { height: headerHeight }).insertAfter(nav);   
                    injectSpace.hide();                 

                $(window).on('load scroll', function(){
                    if ( $(window).scrollTop() > offsetTop + 120 ) {
                        $('.header').addClass('downscrolled');
                        injectSpace.show();
                    } else {
                        $('.header').removeClass('header-small downscrolled');
                        injectSpace.hide();
                    }

                    if ( $(window).scrollTop() > 500 ) {
                        $('.header').addClass('header-small upscrolled');
                    } else {
                        $('.header').removeClass('upscrolled');
                    }
                })
            }
        }     
    };

    var flatSearch = function () {
        $(document).on('click', function(e) {   
            var clickID = e.target.id;   
            if ( ( clickID != 's' ) ) {
                $('.top-search').removeClass('show');                
            } 
        });

        $('.show-search').on('click', function(event){
            event.stopPropagation();
        });

        $('.search-form').on('click', function(event){
            event.stopPropagation();
        });        

        $('.show-search').on('click', function () {
            if(!$('.top-search').hasClass( "show" ))
                $('.top-search').addClass('show');
            else
                $('.top-search').removeClass('show');
        });
    }

	var flatreviews = function() {
        $('.blog-item').each(function() { 
            if ( $().owlCarousel ) {
                $(this).find('.featured-causes').owlCarousel({
                    loop: true,
                    nav: false,
                    dots: true,
                    margin: 0,                     
                    autoplay: false,                    
                    responsive:{
                        0:{
                            items: 1
                        },
                        767:{
                            items: 1
                        },
                        991:{
                            items: 1
                        },
                        1200: {
                            items: 1
                        }
                    }
                });
            }
        });
    };

    var popularflexslider = function(){
        if ( $().flexslider ) {
            $('.flat-item-mem').flexslider({
                animation: "slide",
                direction: "vertical",

                controlNav: false,
                directionNav: true,
                slideshow: true,
                mousewheel: false,
                prevText: "",
                nextText: ""
            });
        };
    };

    var goTop = function() {
        $(window).scroll(function() {
            var bienbottom =  $('body').height() - $('#bottom-nav').height()-983; 
            if ( $(this).scrollTop() > 800 ) {
                $('.go-top').addClass('show');
                if ($(this).scrollTop() > bienbottom )  {

                 $('.go-top').removeClass('show');
                } 
            }             
            else {
                $('.go-top').removeClass('show');
            }
        }); 

        $('.go-top').on('click', function() {            
            $("html, body").animate({ scrollTop: 0 }, 1000 , 'easeInOutExpo');
            return false;
        });

        $('.go-top-v1').on('click', function() {            
            $("html, body").animate({ scrollTop: 0 }, 1000 , 'easeInOutExpo');
            return false;
        });
    };

    var toggles = function() {
        var args = {duration: 600};
        $('.flat-toggle .toggle-title.active').siblings('.toggle-content').show();

        $('.flat-accordion .toggle-title').on('click', function () {
            if( !$(this).is('.active') ) {
                $(this).closest('.flat-accordion').find('.toggle-title.active').toggleClass('active').
                    next().slideToggle(args);
                $(this).toggleClass('active');
                $(this).next().slideToggle(args);
            } else {
                $(this).toggleClass('active');
                $(this).next().slideToggle(args);
            }     
        }); // accordion
    };

    var flatreviews1 = function() {
        $('.flat-row').each(function() { 
            if ( $().owlCarousel ) {
                $(this).find('.featured-causes').owlCarousel({
                    loop: true,
                    nav: false,
                    dots: true,
                    margin: 0,                     
                    autoplay: true,                    
                    responsive:{
                        0:{
                            items: 1
                        },
                        767:{
                            items: 1
                        },
                        991:{
                            items: 1
                        },
                        1200: {
                            items: 1
                        }
                    }
                });
            }
        });
    };

    var flatClient = function() {
        $('.page-title').each(function() {            
            if ( $().owlCarousel ) {
                $(this).find('.flat-blog-carousel').owlCarousel({
                    loop: true,
                    margin: true,
                    nav: true,
                    dots: true,                     
                    autoplay: false,                    
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 2
                        },
                        767:{
                            items: 3
                        },
                        991:{
                            items: 3
                        },
                        1200: {
                            items: 4
                        }
                    }
                });
            }
        });
    };

    var flatClient1 = function() {
        $('.flat-carousel.v1').each(function() {            
            if ( $().owlCarousel ) {
                $(this).find('.flat-blog-carousel').owlCarousel({
                    loop: true,
                    margin: true,
                    nav: true,
                    dots: true,                     
                    autoplay: false,                    
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 2
                        },
                        767:{
                            items: 3
                        },
                        991:{
                            items: 3
                        },
                        1200: {
                            items: 3
                        }
                    }
                });
            }
        });
    };

    var flatClient2 = function() {
        $('.flat-carousel.v2').each(function() {            
            if ( $().owlCarousel ) {
                $(this).find('.flat-blog-carousel').owlCarousel({
                    loop: true,
                    margin: true,
                    nav: true,
                    dots: true,                     
                    autoplay: false,                    
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 2
                        },
                        767:{
                            items: 2
                        },
                        991:{
                            items: 2
                        },
                        1200: {
                            items: 2
                        }
                    }
                });
            }
        });
    };

    var flatClient3 = function() {
        $('.flat-carousel.v3').each(function() {            
            if ( $().owlCarousel ) {
                $(this).find('.flat-blog-carousel').owlCarousel({
                    loop: true,
                    margin: true,
                    nav: true,
                    dots: true,                     
                    autoplay: false,                    
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 1
                        },
                        767:{
                            items: 1
                        },
                        991:{
                            items: 1
                        },
                        1200: {
                            items: 1
                        }
                    }
                });
            }
        });
    };

    var detectViewport = function() {
        $('[data-waypoint-active="yes"]').waypoint(function() {
            $(this).trigger('on-appear');
        }, { offset: '90%', triggerOnce: true });
    };

    var portfolioIsotope = function() { 
        if ( $().isotope ) {           
            var $container = $('.project-portfolio');
            $container.imagesLoaded(function(){
                $container.isotope({
                    itemSelector: '.item',
                    transitionDuration: '1s'
                });
            });

            $('.filter-cat li').on('click',function() {                           
                var selector = $(this).find("a").attr('data-filter');
                $('.filter-cat li').removeClass('active');
                $(this).addClass('active');
                $container.isotope({ filter: selector });
                return false;
            });            
        };
    };

    var videoPopup =  function() {
        $(".fancybox").on("click", function(){
            $.fancybox({
              href: this.href,
              type: $(this).data("type")
            }); // fancybox
            return false   
        }); // on
    }


    var parallax = function() {
        if ( $().parallax && isMobile.any() == null ) {
            $('.parallax1').parallax("50%", 0.2);
            $('.parallax2').parallax("50%", 0.4);  
            $('.parallax3').parallax("50%", 0.5);            
        }
    }; 

    var alertBox = function() {
        $(document).on('click', '.close', function(e) {
            $(this).closest('.flat-alert').remove();
            e.preventDefault();
        })     
    } 

    var swClick = function () {
        function activeLayout () {
            $(".switcher-container" )
            .on( "click", "a.sw-light", function() {
                $(this).toggleClass( "active" );
                $('body').addClass('home-boxed');                               
                $('.sw-pattern.pattern').css ({ "top": "100%", "opacity": 1, "z-index": "10"});
            })
            .on( "click", "a.sw-dark", function() {
                $('.sw-pattern.pattern').css ({ "top": "98%", "opacity": 0, "z-index": "-1"});
                $(this).removeClass('active').addClass('active');
                $('body').removeClass('home-boxed');   
                $('body').css({'background': '#fff' });             
                return false;
            })       
        }

        function activePattern () {
            $('.sw-pattern').on('click', function () {
                $('.sw-pattern.pattern a').removeClass('current');
                $(this).addClass('current');
                $('body').css({'background': 'url("' + $(this).data('image') + '")', 'background-size' : '30px 30px', 'background-repeat': 'repeat' });
                return false
            })
        }

        activeLayout(); 
        activePattern();
    }


    var removePreloader = function() {        
        $('.loader').fadeOut('slow',function () {
            $(this).remove();
        });
    };

    var googleMap = function() {
        if ( $().gmap3 ) {
            $("#map").gmap3({
                map:{
                    options:{
                        zoom: 14,
                        mapTypeId: 'nah_style',
                        mapTypeControlOptions: {
                            mapTypeIds: ['nah_style', google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.HYBRID]
                        },
                        scrollwheel: false
                    }
                },
                getlatlng:{
                    address:  "Big Ben Street, E16 3LS, London, United Kingdom",
                    callback: function(results) {
                        if ( !results ) return;
                        $(this).gmap3('get').setCenter(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()));
                    }
                },
                styledmaptype:{
                    id: "nah_style",
                    options:{
                        name: "Nah Map"
                    },
                    styles: [
                        {
                            "featureType": "water",
                            "stylers": [
                                { "color": "#81abff" }
                            ]
                        },
                        
                        {
                            "featureType": "road.local",
                            "stylers": [
                              { "color": "#edebe3" }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "stylers": [
                              { "color": "#e3e3e3" }
                            ]
                       },
                       {
                            "featureType": "poi.park",
                            "stylers": [
                              { "color": "#c0d997" }
                            ]
                       }                                              
                    ]
                },  
            });
        }
    };   

	// Dom Ready
	$(function() {

        if ( matchMedia( 'only screen and (min-width: 991px)' ).matches ) {
            headerFixed(); 
        }  
        
        responsiveMenu();
		flatreviews();
        videoPopup();
		goTop();
        popularflexslider();
        flatSearch();
		toggles();
        googleMap();
		flatreviews1();
        flatClient();
        flatClient1();
        flatClient2();
        flatClient3();
        detectViewport();
        portfolioIsotope();
        alertBox();
        swClick();
    });

})(jQuery);