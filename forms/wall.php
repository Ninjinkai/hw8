<?php
session_start();

// Begin HTML header.
  echo "<!DOCTYPE html>\n<html>\n<head>\n";

// Connect to database.
  require_once 'functions.php';

  $userstr = ' (Guest)';

// Check if user is signed in.
  if (isset($_SESSION['user']))
  {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
  }
  else $loggedin = FALSE;
?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="photo sharing php COP3813 Nick Petty homework 7">
	<meta name="author" content="Nick Petty">
	<link rel="icon" href="icons/favicon.ico">
<?php
echo "  <title>$appname</title>\n";
?>
	<!-- Stylesheets -->
	<link rel='stylesheet' href='css/bootstrap.css' type='text/css'>
	<link rel='stylesheet' href='css/jumbotron.css' type='text/css'>
	<!-- Javascript -->
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<?php
if ($loggedin)
	{
// Placeholder HTML for photo sharing wall.  Allows pictures and text.
echo <<<_END
		<!-- Navigation bar. -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<p class="navbar-text">$user
						<a class="btn btn-lg btn-primary navbar-btn" href="logout.php" role="button">Sign out</a>
						<a class="btn btn-lg btn-primary navbar-btn" href="#" role="button">Post a pic</a>
					</p>
				</div>
			</div>
		</nav>
		<!-- Page content. -->
		<div class="container well">
			<div class="row">
				<div class="col-md-8">
					<img src="https://upload.wikimedia.org/wikipedia/commons/8/8e/Solna_Brick_wall_Stretcher_bond_variation1.jpg" width="100%"" />
				</div>
				<div class="col-md-4">
					<p>Posted by:<br>Nick<br>Description:<br>A wall pic.</p>
				</div>
			</div>
		</div>

_END;
	}
else
	{
// Redirect to index page if visitor is not signed in.
echo <<<_END
	<div class="main container">
		<p>You must <a href="index.php" role="button">sign in</a> to view this page.</p>
	</div>
_END;
	}

	$db->close();
?>
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>