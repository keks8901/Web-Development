<?php 

// include config.php for database connection and clean input function
require 'includes/config.php';

// if user is not logged in give message
if (!isset($_SESSION['user_id'])) {
  echo 'Signin';
  exit;
}

// if get request sent to delete visit
if (isset($_GET['delete_visit'])) {
  // save visit id 
  $visit_id = clean_input($_GET['visit_id']);

  // delete visit from visits table where id is equal to the sent one
  $db->delete('visits', ['id' => $visit_id]);
  // send message video deleted successfully
  echo 'deleted';
  // exit code execution
  exit;
}

// if get request received for infected places
if (isset($_GET['get_infected_places'])) {
  // from database get ids of users have reported infection
  $infected_user_ids = $db->multiple_row("SELECT DISTINCT user_id FROM infections WHERE user_id != $_SESSION[user_id]");

  // get window number from cookie
  $window_number = $_COOKIE["window_number"];
  // if there is only one infected user
  // we will fetch visits for only one user
  // if they are more then one we will need lot of where queries
  if (count($infected_user_ids) < 2) {
    $where_condition = "user_id = $iui[user_id]";
  } else {
    $where_condition = '';
    foreach ($infected_user_ids as $iui) {
      $where_condition .= "user_id = $iui[user_id] OR ";
    }
    $where_condition .= "FALSE";
  }
  $sql = "SELECT * FROM visits WHERE $where_condition";
  // we fetch all visits of all infected users
  $infected_user_visits = $db->multiple_row($sql);
  // we set header as json so data is set as json
  header('Content-Type: application/json');
  // we send back json data back to browser
  echo json_encode($infected_user_visits);
}