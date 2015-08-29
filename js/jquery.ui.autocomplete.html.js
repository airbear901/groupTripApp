$(document).ready(function($){
    $('#customerAutocomplte').autocomplete({
	source:'suggest_name.php',
	minLength:2
    });
});

$(document).ready(function($){
	$('#zoekNaam').autocomplete({
		source:'suggest_name.php',
		minLength:2,
		select: function(event,ui){
			var code = ui.item.id;
			if(code !== '') {
				location.href = '/invoice.php?customercode=' + code;
			}
		},
                // optional
		html: true,
		// optional (if other layers overlap the autocomplete list)
		open: function(event, ui) {
			$(".ui-autocomplete").css("z-index", 1000);
		}
	});
});