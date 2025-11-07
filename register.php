<?php
include("includes/db.php");

$alert_html_output = userAndEmailAlert();

function userAndEmailAlert()
{
    include("includes/db.php");
    $alert_msg = ['user_error' => '', 'pass_error' => '', 'email_error' => '', 'success' => ''];

    if (isset($_POST["register"])) {
        $user = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $confirmpassword = filter_input(INPUT_POST, "confirm-password", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

        if ($pass !== $confirmpassword) {
            $alert_msg['pass_error'] =
                '<div class="alert-msg">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                <p>Password do not match!</p>
            </div>';
        }

        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM user WHERE username='$user' OR user_email='$email'";
        $res = $conn->query($sql);

        if ($res === false) {
            die("Database query failed: " . $conn->error);
        }

        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            if ($row['username'] === $user) {
                $alert_msg['user_error'] .= '<div class="alert-msg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                    <p>Username already exists!</p>
                </div>';
            }
            if ($row['user_email'] === $email) {
                $alert_msg['email_error'] .= '<div class="alert-msg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                    <p>Email already exists!</p>
                </div>';
            }
        } else {
            if ($pass !== $confirmpassword) {
                $alert_msg['pass_error'] =
                    '<div class="alert-msg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                    <p>Password do not match!</p>
                </div>';
            } else {
                $sql = "INSERT INTO user (username, user_pass, user_email)
                    VALUES ('$user', '$hashed_pass', '$email')";
                if ($conn->query($sql)) {
                    header("location: login.php?registered=1");
                    exit;
                } else {
                    die("Error inserting record: " . $conn->error);
                }
            }
        }
        $conn->close();
    }
    return $alert_msg;
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="css/login-signup.css">
</head>

<body>
    <section class="login-section">
        <div class="container">
            <div class="login-box">
                <h2>Create Account</h2>
                <form action="./register.php" method="post">
                    <div class="input-group <?php if (!empty($alert_html_output['user_error'])) {
                                                echo ' has-error';
                                            } ?>">
                        <input type="text" id="username" name="username" required placeholder=" ">
                        <label for="username">Username</label>
                        <?php
                        if (!empty($alert_html_output['user_error'])) {
                            echo $alert_html_output['user_error'];
                        }
                        ?>
                    </div>
                    <div class="input-group <?php if (!empty($alert_html_output['email_error'])) {
                                                echo ' has-error';
                                            } ?>">
                        <input type="email" id="email" name="email" required placeholder=" ">
                        <label for="email">Email</label>
                        <?php
                        if (!empty($alert_html_output['email_error'])) {
                            echo $alert_html_output['email_error'];
                        }
                        ?>
                    </div>
                    <div class="password">
                        <div class="input-group <?php if (!empty($alert_html_output['pass_error'])) {
                                                    echo ' has-error';
                                                } ?>">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                required placeholder=" "
                                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$"
                                title="Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.">
                            <label for="password">Password</label>
                            <?php
                            if (!empty($alert_html_output['pass_error'])) {
                                echo $alert_html_output['pass_error'];
                            }
                            ?>
                        </div>
                        <div class="input-group <?php if (!empty($alert_html_output['pass_error'])) {
                                                    echo ' has-error';
                                                } ?>">
                            <input type="password" id="confirm-password" name="confirm-password" required placeholder=" ">
                            <label for="confirm-password">Confirm Password</label>
                        </div>
                    </div>
                    <input type="submit" value="Sign Up" name="register" class="login-btn">
                    <?php
                    if (!empty($alert_html_output['success'])) {
                        echo $alert_html_output['success'];
                    }
                    ?>
                </form>
                <p class="create-account">Already have an account? <a href="login.php">Log In</a></p>
            </div>
        </div>
        <div class="background">

        </div>
    </section>
</body>

</html>