//Function To Display Popup
function div_show() {
	document.getElementById('background_layer').style.display = "block";
	document.getElementById('slide').style.display = "none";
	document.getElementById('slide1').style.display = "none";
	document.getElementById('slide2').style.display = "none";
	document.getElementById('slide3').style.display = "none"

}

//Function to Hide Popup
function div_hide() {
	document.getElementById('background_layer').style.display = "none";

}

$(document).ready(function() {
	//YOUR JQUERY CODE

	$('#lawyer-picture').click(function(e) {
		console.log('2test');
		window.location.href = 'lawyer_profile_detail.html';
	});

	$('#lawyer-picture2').click(function(e) {
		console.log('2test');
		window.location.href = 'lawyer_profile_detail.html';
	});


	var appendthis = ("<div class='modal-overlay js-modal-close'></div>");

	$('a[data-modal-id]').click(function(e) {
		e.preventDefault();
		$("body").append(appendthis);
		$(".modal-overlay").fadeTo(500, 0.7);
		//$(".js-modalbox").fadeIn(500);
		var modalBox = $(this).attr('data-modal-id');
		$('#' + modalBox).fadeIn($(this).data());
	});


	$(".js-modal-close, .modal-overlay").click(function() {
		$(".modal-box, .modal-overlay").fadeOut(500, function() {
			$(".modal-overlay").remove();
		});
	});

	$(window).resize(function() {
		$(".modal-box").css({
			top: ($(window).height() - $(".modal-box").outerHeight()) / 2,
			left: ($(window).width() - $(".modal-box").outerWidth()) / 2
		});
	});

	$(window).resize();


	// function check_empty() {
	// 	if (document.getElementById('name').value == "" || document.getElementById('email').value == "" || document.getElementById('msg').value == "") {
	// 		alert("Fill All Fields !");
	// 	} else {
	// 		document.getElementById('form').submit();
	// 		alert("Form Submitted Successfully...");
	// 	}
	// }


});