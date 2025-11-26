<?php
session_start();
include "../includes/db.php";

$alert_html_output = userAndEmailAlert();

function userAndEmailAlert()
{
    include "../includes/db.php";
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
                    $user_id = $conn->insert_id;
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $user;
                    $_SESSION['user_email'] = $email;
                    $_SESSION['role'] = "user";
                    header("location: /Maiden-Home/");
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
        <link rel="stylesheet" href="../css/login-signup.css">
        <link rel="stylesheet" href="../css/all.css">
        <style>
            @keyframes slide-to {
            to {
                transform: translateX(0%);
            }
            }

            @keyframes slide-from{
            from {
                transform: translateX(-100%);
            }
            }
        </style>
    </head>
    <body>
        <section class="login-section">
            <div class="background">
                <div class="marquee-row" id="marquee1">
                    <div class="product"><img src="\Maiden-Home/assets/PRODUCTS/Soft-Boucle-Corner-Sofabed-Product-Image-Hover.jpeg" alt=""></div>
                    <div class="product"><img src="\Maiden-Home/assets/PRODUCTS/Colette_4_Over_6_Chest_Of_Drawers_Hover.png" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Farrow_Triple_Wardrobe_with_Drawers_Hover.png" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Farrow-Low-Bookcase-White-Hover.jpg" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Hudson-Tall-Open-Shelf-Unit-White-Hover.jpg" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Alfie-Large-Corner-Sofa-Ice-Hover.jpg" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Ashbury-4-Seater-Sofa-Moss-Hover.jpg" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Kingsbury_White_Wash_Large_Carved_Wood_Table_Lamp_Hover.png" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Amalia_Natural_Ombre_Textured_Stoneware_Table_Lamp_Hover.png" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Biba_White___Brass_3_Light_Electrified_Pendant_Hover.png" alt=""></div>
                </div>
                <div class="marquee-row" id="marquee2">
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Dania_French_Gold_Metal_Wire_Pendant_Hover.png" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Koble_Thea_Upholstered_Swivel_Office_Chair_Hover.png" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Gaming_Chair_Hover.png" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Koble_Alma_Height_Adjustable_Swivel_Office_Chair_Hover.png" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Koble_Gino_Smart_Electric_Height_Adjustable_Corner_Desk_with_Storage_Drawer_Hover.png" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Maze-Pulse-Square-Corner-Dining-Set-Fire-Pit-Product-Image-hover.jpg" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Pulse-U-Shape-Dining-Set-with-Rising-Table-Product-Image-Hover.jpg" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Thalia-2-Seater-Pop-Up-Sofa-Bed-Products-Image-Hover.jpeg" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Regal-Oatmeal-8-Seat-Rectangular-Fire-Pit-Bar-Set-Product-Image-Hover.webp" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Farrow-Full-Hanging-Wardrobe-WIth-Shelf-Product-Image-Hover.jpeg" alt=""></div>
                </div>
                <div class="marquee-row" id="marquee1">
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Alfie_and_Arthur_Universal_Footstool_Hover.png" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Canterbury_Antique_Silver_Metal_Table_Lamp_Hover.png" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Trafalgar_Nickel_Palm_Tree_Floor_Lamp_Hover.png" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Roma_FSC_4_Seater_Round_Sunray_with_Concrete_Insert_Dining_Set_with_Roma_Dining_Chairs_Hover.png" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Stafford-Grey-Velvet-King-Size-Storage-Bed-Roseland-Hover.jpg" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Milo_Mango___Marble_Fluted_Side_Table_with_Door_Hover.png" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Cavendish-Thick-Pile-Shaggy-Berber-Rug-Product-Image-Hover.jpeg" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Bianca_Linen_Armchair_Hover.png" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\Natural_Wood_Veneer_Teardrop_Shaped_Mirror_Hover.png" alt=""></div>
                    <div class="product"><img src="\Maiden-Home\assets\PRODUCTS\CHRISTMAS_ORNAMENT_Hover.jpg" alt=""></div>
                </div>
            </div>
            <div class="container">
                <div class="login-box">
                    <a href="../index.php" style="text-decoration: none;">
                        <div class="logo">
                            <img src="../assets/Logo.png" alt="">
                            <h1>MAIDEN HOME</h1>
                        </div>
                    </a>
                    <h2>Create Account</h2>
                    <br>
                    <form action="./" method="post">
                        <div class="input-group <?php if (!empty($alert_html_output['user_error'])) {echo ' has-error';} ?>">
                            <input type="text" id="username" name="username" required placeholder=" ">
                            <label for="username">Username</label>
                            <?php if (!empty($alert_html_output['user_error'])) {echo $alert_html_output['user_error'];}?>
                        </div>
                        <div class="input-group <?php if (!empty($alert_html_output['email_error'])) {echo ' has-error';} ?>">
                            <input type="email" id="email" name="email" required placeholder=" ">
                            <label for="email">Email</label>
                            <?php if (!empty($alert_html_output['email_error'])) {echo $alert_html_output['email_error'];} ?>
                        </div>
                        <div class="password">
                            <div class="input-group <?php if (!empty($alert_html_output['pass_error'])) {echo ' has-error';} ?>">
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    required placeholder=" "
                                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$"
                                    title="Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.">
                                <label for="password">Password</label>
                                <button type="button" class="toggle-password" id="togglePassword">
                                    <img src="../assets/Show Password/visibility_off_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Show Password">
                                </button>
                                <?php if (!empty($alert_html_output['pass_error'])) {echo $alert_html_output['pass_error'];}?>
                            </div>
                            <div class="input-group <?php if (!empty($alert_html_output['pass_error'])) {echo ' has-error';} ?>">
                                <input type="password" id="confirm-password" name="confirm-password" required placeholder=" ">
                                <label for="confirm-password">Confirm Password</label>
                                <button type="button" class="toggle-password" id="toggleConfirm">
                                    <img src="../assets/Show Password/visibility_off_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Show Password">
                                </button>
                            </div>
                        </div>
                        <input type="submit" value="Sign Up" name="register" class="login-btn">
                        <?php if (!empty($alert_html_output['success'])) {echo $alert_html_output['success'];}?>
                    </form>
                    <p class="create-account">Already have an account? <a href="../login">Log In</a></p>
                </div>
            </div>
        </section>
        <script>
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirm = document.getElementById('toggleConfirm');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm-password');

            function toggleVisibility(input, button) {
                const img = button.querySelector('img');
                const isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';
                button.classList.toggle('active', isHidden);
                img.src = isHidden 
                    ? '../assets/Show Password/visibility_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg' 
                    : '../assets/Show Password/visibility_off_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg';
            }

            togglePassword.addEventListener('click', () => toggleVisibility(password, togglePassword));
            toggleConfirm.addEventListener('click', () => toggleVisibility(confirmPassword, toggleConfirm));
        </script>
    </body>
</html>