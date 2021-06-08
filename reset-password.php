<?php
session_start();

if (!(isset($_GET["email"]) || !(isset($_GET["token"])) || $_SERVER["REQUEST_METHOD"] == "POST")) {
	header("location: index.php");
	exit;
}

require_once "config.php";

$email_id = trim($_GET["email"]);
$token = trim($_GET["token"]);
$sql = "SELECT * FROM tokens WHERE email='" . $email_id . "';";
$result = $mysqli->query($sql);

if ($row = $result->fetch_assoc()) {
	if ($token !== $row["token"]) {
?>
		<script>
			alert("Token Mismatch: Please use to link provided in mail to reset your password");
			location.href = "index.php";
		</script>
		<?php
		exit;
	}
} else {
	echo "Oops Something went wrong. Please try again";
	exit;
}

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty(trim($_POST["new_password"]))) {
		$new_password_err = "Please enter the new password.";
	} elseif (strlen(trim($_POST["new_password"])) < 6) {
		$new_password_err = "Password must have atleast 6 characters.";
	} else {
		$new_password = trim($_POST["new_password"]);
	}

	if (empty(trim($_POST["confirm_password"]))) {
		$confirm_password_err = "Please confirm the password.";
	} else {
		$confirm_password = trim($_POST["confirm_password"]);
		if (empty($new_password_err) && ($new_password != $confirm_password)) {
			$confirm_password_err = "Password did not match.";
		}
	}

	if (empty($new_password_err) && empty($confirm_password_err)) {

		$sql = "UPDATE users SET password = ? WHERE email = ?";

		if ($stmt = $mysqli->prepare($sql)) {

			$stmt->bind_param("ss", $param_password, $param_email);

			$param_password = password_hash($new_password, PASSWORD_DEFAULT);
			$param_email = $email_id;

			if ($stmt->execute()) {
				session_destroy();
				$sql = "DELETE FROM tokens WHERE email='" . $email_id . "';";
				if (!$mysqli->query($sql)) {
					echo "Failed to update database";
				}
		?>
				<script>
					alert("Password Changed Successfully");
					location.href = "index.php";
				</script>
<?php
				exit();
			} else {
				echo "Oops! Something went wrong. Please try again later.";
			}
			$stmt->close();
		}
	}

	$mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reset Password</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<style type="text/css">
		html {
			width: 100%;
			height: 100%;
		}

		body {
			background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(img2.jpeg);
			background-size: cover;
			background-position: 75%;
			background-attachment: fixed;
			color: white;
			font-family: "Quicksand", serif;
		}

		.frm {
			margin-top: 40%;
			padding: 2rem 2rem;
			box-shadow: 0px 0px 15px 4px rgba(0, 0, 0, 0.75);
			border-radius: 20px;
		}

		.error {
			border-color: red;
			background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right 0.75rem center/8px 10px, url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e") #fff no-repeat center right 1.75rem/calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
		}

		.error:focus {
			border-color: red;
			box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-sm-10 col-md-7 col-lg-5">

				<form class="frm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?" . $_SERVER["QUERY_STRING"]); ?>" method="POST">
					<h1 class="text-center">Reset Password</h1>

					<div class="form-group">
						<label>New Password</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-lock"></i></span>
							</div>

							<input type="password" name="new_password" class="form-control rounded-right <?php echo (!empty($new_password_err)) ? 'error' : ''; ?>" data-toggle="password" id="togglepassword" placeholder="Enter Password" value="<?php echo $new_password; ?>">
							<span class="input-group-text"><i class="fa fa-eye"></i></span>

						</div>
						<span class="help-block text-danger"><?php echo $new_password_err; ?></span>

					</div>
					<div class="form-group">
						<label>Confirm Password</label>
						<input type="text" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'error' : ''; ?>" placeholder="Confirm Password">
						<span class="help-block text-danger"><?php echo $confirm_password_err; ?></span>
					</div>
					<div class="form-group text-center">
						<input type="submit" class="btn btn-primary mr-3" value="Submit">
						<a class="btn btn-danger ml-3" href="dashboard.php">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript">
		! function($) {
			//eyeOpenClass: 'fa-eye',
			//eyeCloseClass: 'fa-eye-slash',
			'use strict';

			$(function() {
				$('[data-toggle="password"]').each(function() {
					var input = $(this);
					var eye_btn = $(this).parent().find('.input-group-text');
					eye_btn.css('cursor', 'pointer').addClass('input-password-hide');
					eye_btn.on('click', function() {
						if (eye_btn.hasClass('input-password-hide')) {
							eye_btn.removeClass('input-password-hide').addClass('input-password-show');
							eye_btn.find('.fa').removeClass('fa-eye').addClass('fa-eye-slash')
							input.attr('type', 'text');
						} else {
							eye_btn.removeClass('input-password-show').addClass('input-password-hide');
							eye_btn.find('.fa').removeClass('fa-eye-slash').addClass('fa-eye')
							input.attr('type', 'password');
						}
					});
				});
			});

		}(window.jQuery);
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>