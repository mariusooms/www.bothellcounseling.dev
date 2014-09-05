jQuery(function ($) {

    /**
     * Initiate the responsive header function.
     *
     * @link http://www.webdesignerdepot.com/2012/09/creating-a-responsive-header-in-wordpress-3-4/
     */
    $('#header-image').picture();

    /**
     * Initiate the owl profiles carousel function.
     *
     * @link http://owlgraphic.com/owlcarousel/#how-to
     */
    $('#profiles').owlCarousel({
        itemsCustom: [
            [0, 3], //items between 0 and 320px
            [480, 4], //items between 480px and 767px
            [768, 4], //items between 786px and 959px
            [960, 5], //items between 960px and 1279px
            [1280, 5], //items between 1280px and 1599px
            [1600, 6] //items above 1600px
        ],
        navigation: false
    });

    /**
     * Initiate the owl testimonials carousel function.
     *
     * @link http://owlgraphic.com/owlcarousel/demos/autoHeight.html
     */


    $('.testimonials-list').owlCarousel({
        navigation: true,
        slideSpeed: 500,
        paginationSpeed: 500,
        singleItem: true,
        pagination: false,
        navigationText: [
            "", // Arrow left  Dash Icons
            "" // Arrow right Dash Icons
        ]
    });

	/**
	 * Initiate the owl locations carousel function.
	 *
	 */
	$("#locations").owlCarousel({
		itemsCustom : [
			[0, 1],
			[460, 2],
			[740, 3],
			[940, 4],
			[1280, 5]
		],
		lazyLoad : true,
		scrollPerPage: true,
		slideSpeed : 700,
		paginationSpeed : 500,
		pagination: false,
		navigation : true,
		slideBy: 'page',
		navigationText : [
			"",
			""
     	]
	});

    $(".youtube").each(function () {

        // Overlay the Play icon to make it look like a video player
        $(this).append($('<div/>', {
            'class': 'play'
        }));

        $(document).delegate('#' + this.id, 'click', function () {
            // Create an iFrame with autoplay set to true
            var iframe_url = "https://www.youtube.com/embed/" + this.id + "?autoplay=1&autohide=1";
            if ($(this).data('params')) {
                iframe_url += '&' + $(this).data('params');
            }

            // The height and width of the iFrame should be the same as parent
            var iframe = $('<iframe/>', {
                'frameborder': '0',
                'src': iframe_url
            });

            // Replace the YouTube thumbnail with YouTube HTML5 Player
            $(this).html(iframe);
        });
    });

	/**
	 * Launch iCheck plugin.
	 *
	 * @link http://fronteed.com/iCheck/
	 */
	$('input').iCheck({
		checkboxClass: 'icheckbox_minimal-grey',
		radioClass: 'iradio_minimal-grey'
	});    

	/**
	 * enquire - Awesome Media Queries.
	 *
	 * @link http://wicky.nillia.ms/enquire.js/
	 */
	 /* global enquire:true */
	var $targets = $("img[data-portrait]");

/*
	enquire
	.register("screen and (max-width: 480px)", function() { 
	    
	})
	.register("screen and  (min-width: 481px) and (max-width: 767px)", function() {
	    
	})
	.register("screen and (min-width: 768px)", function() { 
	    
	});
*/
	 
	enquire.register("screen and (min-width: 768px)", {
	    match : function() {
	        $targets.each(function() {
	            var $this = $(this);
	
	            //toggle src and store old img
	            $this.data("landscape-small", $this.attr("src"));            
	            $this.attr("src", $this.data("portrait"));
	        });
	    },
	    
	    unmatch : function() {
	        $targets.each(function() {
	            var $this = $(this);
	
	            //restore low res src
	            $this.attr("src", $this.data("landscape-small"));
	        });
	    }
	});

	/**
	 * Add tabbed profile navigation.
	 */
	$('.nav-tabs > li > a').click(function(event){
		event.preventDefault();//stop browser to take action for clicked anchor
		
		//get displaying tab content jQuery selector
		var active_tab_selector = $('.nav-tabs > li.active > a').attr('href');					
		
		//find actived navigation and remove 'active' css
		var actived_nav = $('.nav-tabs > li.active');
		actived_nav.removeClass('active');
		
		//add 'active' css into clicked navigation
		$(this).parents('li').addClass('active');
		
		//hide displaying tab content
		$(active_tab_selector).removeClass('active');
		$(active_tab_selector).addClass('hide');
		
		//show target tab content
		var target_tab_selector = $(this).attr('href');
		$(target_tab_selector).removeClass('hide');
		$(target_tab_selector).addClass('active');
	});	

	/**
	 * Read more/less long description mobile view
	 *
	 * @link http://jedfoster.com/Readmore.js/
	 */
/*
	enquire.register("screen and (max-width: 480px)", {
		match : function() {
			$('#main-profile .entry-content').readmore({
				speed: 75,
				maxHeight: 150
			});
		}
	});
	enquire.register("screen and (min-width: 481px)", {
		match : function() {
			$('#main-profile .entry-content').readmore({
				speed: 75,
				maxHeight: 220
			});
		}		
	});
*/
});