jQuery(window).on("load resize scroll",function(){
	setImageHeight();
});

function setImageHeight() {
	const mediaQuery = window.matchMedia('(min-width: 1000px)')
	// Check if the media query is true
	if (mediaQuery.matches) {
		let leftColumnHeight = jQuery(".left-column .make_us_main").outerHeight();
	   jQuery('.two-column-section').find('.make_us_main').css('min-height', leftColumnHeight+'px');
	}else {
		jQuery('.two-column-section').find('.make_us_main').css('min-height', '1px');
	}
} 