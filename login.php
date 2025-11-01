<?php
session_start();
include("./db.php");

$alert_html_output = userAndPassCorrect();

function userAndPassCorrect(){

    include("./db.php");
    $alert_msg = ['user_error' => '', 'pass_error' => ''];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["login"])) {
        $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "SELECT username, user_email, user_pass FROM user WHERE username='$user' or user_email='$user' LIMIT 1";
        $res = mysqli_query($conn, $sql);
        
    if ($res && $res->num_rows > 0) {
            $row = mysqli_fetch_assoc($res);
    
            if (password_verify($pass, $row['user_pass'])) {
                $_SESSION['user_email'] = $user;
                $_SESSION['username'] = $row['username'];
                header("Location: ./homepage.php");
                exit;
            }
            else {
                $alert_msg['pass_error'] .= 
                '<div class="alert-msg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                    <p>Incorrect Password</p>
                </div>';
            }
        } else {
            $alert_msg['user_error'] .= 
            '<div class="alert-msg">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                <p>User not found</p>
            </div>';
        }
    } return $alert_msg;
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="login-signup.css">
    </head>
    <body>
        <section class="login-section">
            <div class="container">
                <div class="login-box">
                    <h2>Log In</h2>
                    <form method="POST">
                        <div class="input-group <?php if (!empty($alert_html_output['user_error'])) {echo ' has-error';} ?>">
                            <input type="text" id="username" name="user" required placeholder=" ">
                            <label for="username">Email / Username</label>
                            <?php
                                if (!empty($alert_html_output['user_error'])) {
                                    echo $alert_html_output['user_error'];
                                }
                            ?>
                        </div>
                        <div class="input-group <?php if (!empty($alert_html_output['pass_error'])) {echo ' has-error';} ?>">
                            <input type="password" id="password" name="pass" required placeholder=" ">
                            <label for="password">Password</label>
                            <?php
                                if (!empty($alert_html_output['pass_error'])) {
                                    echo $alert_html_output['pass_error'];
                                }
                            ?>
                            <div class="forgot-password">
                                <a href="forgotPassword.html">Forgot Password?</a>
                            </div>
                        </div>
                        <input type="submit" class="login-btn" value="Log In" name="login">
                    </form>
                    <p class="create-account">New user? <a href="register.php">Create New Account</a></p>
                </div>
            </div>
            <div class="background">
                
            </div>
        </section>
    </body>
</html>