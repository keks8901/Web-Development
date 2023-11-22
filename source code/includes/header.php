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
    *,body,.container-fluid {
      margin: 0;
      padding: 0;
    }

    .top {
      background: #adb9ca;
    }
    .top > h1 {
      padding-top: 20px;
      padding-bottom: 20px;
    }

  /* The sidebar menu */
  .sidenav {
    height: 100%; /* Full-height */
    width: 160px; /* Set the width of the sidebar */
    position: fixed; /* Fixed Sidebar (stay in place on scroll) */
    z-index: 1; /* Stay on top */
    top: 88px; /* Stay at the top */
    left: 0;
    background-color: #adb9ca; /* Black */
    overflow-x: hidden; /* Disable horizontal scroll */
    padding-top: 20px;
  }

  /* The navigation menu links */
  .sidenav a {
    padding: 6px 8px 6px 16px;
    text-decoration: none;
    font-size: 25px;
    color: #000000;
    display: block;
  }

  .sidenav > a.logout {
    position: fixed;
    bottom: 0px;
  }

  /* When you mouse over the navigation links, change their color */
  .sidenav a:hover,.sidenav a.logout:hover {
    background-color: #8497b0;
    color: #f1f1f1;
  }

  /* Style page content */
  .main {
    margin-left: 160px; /* Same as the width of the sidebar */
    padding: 0px 10px;
  }

  /* On smaller screens, where height is less than 450px, change the style of the sidebar (less padding and a smaller font size) */
  @media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
  }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="top">
      <h1 class="text-center">COVID - 19 Contact Tracing</h1>
    </div>