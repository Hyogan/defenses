<?php 
function flash($key, $message = null) {
  if ($message) {
      // Set flash message
      $_SESSION['flash'][$key] = $message;
  } elseif (isset($_SESSION['flash'][$key])) {
      // Retrieve and delete flash message (so it only appears once)
      $msg = $_SESSION['flash'][$key];
      unset($_SESSION['flash'][$key]);
      return $msg;
  }
  return null;
}

function dd($variable) {
  echo "<pre>";
  print_r($variable); // Use print_r for array display
  echo "</pre>";
  die();
}

