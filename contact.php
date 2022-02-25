<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
?>

<?php require_once './config.php'; ?>


<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];

		require_once "./PHPMailer/PHPMailer.php";
		require_once "./PHPMailer/SMTP.php";
		require_once "./PHPMailer/Exception.php";

		$mail = new PHPMailer(true);
		try {
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username   = 'titi.adesola@gmail.com';
			$mail->Password   = 'titi.adesola6723';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
			$mail->Port       = 465;

			$mail->setFrom('titi.adesola@gmail.com', 'Online Auction');
			$mail->addAddress('ayodeji1.adesola@gmail.com', 'Online Auction');
			$mail->addReplyTo($email, $name);



			$mail->isHTML(true);
			$mail->Subject = 'Contact Form | Online Auction';
			$mail->Body    = "<p>Message: $message</p><br><p>Name: $name</p><br><p>Email: $email</p><br>";
			$mail->AltBody = "Message: $message\nName: $name\nEmail: $email";
			$mail->send();
			
			$_SESSION['success'] = true;
		} catch (Exception $e) {
			// $_SESSION['error'] = true;
			die("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
		}

		header('location: contact.php');
	}

	$success = null;
	if (isset($_SESSION['success'])) {
		$success = "Message sent successfully";
		unset($_SESSION['success']);
	}

	$error = null;
	if (isset($_SESSION['error'])) {
		$error = "Failed to send message";
		unset($_SESSION['error']);
	}
?>

<?php include_once './layout/header.php'; ?>




<!----><div  class="contactbody">
	<h4 class="sentNotification"></h4>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="text-center">CONTACT US</h1>
				<p class="text-center">We'd love to hear from you!</p>
			</div>
		</div>
		<div class="row mt-5">
			
<!--how it works-->
<section class="how-section padding-bottom" id="howitworks">
	<div id="container">
		<div class="how-wrapper section-bg">
			<div class="row justify-content-center mb--40">
				<div class="col-md-6 col-lg-4">
					<div class="how-item">
						<div class="how-content">
							<h4 class="hiwtitle"></h4>
							<p>Tel: +90 533 821 8138</p>
							E-mail: titi.adesola@gmail.com
							European University of Lefke
					Lefke , Northern Cyprus TR-10 Mersin, Turkey, 99010
						</div>
					</div>


				</div>
				
				
			</div>
		</div>
	</div>
</section>
<!--============= How Section Ends Here =============-->

		</div>
	</div>
</div>

<?php include_once './layout/footer.php'; ?>