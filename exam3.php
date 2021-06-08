<?php
session_start();

if (!isset($_SESSION["loggedin"]) or $_SESSION["loggedin"] === false) {
	header("location: index.php");
	exit;
}

if (!isset($_GET["exam_id"]) || !isset($_GET["duration"])) {
	header("location: dashboard.php");
	exit;
}

require_once "config.php";

$questions = [[]];
$exam_id = $_GET["exam_id"];
$duration = $_GET["duration"];
$_SESSION["exam_id"] = $exam_id;

$sql = "SELECT qid,question,marks FROM `questions` INNER JOIN `difficulty` ON 
	questions.diff_id=difficulty.did WHERE exam_id=$exam_id AND diff_id=1 ORDER BY RAND() LIMIT 6;";
$n = 0;

if ($result = $mysqli->query($sql)) {
	while ($row = $result->fetch_assoc()) {
		$questions[$n++] = $row;
	}
	$result->free_result();
}

$sql = "SELECT qid,question,marks FROM `questions` INNER JOIN `difficulty` ON 
	questions.diff_id=difficulty.did WHERE exam_id=$exam_id AND diff_id=2 ORDER BY RAND() LIMIT 5;";

if ($result = $mysqli->query($sql)) {
	while ($row = $result->fetch_assoc()) {
		$questions[$n++] = $row;
	}
	$result->free_result();
}

$sql = "SELECT qid,question,marks FROM `questions` INNER JOIN `difficulty` ON 
	questions.diff_id=difficulty.did WHERE exam_id=$exam_id AND diff_id=3 ORDER BY RAND() LIMIT 4;";

if ($result = $mysqli->query($sql)) {
	while ($row = $result->fetch_assoc()) {
		$questions[$n++] = $row;
	}
	$result->free_result();
}

if ($n == 0) {
	echo "No questions selected";
	exit;
}

shuffle($questions);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Exam</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
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
		}

		input[type="radio"]:hover,
		label:hover {
			cursor: pointer;
		}

		#ques {
			margin-bottom: 2rem;
		}

		.card {
			box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.75);
			background-color: #dee2ff;
			border-radius: 10px;
		}

		@media (max-width: 768px) {
			#ques {
				margin-top: 70%;
			}
		}

		@media (min-width: 768px) {

			#timer,
			#timer .card-header {
				background: none;
				color: white;
				border: none;
			}
		}
	</style>
	<link href="TimeCircles.css" rel="stylesheet">
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8" id="ques">
				<form action="result.php" method="POST">
					<?php
					$n = 1;
					foreach ($questions as $key => $ques) {
						$sql = "SELECT * FROM `answers` WHERE qid=" . $ques['qid'] . ";";
						$questions[$key]["options"] = [[]];
						$i = 0;
						if ($result = $mysqli->query($sql)) {
							while ($row = $result->fetch_assoc()) {
								$questions[$key]["options"][$i++] = $row;
							}
							$result->free_result();
						}
						echo '<div class="card my-4">
											<div class="card-header d-flex justify-content-between"><span>Q.' . $n++ . ' ' . $ques['question'] . '</span><span>' . $ques['marks'] . ' Marks</span></div>
											<div class="card-body">
												<div class="card-text">';
						foreach ($questions[$key]["options"] as $opt) {
							echo '<div>
												<input type="radio" name="' . $ques['qid'] . '" id="' . $opt['ans_id'] . '" value="' . $opt['ans_id'] . '">
												<label for="' . $opt['ans_id'] . '">' . $opt['answer'] . '</label>
											</div>';
						}
						echo '</div>
										</div>
										</div>';
					}
					$_SESSION["questions"] = $questions;
					$mysqli->close();
					?>
					<input class="btn btn-success" type="submit" name="submit" id="submit" value="Submit">
				</form>
			</div>
			<div class="col-md-4 offset-md-8 fixed-top mt-3 mt-md-5">
				<div class="card" id="timer">
					<h3 class="card-header text-center">Remaining Time</h3>
					<div class="card-body">
						<div class="card-text" id="exam_timer" data-timer="<?php echo $duration ?>"> </div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="text/javascript" src="TimeCircles.js"></script>
		<script>
			$('#exam_timer').TimeCircles({
				time: {
					Days: {
						show: false
					},
					Hours: {
						show: false
					}
				}
			});

			$(window).resize(function() {
				$('#exam_timer').TimeCircles().rebuild();
			});

			setInterval(function() {
				var remain_sec = $('#exam_timer').TimeCircles().getTime();

				if (remain_sec < 1) {
					$('#submit').click();
				}
			}, 1000);
		</script>
</body>

</html>