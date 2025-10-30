<?php
include('./db.php');

$alert_html_output = userAndEmailAlert();

function userAndEmailAlert() {
    include('./db.php');
    $alertMsg = '';

    if (isset($_POST["register"])) {
        $user = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $confirmpassword = filter_input(INPUT_POST, "confirm-password", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

        if ($pass !== $confirmpassword) {
            return '<div class="alert alert-error">Passwords do not match!</div>';
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
                $alertMsg .= '<div class="alert alert-error">Username already exists!</div>';
            }
            if ($row['user_email'] === $email) {
                $alertMsg .= '<div class="alert alert-error">Email already exists!</div>';
            }
        } else {
            $sql = "INSERT INTO user (username, user_pass, user_email)
                    VALUES ('$user', '$hashed_pass', '$email')";

            if ($conn->query($sql)) {
                $alertMsg .= '
                    <div role="alert" class="alert alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Your account has been created!</span>
                    </div>';
            } else {
                die("Error inserting record: " . $conn->error);
            }
        }

        $conn->close();
    }

    return $alertMsg;
}
?>

<html>
<head>
    <title>Create Account</title>
    <link rel="stylesheet" href="login-signup.css">
</head>
<body>
    <section class="login-section">
        <div class="container">
            <div class="login-box">
                <h2>Create Account</h2>
                <form action="./register.php" method="post">
                <div class="input-group">
                    <input type="text" id="username" name="username" required placeholder=" ">
                    <label for="username">Username</label>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" required placeholder=" ">
                    <label for="email">Email</label>
                </div>
                <div class="input-group">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required placeholder=" "
                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$"
                        title="Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.">
                    <label for="password">Password</label>
                </div>
                <div class="input-group">
                    <input type="password" id="confirm-password" name="confirm-password" required placeholder=" ">
                    <label for="confirm-password">Confirm Password</label>
                </div>
                    <input type="submit" value="Sign Up" name="register" class="login-btn">
                </form>
                <p class="create-account">Already have an account? <a href="login.php">Log In</a></p>
            </div>
        </div>
        <div class="background">

        </div>
    </section>
</body>
</html>