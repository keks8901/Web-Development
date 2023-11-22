<?php require 'includes/config.php'; ?>
<?php 

// check if user is logged in
if (!isset($_SESSION['user_id'])) {
  // if not redirect him to login page
  header('Location: login.php');
  // exit code execution
  exit;
}

// select all visits of loggedin user ordered by date in descending order
$visits = $db->multiple_row("SELECT * FROM visits WHERE user_id = $_SESSION[user_id] ORDER BY date ASC");

?>
<?php require 'includes/header.php'; ?>
<?php require 'includes/navigation.php'; ?>

<style>
hr {
  border: 1px solid black;
}

tr:hover {
  background-color:#f5f5f5;
}

td:nth-child(6) {
  color: red !important;
}

td:nth-child(6):hover {
  cursor: pointer;
}
</style>

<div class="main">

<table class="table">
  <thead>
    <tr>
      <td>Date</td>
      <td>Time</td>
      <td>Duration</td>
      <td>X</td>
      <td>Y</td>
      <td></td>
    </tr>
  </thead>
  <tbody>
    <?php foreach($visits as $visit): ?>
      <tr>
        <?php 
        $date = date_format(date_create($visit['date']),"d-m-Y");
        $time = date_format(date_create($visit['date']),"H:i");
        ?>
        <td><?= $date; ?></td>
        <td><?= $time; ?></td>
        <td><?= $visit['duration']; ?></td>
        <td><?= $visit['x_coordinate']; ?></td>
        <td><?= $visit['y_coordinate']; ?></td>
        <td class="delete-visit" data-id="<?= $visit['id'] ?>">X</td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</div>

<script>
$(document).ready(function() {
  // when user clicks delete icon
  $('.delete-visit').click(function() {
    var tr = $(this).parent('tr');
    // get visit_id for deleting visit
    var visit_id = $(this).attr('data-id');
    // confirm if he really wants to delete
    var confirm_value = confirm('Are you sure ?');
    // if confirmed 
    // make ajax request to server for deleting user visit
    if (confirm_value) {
      $.ajax({
        url: 'ajax.php',
        method: 'GET',
        data: {
          delete_visit: 'true',
          visit_id: visit_id
        },
        success: function(data) {
          // if visit is deleted from server side
          // that visit data is also removed from user side
          if (data == 'deleted') {
            $(tr).fadeOut();
          }
        },
        error: function(error) {
          console.log(error);
        }
      });
    }
  });

});
</script>
<?php require 'includes/footer.php'; ?>
