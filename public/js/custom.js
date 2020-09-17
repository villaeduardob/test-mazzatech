;(function($, window, undefined)
{
	"use strict";
	
	$(document).ready(function(){

		if (document.getElementById('tableItems') !== null) 
		{
			$('#tableItems').dataTable({
				'pagingType': 'simple_numbers',
				'columnDefs': [{
					'targets': [], 
					'searchable': true, 
					'orderable': false, 
					'visible': true
				}]
			});

		}

	});
	
})(jQuery, window);