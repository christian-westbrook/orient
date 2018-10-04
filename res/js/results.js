$('.addToCart').hover(function(){
	var star = $(this);
	star.css('cursor', 'pointer')
	if(star.hasClass('text-warning')){
		star.removeClass('text-warning');
	}else if(star.hasClass('text-success')){
		star.removeClass('text-success');
		star.addClass('text-danger');
	}else if(star.hasClass('text-danger')){
		star.removeClass('text-danger');
	}else{
		star.addClass('text-warning');
	}
});

function addToCart(userID, courseID){
	console.log('User ID: ' + userID);
	console.log('Course ID: ' + courseID);
	$.ajax({
		url: 'manageCart.php',
		cache: false,
		method: 'GET',
		dataType: 'json',
		data: {'method':'add', 'userid':userID, 'courseid': courseID},
		success: function(response){
			if(response.status == true){
				bootbox.alert("Success! You class has been added to the cart.");
			}else {
				bootbox.alert("Oh no! You class could not be added to cart at this time.");
			}
		},
		error: function(xhr) {
    console.log(xhr);
  }
	});

}
