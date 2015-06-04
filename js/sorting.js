<script>
$(document).ready(function(){
 $('#paging_container1').pajinate();
   $('th a').click(function(event) {
    var order = event.target.id;  
	$('a#'+order).toggleClass('DESC');
	var sort = $('a#'+order).attr('class');
	
			param = {
				order:order,
				sort: sort
			};
			$.ajax({
				type: 'POST',
				url: 'php/loadData.php',
				data: param,
				success: function(data){
					$('#placeForData').html(data);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){alert(textStatus+XMLHttpRequest+errorThrown)}
			});
	
	});
});

