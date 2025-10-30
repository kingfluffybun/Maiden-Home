<?php
session_start();
include("./db.php");

$alert_html_output = userAndPassCorrect();

function userAndPassCorrect(){

    include("./db.php");
    $alertMsg = '';

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
        <link rel="stylesheet" href="login-signup.css">
    </head>
    <body>
        <section class="login-section">
            <div class="container">
                <div class="login-box">
                    <h2>Log In</h2>
                    <form method="POST">
                        <div class="input-group">
                            <input type="text" id="username" name="user" required placeholder=" ">
                            <label for="username">Email / Username</label>
                        </div>
                        <div class="input-group">
                            <input type="password" id="password" name="pass" required placeholder=" ">
                            <label for="password">Password</label>
                            <div class="forgot-password">
                                <a href="forgotPassword.html">Forgot Password?</a>
                            </div>
                        </div>
                        <input type="submit" class="login-btn" value="Log In" name="login">
                    </form>
                        <p class="create-account">New user? <a href="register.php">Create New Account</a></p>
                    </div>
                    <div class=" w-fit gap-2 flex-col flex min-h-30">
                        <?php
                            echo $alert_html_output;
                        ?>
                    </div>
                </div>
            </div>
            <div class="background">
                
            </div>
        </section>
    </body>
</html>