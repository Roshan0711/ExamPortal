<?php
session_start();

if (!isset($_SESSION["loggedin"]) or $_SESSION["loggedin"] === false) {
	header("location: index.php");
	exit;
}

require_once "config.php";

$sql = "SELECT exam.exam_name, score, total, exam.duration, time FROM `result` INNER JOIN `exam` ON result.exam_id = exam.exam_id WHERE user_id = '" . $_SESSION["id"] . "' ORDER BY time DESC;";
$allResults = [[]];
$n = 0;
if ($result = $mysqli->query($sql)) {
	while ($row = $result->fetch_assoc()) {
		$allResults[$n++] = $row;
	}
	$result->free_result();
} else {
	echo "Oops Something went wrong. Please try again.";
	exit;
}
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Results</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<style>
		body {
			background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(img1.jpg);
			background-size: cover;
			background-position: right;
			background-attachment: fixed;
			font-family: 'Quicksand', serif;
			color: white;
		}

		h1 {
			margin-top: 6rem;
			margin-bottom: 3rem;
		}

		.table {
			background-color: #d6eaf8;
			color: black;
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="dashboard.php">Exaam Portal</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="dashboard.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="all-results.php">Results</a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-user"></i>
							<?php
							echo $_SESSION["name"];
							?>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="change-password.php">Change Password</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="logout.php">Log Out</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<main class="container">
		<h1 class="text-center">Results</h1>
		<?php
		if ($n == 0) {
			echo '<p class="text-danger text-center">You have not given any exam yet.</p>';
		}
		?>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead class="thead-dark">
					<tr>
						<th>Sr No.</th>
						<th>Exam Name</th>
						<th>Score</th>
						<th>Total</th>
						<th>Duration</th>
						<th>TimeStamp</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($n > 0) {
						$n = 1;
						foreach ($allResults as $res) {
							$duration = $res['duration'];
							$hrs = $min = $sec = null;
							$time = "";
							$sec = $duration;
							$hrs = floor($sec / 3600);
							$sec = $sec % 3600;
							$min = floor($sec / 60);
							$sec = $sec % 60;
							if ($hrs) {
								$time .= $hrs . " hrs ";
							}
							if ($min) {
								$time .= $min . " min ";
							}
							if ($sec) {
								$time .= $sec . " sec ";
							}
							echo '<tr>
							<td>' . $n++ . '</td>
							<td>' . $res["exam_name"] . '</td>
							<td>' . $res["score"] . '</td>
							<td>' . $res["total"] . '</td>
							<td>' . $time . '</td>
							<td>' . $res["time"] . '</td>
						</tr>';
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</main>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>