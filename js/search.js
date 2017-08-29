$(function() {

	$('.pluginSearch .pluginSearchBox .pluginSearchInput').keyup(function(e) {

		var searchQuery = $(this).val();

		if(e.keyCode == 13 && searchQuery.length > 3) {
			$('.pluginSearchBox').append('<div class="searchLoader"></div>');

			$.ajax({
				url: '/bl-plugins/search/lib/doSearch.php',
				type: 'POST',
				data: {query: searchQuery},
				success: function(response) {
					if(response) {
					
						if($('.pluginSearch .searchResults').length == 0) $('.pluginSearch').append('<div class="searchResults"></div>');

						$('.pluginSearch .searchResults').html(response);

						$('.pluginSearchBox .searchLoader').remove();

					}
				}
			});;
			
		}

	});

});
