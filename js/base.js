var $ = jQuery.noConflict();
$(document).ready(function(){

	// Tabbed Content
	var tabs = $('.tab');
	var productDisplay = $('#product-display');

	tabs.on('click', function(e) {
		e.preventDefault();
		var tab = $(this);

		tabs.each(function() {
			$(this).removeClass('active');
		});

		tab.addClass('active');
	
		var productData = tab.find( ".tab-content-hidden" );
		var productDisplayData = productData.html();
		productsDisplay(productDisplayData);
	});

	function productsDisplay(content) {
		productDisplay.html(content);
	};

	tabs.click();

	// Video iFrame responsive
	var promoVideo = jQuery("#promo-video");

	promoVideo.attr( "width", ($('.promo-video').width()) );

	jQuery(window).resize(function(){

		promoVideo.attr( "width", ($('.promo-video').width()) );
	});
});