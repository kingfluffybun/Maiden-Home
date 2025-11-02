<?php
session_start();
include("./db.php");

$alert_html_output = userAndPassCorrect();

function userAndPassCorrect(){

    global $conn;
    $alert_msg = ['user_error' => '', 'pass_error' => ''];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["login"])) {
        $user = trim(filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS));
        $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "SELECT username, user_email, user_pass FROM user WHERE username='$user' or user_email='$user' LIMIT 1";
        $res = mysqli_query($conn, $sql);

    if ($res && $res->num_rows > 0) {
            $row = mysqli_fetch_assoc($res);
    
            if (password_verify($pass, $row['user_pass'])) {
                $_SESSION['user_email'] = $row['user_email'];
                $_SESSION['username'] = $row['username'];

                if (isset($_POST['remember'])) {
                    setcookie("username", $row['username'], time() + (86400 * 30), "/"); 
                    setcookie("user_email", $row['user_email'], time() + (86400 * 30), "/");
                }

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
            <div class="back-button">
                    <a href="./homepage.php">
                        Logo
                    </a>
                </div>
            <div class="container">
                <div class="login-box">
                    <h2>Log In</h2>
                    <?php if (isset($_GET['registered']) && $_GET['registered'] == 1): ?>
                        <div class="alert-msg success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M9 12l2 2l4-4"></path>
                            </svg>
                        <p>Your account has been created successfully! Please log in.</p>
                    </div>
                    <?php endif; ?>

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
                        </div>
                        <div class="remember-forgot">
                            <div class="remember-me">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Remember Me</label>
                            </div>
                            <div class="forgot-password">
                                <a href="forgotPassword.html">Forgot Password?</a>
                            </div>
                            <!--To here-->
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