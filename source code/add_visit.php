<?php require 'includes/config.php'; ?>
<?php 

// check if user is logged in 
if (!isset($_SESSION['user_id'])) {
  // if not redirect him to login page
  header('Location: login.php');
  // exit code execution
  exit;
}

// if form is submitted
if (isset($_POST['submit'])) {
  // fetch all values clean and save them to variables
  $date = clean_input($_POST['date']);
  $time = clean_input($_POST['time']);
  $duration = clean_input($_POST['duration']);
  $x_coordinate = clean_input($_POST['x_coordinate']);
  $y_coordinate = clean_input($_POST['y_coordinate']);
  $user_id = $_SESSION['user_id'];

  $originalDate = $date . ' ' . $time;
  // data send from browser is in different format here 
  // we create a date that can be saved into mysql database without error
  $newDate = date("Y-m-d H:i:s", strtotime($originalDate));

  $data = Array(
    'user_id' => $user_id,
    'date' => $newDate,
    'duration' => $duration,
    'x_coordinate' => $x_coordinate,
    'y_coordinate' => $y_coordinate,
  );

  // we save visit to a visits table
  $db->insert('visits', $data);
  // we create a message that visit saved successfully
  $_SESSION['message'] = '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> Visit saved successfully!
  </div>';

  // redirect user to add_visit page with message
  header('location: ' . URL . 'add_visit.php');
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
</style>

<div class="main">

<div class="row">
  <div class="col-md-6">
    <?php 
    if (isset($_SESSION['message'])) {
      // if there is message saved in session variable we display
      echo $_SESSION['message'];
      // and unset the session variable so it is not displayed again and again
      unset($_SESSION['message']);
    }
    ?>
    <form method="POST" name="add_visit" action="add_visit.php">
      <input type="hidden" name="x_coordinate" value="">
      <input type="hidden" name="y_coordinate" value="">
      <div class="form-group">
        <input type="date" name="date" placeholder="Date" class="form-control">
      </div>

      <div class="form-group">
        <input type="time" name="time" placeholder="Time" class="form-control">
      </div>

      <div class="form-group">
        <input type="text" name="duration" placeholder="Duration" class="form-control">
      </div>

      <div class="form-group">
        <input type="submit" name="submit" value="Submit" class="form-control">
      </div>
    </form>
  </div>

  <div class="col-md-6" style="padding:0;margin:0;">
    <img src="assets/images/exeter.jpg" class="img-fluid map-image" alt="">
  </div>
</div>

</div>

<script>
$(document).ready(function() {

  // if user clicks on map image
  $("img.map-image").on("click", function(event) {
      // we get x and y place where he clicked
      var xCoordinate = event.offsetX;
      var yCoordinate = event.offsetY;
      // console.log(xCoordinate, yCoordinate);

    // we remove previous mark of marker(if it exists)
    $('.marker').remove();

    // we get exact value of click
    var x = event.pageX - this.offsetLeft;
    var y = event.pageY - this.offsetTop;
    
    // we set values to hidden inputs inside form
    $('input[name="x_coordinate"]').val(x);
    $('input[name="y_coordinate"]').val(y);

    // we append marker to place where it was clicked
    $("body").append(
      $('<div class="marker"></div>').css({
        position: 'absolute',
        top: y + 'px',
        left: x + 'px',
        width: '10px',
        height: '10px',
        background: '#000000'
      })
    );
  });

});
</script>

<?php require 'includes/footer.php'; ?>
