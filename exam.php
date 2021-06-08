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
      color: white;
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
      color: black;
      font-size: large;
    }

    .buttons {
      width: 3.5rem;
      height: 3.5rem;
      border-radius: 50%;
    }

    .marks {
      font-weight: bold;
    }

    #exam_timer {
      width: 35%;
      margin: auto;
    }

    @media(max-width: 768px) {
      #exam_timer {
        width: 100%;
        margin: auto;
      }
    }
  </style>
  <link href="TimeCircles.css" rel="stylesheet">
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="mt-4" id="timer">
          <h1 class="text-center">Remaining Time</h1>
          <div id="exam_timer" data-timer="<?php echo $duration ?>"> </div>
        </div>
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
            echo '<div class="questions card mb-5 mt-3">
											<div class="card-header p-4 d-flex justify-content-between"><span>Q.' . $n++ . ' ' . $ques['question'] . '</span><span class="marks">' . $ques['marks'] . ' Marks</span></div>
											<div class="card-body">
												<div class="card-text">';
            foreach ($questions[$key]["options"] as $opt) {
              echo '<div class="p-2">
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
          <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-info btn-lg" id="prev">Previous</button>
            <button class="btn btn-success btn-lg" name="submit" id="submit">Submit</button>
            <button class="btn btn-info btn-lg" id="next">Next</button>
          </div>
        </form>
      </div>
      <div class="col-md-4 mt-4 text-center">
        <div>
          <h1 class="mb-4">Question Navigation</h1>
          <?php
          for ($i = 1; $i < $n; $i++) {
            echo '<button class="buttons btn btn-info btn-lg m-2" value="' . $i . '">' . $i . '</button>';
          }
          ?>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="TimeCircles.js"></script>
    <script type="text/javascript" src="questionNavigation.js"></script>
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