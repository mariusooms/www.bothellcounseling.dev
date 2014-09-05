jQuery(function( $ ){

	$("nav.nav-primary ul.genesis-nav-menu").addClass("responsive-menu").before('<div class="responsive-menu-icon"></div>');

	$(".responsive-menu-icon").click(function(){
		$(this).toggleClass("active");
		$(this).next("nav.nav-primary ul.genesis-nav-menu").animate({
            height: "toggle",
            opacity: "toggle"
        }, "slow");
	});

	$(window).resize(function(){
		if(window.innerWidth > 768) {
			$("nav.nav-primary ul.genesis-nav-menu, nav .sub-menu").removeAttr("style");
			$(".responsive-menu > .menu-item").removeClass("menu-open");
		}
	});

	$(".responsive-menu > .menu-item").click(function(event){
		if (event.target !== this) {
			return;
		}
			$(this).find(".sub-menu:first").slideToggle(function() {
			$(this).parent().toggleClass("menu-open");
		});
	});

});