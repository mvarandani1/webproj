
<head>
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<?php include 'includes/header.php' ?>
<?php include 'includes/db.php' ?>

<body class="masthead" style="margin-top:-32px">

	<div class="container-contact100">
		<div class="contact100-map" id="google_map" data-map-x="40.722047" data-map-y="-73.986422" data-pin="img/icons/map-marker.png" data-scrollwhell="0" data-draggable="1"></div>

		<div class="wrap-contact100">
			<div class="contact100-form-title" style="background-image: url(img/bg-01.jpg);">
				<span class="contact100-form-title-1">
					Contact Us
				</span>

				<span class="contact100-form-title-2">
					Feel free to drop us a line below!
				</span>
			</div>

			<form class="contact100-form validate-form" method="post">
				<div class="wrap-input100 validate-input" data-validate="Name is required">
					<span class="label-input100">Full Name:</span>
					<input class="input100" type="text" name="name" id="name" placeholder="Enter full name">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<span class="label-input100">Email:</span>
					<input class="input100" type="text" id="email" name="email" placeholder="Enter email addess">
					<span class="focus-input100"></span>
				</div>


				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<span class="label-input100">Message:</span>
					<textarea class="input100" name="message" id="message" placeholder="Your Comment..."></textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn text-center">
					<input type="submit" name="submit" class="contact100-form-btn ml-5" value="Submit"/>
				</div>
			</form>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade bd-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered " role="document">
	    <div class="modal-content">
	      <div class="modal-header " style="border-bottom:1px solid black">
	        <h5 class="modal-title " id="exampleModalLongTitle">Submitted Successfully</h5>

	      </div>
	      <div class="modal-body text-center">
	        <span class="h5">Thanks For The Response We will Contact you back to your email address within 4-5 Days</span>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="okbtn" class="btn btn-secondary m-auto" data-dismiss="modal">OK</button>
	      </div>
	    </div>
	  </div>
	</div>
<!-- end Modal -->

	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
	<script src="js/map-custom.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');

		$('#okbtn').click(function()
	{
		window.location.href="index.php";
	});
	$( document ).ready(function() {
  
	$('#myModal').on('hide.bs.modal', function (e) {
  	window.location.href="index.php";
});
});
	</script>

<?php include 'includes/footer.php' ?>
<?php
if(isset($_POST['submit']))
{
	echo"sdsd";
$name=$_POST['name'];
$email=$_POST['email'];
$comment=$_POST['message'];
$curr_date = date("Y-m-d H:i:s");
$sql="Insert into contactus(name,email,comment,date) values('$name','$email','$comment','$curr_date')";
$result=mysqli_query($connection,$sql);
if($result)
{
echo"<script>$('#myModal').modal('show')</script>";
}
}

 ?>
