<?php
require_once 'db_connect.php';

// The app can be renamed through this variable.
  $appname = "WallPics";

// Sanitizes the username and password strings to prevent injection attacks.
function sanitizeString($_db, $str)
{
    $str = strip_tags($str);
    $str = htmlentities($str);
    $str = stripslashes($str);
    return mysqli_real_escape_string($_db, $str);
}

// Sanitizes the username and password strings to prevent injection attacks. (From homework 7)
  function sanitizeStringHW7($var)
{
    global $db;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $db->real_escape_string($var);
}

function SavePostToDB($_db, $_user, $_title, $_text, $_time, $_file_name, $_filter)
{
	/* Prepared statement, stage 1: prepare query */
	if (!($stmt = $_db->prepare("INSERT INTO WALL(USER_USERNAME, STATUS_TITLE, STATUS_TEXT, TIME_STAMP, IMAGE_NAME, FILTER) VALUES (?, ?, ?, ?, ?, ?)")))
	{
		echo "Prepare failed: (" . $_db->errno . ") " . $_db->error;
	}

	/* Prepared statement, stage 2: bind parameters*/
	if (!$stmt->bind_param('sssssi', $_user, $_title, $_text, $_time, $_file_name, $_filter))
	{
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	/* Prepared statement, stage 3: execute*/
	if (!$stmt->execute())
	{
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
}

function getPostcards($_db)
{
    $query = "SELECT USER_USERNAME, STATUS_TITLE, STATUS_TEXT, TIME_STAMP, IMAGE_NAME FROM WALL ORDER BY TIME_STAMP DESC";
    
    if(!$result = $_db->query($query))
    {
        die('There was an error running the query [' . $_db->error . ']');
    }
    
    $output = '';
    while($row = $result->fetch_assoc())
    {
        $output = $output . '<div class="panel panel-default"><div class="panel-heading">"' . $row['STATUS_TITLE']
        . '" posted by ' . $row['USER_USERNAME'] 
        . '</div><div class="body"><img src="' . $server_root . 'users/' . $row['IMAGE_NAME'] . '" width="300px">' . $row['STATUS_TEXT'] . '</div></div>' ;
    }
    
    return $output;
}

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
?>