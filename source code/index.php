<?php require 'includes/config.php'; ?>
<?php 

// check if user is loggedin
if (!isset($_SESSION['user_id'])) {
  // if not redirect him to login page
  header('Location: login.php');
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
<h1 class="text-center">Status</h1>
<hr>

<div class="row">
  <div class="col-md-6">
  Hi <?= ucfirst($_SESSION['username']); ?>, you might have had a connection to an infected person the location show in red.
  </div>

  <div class="col-md-6 map-container">
    <img src="assets/images/exeter.jpg" width="600" alt="">
  </div>
</div>

</div>

<script>
$(document).ready(function() {
  // we are getting infected places through ajax request
  $.ajax({
    url: 'ajax.php',
    method: 'GET',
    data: {
      get_infected_places: true
    },
    success: function(success) {
      // for each infected place we are creating a marker
      success.forEach(function(data) {
        $("body").append(
          $('<div class="marker"></div>').css({
            position: 'absolute',
            top: data.y_coordinate + 'px',
            left: data.x_coordinate + 'px',
            width: '10px',
            height: '10px',
            background: '#000000'
          })
        );
      });
    },
    error: function(error) {
      console.log(error);
    }
  });
});
</script>

<?php require 'includes/footer.php'; ?>