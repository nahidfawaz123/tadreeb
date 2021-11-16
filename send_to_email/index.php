<?php

	error_reporting(0);
	
	if(isset($_POST["submit"]))
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Send an Email on Form Submission using PHP with PHPMailer</title>
		<link rel="stylesheet" href="bootstrap.css" />
		<script src="bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
			<div class="row">
				<div class="col-md-8" style="margin:0 auto; float:none;">
					<h3 align="center">Send an Email on Form Submission using PHP with PHPMailer</h3>
					<br />
					<form name="sendEmail" method="post" action="contact.php">
						<div class="form-group">
							<label>Enter Name</label>
							<input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $name; ?>" />
						</div>
						<div class="form-group">
							<label>Enter Email</label>
							<input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $email; ?>" />
						</div>
						<div class="form-group">
							<label>Enter Subject</label>
							<input type="text" name="subject" class="form-control" placeholder="Enter Subject" value="<?php echo $subject; ?>" />
						</div>
						<div class="form-group">
							<label>Enter Message</label>
							<textarea name="message" class="form-control" placeholder="Enter Message"><?php echo $message; ?></textarea>
						</div>
						<div class="form-group" align="center">
							<input type="submit" name="submit" value="Submit" class="btn btn-info" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>





