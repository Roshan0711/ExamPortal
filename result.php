<?php
session_start();

if (!isset($_SESSION["loggedin"]) or $_SESSION["loggedin"] === false) {
  header("location: index.php");
  exit;
}

if (!isset($_POST["submit"]) || !isset($_SESSION["exam_id"])) {
  header("location: dashboard.php");
  exit;
}

require_once "config.php";

$user_id = $_SESSION["id"];
$exam_id = $_SESSION["exam_id"];
$questions = $_SESSION["questions"];
$total = $score = 0;
$correct_ans = [];

$sql = "SELECT qid,ans_id FROM `correct_answer` WHERE exam_id=$exam_id;";

if ($result = $mysqli->query($sql)) {
  while ($row = $result->fetch_assoc()) {
    $correct_ans[$row['qid']] = $row['ans_id'];
  }
  $result->free_result();
}

foreach ($questions as $ques) {
  if (isset($_POST[$ques['qid']]) && $correct_ans[$ques['qid']] === $_POST[$ques['qid']]) {
    $score += $ques['marks'];
  }
  $total += $ques['marks'];
}

$sql = "INSERT INTO `result` (`user_id`, `exam_id`, `score`, `total`) VALUES ($user_id, $exam_id, $score, $total);";

if (!$mysqli->query($sql)) {
?>
  <script>
    alert("Failed to update database");
  </script>
<?php
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Result</title>
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

    .jumbotron {
      margin-top: 5rem;
      background: none;
      box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.75);
      border-radius: 10px;
    }

    .card {
      box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.75);
      border-radius: 10px;
      color: black;
    }

    .wrong {
      background-color: rgb(255, 166, 166);
    }

    .correct {
      background-color: rgb(166, 255, 166);
    }

    .fa-times {
      color: red;
    }

    .fa-check {
      color: green;
    }

    .marks {
      font-weight: bold;
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
      <h1 class="text-center display-4">Result: <?php echo $score . ' / ' . $total ?></h1>
    </div>
    <form>
      <?php
      $n = 1;
      foreach ($questions as $ques) {
        $ansId = $correct_ans[$ques['qid']];
        $selectId = null;
        if (isset($_POST[$ques['qid']])) {
          $selectId = $_POST[$ques['qid']];
        }
        if ($selectId && $selectId === $ansId) {
          echo '<div class="card my-4 correct">
											<div class="card-header d-flex justify-content-between"><span>Q.' . $n++ . ' ' . $ques['question'] . '</span><span class="marks">' . $ques['marks'] . ' / ' . $ques['marks'] . ' Marks</span></div>
											<div class="card-body">
												<div class="card-text">';
          foreach ($ques["options"] as $opt) {
            if ($opt['ans_id'] === $ansId) {
              echo '<div>
												<input type="radio" name="' . $ques['qid'] . '" id="' . $opt['ans_id'] . '" disabled checked>
												<label for="' . $opt['ans_id'] . '">' . $opt['answer'] . '</label>
                        <i class="fas fa-check"></i>
                      </div>';
            } else {
              echo '<div>
												<input type="radio" name="' . $ques['qid'] . '" id="' . $opt['ans_id'] . '" disabled>
												<label for="' . $opt['ans_id'] . '">' . $opt['answer'] . '</label>
											</div>';
            }
          }
          echo '</div>
										</div>
										</div>';
        } elseif ($selectId) {
          echo '<div class="card my-4 wrong">
											<div class="card-header d-flex justify-content-between"><span>Q.' . $n++ . ' ' . $ques['question'] . '</span><span class="marks">0 / ' . $ques['marks'] . ' Marks</span></div>
											<div class="card-body">
												<div class="card-text">';
          foreach ($ques["options"] as $opt) {
            if ($opt['ans_id'] === $ansId) {
              echo '<div>
												<input type="radio" name="' . $ques['qid'] . '" id="' . $opt['ans_id'] . '" disabled>
												<label for="' . $opt['ans_id'] . '">' . $opt['answer'] . '</label>
                        <i class="fas fa-check"></i>
                      </div>';
            } elseif ($opt['ans_id'] === $selectId) {
              echo '<div>
												<input type="radio" name="' . $ques['qid'] . '" id="' . $opt['ans_id'] . '" disabled checked>
												<label for="' . $opt['ans_id'] . '">' . $opt['answer'] . '</label>
                        <i class="fas fa-times"></i>
                      </div>';
            } else {
              echo '<div>
												<input type="radio" name="' . $ques['qid'] . '" id="' . $opt['ans_id'] . '" disabled>
												<label for="' . $opt['ans_id'] . '">' . $opt['answer'] . '</label>
											</div>';
            }
          }
          echo '</div>
										</div>
										</div>';
        } else {
          echo '<div class="card my-4 wrong">
											<div class="card-header d-flex justify-content-between"><span>Q.' . $n++ . ' ' . $ques['question'] . '</span><span class="marks">0 / ' . $ques['marks'] . ' Marks</span></div>
											<div class="card-body">
												<div class="card-text">';
          foreach ($ques["options"] as $opt) {
            if ($opt['ans_id'] === $ansId) {
              echo '<div>
												<input type="radio" name="' . $ques['qid'] . '" id="' . $opt['ans_id'] . '" disabled>
												<label for="' . $opt['ans_id'] . '">' . $opt['answer'] . '</label>
                        <i class="fas fa-check"></i>
                      </div>';
            } else {
              echo '<div>
												<input type="radio" name="' . $ques['qid'] . '" id="' . $opt['ans_id'] . '" disabled>
												<label for="' . $opt['ans_id'] . '">' . $opt['answer'] . '</label>
											</div>';
            }
          }
          echo '</div>
										</div>
										</div>';
        }
      }
      unset($_SESSION["exam_id"]);
      unset($_SESSION["questions"]);
      ?>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>