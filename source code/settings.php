<?php require 'includes/config.php'; ?>
<?php 

// check if user is loggedin or not
if (!isset($_SESSION['user_id'])) {
  // if not redirect him to login page
  header('Location: login.php');
  // and exit code execution
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

<div class="col-md-12">
    <h3 class="text-center">Alert Settings</h3>
    <hr>
    <p class="text-center">Here you may change the alert distance and the time span for which the contact tracing will be performed.</p>

    <div class="col-md-5 formDiv">
      <form action="settings.php" method="POST" name="report_form">
        <div class="form-group">
          <label for="">Window</label>
          <select name="window" id="" class="form-control">
            <option value="">Select</option>
            <option value="1">One week</option>
            <option value="2">Two weeks</option>
            <option value="3">Three weeks</option>
            <option value="4">Four weeks</option>
          </select>
        </div>

        <div class="form-group">
          <label for="">Distance</label>
          <input type="text" name="distance" class="form-control" min="1" max="500">
        </div>

        <div class="form-group">
          <input type="submit" name="report" value="Report" class="form-control">
        </div>
      </form>
    </div>

</div>

<script>
$(document).ready(function() {
  function setCookie(cname, cvalue, exdays) {$('.alert').remove();
    // create a new date
    var d = new Date();
    // add days to new created date
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    // set expire time for cookie
    var expires = "expires="+ d.toUTCString();
    // set cookie
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    // show user message
    var message = $(`<div class="alert alert-success alert-dismissible" style="display: none;">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Success!</strong> Settings updated successfully.
    </div>`);
    $('form[name="report_form"]').before(message);
    $(message).fadeIn();
  }

  // code to get cookie value in browser
  function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

  // when user submits the form
  $('form[name="report_form"]').submit(function(e){
    // stop the form submit default behaviour
    e.preventDefault();
    // remove previous alert messages
    $('.alert').remove();

    // get value of window from user input
    var window_number = ($('select[name="window"]').val()).trim();
    // get value of window number from user input
    var distance = ($('input[name="distance"]').val()).trim();

    // if window number is not empty and distance value is greater the 0 and less then 501
    // then set cookie values in browser
    if (window_number != '' && distance > 0 && distance < 501) {
      setCookie('window_number', window_number, 30);
      setCookie('distance', distance, 30);
    }
    
    
  });

});
</script>

<?php require 'includes/footer.php'; ?>