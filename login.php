<?php
session_start();
include("./db.php");

$alert_html_output = userAndPassCorrect();

function userAndPassCorrect(){

    include("./db.php");
    $alertMsg = '';

    if (isset($_POST["login"])) {
        $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "SELECT username, user_email FROM user WHERE username='$user' or user_email='$user' LIMIT 1";
        $res = mysqli_query($conn, $sql);

    if ($res && $res->num_rows > 0) {
            $row = mysqli_fetch_assoc($res);

            if ($pass === $row['user_password']) {
                $_SESSION['user_email'] = $user;
                $_SESSION['username'] = $row['username'];
                header("Location: ./homepage.php");
                exit;
            }
            else {
                $alertMsg .= "Incorrect password.";
            }
        } else {
            $alertMsg .= "User not found.";
        }
    }
    return $alertMsg;   
}

?>

<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="login-signup.css" />
  </head>
  <body>
    <nav></nav>
    <section class="login">
    <div class="container">
      <div class="login-box">
        <h2>Log In</h2>
        <form>
          <div class="input-group">
            <input
              type="text"
              id="username"
              name="username"
              required
              placeholder=" "
            />
            <label for="username">Email / Username</label>
          </div>
          <div class="input-group">
            <input
              type="password"
              id="password"
              name="password"
              required
              placeholder=" "
            />
            <label for="password">Password</label>
            <div class="forgot-password">
              <a href="forgotPassword.html">Forgot Password?</a>
            </div>
          </div>
          <button type="submit" class="login-btn">Log In</button>
        </form>
        <p class="create-account">
          New user? <a href="createAccount.html">Create New Account</a>
        </p>
      </div>
    </div>
    </section>
  </body>
</html>
