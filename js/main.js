(function($){
	$('#addPanier').click(function(event){
		event.preventDefault(); 
		$.get($(this).attr('href'),{},function(data){
			if (data.error) {
				alert(data.message);
			}else{
				alert(data.message);

				//S'il n'ya pas de redirection
				$('#total').empty().append(data.total);
				$('#count').empty().append(data.count);
			}
		},'json');
		return false;
	});
})(jQuery);