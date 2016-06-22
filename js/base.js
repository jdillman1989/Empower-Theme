var $ = jQuery.noConflict();
$(document).ready(function(){

	// Tabbed Content
	var tabs = $('.tab');
	var productDisplay = $('#product-display');

	tabs.on('click', function(e) {
		e.preventDefault();
		var tab = $(this);
		tab.addClass('active');
		var productData = tab.find( ".tab-content-hidden" );
		var productDisplayData = productData.html();
		productsDisplay(productDisplayData);
	});

	function productsDisplay(content) {
		productDisplay.html(content);
	};

	tabs.click();
});