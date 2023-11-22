<?php 

require 'includes/config.php';

// check if user is loggedin
if (isset($_SESSION['user_id'])) {
  // if yes redirect him to login page
  header('Location: index.php');
  // exit code execution
  exit;
}

// if post request for login is made
if (isset($_POST['Login'])) {
  // get and clean username and password
  $username = clean_input($_POST['username']);
  $password = clean_input($_POST['password']);

  //  check if user with usernme exists
  $user = $db->single_row("SELECT * FROM users WHERE username = '$username'");
  
  if (count($user) > 0) {
    // if user exists check if he entered password match with the one in database
    if (!password_verify($password, $user['password'])) {
      // if not redirect him to login page with wrong password message
      $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> Wrong password.
      </div>';

      header('location: ' . URL . 'login.php');
      exit;
    } else {
      // other wise set session variables with the database values against that user
      // and redirect to login page
      $_SESSION['username'] = $user['username'];
      $_SESSION['surname'] = $user['surname'];
      $_SESSION['user_id'] = $user['id'];

      header('Location: index.php');
      exit;
    }
  } else {
    // if no user found with that username give message
    $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Error!</strong> No user found with this username.
		</div>';

		header('location: ' . URL . 'login.php');
		exit;
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COVID 19</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    body, * {
      padding:0;
      margin:0;
    }
    .top {
      background: #adb9ca;
    }

    .top {
      padding: 20px 0 20px 0;
      margin: 0;
      text-align: center;
    }

    .container {
      margin: 0 auto;
    }

    .form-container {
      margin: 0 auto;
      background-image: url('assets/images/watermark.png');
      background-repeat: no-repeat, repeat;
      min-height: 380px;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
    }

    a:link,a,a:hover {
      text-decoration: none;
      color: #495057;
    }
  </style>
</head>
<body>
  <div class="container">

    <div class="top">
      <h1>
        COVID - 19 Contact Tracing
      </h1>
    </div>

    <div class="form-container col-6">
      <?php 
      if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
      }
      ?>
      <form action="login.php" method="POST" name="login">
        <div class="form-group">
          <label for=""></label>
          <input type="text" name="username" class="form-control" placeholder="Username">
        </div>

        <div class="form-group">
          <label for=""></label>
          <input type="password" name="password" class="form-control" placeholder="Password">
        </div>

        <div class="form-group">
              <label for=""></label>
              <input type="submit" name="Login" class="form-control" value="Login" placeholder="Login">
        </div>

        <div class="form-group">
        <label for=""></label>
          <a href="register.php"><button type="button" name="Register" class="form-control" value="Register" placeholder="Register">Register</a>
        </div>
      </form>
    </div>

  </div>
<script>
$(document).ready(function() {

  $('form[name="login"]').submit(function(e) {
    $('.alert').remove();

    var form = $(this);
    var username = ($('input[name="username"]').val()).trim();
    var password = ($('input[name="password"]').val()).trim();

    // check if user has entered username an password or not
    if (username == '' || password == '') {
      e.preventDefault();

      var message = $(`<div class="alert alert-danger alert-dismissible" style="display: none;">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Error!</strong> All fields are required.
			</div>`);
      $(form).before(message);
      $(message).fadeIn();
    }
  });

});
</script>
</body>
</html>