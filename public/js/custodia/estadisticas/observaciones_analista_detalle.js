(function($, window, document) {
	$(function() {
		$('#btnImprimir').on('click', function(event) {
			window.print();
		});
	});
}(window.jQuery, window, document));