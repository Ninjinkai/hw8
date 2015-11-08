<?php
  require_once 'header.php';

// Check if user is signed in.  Sign them out if they are, otherwise direct to index.
  if (isset($_SESSION['user']))
  {
    destroySession();
// Show sign out confirmation, direct to index.
echo <<<_END
  <script>
      $("#primaryForm").remove();
  </script>
  <div class='main container'>You have been signed out. Please <a href='index.php'>click here</a> to refresh the screen.
_END;
  }
  else
  {
// If a user reaches this page without being signed in, they are directed to the index.
echo <<<_END
  <script>
      $("#primaryForm").remove();
    </script>
  <div class='main container'>You cannot sign out because you are not signed in. Please <a href='index.php'>click here</a> to sign in or sign up.
_END;
  }

  $db->close();
?>
      </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
