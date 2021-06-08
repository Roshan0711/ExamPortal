<?php
session_start();

if (isset($_SESSION["loggedin"]) and $_SESSION["loggedin"] === true) {
	header("location: dashboard.php");
	exit;
}

if (!isset($_POST["submit"])) {
	header("location: index.php");
	exit;
}

require_once "config.php";

$email = trim($_POST["email"]);
$password = trim($_POST["password"]);

$sql = "SELECT id, email, password, name FROM users WHERE email = ?";

if ($stmt = $mysqli->prepare($sql)) {
	$stmt->bind_param("s", $param_email);
	$param_email = $email;

	if ($stmt->execute()) {
		$stmt->store_result();

		if ($stmt->num_rows === 1) {
			$stmt->bind_result($id, $email, $hashed_password, $name);

			if ($stmt->fetch()) {

				if (password_verify($password, $hashed_password)) {
					session_destroy();
					session_start();

					$_SESSION["loggedin"] = true;
					$_SESSION["id"] = $id;
					$_SESSION["email"] = $email;
					$_SESSION["name"] = $name;

					header("location: dashboard.php");
				} else {
?>
					<script>
						alert("Invalid Password");
						location.href = "index.php";
					</script>
			<?php
				}
			}
		} else {
			?>
			<script>
				alert("Invalid Email ID")
				location.href = "index.php";
			</script>
		<?php
		}
	} else {
		?>
		<script>
			alert("Oops! Something went wrong. Please try again.")
			location.href = "index.php";
		</script>
	<?php
	}
	$stmt->close();
} else {
	?>
	<script>
		alert("Oops! Something went wrong. Please try again.")
		location.href = "index.php";
	</script>
<?php
}

$mysqli->close();

?>