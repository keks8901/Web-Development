<?php 

require 'includes/config.php';

// if user is logged in 
if (isset($_SESSION['user_id'])) {
  // redirect him to index page
  header('Location: index.php');
  // exit code execution
  exit;
}

if (isset($_POST['Register'])) {
  $username = clean_input($_POST['username']);
  $surname = clean_input($_POST['surname']);
  $password = clean_input($_POST['password']);
  // encrypt password before saving it to database
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  // check if password is less then eight characters
  if (strlen($password) < 8) {
    // display error message
    $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Error!</strong> Password must be 8 characters long.
		</div>';

		header('location: ' . URL . 'register.php');
		exit;
  } else if (preg_match('/[a-z]/', $password) && preg_match('/[A-Z]/', $password) && preg_match('/[0-9]/', $password)) {
    // check if password has alphabet
    // check if password has capital letter
    // check if password has uppercase

    // check if user with same username already exist or not
    $previous_user = $db->single_row("SELECT * FROM users WHERE username = '$username'");
    if (count($previous_user) > 0) {
      $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Error!</strong> Username already in use!
		</div>';

		header('location: ' . URL . 'register.php');
		exit;
    }

    // if not save user to database
    $data = Array(
      'username' => $username,
      'password' => $hashed_password,
      'surname' => $surname,
    );
    $db->insert('users', $data);

    $new_user = $db->single_row("SELECT * FROM users WHERE username = '$username'");
    
    // get the values of newly registerd user and set session variables for login
    $_SESSION['username'] = $new_user['username'];
    $_SESSION['surname'] = $new_user['surname'];
    $_SESSION['user_id'] = $new_user['id'];
    // redirect user to index page
    header('Location: index.php');
    exit;
    
  } else {
    $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Error!</strong> Password must have one uppercase letter, one lowercase letter and one number.
		</div>';

		header('location: ' . URL . 'register.php');
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
      <form action="register.php" method="POST" name="registration_form">
        <div class="form-group">
          <label for=""></label>
          <input type="text" name="username" class="form-control" placeholder="Username">
        </div>

        <div class="form-group">
          <label for=""></label>
          <input type="text" name="surname" class="form-control" placeholder="Surname">
        </div>

        <div class="form-group">
          <label for=""></label>
          <input type="password" name="password" class="form-control" placeholder="Password">
        </div>

        <div class="form-group">
              <label for=""></label>
              <input type="submit" name="Register" class="form-control" value="Register" placeholder="Register"> 
        </div>

        <div class="form-group">
        <label for=""></label>
          <a href="login.php"><button type="button" name="login" class="form-control" value="Login" placeholder="Login">Login</a>
        
        </div>
      </form>
    </div>

  </div>

<script>
$(document).ready(function() {
  $('form[name="registration_form"]').submit(function(e) {
    $('.alert').remove();

    var form = $(this);
    var username = ($('input[name="username"]').val()).trim();
    var surname = ($('input[name="surname"]').val()).trim();
    var password = ($('input[name="password"]').val()).trim();

    if (username == '' && password == '') {
      e.preventDefault();

      var message = $(`<div class="alert alert-danger alert-dismissible" style="display: none;">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Error!</strong> Username and password fields are required.
			</div>`);
      $(form).before(message);
      $(message).fadeIn();
    }
  })
});
</script>
</body>
</html>