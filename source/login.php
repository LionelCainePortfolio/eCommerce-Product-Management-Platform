<!DOCTYPE html>
<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit();
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Wprowadź nazwę użytkownika.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Wprowadź hasło.";
    } else {
        $password = trim($_POST["password"]);
    }
    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql =
            "SELECT id, username, password FROM users_platform WHERE username = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result(
                        $stmt,
                        $id,
                        $username,
                        $hashed_password
                    );
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: index.php");
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Nieprawidłowy login lub hasło.";
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_err = "Nieprawidłowy login lub hasło.";
                }
            } else {
                echo "Oops! Coś poszło nie tak! Spróbuj ponownie później.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($conn);
}
?>
 


<html lang="pl">
<head>
  <title>Alione Platforma - logowanie</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main_login.css">
<!--===============================================================================================-->
  <script src="alertify.js"></script>

<style>





.alertify,
.alertify-show,
.alertify-log {
  -webkit-transition: all 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -moz-transition: all 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -ms-transition: all 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -o-transition: all 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
  transition: all 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
  /* easeOutBack */
}

.alertify-hide {
  -webkit-transition: all 250ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  -moz-transition: all 250ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  -ms-transition: all 250ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  -o-transition: all 250ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  transition: all 250ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  /* easeInBack */
}

.alertify-log-hide {
  -webkit-transition: all 500ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  -moz-transition: all 500ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  -ms-transition: all 500ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  -o-transition: all 500ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  transition: all 500ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  /* easeInBack */
}

.alertify-cover {
  position: fixed;
  z-index: 99999;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: white;
  filter: alpha(opacity=0);
  opacity: 0;
}

.alertify-cover-hidden {
  display: none;
}

.alertify {
  position: fixed;
  z-index: 99999;
  top: 50px;
  left: 50%;
  width: 550px;
  margin-left: -275px;
  opacity: 1;
}

.alertify-hidden {
  -webkit-transform: translate(0, -150px);
  -moz-transform: translate(0, -150px);
  -ms-transform: translate(0, -150px);
  -o-transform: translate(0, -150px);
  transform: translate(0, -150px);
  opacity: 0;
  display: none;
}

/* overwrite display: none; for everything except IE6-8 */
:root * > .alertify-hidden {
  display: block;
  visibility: hidden;
}

.alertify-logs {
  position: fixed;
  z-index: 5000;
  bottom: 10px;
  right: 10px;
  width: 300px;
}

.alertify-logs-hidden {
  display: none;
}

.alertify-log {
  display: block;
  margin-top: 10px;
  position: relative;
  right: -300px;
  opacity: 0;
}

.alertify-log-show {
  right: 0;
  opacity: 1;
}

.alertify-log-hide {
  -webkit-transform: translate(300px, 0);
  -moz-transform: translate(300px, 0);
  -ms-transform: translate(300px, 0);
  -o-transform: translate(300px, 0);
  transform: translate(300px, 0);
  opacity: 0;
}

.alertify-dialog {
  padding: 25px;
}

.alertify-resetFocus {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}

.alertify-inner {
  text-align: center;
}

.alertify-text {
  margin-bottom: 15px;
  width: 100%;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  font-size: 100%;
}

.alertify-button,
.alertify-button:hover,
.alertify-button:active,
.alertify-button:visited {
  background: none;
  text-decoration: none;
  border: none;
  /* line-height and font-size for input button */
  line-height: 1.5;
  font-size: 100%;
  display: inline-block;
  cursor: pointer;
  margin-left: 5px;
}

@media only screen and (max-width: 680px) {
  .alertify,
  .alertify-logs {
    width: 90%;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }

  .alertify {
    left: 5%;
    margin: 0;
  }
}
/**
 * Default Look and Feel
 */
.alertify,
.alertify-log {
  font-family: sans-serif;
}

.alertify {
  background: #FFF;
  border: 10px solid #333;
  /* browsers that don't support rgba */
  border: 10px solid rgba(0, 0, 0, 0.7);
  border-radius: 8px;
  box-shadow: 0 3px 3px rgba(0, 0, 0, 0.3);
  -webkit-background-clip: padding;
  /* Safari 4? Chrome 6? */
  -moz-background-clip: padding;
  /* Firefox 3.6 */
  background-clip: padding-box;
  /* Firefox 4, Safari 5, Opera 10, IE 9 */
}

.alertify-text {
  border: 1px solid #CCC;
  padding: 10px;
  border-radius: 4px;
}

.alertify-button {
  border-radius: 4px;
  color: #FFF;
  font-weight: bold;
  padding: 6px 15px;
  text-decoration: none;
  text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.5);
  box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.5);
  background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0));
  background-image: -moz-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0));
  background-image: -ms-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0));
  background-image: -o-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0));
  background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0));
}

.alertify-button:hover,
.alertify-button:focus {
  outline: none;
  background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.1), transparent);
  background-image: -moz-linear-gradient(top, rgba(0, 0, 0, 0.1), transparent);
  background-image: -ms-linear-gradient(top, rgba(0, 0, 0, 0.1), transparent);
  background-image: -o-linear-gradient(top, rgba(0, 0, 0, 0.1), transparent);
  background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0));
}

.alertify-button:focus {
  box-shadow: 0 0 15px #2B72D5;
}

.alertify-button:active {
  position: relative;
  box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
}

.alertify-button-cancel,
.alertify-button-cancel:hover,
.alertify-button-cancel:focus {
  background-color: #FE1A00;
  border: 1px solid #D83526;
}

.alertify-button-ok,
.alertify-button-ok:hover,
.alertify-button-ok:focus {
  background-color: #5CB811;
  border: 1px solid #3B7808;
}

.alertify-log {
  background: #1F1F1F;
  background: rgba(0, 0, 0, 0.9);
  padding: 15px;
  border-radius: 4px;
  color: #FFF;
  text-shadow: -1px -1px 0 rgba(0, 0, 0, 0.5);
}

.alertify-log-error {
  background: #FE1A00;
  background: rgba(254, 26, 0, 0.9);
}

.alertify-log-success {
  background: #5CB811;
  background: rgba(92, 184, 17, 0.9);
}
.invalid-feedback{
  color: red;
    font-size: 11px;
    /* text-align: right; */
    /* width: 100%; */
    right: 0px;
    position: absolute;
    /* margin-top: -40px; */
    margin-top: 10px;
}



  </style>
                  <?php if (!empty($login_err)) {
                 echo '<script> alertify.error("' .
                     $login_err .
                     '"); </script>';
             } ?>
</head>

<body>
  
  <div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
      <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">


        <form class="login100-form validate-form" action="<?php echo htmlspecialchars(
        $_SERVER["PHP_SELF"]
    ); ?>" method="post">
          <span class="login100-form-title p-b-49">
            Zaloguj się
          </span>

          <div class="wrap-input100 validate-input m-b-23" data-validate = "Login jest wymagany">
            <span class="label-input100">Login</span>
            <input class="input100  <?php echo !empty($username_err)
          ? "is-invalid"
          : ""; ?>" type="text" name="username" value="<?php echo $username; ?>" placeholder="Wprowadź swój login">
            <span class="focus-input100" data-symbol="&#xf206;"></span>
                     <span class="invalid-feedback"><?php echo $username_err; ?></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Hasło jest wymagane">
            <span class="label-input100">Hasło</span>
            <input class="input100  <?php echo !empty($password_err)
          ? "is-invalid"
          : ""; ?>" type="password" name="password" placeholder="Wprowadź swoje hasło">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
          </div>
          
          <div class="container-login100-form-btn" style="    margin-top: 40px;">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button type="submit" class="login100-form-btn" value="Zaloguj">Zaloguj</button>

            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
  
<!--===============================================================================================-->
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/daterangepicker/moment.min.js"></script>
  <script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="js/main.js"></script>

</body>
</html>