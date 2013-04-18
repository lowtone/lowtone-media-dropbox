;(function($, d) {
	
	$(function() {
		$('<iframe>')
			.attr('src', d._chooserUrl({
				linkType: 'preview'
			}))
			.insertAfter($('#media-upload-header'));

		/*d.choose({
			iframe: true
		});*/
	});

})(jQuery, Dropbox);