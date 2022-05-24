<?php 
?>
<!DOCTYPE html>
<html>
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php echo base_url()?>js/otp.js"></script>

</head>
<body>
	<div class="container w3-card">
		<div class="err"></div>
		<form id="mobile-number-verification">
			<div class="mobile-heading">Login</div>
			<input type="hidden" id='base_url' value="<?php echo base_url();?>" >

			<div class="mobile-row">
				<td> <input type="tel" id="phone" placeholder="phone number"></td>
			</div>
            <input type="button" class="mobileSubmit" value="Get OTP"onClick="sendOTP();">
		</form>
	</div>
</body>
</html>
