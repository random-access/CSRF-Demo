<?php
  // fetch current session
  session_start();

  // unset session cookie on client
  if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), "", time()-42000, "/");
  }

  // remove all session variables
  session_unset();

  // destroy serverside session data
  session_destroy();

  // redirect to login page
  header("Location: index.php");
?>
