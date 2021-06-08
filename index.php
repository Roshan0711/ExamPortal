<?php
session_start();

if (isset($_SESSION["loggedin"]) and $_SESSION["loggedin"] === true) {
  header("location: dashboard.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
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
      font-family: 'Quicksand', serif;
    }

    .frm {
      margin-top: 25%;
      padding: 2rem 2rem;
      box-shadow: 0px 0px 15px 4px rgba(0, 0, 0, 0.75);
      border-radius: 20px;
    }

  </style>
</head>

<body>

  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-sm-10 col-md-7 col-lg-5">

        <form class="frm" action="login_db.php" method="POST">
          <i class="fas fa-user fa-5x d-flex justify-content-center"></i>
          
          <h1 class="text-center">Log In</h1>
          
          <div class="form-group">
            <label>Email ID</label>
            <div class="input-group">
              
              <input type="email" name="email" class="form-control rounded-right" placeholder="Enter Email ID" required>
            </div>
          </div>

          <div class="form-group">
            <label>Password</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
              </div>
              <input type="password" name="password" class="form-control rounded-right" data-toggle="password" id="togglepassword" placeholder="Enter Password" required>
              <span class="input-group-text"><i class="fa fa-eye"></i></span>
            </div>
          </div>

          <div class="form-group text-center">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Log In</button>
          </div>

          <div class="form-group text-center">
            <a href="forgot-password.php">Forgot Password?</a>
          </div>

          <div class="form-group text-center">
            <span>Not An User Yet?<a class="pl-2" href="signup.php">Sign Up</a></span>
          </div>
        </form>
      </div>
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