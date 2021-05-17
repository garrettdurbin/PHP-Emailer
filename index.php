<?php
	// Message Vars
	// Useful for Bootstrap
	$msg = '';
	$msgClass = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
		<link rel="stylesheet" href="garrettWebSite.css">
    
    <title>Contact Garrett</title>
</head>

<body>
	<div id ="topBorder">
		<div id ="topBorderText">
			<p>Garrett Durbin | Software Developer</p>
		</div>
		
		<div id="buttonGroup" class="btn-sm">
				<button id="portfolioButton"><a href="index.html">PORTFOLIO</a></button>
				<button id="resumeButton"><a href="resume.html">RESUME</a></button>
				<button id="contactMeButton"><a href="index.php">CONTACT ME</a></button>
		</div>
	</div>
	<br>
	<br>  
	<br>  
    <div>
        <h2 id="contactTitle" class="text-center">Contact Garrett</h2>
        <?php
		// Check For Submit
		if(filter_has_var(INPUT_POST, 'submit')){
			// Get Form Data
			$name = htmlspecialchars($_POST['name']);
			$email = htmlspecialchars($_POST['email']);
			$message = htmlspecialchars($_POST['message']);
			
			// Check Required Fields
			if(!empty($email) && !empty($name) && !empty($message)){
				// Passed
				// Recipient Email
				$toEmail = 'garrett@garrettdurbin.com';
				$subject = 'Contact Request From '.$name;
				$body = '<h2>Contact Request</h2>
					<h4>Name</h4><p>'.$name.'</p>
					<h4>Email</h4><p>'.$email.'</p>
					<h4>Message</h4><p>'.$message.'</p>
				';

				// Email Headers
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

				// Aditional Headers
				$headers .= "From: " .$name. "<".$email.">". "\r\n";

				if(mail($toEmail, $subject, $body, $headers)){
					// Email Sent
					$msg = 'Your email has been sent';
					$msgClass = 'alert-success';
				} else {
					// Failed
					$msg = 'Your email was not sent';
					$msgClass = 'alert-danger';
				}

			}
			}

		

		?>
    </div>
    
		<div id="contactMe" class="container">
		<?php if($msg != ''): ?>
			<div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
		<?php endif; ?>
		<form method="post" id="contactForm" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<div id="contactMeTable" class="row">
				<div id="nameCell" class="form-group col-md-5 offset-md-1">
					<label>Your name:</label>
					<input type="text" id="name" class="formInput form-control" placeholder="Add Name" name="name" value="<?php echo isset($_POST['name']) ? $name : '';?>" required>
				</div>
				<div id="emailCell" class="form-group col-md-5">
					<label>Your email:</label>
					<input type="email" id="email" class="formInput form-control" placeholder="Add Email" name="email" value="<?php echo isset($_POST['email']) ? $email : '';?>" required>
				</div>
			</div>
			<div class="row">
				<div id="messageCell" class="form-group col-md-10 offset-md-1">
					<label>Your message:</label>
					<textarea name="message" id="message" class="formInput form-control" placeholder="Add Message"><?php echo isset($_POST['message']) ? $message : '';?></textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<button type="submit" name="submit" class="submitButtons btn btn-outline-secondary col-md-4 offset-md-4 col-6 offset-3">Submit</button>
			</div>
		</form>
	</div>
	<br>
</body>
</html>