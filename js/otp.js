// jQuery( document ).ready(function( $ ) {
function sendOTP() {
	// $(".error").html("").hide();
	var number = $("#phone").val();
	var base_url = $('#base_url').val();
	console.log(number);
	if (number.length == 10 && number != null) {
		var input = {
			"mobile_number" : number,
			"action" : "send_otp"
		};
		$.ajax({
			url : base_url+'mobile_otp/processMobileVerification',
			type : 'POST',
			data : input,
			success : function(response) {
				$(".container").html(response);
			}
		});
	} else {
		$(".error").html('Please enter a valid number!')
		$(".error").show();
	}
}

function verifyOTP() {
	$(".error").html("").hide();
	$(".success").html("").hide();
	var otp = $("#mobileOtp").val();
	var input = {
		"otp" : otp,
		"action" : "verify_otp"
	};
	if (otp.length == 6 && otp != null) {
		$.ajax({
			url : 'controller.php',
			type : 'POST',
			dataType : "json",
			data : input,
			success : function(response) {
				$("." + response.type).html(response.message)
				$("." + response.type).show();
			},
			error : function() {
				alert("ss");
			}
		});
	} else {
		$(".error").html('You have entered wrong OTP.')
		$(".error").show();
	}
}

// });