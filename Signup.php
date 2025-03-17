<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Cozy Kitchen Delights</title>
    <link rel="stylesheet" type="text/css" href="css/Signup.css" />
</head>

<body>

    <div class="container">
        <!-- ✅ Success Message -->
        <?php if (isset($_GET['signup']) && $_GET['signup'] == 'success'): ?>
            <div class="alert alert-success text-center">
                Registration successful! Redirecting to home page...
            </div>
            <script>
                setTimeout(function () {
                    window.location.href = 'index.php';
                }, 3000);
            </script>
        <?php endif; ?>

        <!-- ✅ Error Message Handling -->
        <?php if (isset($_GET['signup']) && $_GET['signup'] == 'failed'): ?>
            <div class="alert alert-danger text-center">
                <?php
                if ($_GET['error'] == 'password_mismatch') {
                    echo "Passwords do not match. Please try again.";
                } elseif ($_GET['error'] == 'user_exists') {
                    echo "Username or email is already taken.";
                } else {
                    echo "Signup failed. Please try again.";
                }
                ?>
            </div>
        <?php endif; ?>

        <!-- ✅ Title Section -->
        <div class="title">Registration</div>
        <div class="content">
            <!-- ✅ Registration Form -->
            <form action="actions/signup.php" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Full Name</span>
                        <input type="text" name="full_name" placeholder="Enter your name" required />
                    </div>
                    <div class="input-box">
                        <span class="details">Username</span>
                        <input type="text" name="username" placeholder="Enter your username" required />
                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="email" name="email" placeholder="Enter your email" required />
                    </div>
                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="text" name="phone_number" placeholder="Enter your phone number" required />
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="password" placeholder="Enter your password" required />
                    </div>
                    <div class="input-box">
                        <span class="details">Confirm Password</span>
                        <input type="password" name="confirm_password" placeholder="Confirm your password" required />
                    </div>
                </div>

                <!-- ✅ Gender Selection -->
                <div class="gender-details">
                    <input type="radio" name="gender" id="dot-1" value="Male" required />
                    <input type="radio" name="gender" id="dot-2" value="Female" required />
                    <input type="radio" name="gender" id="dot-3" value="Prefer not to say" required />
                    <span class="gender-title">Gender</span>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="gender">Male</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="gender">Female</span>
                        </label>
                        <label for="dot-3">
                            <span class="dot three"></span>
                            <span class="gender">Prefer not to say</span>
                        </label>
                    </div>
                </div>

                <!-- ✅ Register Button -->
                <div class="button">
                    <input type="submit" value="Register" />
                </div>
            </form>
        </div>
    </div>

</body>

</html>