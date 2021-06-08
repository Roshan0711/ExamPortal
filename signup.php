<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
  <script src="signup_validation.js"></script>
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
      font-family: 'Quicksand', serif;
      color: white;
    }

    .frm {
      margin-top: 10%;
      margin-bottom: 10%;
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

    .success {
      border-color: rgb(15, 226, 43);
      background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right 0.75rem center/8px 10px, url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e") #fff no-repeat center right 1.75rem/calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }

    .success:focus {
      border-color: rgb(15, 226, 43);
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(15, 226, 43, 0.6);
    }
  </style>
</head>

<body>

  <div class="container">

    <div class="row d-flex justify-content-center">
      <div class="col-sm-11 col-md-7 col-lg-5">

        <form name="signup_form" class="frm" action="signup_db.php" method="POST" onsubmit="return validate_form()">
          <i class="fas fa-user-plus fa-5x d-flex justify-content-center"></i>
          <h1 class="text-center">Sign Up</h1>

          <?php
          if (isset($_GET["signup"])) {
            $signup = $_GET["signup"];
            if ($signup === "exists") {
              echo "<p class='text-danger text-center'>Email ID is already registered. Try Log In.</p>";
            } elseif ($signup === "success") {
               echo "<p class='text-success text-center'>Sign Up successful. You can now<a class='pl-2' href ='index.php'>Log In.</a></p>";
            }
          }
          ?>

          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required>
            <span class="text-danger" id="name_err"></span>
          </div>

          <div class="form-group">
            <label>Phone Number</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
              </div>
              <input type="text" name="phone_no" id="phone_no" class="form-control rounded-right" placeholder="Enter Phone Number" required>
            </div>
            <span class="text-danger" id="phone_err"></span>
          </div>

          <div class="form-group">
            <label>Email ID</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="email" name="email" id="email" class="form-control rounded-right" placeholder="Enter Email ID" required>
            </div>
            <span class="text-danger" id="email_err"></span>
          </div>

          <div class="form-group">
            <label>Password</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
              </div>
              <input type="password" name="password" id="password" class="form-control rounded-right" placeholder="Enter Password" required>
            </div>
            <span class="text-danger" id="password_err"></span>
          </div>

          <div class="form-group">
            <label>Confirm Password</label>
            <input type="text" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required>
            <span class="text-danger" id="confirm_password_err"></span>
          </div>

          <div class="form-group text-center">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign Up</button>
          </div>

          <div class="form-group text-center">
            <span>Already an User? <a class="pl-2" href="index.php">Log In</a></span>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
</body>

</html>