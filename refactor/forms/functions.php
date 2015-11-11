<?php
  require_once 'db_connect.php';

// The app can be renamed through this variable.
  $appname = "WallPics";

// Runs a MySQL query and returns results or an error message.
  function queryMysql($query)
  {
    global $db;
    $result = $db->query($query);
    if (!$result) die($db->error);
    return $result;
  }

// Ends the signed in session.
  function destroySession()
  {
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
  }

// Sanitizes the username and password strings.
  function sanitizeString($var)
  {
    global $db;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $db->real_escape_string($var);
  }
?>
