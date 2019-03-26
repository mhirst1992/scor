<?php
  $signin_page = 1;
  
  require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';

 
  // Define variables and initialize with empty values
  $email = $password = $user_ID = "";
  $email_err = $password_err = "";
 
  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = trim($_POST["inputEmail"]);
    $password = trim($_POST["inputPassword"]);
  
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
      // Prepare a select statement
      $sql = "SELECT email, password, userID, displayname FROM core_Users WHERE lower(email) = ?";
      
      if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_email);
            
        // Set parameters
        $param_email = strtolower($email);
            
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
          // Store result
          mysqli_stmt_store_result($stmt);
                
          // Check if email exists, if yes then verify password
          if(mysqli_stmt_num_rows($stmt) == 1){                    
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $email, $hashedpassword, $userID, $displayname);
            if(mysqli_stmt_fetch($stmt)){
              //echo $password, " ", $hashed_password, " ", password_hash($password, PASSWORD_DEFAULT);
              if(password_verify($password, $hashedpassword)){
                /* Password is correct, so start a new session and
                save the email to the session */
                session_start();
                
                $_SESSION['userID'] = $userID;
                $_SESSION['displayname'] = $displayname;
                LogFile("newfile.txt", "user id " . $_SESSION['userID'] . ", " . $_SESSION['displayname'] . ", logged in");
                
                header("location: ../../index.php");
              } else{
                // Display an error message if password is not valid
                $password_err = '<div class="alert alert-danger" role="alert">The password you entered was not valid.</div>';
              }
            }
          } else{
            // Display an error message if email doesn't exist
            $email_err = '<div class="alert alert-danger" role="alert">No account found with that email.</div>' . $email . 'test';
          }
        } else{
          echo "Oops! Something went wrong. Please try again later.";
        }
      }
        
      // Close statement
      mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
  }
  else{
  }

?>





<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin | SCOR Manager</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>

  <body class="text-center container" style="width: 300px; margin-top: 5rem;">
    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
      <div id="errorbox">
        <?php echo $email_err;?>
        <br>
        <?php echo $password_err;?>
      </div>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
    </form>
    
    
    
  </body>
</html>