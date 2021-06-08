<?php
session_start();

if (!isset($_SESSION["loggedin"]) or $_SESSION["loggedin"] === false) {
	header("location: index.php");
	exit;
}

require_once "config.php";

$exam = [[]];
$n = 0;
$sql = "SELECT * FROM `exam`;";

if ($result = $mysqli->query($sql)) {
	while ($row = $result->fetch_assoc()) {
		$exam[$n++] = $row;
	}
	$result->free_result();
} else {
	echo "Something went wrong. Please try again later.";
}

$mysqli->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<style>
		html {
			width: 100%;
			height: 100%;
		}

		body {
			background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(img1.jpg);
			background-size: cover;
			background-position: right;
			background-attachment: fixed;
			font-family: 'Quicksand', serif;
			color: white;
		}

		a:hover {
			text-decoration: none;
		}

		@font-face {
			font-family: AphroditeSlimText;
			src: url(AphroditeSlimText.ttf);
		}

		.jumbotron {
			margin-top: 5rem;
			font-family: 'AphroditeSlimText';
			background: none;
			box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.75);
			border-radius: 10px;
		}

		.card {
			box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.75);
			background-color: #007bff;
			transition: 0.3s;
			border-radius: 10px;
		}

		.card:hover {
			background-color: #0056b3;
			transform: scale(1.1);
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
						<a class="nav-link active" href="dashboard.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="all-results.php">Results</a>
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
	<div class="container">
		<div class="jumbotron">
			<?php
			echo "<h1 class='text-center'>Hello,  " . $_SESSION["name"] .  "</h1>";
			?>
			<h1 class="text-center">Welcome to the Exaam Portal</h1>
		</div>
		<h2 class="text-center mt-5">Exam List</h2>
		<div class="row">
			<?php
			foreach ($exam as $exm) {
				$exam_id = $exm['exam_id'];
				$exam_name = $exm['exam_name'];
				$duration = $exm['duration'];
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

				echo '<div class="col-sm-6 col-lg-4 my-3">
				<a href="exam.php?exam_id=' . $exam_id . '&duration=' . $duration . '">
					<div class="card p-3 text-white">
						<div class="card-body text-center">
							<h4 class="card-title">' . $exam_name . '</h4>
							<div class="text-left py-1">
								<i class="fas fa-list-ol"></i>
								<span>15 Questions</span>
							</div>
							<div class="text-left py-1">
								<i class="fas fa-bookmark"></i>
								<span>Total Marks: 28</span>
							</div>
							<div class="text-left py-1">
								<i class="fas fa-clock"></i>
								<span>Duration: ' . $time . '</span>
							</div>
						</div>
					</div>
				</div>
				</a>';
			}
			?>
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>