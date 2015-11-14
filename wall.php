<?php
require_once "php/functions.php";

session_start();

$userstr = ' (Guest)';

// Check if user is signed in.
  if (isset($_SESSION['user']))
  {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
  }
  else $loggedin = FALSE;

if(isset($_POST['name']) && isset($_POST['title']) && isset($_POST['text']))
{    
    $name = sanitizeString($db, $_POST['name']);
    $title = sanitizeString($db, $_POST['title']);
    $text = sanitizeString($db, $_POST['text']);
    
    $time = $_SERVER['REQUEST_TIME'];
	$file_name = $time . '.jpg';

    if (isset($_POST['filter']))
    {
        $filter = $_POST['filter'];
    }
    else
    {
        $filter = "NULL";
    }

    if ($_FILES)
    {
        $tmp_name = $_FILES['upload']['name'];
        $dstFolder = 'users';
        move_uploaded_file($_FILES['upload']['tmp_name'], $dstFolder . DIRECTORY_SEPARATOR . $file_name);
    }

    SavePostToDB($db, $name, $title, $text, $time, $file_name, $filter);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="COP3813 Homework 8 PHP Photo Sharing App Nick Petty">
    <meta name="author" content="Nick Petty">
    <link rel="icon" href="icons/favicon.ico">
<?php
    echo "    <title>$appname</title>\n";
?>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/jumbotron.css">
    <link rel="stylesheet" href="css/styles.css">
    
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation bar. -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
<?php
                if($loggedin)
                {
echo <<<_END
                <p class="navbar-text">$user
                    <a class="btn btn-lg btn-primary navbar-btn" href="logout.php" role="button">Sign out</a>
                    <a class="btn btn-lg btn-primary navbar-btn" href="form.php" role="button">Post pic</a>
                </p>
_END;
                }
                else
                {
echo <<<_END
                <p class="navbar-text">Not signed in
                    <a class="btn btn-lg btn-primary navbar-btn" href="signup.php" role="button">Sign up</a>
                    <a class="btn btn-lg btn-primary navbar-btn" href="signin.php" role="button">Sign in</a>
                </p>
_END;
                }
?>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php echo getPostcards($db); ?>
    </div>
</body>



<?php $db->close(); ?>