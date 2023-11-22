<?php require 'includes/config.php'; ?>
<?php 

// check if user is loggedin or not
if (!isset($_SESSION['user_id'])) {
  // if not redirect him to login page
  header('Location: login.php');
  // exit code execution
  exit;
}

// if post request is made
if (isset($_POST['Report'])) {
  // get date
  $date = clean_input($_POST['date']);
  // get time
  $time = clean_input($_POST['time']);
  // get user id from session variable
  $user_id = $_SESSION['user_id'];

  $originalDate = $date . ' ' . $time;
  // format date so it is saved in mysql database without an error
  $newDate = date("Y-m-d H:i:s", strtotime($originalDate));
  
  $data = Array(
    'date' => $newDate,
    'user_id' => $user_id
  );

  // save user_id and date in infections table
  $db->insert('infections', $data);
  // save success message in session variable
  $_SESSION['message'] = '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> Infection reported successfully!
  </div>';
  // redirect user to report page
  header('location: ' . URL . 'report.php');
  // exit code execution
  exit;
}

?>
<?php require 'includes/header.php'; ?>
<?php require 'includes/navigation.php'; ?>

<style>
hr {
  border: 1px solid black;
}

.formDiv {
  margin: 0 auto;
}
</style>

<div class="main">

<div class="row">
  <div class="col-md-12">
    <h3 class="text-center">Report an Infection</h3>
    <hr>
    <p class="text-center">Please report the date and time when you were tested positive for COVID-19.</p>

    <div class="col-md-5 formDiv">
    <?php 
    if (isset($_SESSION['message'])) {
      // if success message is set, show to user and unset it later so it does not display again and again
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    }
    ?>
      <form action="report.php" method="POST">
        <div class="form-group">
          <input type="date" name="date" class="form-control">
        </div>

        <div class="form-group">
          <input type="time" name="time" class="form-control">
        </div>

        <div class="form-group">
          <input type="submit" name="Report" class="form-control">
        </div>
      </form>
    </div>

  </div>
</div>

</div>

<?php require 'includes/footer.php'; ?>